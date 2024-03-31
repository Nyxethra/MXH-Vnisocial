<?php
// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

// Tạo kết nối
$conn = mysqli_connect("localhost", "root", "", "vnisocial");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xóa tài khoản
if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $sql = "DELETE FROM nguoidung WHERE ma_nguoidung = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}

$conn->close();
?>
