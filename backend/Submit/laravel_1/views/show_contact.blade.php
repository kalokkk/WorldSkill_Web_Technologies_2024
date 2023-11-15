<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/news">News</a></li>
        <li><a href="/contact">Contact</a></li>
    </ul>
    <div>
        <h1>Contact</h1>
    </div>
    <div class="">
        Here's ur inputs:
        <ul>
            <li>Name: {{ $name ?: "No input" }}</li>
            <li>Email: {{ $email ?: "No input" }}</li>
            <li>Message: {{ $message ?: "No input" }}</li>
        </ul>
    </div>
</body>
</html>