<?php session_start();

include "comment.php"

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
<?php
$ma_baidang = isset($_GET['ma_baidang']) ? $_GET['ma_baidang'] : '';
$ma_nguoidung = isset($_GET['ma_nguoidung']) ? $_GET['ma_nguoidung'] : '';
// var_dump($ma_nguoidung);
 ?>
<body>

  <div class="binhluan-form">
    <h3>Thêm bình luận</h3>
    <form method="post" action="comment.php?ma_baidang=<?php echo $ma_baidang ?> &ma_nguoidung=<?php echo $ma_nguoidung?>">
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
        echo "<b>". $row["ten_nguoidung"]. "</b>";
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

    //     // Sự kiện click nút "Xóa"
    //     var deleteButtons = document.getElementsByClassName("delete-btn");
    //     for (var i = 0; i < deleteButtons.length; i++) {
    //       deleteButtons[i].addEventListener("click", function() {
    //         var commentId = this.getAttribute("data-comment-id");
    // //          Gửi yêu cầu xóa bình luIn the previous response, the code snippet got cut off before completing the delete functionality. Here's the continuation of the code for deleting comments:
    // // ```php
    // // an bằng Ajax hoặc gửi yêu cầu xóa thông qua form và xử lý ở file comment.php
    // //         // Ví dụ: Gửi yêu cầu xóa bình luận bằng Ajax
    //         var xhr = new XMLHttpRequest();
    //         xhr.open("POST", "comment.php", true);
    //         xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //         xhr.onreadystatechange = function() {
    //           if (xhr.readyState === 4 && xhr.status === 200) {
    //             // Xử lý phản hồi từ server sau khi xóa bình luận thành công
    //             // Ví dụ: Tải lại danh sách bình luận sau khi xóa
    //             location.reload();
    //           }
    //         };
    //         xhr.send("action=delete&comment_id=" + commentId);
    //       });
    //     }
    //   
  </script>
  <script>
    // Lấy giá trị mã bài đăng từ URL
    var urlParams = new URLSearchParams(window.location.search);
    var ma_baidang = urlParams.get('ma_baidang');

    // Sử dụng mã bài đăng để thực hiện các xử lý khác, ví dụ: truy vấn cơ sở dữ liệu để lấy các comment liên quan
    // ...
  </script>
</body>

</html>