<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'roles_name' => 'required',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'roles_name' => ["$request->roles_name"],
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function profile()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

                return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

                return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

                return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function refresh()
    {
        try {
            $newToken = JWTAuth::parseToken()->refresh();
            return response()->json([
                'token' => $newToken
            ]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_refresh_token'], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken());
            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_invalidate_token'], 500);
        }
    }


    
    public function googlepage(){
        $googleUrl = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
    
        return response()->json(['url' => $googleUrl], 200);
    }

    public function googlecallback(Request $request)
    {
        try {
            $code = $request->get('code');

            $response = Http::post('https://oauth2.googleapis.com/token', [
                'code' => $code,
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'redirect_uri' => config('services.google.redirect'),
                'grant_type' => 'authorization_code',
            ]);

            if ($response->failed()) {
                return response()->json([
                    'message' => 'Failed to retrieve access token',
                    'error' => $response->json(),
                ], $response->status());
            }

            $data = $response->json();

            if (isset($data['access_token'])) {
                // Retrieve user info using the access token
                $userResponse = Http::withToken($data['access_token'])
                    ->get('https://www.googleapis.com/oauth2/v3/userinfo');

                // Check if the user response was successful
                if ($userResponse->failed()) {
                    return response()->json([
                        'message' => 'Failed to retrieve user info',
                        'error' => $userResponse->json(),
                    ], $userResponse->status());
                }

                $userData = $userResponse->json();

                // Check if required fields exist in user data
                if (!isset($userData['email']) || !isset($userData['name']) || !isset($userData['sub'])) {
                    return response()->json([
                        'message' => 'Invalid user data received from Google',
                    ], 400);
                }

                // Check if the user already exists in the database
                $user = User::where('email', $userData['email'])->first();

                if ($user) {
                    // If the user exists, log them in
                    Auth::login($user);
                } else {
                    // If the user doesn't exist, create a new user
                    $user = User::create([
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'password' => Hash::make(uniqid()), // Create a random password
                        'roles_name' => [$userData['roles_name']],
                        'google_id' => $userData['sub'], // Store Google ID
                    ]);

                    Auth::login($user);
                }

                // Generate a JWT token for the user
                $token = JWTAuth::fromUser($user);

                // Return a success response with the token
                return response()->json([
                    'message' => 'User logged in successfully',
                    'user' => $user,
                    'token' => $token,
                ]);
            } else {
                return response()->json([
                    'message' => 'Access token not found in response',
                    'response' => $data,
                ], 400);
            }
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return response()->json([
                'message' => 'Authentication failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
        
}

