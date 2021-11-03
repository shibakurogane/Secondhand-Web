<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #token{
            display: none;
        }
    </style>
</head>
<body>
    <form action="{{ $url }}" method="POST">
        <input type="text" name="password" placeholder="Mật khẩu" id="password">
        <input type="hidden" name="token" id="token" value="{{$token}}">
        <input type="submit" value="Thay đổi">
    </form>
</body>
</html>