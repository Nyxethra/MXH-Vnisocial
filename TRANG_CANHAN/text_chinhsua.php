<?php session_start();

include "../BINHLUAN/db_connection.php";
// Xử lý khi người dùng gửi bình luận

if ($_SERVER["REQUEST_METHOD"] == "POST") {

     // Lấy dữ liệu từ form
     $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : '';
     $noidung_binhluan = isset($_POST["noidung_binhluan"]) ? $_POST["noidung_binhluan"] : '';
     $ma_baidang = isset($_GET['ma_baidang']) ? $_GET['ma_baidang'] : '';
 
    // Kiểm tra nếu bình luận không rỗng
    if (!empty($noidung_binhluan)) {
        // Thực hiện truy vấn để lưu bình luận vào cơ sở dữ liệu
        $sql = "INSERT INTO binhluan (ma_baidang, noidung_binhluan) VALUES ('$ma_baidang', '$noidung_binhluan')";

        if ($conn->query($sql) === TRUE) {
            echo "Bình luận đã được lưu thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Vui lòng nhập bình luận của bạn.";
    }
}

// Xử lý yêu cầu sửa bình luận
if (isset($_POST['edit_comment'])) {
    $commentId = $_POST['comment_id'];
    $editedComment = $_POST['edited_comment'];

    // Thực hiện câu truy vấn để cập nhật bình luận trong cơ sở dữ liệu
    $sql = "UPDATE binhluan SET noidung_binhluan = '$editedComment' WHERE ma_binhluan = '$commentId'";
    $result = $conn->query($sql);

    if ($result) {
        echo "Cập nhật bình luận thành công";

        // Có thể chuyển hướng hoặc hiển thị thông báo thành công
    } else {
        echo "Cập nhật bình luận thất bại";

        // Có thể chuyển hướng hoặc hiển thị thông báo lỗi
    }
}

// Xử lý yêu cầu xóa bình luận
if (isset($_POST['delete_comment'])) {
    $commentId = $_POST['comment_id'];

    // Thực hiện câu truy vấn để xóa bình luận khỏi cơ sở dữ liệu
    $sql = "DELETE FROM binhluan WHERE ma_binhluan = '$commentId'";
    $result = $conn->query($sql);

    if ($result) {
        echo "Xóa bình luận thành công";

        // Có thể chuyển hướng hoặc hiển thị thông báo thành công
    } else {
        echo "Xóa bình luận thất bại";
        // Có thể chuyển hướng hoặc hiển thị thông báo lỗi
    }
}

// Sau khi xử lý yêu cầu sửa hoặc xóa bình luận, bạn có thể chuyển hướng người dùng hoặc hiển thị thông báo thành công.
// ...
?>
<!DOCTYPE html>
<html>

<head>
  <style>
    * {

      font-size: 100%;
    }

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

    .binhluan-list .edit_btn,
    .binhluan-list .delete_btn {
      margin-left: 10px;
    }
  </style>
</head>

<body>
  <?php
$ma_baidang = isset($_GET['ma_baidang']) ? $_GET['ma_baidang'] : '';
  
  ?>
  <div class="binhluan-form">
    <h3>Thêm bình luận</h3>
    <form method="post" action="comment.php?ma_baidang=<?php echo $ma_baidang; ?>">
      <textarea name="noidung_binhluan" placeholder="Nhập bình luận của bạn"></textarea>
      <button type="submit">Gửi</button>
    </form>
  </div>
  <div class="binhluan-list">
    <h3>Danh sách bình luận</h3>
    <?php
    // Hiển thị danh sách bình luận
    $sql = "SELECT binhluan.*, nguoidung.ten_nguoidung FROM binhluan 
      JOIN nguoidung ON binhluan.binhluan_boi = nguoidung.ma_nguoidung 
      WHERE binhluan.ma_baidang = '$ma_baidang' 
      LIMIT 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='binhluan'>";
        echo $row["ten_nguoidung"];
        echo "<br>";
        echo $row["noidung_binhluan"];
        echo "<button class='edit-btn' data-comment-id='" . $row["ma_binhluan"] . "'>Sửa</button>";
        echo "<button class='delete-btn' data-comment-id='" . $row["ma_binhluan"] . "'>Xóa</button>";
        echo "</div>";
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

    // Sự kiện click nút "Sửa"
    var editButtons = document.getElementsByClassName("edit-btn");
    for (var i = 0; i < editButtons.length; i++) {
      editButtons[i].addEventListener("click", function() {
        var commentId = this.getAttribute("data-comment-id");
        // Thực hiện xử lý sửa bình luận, ví dụ: chuyển hướng người dùng đến trang sửa bình luận với mã bình luận tương ứng
        window.location.href = "edit_comment.php?comment_id=" + commentId;
      });
    }


//   </script>
  <script>
    // Lấy giá trị mã bài đăng từ URL
    var urlParams = new URLSearchParams(window.location.search);
    var ma_baidang = urlParams.get('ma_baidang');

    // Sử dụng mã bài đăng để thực hiện các xử lý khác, ví dụ: truy vấn cơ sở dữ liệu để lấy các comment liên quan
    // ...
  </script>
</body>

</html>