<!DOCTYPE html>
<html>
<head>
    <title>Your Custom Email Notification</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #EDF2F7;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: block;
            width: 200px;
            margin: 0 auto;
            padding: 10px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Сайн байна уу, {{$user->name}}</h2>
        <p>Таны №{{$complaint->serial_number}} дугаартай гомдол {{$complaint->status->name}} төлөвт орсон байна.</p>

        <p>Та доорх холбоос дээр дарж дэлгэрэнгүй мэдээллийг харах боломжтой.</p>

        <a href="{{$complaint_url}}" class="button">Харах</a>

        Баярлалаа,<br>
        {{ config('app.name') }}
    </div>
</body>
</html>