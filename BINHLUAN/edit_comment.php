<?php
session_start();
include("db_connection.php"); // Thay thế "db_connection.php" bằng tệp kết nối cơ sở dữ liệu của bạn

// Kiểm tra xem người dùng đã gửi yêu cầu cập nhật bình luận chưa
$ma_baidang = isset($_GET['ma_baidang']) ? $_GET['ma_baidang'] : '';
$ma_nguoidung = isset($_GET['ma_nguoidung']) ? $_GET['ma_nguoidung'] : '';
// var_dump($ma_nguoidung);
if (isset($_POST['update_comment'])) {
    $commentId = $_POST['comment_id'];
    $editedComment = $_POST['edited_comment'];

    // Thực hiện câu truy vấn để cập nhật bình luận trong cơ sở dữ liệu
    $sql = "UPDATE binhluan SET noidung_binhluan = '$editedComment' WHERE ma_binhluan = '$commentId'";
    $result = $conn->query($sql);

    if ($result) {
        echo "<script>
        alert('Cập nhật bình luận thành công!');
    </script>";;
    } else {
        echo "<script>
        alert('Cập nhật bình luận thất bại!');
    </script>";;
       
        // Có thể chuyển hướng hoặc hiển thị thông báo lỗi
    }
}

// Hiển thị biểu mẫu chỉnh sửa bình luận
if (isset($_GET['comment_id'])) {
    $commentId = $_GET['comment_id'];

    // Thực hiện câu truy vấn để lấy thông tin bình luận từ cơ sở dữ liệu
    $sql = "SELECT * FROM binhluan WHERE ma_binhluan = '$commentId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $commentContent = $row['noidung_binhluan'];

        // Hiển thị biểu mẫu chỉnh sửa bình luận với nội dung bình luận ban đầu
        echo "
        <form method='post' action=''>
            <textarea name='edited_comment'>$commentContent</textarea>
            <input type='hidden' name='comment_id' value='$commentId'>
            <button type='submit' name='update_comment'>Cập nhật</button>
        </form>";
    } else {
        // Không tìm thấy bình luận
        // Có thể chuyển hướng hoặc hiển thị thông báo lỗi
    }
}?>
