<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chỉnh Sửa Bài Viết</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    /* CSS cho pop-up */

    .popup {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .popup h2 {
      font-size: 20px;
      margin-bottom: 20px;
      text-align: center;
    }

    .popup input[type="text"],
    .popup textarea {
        height: 200px;
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      resize: none;
    }

    .popup .button-container {
      display: flex;
      justify-content: center;
    }

    .popup .button-container button {
      padding: 10px 20px;
      margin: 0 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .popup .button-container button.cancel {
      background-color: #ccc;
      color: #fff;
    }

    .popup .button-container button.submit {
      background-color: #007bff;
      color: #fff;
    }
  </style>
</head>
<body>

<div class="popup-container">
  <div class="popup">
    <h2>Chỉnh sửa bài đăng</h2>
    <?php
    $ma_baidang = isset($_GET['ma_baidang']) ? $_GET['ma_baidang'] : '';
    $ma_nguoidung = isset($_GET['ma_nguoidung']) ? $_GET['ma_nguoidung'] : '';
    
    // Kiểm tra xem ma_baidang đã được gửi từ form không
    if(isset($_GET['ma_baidang'])) {
        $ma_baidang = $_GET['ma_baidang'];

        // Truy vấn lấy thông tin của bài viết cần chỉnh sửa
        $sql = "SELECT * FROM baidang WHERE ma_baidang = $ma_baidang";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <!-- Hiển thị form chỉnh sửa -->
            <form action="baidang/update_post.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="ma_baidang" value="<?php echo $ma_baidang; ?>">
                <!-- Hiển thị nội dung bài viết -->
                <textarea name="noidung_moi"><?php echo $row['noidung']; ?></textarea>
                <!-- Hiển thị ảnh hiện tại (nếu có) -->
                <?php if(!empty($row['image'])): ?>
                    <img src="IMG/<?php echo $row['image']; ?>" style=" width:100px"   alt="Post Image">
                    <!-- Thêm nút để người dùng xóa ảnh hiện tại -->
                    <label>Xóa ảnh hiện tại:</label>
                    <input type="checkbox" name="xoa_anh" value="1">
                <?php endif; ?>
                <!-- Trường để người dùng chọn và tải lên ảnh mới -->
                <label>Chọn ảnh mới:</label>
                <input type="file" name="anh_moi">
                <!-- Nút "Lưu" để gửi dữ liệu form -->
                <div class="button-container">
                  <button type="button" class="cancel">Hủy</button>
                  <button type="submit" class="submit">Cập nhật</button>
                </div>
            </form>
            <?php
        } else {
            echo "Bài viết không tồn tại.";
        }

        // Đóng kết nối
        $conn->close();
    } else {
        echo "Thiếu ID bài viết.";
    }
    ?>
  </div>
</div>

<script>
  // Sự kiện click vào nút "Hủy"
  document.querySelector('.cancel').addEventListener('click', function() {
    Swal.fire({
      title: 'Bạn có muốn hủy chỉnh sửa bài?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Đồng ý',
      cancelButtonText: 'Không'
    }).then((result) => {
      if (result.isConfirmed) {
        // Đồng ý hủy, đóng pop-up
        Swal.close();
      }
    });
  });
</script>

</body>
</html>
