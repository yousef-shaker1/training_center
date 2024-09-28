<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Training Hub Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: linear-gradient(120deg, #3498db, #8e44ad);
            font-family: 'Roboto', sans-serif;
        }
        .login-box {
            margin-top: 32px;
            height: auto;
            background: white;
            text-align: center;
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
        }
        .login-box h2 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border: none;
            border-bottom: 2px solid #3498db;
            margin-bottom: 20px;
            border-radius: 0;
            font-size: 18px; /* زيادة حجم الخط */
            padding-left: 10px;
            padding: 15px; /* زيادة ارتفاع الحقول */
            width: 100%;
        }
        .form-control:focus {
            border-color: #8e44ad;
            box-shadow: none;
        }
        .btn-primary {
            background: #3498db;
            border: none;
            width: 100%;
            font-size: 20px; /* تكبير حجم النص في الزر */
            padding: 15px; /* زيادة حجم الزر */
            border-radius: 25px;
            transition: background 0.4s;
        }
        .btn-primary:hover {
            background: #8e44ad;
        }
        .social-login .btn-google {
            background: #db4a39;
            color: white;
            width: 100%;
            padding: 15px;
            border-radius: 25px;
            text-align: left;
        }
        .social-login .btn-google:hover {
            background: #c23321;
        }
        .google-logo {
            margin-right: 10px;
            float: left;
        }
        .forgot-password {
            display: block;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
        }
        .forgot-password:hover {
            color: #8e44ad;
        }
    </style>
</head>
<body>

<div class="container h-90 d-flex justify-content-center align-items-center">
    <div class="col-md-10 login-box">
        <h2>Welcome Back!</h2>
        <form action="{{ route('login') }}"  method="POST">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                @error('email')<div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                @error('password')<div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            @if (Route::has('password.request'))
            <a class="forgot-password" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </form>
        <div class="mt-4">
            <p>Or login with:</p>
            <div class="social-login">
                <a href="{{ route('googlepage') }}" class="btn btn-google">
                    <img src="{{ URL::asset('assets/img/images.png') }}" style="width: 30px;" alt="Google Logo" class="google-logo"> 
                    Login with Google
                </a>
            </div>
        </div>

        <p class="mt-4">Don't have an account? <a href="{{ route('register') }}" style="color: #8e44ad;">Sign up</a></p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
