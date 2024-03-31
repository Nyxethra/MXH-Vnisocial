<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-KVZ4X6ZkGa5Pw4e2spzhpxQVdG0+PwT8/x8q+ABe3xooqZ1gA7p4hFjcqLoO6703X/71Xsm1+98olIw5W4f+sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNIsocial</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">
</head>
<body> 
    
    <?php include("thanhbar_dangnhap.php")?>
<section>
    <div class="signup_body" style="background-color: #a72f2f;">
        <p class="acc_crt"style="color:white"><b>Đăng ký</b></p>
        <p class="free_hint" style="color:white">Mạng Xã Hội Mang Bản Sắc Việt.</p>
        <form class="signup_form" method="POST" action="dangki.php">
            <div>

                <input  class="firstname" type="text" name="firstname" placeholder="Họ">
                <input  class="lastname" type="text" name="lastname" placeholder="Tên">
                <input  class="email" type="text" name="email" placeholder="Điền email của bạn">
                <input  class="password" type="password" name="matkhau" placeholder="Mật khẩu">
                <input  class="password2" type="password" name="matkhau2" placeholder="Xác nhận mật khẩu">
            </div>
            <p class="birthday" > Ngày sinh</p>
            <div class="birth_date">
                <input type="date" name="birthday" class="birth_date">
                <!-- <select class="Day" name="ngay">
                    
                    <option>Ngày</option><option>1</option><option>2</option>
                    <option>13</option><option>14</option><option>15</option>
                    <option>16</option><option>17</option><option>18</option>
                    <option>19</option><option>20</option><option>21</option><option>22</option>
                    <option>23</option><option>24</option><option>25</option>
                    <option>26</option><option>27</option><option>28</option>
                    <option>29</option><option>30</option><option>31</option>
                </select>
                <select class="Month" name="thang">
                    
                    <option>Tháng</option><option>1</option><option>2</option>
                    <option>3</option><option>4</option><option>5</option>
                    <option>6</option><option>7</option><option>8</option>
                    <option>9</option><option>10</option><option>11</option><option>12</option>
                </select>
                <select class="Year" name="nam">
                
                    <option>Năm</option><option>1988</option><option>1989</option>
                    <option>1990</option><option>1991</option><option>1992</option>
                    <option>1993</option><option>1994</option><option>1995</option><option>1996</option>
                    <option>1997</option><option>1998</option><option>1999</option>
                    <option>2000</option><option>2001</option><option>2002</option>
                    <option>2003</option><option>2004</option><option>2005</option>
                    <option>2006</option><option>2007</option><option>2008</option>
                </select>-->
            </div> 

            <p class="birthday" > Giới tính</p>
            <select class="gender" name="gioitinh">
            <option value="nam">Nam</option>
            <option value="nu">Nữ</option>
            </select>
            <p class="agreement">Nhấn đăng ký đồng nghĩa với việc bạn đã đồng ý với các <a href="#">điều khoản</a>.</p>
            <button class="signup">Đăng ký</button>

            <img class="logonen" src="../img/logo_nen.jpg" style="position: absolute; top: 133px; left: 529px; width: 700px;">

</body>
</html>