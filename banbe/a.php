<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Nút kết bạn kiểu Facebook</title>
  <style>
    /* Định dạng thẻ div chứa thông tin người dùng */
    .user-info {
      display: flex;
      align-items: center;
      padding: 10px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }

    /* Định dạng ảnh đại diện */
    .user-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 10px;
    }

    /* Định dạng tên người dùng */
    .user-name {
      font-weight: bold;
    }

    /* Định dạng nút kết bạn */
    .btn-ketban {
      background-color: #3b5998;
      color: #fff;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <?php
 $user_id=1;
  // Lấy thông tin người dùng
  $conn = new mysqli('localhost', 'root', '', 'vnisocial');
  $sql = "SELECT * FROM nguoidung WHERE ma_nguoidung = 1";
  $result = $conn->query($sql);
  $user= $result->fetch_assoc();


  ?>

  <div class="user-info">
    <img class="user-avatar" src="../img/<?php echo $user['avatar']; ?>">
    <span class="user-name"><?php echo $user['ten_nguoidung']; ?></span>
    <button class="btn-ketban" onclick="guiYeuCauKetBan(<?php echo  $user['ma_nguoidung']; ?>,  <?php echo   $user_id; ?>)">Kết bạn</button>
  </div>

  <script>
    function guiYeuCauKetBan(friend_id, user_id) {
  // Chuyển đổi friend_id thành số nguyên
  friend_id = parseInt(friend_id);

  // Gửi yêu cầu kết bạn bằng AJAX
  $.ajax({
    url: "yeucau.php",
    method: "POST",
    data: {
      friend_id: friend_id,
      user_id: user_id
    },
    success: function(response) {
      // Parse response as JSON
      var jsonResponse = JSON.parse(response);
      
      // Xử lý kết quả phản hồi từ server
      if (jsonResponse.success) {
        alert("Yêu cầu kết bạn đã được gửi.");
      } else {
        alert(jsonResponse.message);
      }
    },
    error: function(xhr, status, error) {
      // Xử lý lỗi nếu có
      alert("Có lỗi xảy ra: " + error);
    }
  });
}

  </script>
</body>
</html>
