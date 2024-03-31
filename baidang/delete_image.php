<?php
// Kiểm tra xem phương thức yêu cầu là POST và tồn tại tham số ma_baidang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ma_baidang'])) {
    // Lấy mã bài đăng từ dữ liệu gửi đi
    $ma_baidang = $_POST['ma_baidang'];

    // Kết nối vào cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'vnisocial');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Truy vấn cập nhật cột image thành NULL để xóa ảnh của bài đăng
    $sql = "UPDATE baidang SET image = NULL WHERE ma_baidang = $ma_baidang";

    if ($conn->query($sql) === TRUE) {
        echo "Ảnh của bài đăng đã được xóa thành công.";
    } else {
        echo "Lỗi khi xóa ảnh của bài đăng: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
} else {
    // Nếu không phải là yêu cầu POST hoặc không có ma_baidang, hiển thị thông báo lỗi
    echo "Yêu cầu không hợp lệ.";
}
?>
