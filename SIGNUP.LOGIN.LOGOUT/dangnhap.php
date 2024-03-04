<?php
session_start();

// Kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vnisocial";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Kiểm tra xem người dùng đã gửi biểu mẫu đăng nhập chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị từ biểu mẫu đăng nhập
    $email = $_POST['email'];
    $matkhau = $_POST['matkhau'];

    // Truy vấn cơ sở dữ liệu để kiểm tra xem tên người dùng và mật khẩu có khớp hay không
    $query = "SELECT ma_nguoidung FROM nguoidung WHERE email = '$email' AND matkhau = '$matkhau'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Tên người dùng và mật khẩu khớp
        $row = $result->fetch_assoc();
        $_SESSION['ma_nguoidung'] = $row['ma_nguoidung']; // Lưu mã người dùng vào session
        header("location:../home.php");
    } else {
        // Tên người dùng hoặc mật khẩu không chính xác
        echo 'Đăng nhập không thành công. Vui lòng kiểm tra lại thông tin đăng nhập!';
    }
}
?>
