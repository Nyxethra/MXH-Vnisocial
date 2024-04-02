<?php include ('THONG_BAO/thongbao.php');?>
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

    .nav-bar {
    position: fixed;
    top: 0;
    width: 100%;
    height: 50px;
    background-color: #a72f2f;
    display: flex;
    align-items: center;
    padding: 0 20px;
    z-index: 100;
    left: 0px;
}
    .badge{
      margin-left:0.5px;



    }
    .nav-logo {
      flex-basis: 200px; 
      /* Set a fixed width */
    }

    .nav-logo img {
      border-style: none;
      max-width: 100%;
    }

    .nav-search input {
      background-color: #f0f2f5;
      border: none;
      border-radius: 20px;
      padding: 5px 10px;
      width: 300px;
      height: 30px;
      font-size: 14px;
      color: #000; /* Black text */
    }

    .nav-icons {
    display: flex;
    gap: 20px;
    margin-right: 40px;
    margin-left: 50px;
    /* align-items: center; */
    position: relative;

}

    .nav-icons i {
      color: white;
      font-size: 24px;
    }

    .nav-links {
      display: flex;
      align-items: center;
      margin-left: auto; /* Align links to the right */
      
    }

    .nav-links a {
      color: white;
      margin: 0 10px;
      text-decoration: none;
      font-size: 14px;
    }

    

    .nav-search {
      margin-left: 10px; /* Adjust the value for desired distance */
    }

    /* Pop-up styles */
    .poppup {
      display: none;
      position: fixed; /* Sử dụng position: fixed thay vì absolute */
      top: 50px; /* Đặt top bằng chiều cao của navbar */
      right: 20px; /* Đặt right bằng padding của navbar */
      transform: none; /* Xóa thuộc tính transform */
      background-color: #FFFFFF;    
      color: black;
      padding: 15px;
      border-radius: 10px;
      margin-left: 50px;
      width: 30%;
      max-width: 500px; /* Thêm max-width để hạn chế chiều rộng tối đa của pop-up */
      word-wrap: break-word; /* Đảm bảo rằng văn bản không vượt quá khung pop-up */
      z-index:1;
    }

    .popup-content {
      text-align: center;
    }

    .close {
      position: absolute;
      top: 10px;
      right: 10px;
      color: black;
      cursor: pointer;
    }
    svg:not(:root).svg-inline--fa {
    overflow: visible;
    color: white;
    font-size: 26px;
    margin: 5px;
}

  </style>
</head>
<body>
  <div class="nav-bar">
    <div class="nav-logo">

    <a class="nav-link" href="index.php?diden=trangchu"><b>
      <img src="IMG/logo.png" class="logo"></b>
    </a>
 
    </div>
    <div class="nav-search">
      <form action="index.php?diden=ketqua_timkiem" method="post">
        <input type="text" name="ten" placeholder="Nhập tên người dùng">
      </form>
    </div>
    <div class="nav-links">
      <a class="nav-link" href="index.php?diden=trangchu"><b>Trang chủ</b></a>
      <a class="nav-link" href="#"><b>|</b></a>
      <a class="nav-link" href="index.php?diden=trangcanhan"><b>Trang cá nhân</b></a>
    </div>
    <div class="nav-icons">
    <div class="nav-icons">
  <i class="fab fa-facebook-messenger"></i>
  <div class="notification" onclick="showPopup()">
  <i class="far fa-bell"></i>
  <?php if (isset($notification_count) && $notification_count > 0): ?>
    <span class="badge"><?php echo $notification_count; ?></span>
  <?php endif; ?>
  </div>

  <a class="nav-link " href="SIGNUP.LOGIN.LOGOUT/dangxuat.php"><i class="fas fa-sign-out-alt"></i></a> <!-- Sử dụng biểu tượng đăng xuất từ Font Awesome -->
</div>

      </div>
    </div>
  </div>

  <!-- Phần pop-up thông báo -->
  <div class="poppup" id="popup">
    <div class="popup-content">
      <span class="close" onclick="closePopup()">×</span>
      <!-- Nội dung của pop-up sẽ được đưa vào đây -->
      <h3>Thông báo mới</h3>
      <?php foreach ($notifications as $notification) { ?>
        <p><?php echo $notification; ?></p>
      <?php } ?>
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
