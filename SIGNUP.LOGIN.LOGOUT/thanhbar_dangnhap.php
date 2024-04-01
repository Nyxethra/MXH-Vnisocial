<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
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

// Khởi tạo giá trị mặc định cho $email_r và $matkhau_r
$email_r = "";
$matkhau_r = "";


// Kiểm tra xem người dùng đã gửi biểu mẫu đăng nhập chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị từ biểu mẫu đăng nhập
    $email = $_POST['email'];
    $matkhau = $_POST['matkhau'];

    // //truy vấn email hợp lệ
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     echo "<script>
    //         Swal.fire({
    //             title: 'Email không hợp lệ!',
    //             icon: 'error',
    //             button: 'Đóng'
    //         });
    //     </script>";
    //     // exit; // Dừng việc thực thi mã PHP tiếp theo
    // }

    // Truy vấn cơ sở dữ liệu để kiểm tra xem tên người dùng và mật khẩu có khớp hay không
    $query = "SELECT * FROM nguoidung WHERE email = '$email' OR matkhau = '$matkhau'";
    $result = $conn->query($query);


    if ($result->num_rows > 0) {
        // Tên người dùng và mật khẩu khớp
        $row = $result->fetch_assoc();
        $email_r = $row['email'];
        $matkhau_r = $row['matkhau'];
        if ($email != $email_r) {
            echo "<script>
        swal.fire({
            title: 'Email hoặc mật khẩu không đúng!',
            icon: 'error',
            button: 'Đóng'
        });
    </script>";
        } else {
            if ($matkhau != $matkhau_r) {
                echo "<script>
        swal.fire({
            title: 'Email hoặc mật khẩu không đúng!',
            icon: 'error',
            button: 'Đóng'
        });
    </script>";
            }else{
                $_SESSION['ma_nguoidung'] = $row['ma_nguoidung']; // Lưu mã người dùng vào session
                echo  "<script>window.location.href = '../home.php';</script>";
            }
        }

        }else{
                echo "<script>
                swal.fire({
                    title: 'Tài khoản không tồn tại!',
                    icon: 'error',
                    button: 'Đóng'
                });
            </script>";
            
    }
} ?>

<body>
    <?php
    ?>
    <div class="thanhbar">
        <img src="../IMG/logo.png" class="logo">
        <form class="login_form" name ="login_form" method="POST" action="">
            <div class="email">
                <div class="font">Email</div>
                <input type="text" name="email" require>
            </div>
            <div class="password">
                <div class="font">Mật khẩu</div>
                <input type="password" name="matkhau" require>
            </div>
            <button class="btn">Đăng nhập</button>
        </form>
    </div>

    </header>

</body>

</html>