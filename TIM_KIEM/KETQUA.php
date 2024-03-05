<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title class>Kết quả tìm kiếm</title>
  <style>
    /* Reset CSS */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    .container {
      width: 800px;
      margin: 0 auto;
    }
    .title {
        display: flex;
        justify-content: center;
        font-size: 25px;
    }
    .danh-sach {
      display: flex;
      flex-wrap: wrap;
      margin: 20px 0;

    }

    .item {
      width: 33%);
      border: 1px solid #ccc;
      padding: 10px;
      margin: 10px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .item img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
    }

    .item h2 {
      margin-top: revert;
    }

    .item p {
      margin-top: 5px;
      color: #777;
    }

    .item a {
      color: #000;
      text-decoration: none;
    }

    .item a:hover {
      text-decoration: underline;
    }
    .avatar {
    
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    float: left;
    width: 30px;
    height: 30px;
   }
    .anh_va_ten{
    display: flex;
    align-content: center;
    flex-wrap: wrap;
    }
    
}

  </style>
</head>
<body>
  
  <div class="container">
    <div class="danh-sach">
      <?php
      // Lấy dữ liệu từ database
      $conn = mysqli_connect("localhost", "root", "", "vnisocial");
      $ten = $_POST['ten'];
      $sql = "SELECT * FROM nguoidung AS n
              INNER JOIN tt_nguoidung AS tt ON n.ma_nguoidung = tt.ma_nguoidung
              WHERE n.ten_nguoidung LIKE '%$ten%'
              ORDER BY n.ten_nguoidung ASC
              LIMIT 10";
      $result = mysqli_query($conn, $sql);

      // Kiểm tra kết quả
        if (!$result) {
            echo "Lỗi: " . mysqli_error($conn);
            exit;
            // Đóng kết nối database
        mysqli_close($conn);
        }
        
        
    
         // Thực thi câu lệnh SQL
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả
$num_rows = mysqli_num_rows($result);

// Hiển thị thông báo hoặc danh sách kết quả
if ($num_rows == 0) {
?>

<div class="khong-tim-thay">
  <h1>Không tìm thấy người dùng</h1>
  <p>Hãy thử tìm kiếm với từ khóa khác.</p>
</div>

<?php } else  ?>

<div class="danh-sach">
  <?php
  // Duyệt qua kết quả và hiển thị
  while ($row = mysqli_fetch_assoc($result)) {
  ?>
  <div class="item">
    <div class="anh_va_ten">
    <img class="avatar" src="../img/<?php echo $row['avatar']; ?>" alt="<?php echo $row['ten_nguoidung']; ?>">
    <h2><?php echo $row['ten_nguoidung']; ?></h2>
  </div>
    <p><?php echo $row['hoc_tai']; ?></p>
    <p><?php echo $row['tieusu']; ?></p>
    <a href="#">Xem trang cá nhân</a>
  </div>
  <?php } ?>
</div>


