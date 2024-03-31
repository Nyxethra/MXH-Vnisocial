<?php
// Kiểm tra xem post_id có tồn tại không
if(isset($_GET['ma_baidang'])) {
    $post_id = $_GET['ma_baidang'];

    // Kết nối vào cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'vnisocial');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Truy vấn lấy thông tin của bài viết cần chỉnh sửa
    $sql = "SELECT * FROM baidang WHERE ma_baidang = $post_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Hiển thị hình ảnh bài đăng (nếu có)
        if (!empty($row['image'])) {
            echo '<img src="' . $row['image'] . '" alt="Post Image"><br>';
        }
        // Hiển thị nội dung văn bản của bài đăng
        echo '<p>' . $row['noidung'] . '</p>';
        // Thêm nút xóa ảnh và form để xử lý khi người dùng nhấp vào nút này
        echo '<form method="post" action="delete_image.php">';
        echo '<input type="hidden" name="ma_baidang" value="' . $row['ma_baidang'] . '">';
        echo '<button type="submit" name="delete_image">Xóa Ảnh</button>';
        echo '</form>';
    } else {
        echo "Bài viết không tồn tại.";
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Thiếu ID bài viết.";
}
?>
