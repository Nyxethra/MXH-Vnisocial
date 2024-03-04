<?php
            // Include file đếm thông báo
            include "THONG_BAO/thongbao.php";

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "vnisocial");

// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn nội dung thông báo từ cơ sở dữ liệu
$sql = "SELECT noidung_thongbao FROM thongbao WHERE ma_thongbao = 1"; // Thay đổi điều kiện truy vấn tùy thuộc vào nhu cầu của bạn
$result = $conn->query($sql);

// Kiểm tra và lấy nội dung thông báo
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $notification_content = $row["noidung_thongbao"];
} else {
  $notification_content = "Không có thông báo mới";
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?> 

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
  flex-basis: 200px; 
  /* Set a fixed width */
}
.navbar-logo.img {
    border-style: none;
    max-width: 100%;
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
    position: absolute;
    top: 13%;
    transform: translate(218%, -28%);
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 20px;
    border-radius: 10px;
    width: 30%;
}



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
      <img src="img/logo.png" alt="Vnisocial Logo">
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
      <p><?php echo $notification_content; ?></p>
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
