<?php
session_start();
include("db_connection.php"); // Thay thế "db_connection.php" bằng tệp kết nối cơ sở dữ liệu của bạn

// Kiểm tra xem người dùng đã gửi yêu cầu xóa bình luận chưa
if (isset($_GET['comment_id'])) {
    $commentId = $_GET['comment_id'];

    // Thực hiện câu truy vấn để xóa bình luận khỏi cơ sở dữ liệu
    $sql = "DELETE FROM binhluan WHERE ma_binhluan = '$commentId'";
    $result = $conn->query($sql);

    if ($result) {
        // Xóa bình luận thành công
        // Có thể chuyển hướng hoặc hiển thị thông báo thành công
    } else {
        // Xóa bình luận thất bại
        // Có thể chuyển hướng hoặc hiển thị thông báo lỗi
    }
}
?>