<br />
<b>Warning</b>:  include(THONG_BAO/thongbao.php): Failed to open stream: No such file or directory in <b>D:\My Repository\web\Vnisocial_For_Vietnamese\BAR\Nav_Bar.php</b> on line <b>3</b><br />
<br />
<b>Warning</b>:  include(): Failed opening 'THONG_BAO/thongbao.php' for inclusion (include_path='C:\xampp\php\PEAR') in <b>D:\My Repository\web\Vnisocial_For_Vietnamese\BAR\Nav_Bar.php</b> on line <b>3</b><br />
 

<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Base styles */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif; /* Similar to Facebook's font */
    }

    .navbar {
      height: 50px;
      background-color: #a72f2f; /* Facebook blue */
      display: flex;
      align-items: center;
      padding: 0 20px;
    }

    .navbar-logo {
  flex-basis: 200px; /* Set a fixed width */
}
   

    .navbar-search input {
      background-color: #f0f2f5;
      border: none;
      border-radius: 20px;
      padding: 5px 10px;
      width: 300px;
      height: 30px;
      font-size: 14px;
      color: #000; /* Black text */
    }

    .navbar-icons {
      display: flex;
      gap: 20px; margin-right: 40px; margin-left: 50px;
    }

    .navbar-icons i {
      color: white;
      font-size: 24px;
    }

    .navbar-links {
      display: flex;
      align-items: center;
      margin-left: auto; /* Align links to the right */
    }

    .navbar-links a {
      color: white;
      margin: 0 10px;
      text-decoration: none;
      font-size: 14px;
    }

    .navbar-links a:hover {
      text-decoration: underline;
    }

    .navbar-search {
  margin-left: 10px; /* Adjust the value for desired distance */
}
/* Pop-up styles */
.popup {
    display: none;
    position: relative;
    top: 10%;
    left: 84%;
    right: 0px;
    transform: translate(-27%, -58%);
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 20px;
    border-radius: 10px;

    .popup-content {
    text-align: center;
    }

    .close {
    position: absolute;
    top: 10px;
    right: 10px;
    color: white;
    cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <div class="navbar-logo">
      <img src="logo.png" alt="Vnisocial Logo">
    </div>
    <div class="navbar-search">
      <form action="TIM_KIEM/KETQUA.php" method="post">
        <input type="text" name="ten" placeholder="Nhập tên người dùng">
      </form>
    </div>
    <div class="navbar-links">
      <a class="abc" href="#"><b>Trang chủ</b></a>
      <a class="abc" href="#"><b>|</b></a>
      <a class="abc "href="TRANG_CANHAN/trangcanhan.php"><b>Trang cá nhân</b></a>
    </div>
    <div class="navbar-icons">
      <i class="fab fa-facebook-messenger"></i>
      <div class="notification" onclick="showPopup()">
        <i class="far fa-bell"></i>
        <span class="badge">3</span>
      </div>
    </div>
  </div>

  <!-- Phần pop-up thông báo -->
  <div class="popup" id="popup">
    <div class="popup-content">
      <span class="close" onclick="closePopup()">&times;</span>
      <!-- Nội dung của pop-up sẽ được đưa vào đây -->
      <h3>Thông báo mới</h3>
      <p>đã thích bài viết của bạn</p>
    </div>
  </div>

  <script>
    // Hàm để hiển thị pop-up
    function showPopup() {
      var popup = document.getElementById("popup");
      popup.style.display = "block";
    }

    // Hàm để ẩn pop-up
    function closePopup() {
      var popup = document.getElementById("popup");
      popup.style.display = "none";
    }
  </script>
</body>
</html>
