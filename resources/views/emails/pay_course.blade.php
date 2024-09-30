<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background-color: white;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-size: 24px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }
        .course-title {
            color: #3498db;
            font-size: 20px;
        }
        .course-details {
            background-color: #fafafa;
            padding: 10px;
            margin: 20px 0;
            border-left: 4px solid #3498db;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #aaa;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello, {{ Auth::user()->name }}!</h1>

        <p>Thank you for purchasing the course! Below are the details of your purchase:</p>

        <div class="course-details">
            <h2 class="course-title">{{ $course->name }}</h2>
            <p><strong>Price:</strong> {{ $course->price }}</p>
            <p><strong>Number of Hours:</strong> {{ $course->Numberofhours}}</p>
            <p><strong>Start Date:</strong> {{ $course->start_data }}</p>
            <p><strong>End Date:</strong> {{ $course->end_data }}</p>
            <p><strong>Description:</strong> {{ $course->description }}</p>
            <p><strong>Quantity:</strong> {{ $course->Quantity }}</p>
        </div>

        <p>If you have any questions, feel free to contact us. Enjoy your course!</p>

        <p
