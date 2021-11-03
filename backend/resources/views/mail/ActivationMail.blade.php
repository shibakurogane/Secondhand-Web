<html>

<head>
    <title>Activation Email - SecondHand</title>
    <style>
        
        a {
            display: block;
            align-items: center;
            justify-content: center;
            background: rgb(131, 58, 180);
            background: linear-gradient(90deg, rgba(131, 58, 180, 1) 0%, rgba(253, 29, 29, 1) 50%, rgba(252, 176, 69, 1) 100%);
            border: 1px solid black;
            padding: 25px 50px;
            text-decoration: none;
            font-size: 30px;
            text-align: center;
            color: black;
            size: 30px;
        }
        
        a:hover {
            background: rgb(0, 0, 0);
            background: linear-gradient(325deg, rgba(0, 0, 0, 1) 76%, rgba(255, 255, 255, 1) 100%);
            color: white;
        }
        
        h1 {
            text-align: center;
        }
        
        p {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Chào mừng {{ $user->name }}</h1>
    <p>
        Chào mừng {{ $user->name }} đã đăng ký thành viên tại SecondHand web. Bạn hãy click vào đường link sau đây để hoàn tất việc đăng ký.
    </p>
        <a href="{{ $activationLink }}"><b>Ấn vào đây để xác nhận</b></a>
</body>

</html>