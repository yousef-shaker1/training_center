<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            margin: 30px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        .header img {
            max-width: 100px;
        }
        .content {
            padding: 20px;
            color: #333;
        }
        .content h1 {
            font-size: 24px;
            color: #4CAF50;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 12px;
            color: #999;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Welcome, {{ $user->name }}!</h1>
            <p>Thank you for registering with us. We are thrilled to have you on board. We hope you enjoy our services and find everything you're looking for.</p>
            <p>If you have any questions, feel free to <a href="mailto:support@example.com">contact our support team</a>. We are here to help you at any time.</p>
            <a href="{{ route('home') }}" class="button">Get Started</a>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
