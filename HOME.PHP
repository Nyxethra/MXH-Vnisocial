<?php
session_start();

$user_id = $_SESSION['ma_nguoidung'];

if(!isset($user_id)){
   header('location:SIGNUP.LOGIN.LOGOUT/login.php');
};
?>

    <?php include ('BAR/Nav_Bar.php');?>
    <?php include ('dang_bai/dangbai.php');?>
    <?php include ('baidang/baidang.php');?>
    
  </body>
</html>
