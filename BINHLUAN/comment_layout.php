<?php include("comment.php") ?>
<!DOCTYPE html>
<html>

<head>
  <style>
    .binhluan-form {
      margin-bottom: 20px;
    }

    .binhluan-form h3 {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .binhluan-form textarea {
      width: 100%;
      height: 80px;
      resize: vertical;
      margin-bottom: 10px;
    }

    .binhluan-form button {
      margin-top: 10px;
      background-color: #1877f2;
      color: #fff;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
    }

    .binhluan-list {
      margin-top: 20px;
    }

    .binhluan-list h3 {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .binhluan-list .binhluan {
      background: #f1f1f1;
      padding: 10px;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
<?php 
  @var_dump($_SESSION['ma_baidang']);
?>
  <div class="binhluan-form">
    <h3>Thêm bình luận</h3>
    <form method="post" action="comment.php">
      <textarea name="noidung_binhluan" placeholder="Nhập bình luận của bạn"></textarea>
      <button type="submit">Gửi</button>
    </form>
  </div>
  <div class="binhluan-list">
    <h3>Danh sách bình luận</h3>
    <?php
    // Hiển thị danh sách bình luận
    $sql = "SELECT * FROM binhluan where ma_baidang='$ma_baidang' limit 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='binhluan'>" . $row["noidung_binhluan"] . "</div>";
      }
    } else {
      echo "Chưa có bình luận nào.";
    }
    ?>
  </div>
  <script>
    // Lấy giá trị mã bài đăng từ URL
    var urlParams = new URLSearchParams(window.location.search);
    var ma_baidang = urlParams.get('ma_baidang');

    // Sử dụng mã bài đăng để thực hiện các xử lý khác, ví dụ: truy vấn cơ sở dữ liệu để lấy các comment liên quan
    // ...
  </script>
</body>

</html>