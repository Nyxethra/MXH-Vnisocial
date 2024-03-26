<?php
session_start();

$user_id = $_SESSION['ma_nguoidung'];

if(!isset($user_id)){
   header('location:SIGNUP.LOGIN.LOGOUT/login.php');
}; 
?>

    <?php include ('BAR/Nav_Bar.php');?>


    <?php 
        if (isset($_GET["pid"])){
            $id=$_GET["pid"];
            switch ($id){
              // case 0:
              //   include("view/public_dichvu.php");
              //   break;
              case 1: 
                include("TRANG_CANHAN/trangcanhan.php");
                break;
              case 0:
                include("subhome.php");
                break;
          }
        }else {include("subhome.php");}
    ?> 
  </body>
</html>
 