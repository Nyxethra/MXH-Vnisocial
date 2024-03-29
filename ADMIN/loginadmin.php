<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";
session_start();

// Tạo kết nối
$db = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($db->connect_error) {
  die("Kết nối thất bại: " . $db->connect_error);
}

// Lấy dữ liệu từ form đăng nhập
$email = $_POST['email'];
$matkhau = $_POST['matkhau'];

// Kiểm tra thông tin đăng nhập
$query = "SELECT * FROM inforadmin WHERE email = '$email'";
$result = $db->query($query);
$user = $result->fetch_assoc();

if ($matkhau == $user['matkhau']) {
    // Nếu thông tin đăng nhập chính xác, thiết lập phiên
    $_SESSION['email'] = $email;

    // Nếu người dùng là quản trị viên, chuyển hướng họ đến trang index của quản trị viên
    if ($email == 'email') {
        $_SESSION['isAdmin'] = true;
        header('Location: index.php');
        exit();
    }
} else {
    // Nếu thông tin đăng nhập không chính xác, hiển thị lỗi
    echo "Thông tin đăng nhập không chính xác.";
}
?>
