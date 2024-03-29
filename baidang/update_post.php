<?php
// Kiểm tra xem yêu cầu POST đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem post_id và content đã được gửi hay chưa
    if (isset($_POST['ma_baidang'], $_POST['noidung'])) {
        // Lấy post_id và content từ biến POST
        $post_id = $_POST['ma_baidang'];
        $content = $_POST['noidung'];

        // Kết nối vào cơ sở dữ liệu
        $conn = new mysqli('localhost', 'root', '', 'vnisocial');

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sử dụng câu lệnh chuẩn bị để ngăn chặn SQL Injection
        $sql = "UPDATE baidang SET noidung=? WHERE ma_baidang=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $content, $post_id);

        // Thực thi truy vấn SQL
        if ($stmt->execute()) {
            echo "Bài đăng đã được cập nhật thành công.";
        } else {
            echo "Cập nhật bài đăng thất bại: " . $stmt->error;
        }

        // Đóng kết nối
        $stmt->close();
        $conn->close();
    } else {
        echo "Thiếu thông tin cần thiết để cập nhật bài đăng.";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
