<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['ma_nguoidung'])) {
    die("Bạn cần đăng nhập để thực hiện thao tác này.");
}

// Lấy mã bài đăng từ request POST
if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'vnisocial');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Lấy mã người dùng hiện tại từ session
    $ma_nguoidung = $_SESSION['ma_nguoidung'];

    // Kiểm tra xem người dùng đã thích bài viết này chưa
    $check_like_query = "SELECT * FROM thich WHERE thich_boi = '$ma_nguoidung' AND ma_baidang = '$post_id'";
    $result = $conn->query($check_like_query);

    if ($result->num_rows > 0) {
        // Nếu người dùng đã thích bài viết này rồi, không cần thực hiện gì
        echo "Bạn đã thích bài viết này.";
    } else {
        // Nếu chưa thích, thêm dữ liệu vào bảng thích
        $insert_like_query = "INSERT INTO thich (thich_boi, ma_baidang) VALUES ('$ma_nguoidung', '$post_id')";
        if ($conn->query($insert_like_query) === TRUE) {
            echo "Thích bài viết thành công.";
        } else {
            echo "Lỗi: " . $insert_like_query . "<br>" . $conn->error;
        }
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Không có mã bài đăng được cung cấp.";
}
?>
