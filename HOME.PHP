<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>TRANG CHỦ - Vnisocial</title>
    <link rel="icon" href="#" type = "image/x-icon" > 
  </head>
  <body>
    <?php include ('BAR/Nav_Bar.php');?>
    <?php
        if (isset($_GET["pid"])){
            $id=$_GET["pid"];
            switch ($id){
              // case 0:
              //   include("view/public_dichvu.php");
              //   break;
              case 1: 
                include("view/profile_khachhang.php");
                break;
              case 2:
                include("view/public_dichvu.php");
                break;
              case 3:
                include("view/public_nhahang.php");
                break;
              case 4:
                include("view/public_spa.php");
                break; 
              case 5:
                include("view/public_khuyenmai.php");
                break;
              case 6:
                include("view/public_contact.php");
                break;
              case 8:
                include("view/public_loaiphong.php");
                break;
              case 10:
                include("view/public_checkphong.php");
                break;
          }
        }else {include("page_home.php");}
    ?> 
  </body>
</html>
