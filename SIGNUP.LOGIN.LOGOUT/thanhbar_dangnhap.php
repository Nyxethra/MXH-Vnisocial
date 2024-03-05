<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style_login.csss">
</head>
<body>
<?php
?>
<div class="thanhbar" >
    <div><img src="../IMG/logo.png" class="logo "></div>
    <form class="login_form"method="POST" action="dangnhap.php" >
        <div class="email">
            <div class="font">nhap Email cua ban</div>
            <input type ="text" name="email">
        </div>
        <div class="password">
            <div class="font">Mật khẩu</div>
            <input type="password" name="matkhau">
        </div>
        <button class="btn">Đăng nhập</button>
    </form>
    </div> 
</header>
</body>
</html>
