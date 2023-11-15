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
        <form method="POST" action="/contact">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <label for="name">
                name
                <input type="text" name="name">
            </label>
            <label for="email">
                email
                <input type="email" name="email">
            </label>
            <label for="message">
                message
                <input type="message" name="message">
            </label>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>