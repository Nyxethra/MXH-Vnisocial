<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị từ biểu mẫu đăng nhập
    $email = $_POST['email'];
    $matkhau = $_POST['matkhau'];

    // Kiểm tra giá trị đăng nhập với giá trị đã được lưu trữ
    // (Trong ví dụ này, chúng ta sẽ sử dụng giá trị đăng nhập cứng để minh họa)
    if ($email === '$email' && $matkhau === '$matkhau') {
        // Đăng nhập thành công
        $_SESSION['email'] = $email;
        header("Location: trangcanhan.php");
        echo 'Đăng nhập thành công!';
    } else {
        // Đăng nhập không thành công
        echo 'Tên đăng nhập hoặc mật khẩu không đúng!';
    }
}
?>