<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNIsocial</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">
</head>
<body>
    <?php
    include("classes/connect.php");
    include("classes/dangki.php");

    $firstname="";
    $lastname="";
    $matkhau2="";
    $matkhau="";
    $email="";
    $gioitinh="";
    // $ngay ="";
    // $thang="";
    // $nam="";



    if(($_SERVER)['REQUEST_METHOD']=='POST')
    {
        $signup = new Signup();
        $result= $signup -> evaluate($_POST);

        if($result != ""){
    //         //co the dung 
    //         echo "<div style='text-align:center; font-size:12px; color:white;background-color:grey'>";
    //         echo " <br>Nhung thong tin con thieu <br><br>";
    //         echo $result;
    //         echo "</div>";
        }
        else
        {
            header("Location:trangcanhan.php");
        }
    
    }
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $matkhau2=$_POST['matkhau2'];
    $matkhau=$_POST['matkhau'];
    $email=$_POST['email'];
    $gioitinh=$_POST['gioitinh'];
    // $ngay =$_POST['ngay'];
    // $thang=$_POST['Thang'];
    // $nam=$_POST['nam'];

    ?>
<div class="thanhbar">
    <img src="VNISocial.png" class="logo">
    <form class="login_form" method="post">
        <div class="email">
            <div class="font">nhap Email cua ban</div>
            <input type ="text" value="<?php echo $email ?>"name="username">
        </div>
        <div class="password">
            <div class="font">Mật khẩu</div>
            <input type="password" value="<?php echo $email ?> "name="password">
        </div>
        <button class="btn">Đăng nhập</button>
    </form>
</div> 
<section>
    <div class="signup_body">
        <p class="acc_crt">Đăng ký</p>
        <p class="free_hint">Luôn miễn phí</p>
        <form class="signup_form" method="post" action="">
            <div>

                <input value="<?php echo $firstname ?>" class="firstname" type="text" name="firstname" placeholder="First name">
                <input value="<?php echo $lastname ?>" class="lastname" type="text" name="lastname" placeholder="Last name">
                <input value="<?php echo $email ?>" class="email" type="text" name="email" placeholder="Dien email cua ban">
                <input value="<?php echo $matkhau ?>" class="password" type="password" name="matkhau" placeholder="Mat khau">
                <input value="<?php echo $matkhau2 ?>" class="password2" type="password" name="matkhau2" placeholder="Xac nhan mat khau">
            </div>
            <p class="birthday" > Ngày sinh</p>
            <div class="birth_date">
                <select class="Day">
                    
                    <option>Ngày</option><option>1</option><option>2</option>
                    <option>13</option><option>14</option><option>15</option>
                    <option>16</option><option>17</option><option>18</option>
                    <option>19</option><option>20</option><option>21</option><option>22</option>
                    <option>23</option><option>24</option><option>25</option>
                    <option>26</option><option>27</option><option>28</option>
                    <option>29</option><option>30</option><option>31</option>
                </select>
                <select class="Month">
                    
                    <option>Tháng</option><option>Tháng 1</option><option>Tháng 2</option>
                    <option>Tháng 3</option><option>Tháng 4</option><option>Tháng 5</option>
                    <option>Tháng 6</option><option>Tháng 7</option><option>Tháng 8</option>
                    <option>Tháng 9</option><option>Tháng 10</option><option>Tháng 11</option><option>Tháng 12</option>
                </select>
                <select class="Year">
                
                    <option>Năm</option><option>1988</option><option>1989</option>
                    <option>1990</option><option>1991</option><option>1992</option>
                    <option>1993</option><option>1994</option><option>1995</option><option>1996</option>
                    <option>1997</option><option>1998</option><option>1999</option>
                    <option>2000</option><option>2001</option><option>2002</option>
                    <option>2003</option><option>2004</option><option>2005</option>
                    <option>2006</option><option>2007</option><option>2008</option>
                </select>
            </div>

            <p class="birthday" > Gioi tinh</p>
            <select class="gender">
            <option><?php $gioitinh ?></option>
            <option>Nam</option>
            <option>Nu</option>
            </select>
            <p class="agreement">Đồng ý các <a href="#">điều khoản</a>.</p>
            <button class="signup">Đăng ký </button>
</body>
</html>