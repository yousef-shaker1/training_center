<?php

namespace App\Http\Controllers\api;

use App\Models\contact;
use App\ApirequestTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\MessageResource;

class Customer_messagesController extends Controller
{
    use ApirequestTrait;
    public function index(){
        $message = MessageResource::collection(contact::all());
        return $this->apiResponse($message, 'ok',200);
    }

    
    public function create_message(Request $request){
        try{
            $validator = $request->validate([
                'name' => 'required|min:2|max:80',
                'email' => 'required|email|unique:contacts,email',
                'message' => 'required|min:2|max:90',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 400);
        }
        $Comment_Blog = contact::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'message' => $request->message,
        ]);
        if(!$Comment_Blog){
            return $this->apiResponse(null, 'blog not found', 404);
        }
        return $this->apiResponse(new MessageResource($Comment_Blog), 'create message success', 200);
    }
    
    public function delete(Request $request, $id){
        $message = contact::find($id);
        if(!$message){
            return $this->apiResponse(null, 'not found',200);
        } 
        try{
                $message->delete();
        } catch(\Exception $e){
            return $this->apiResponse(null, 'not found',200);
        }
        return $this->apiResponse(null, 'delete success',200);
    }
}
