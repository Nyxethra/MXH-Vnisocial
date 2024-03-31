<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <!-- Thư viện Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Thư viện SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

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

// Biến để theo dõi lỗi
$error_msg = "";

// Kiểm tra xem người dùng đã gửi biểu mẫu đăng nhập chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị từ biểu mẫu đăng nhập
    $email = $_POST['email'];
    $matkhau = $_POST['matkhau'];

    // Truy vấn cơ sở dữ liệu để kiểm tra xem tên người dùng và mật khẩu có khớp hay không
    $query = "SELECT ma_nguoidung FROM nguoidung WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Kiểm tra mật khẩu
        $query_check_password = "SELECT ma_nguoidung FROM nguoidung WHERE email = '$email' AND matkhau = '$matkhau'";
        $result_check_password = $conn->query($query_check_password);

        if ($result_check_password->num_rows > 0) {
            // Tên người dùng và mật khẩu khớp
            $_SESSION['ma_nguoidung'] = $row['ma_nguoidung']; // Lưu mã người dùng vào session
            
            // Hiển thị thông báo đăng nhập thành công bằng SweetAlert
            echo "<script>
                Swal.fire({
                    title: 'Đăng nhập thành công!',
                    icon: 'success',
                    confirmButtonColor: '#28a745',
                    confirmButtonText: 'Đóng'
                }).then(() => {
                    window.location.href = '../home.php'; // Chuyển hướng sau khi nhấn nút 'Đóng'
                });
            </script>";
        } else {
            // Sai mật khẩu
            $error_msg = "Sai mật khẩu.";
        }
    } else {
        // Sai email
        $query_check_email = "SELECT ma_nguoidung FROM nguoidung WHERE email = '$email'";
        $result_check_email = $conn->query($query_check_email);
        if ($result_check_email->num_rows === 0) {
            $error_msg = "Sai email.";
        } else {
            // Sai cả email và mật khẩu (tài khoản không tồn tại)
            $error_msg = "Tài khoản không tồn tại.";
        }
    }
}
?>

<script>
    // Hiển thị thông báo lỗi bằng SweetAlert
    <?php if (!empty($error_msg)): ?>
        Swal.fire({
            title: 'Lỗi!',
            text: '<?php echo $error_msg; ?>',
            icon: 'error',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Đóng'
        }).then(() => {
            window.location.href = 'login.php'; // Chuyển hướng về trang login.php
        });
    <?php endif; ?>
</script>

</body>
</html>
