<html>

<head>
    <title>Reset Password Email - SecondHand</title>
    <style>
        
        #resetLink{
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
        
        #resetLink:hover {
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
    <h1>Khôi phục mật khẩu cho email: {{ $user->email }}</h1>
    <p>
        Nếu như bạn không có nhu cầu đổi mật khẩu thì hãy bỏ qua nó.Click vào đường link sau đây để thay đổi mật khẩu.
    </p>
        <a id="resetLink"href="{{ $ResetLink }}"><b>Ấn vào đây để tới trang đổi mật khẩu</b></a>
</body>

</html>