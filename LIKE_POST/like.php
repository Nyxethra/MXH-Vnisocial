<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "ten_nguoidung";
$password = "matkhau";
$dbname = "vnisocial";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Xử lý yêu cầu Like
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST["ma_baidang"];
    $user_id = $_POST["ma_nguoidung"];

    // Kiểm tra xem người dùng đã like bài đăng này chưa
    $sql = "SELECT * FROM post_likes WHERE post_id = $post_id AND user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Thêm like mới vào cơ sở dữ liệu
        $sql_insert = "INSERT INTO thich (ma_baidang, ma_nguoidung) VALUES ($post_id, $user_id)";
        if ($conn->query($sql_insert) === TRUE) {
            // Cập nhật số lượng like của bài đăng
            $sql_update = "UPDATE posts SET likes = likes + 1 WHERE id = $post_id";
            $conn->query($sql_update);
            echo "Liked successfully";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        // Xóa like khỏi cơ sở dữ liệu
        $sql_delete = "DELETE FROM post_likes WHERE post_id = $post_id AND user_id = $user_id";
        if ($conn->query($sql_delete) === TRUE) {
            // Cập nhật số lượng like của bài đăng
            $sql_update = "UPDATE posts SET likes = likes - 1 WHERE id = $post_id";
            $conn->query($sql_update);
            echo "Unliked successfully";
        } else {
            echo "Error: " . $sql_delete . "<br>" . $conn->error;
        }
    }
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
