<?php
session_start();

$user_id = $_SESSION['ma_nguoidung'];
$user_id2 = $_SESSION['ma_nguoidung'];

if(!isset($user_id)){
   header('location:SIGNUP.LOGIN.LOGOUT/login.php');
}; 
?> 

    <?php include ('BAR/Nav_Bar.php');?>
   <?php $id2=2;?>

   <?php 
    if (isset($_GET["diden"])){
        $id=$_GET["diden"];
        switch ($id){
            case 'trangcanhan': 
                include("TRANG_CANHAN/trangcanhan.php");  
                break;
            case 'trangchu':
                include("subhome.php");
                break;
            case 'dsyeucau':
                include("banbe/dsyeucau.php");
                break;
            case 'trangcanhan_nl':
                $id2 = $_GET["id2"]; // Lấy tham số id2 từ URL
                include("TRANG_CANHAN/trangcanhan_nl.php");
                break;
            case 'ketqua_timkiem':
                // Lấy tham số id2 từ URL
                include("tim_kiem/ketqua.php");
                break;
            case 'dsbanbe':
                include("banbe/dsbanbe.php");
                break;
        }
    }else {include("subhome.php");}
    include ("css/css.php");
?>


  </body>
</html>
 