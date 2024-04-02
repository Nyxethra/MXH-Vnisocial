<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    <?php
    // Thông tin kết nối CSDL
    $servername = "localhost";
    $username = "root";
    $matkhau = "";
    $dbname = "admin";

    // Khởi động phiên
    session_start();
    $conn = new mysqli($servername, $username, $matkhau, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

        // Xử lý đăng nhập
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $matkhau = $_POST['matkhau'];

        // Xây dựng truy vấn SQL
        $sql = "SELECT * FROM inforadmin WHERE email='$email' AND matkhau='$matkhau'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Đăng nhập thành công, chuyển hướng đến trang index.php
            header("Location: index.php");
            exit();
        } else {
            // Đăng nhập thất bại, hiển thị thông báo lỗi bằng SweetAlert2
            echo '<script>
            Swal.fire({
                icon: "error",
                title: "ERROR...",
                text: "Dăng nhập thất bại!",
               timer:3000
            }).then(function() {
                window.location = "layoutadmin.php";
            });
        </script>';
        }
    }

    
    ?>

</body>
</html>