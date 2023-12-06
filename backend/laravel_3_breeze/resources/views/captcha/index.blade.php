<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="">
        <img src="{{ route('captcha.image')}}" alt="">
        <form method="POST" action="{{ route('captcha.submit')}}">
            @csrf
            <label for="captcha_value">
                Enter the value on the image<br/>
                @if(session('errors') != null && session('errors')->has('message'))
                <span style="display: block; color: red;">{{ session('errors')->first('message') }}</span>
                @endif
                <input type="text" name="captcha_value" />
            </label>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>