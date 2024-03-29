<?php
session_start();

$user_id = $_SESSION['ma_nguoidung'];

if(!isset($user_id)){
   header('location:SIGNUP.LOGIN.LOGOUT/login.php');
}; 
?> 

    <?php include ('BAR/Nav_Bar.php');?>


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
                  
                
          }
        }else {include("subhome.php");}
    ?> 
  </body>
</html>
 