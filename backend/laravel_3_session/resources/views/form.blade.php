<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/form">
        @method('POST')
        @csrf
        <label for="form_name">Form Name
            <input type="text" id="form_name" name="form_name" />
        </label>

    </form>
</body>
</html>