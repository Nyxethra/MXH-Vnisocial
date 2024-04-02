<?php
session_start(); // Bắt đầu session

// Kiểm tra xem người dùng đã gửi biểu mẫu đăng nhập hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu đăng nhập
    $email = $_POST['email'];
    $matkhau = $_POST['matkhau'];

    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "vnisocial");
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Truy vấn kiểm tra email và mật khẩu
    $sql = "SELECT * FROM nguoidung WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Tìm thấy người dùng với email đã nhập
        $row = $result->fetch_assoc();
        $ma_nguoidung = $row['ma_nguoidung'];
        $matkhau_hashed = $row['matkhau'];

        // Kiểm tra mật khẩu
        if (password_verify($matkhau, $matkhau_hashed)) {
            // Mật khẩu khớp, đăng nhập thành công
            $_SESSION['ma_nguoidung'] = $ma_nguoidung;
            header("Location: index.php"); // Chuyển hướng đến trang index.php
            exit();
        } else {
            // Mật khẩu không khớp, hiển thị thông báo lỗi
            $error_message = "Mật khẩu không đúng!";
        }
    } else {
        // Không tìm thấy người dùng với email đã nhập, hiển thị thông báo lỗi
        $error_message = "Email không tồn tại!";
    }

    // Đóng kết nối đến cơ sở dữ liệu
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
</head>

<body>
    <h2>Đăng nhập</h2>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Mật khẩu:</label>
        <input type="password" name="matkhau" required><br><br>
        <input type="submit" value="Đăng nhập">
    </form>
</body>

</html>