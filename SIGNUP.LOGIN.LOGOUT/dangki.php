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

// Kiểm tra xem người dùng đã gửi biểu mẫu đăng ký chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị từ biểu mẫu đăng ký
    $email = $_POST['email'];
    $matkhau = $_POST['matkhau'];
    $firstname = $_POST['firstname'];
    $lastname =$_POST['lastname'];
    $gioitinh = $_POST['gioitinh'];
    $ngay = $_POST['ngay'];
    $thang = $_POST['thang'];
    $nam = $_POST['nam'];

// Kiểm tra nếu ngày, tháng, năm không rỗng
if (!empty($ngay) && !empty($thang) && !empty($nam)) {
    // Tạo chuỗi ngày tháng hợp lệ
    $dateString = $nam . '-' . $thang . '-' . $ngay;
    
    // Chuyển đổi chuỗi thành kiểu dữ liệu datetime
    $datetime = new DateTime($dateString);

}else
{
    echo "Trống ngày tháng năm";
}
    $ten_nguoidung= ucfirst($firstname) . ucfirst($lastname);


    // Truy vấn cơ sở dữ liệu để kiểm tra xem tên người dùng đã tồn tại hay chưa
    $checkQuery = "SELECT * FROM nguoidung WHERE email = '$email'";
    $checkResult = $conn->query($checkQuery);
    
    if ($checkResult->num_rows > 0) {
        // Tên người dùng đã tồn tại
        echo 'Tên đăng nhập đã tồn tại!';
    } else {
        // Thực hiện truy vấn để thêm người dùng mới vào cơ sở dữ liệu
        $insertQuery = "INSERT INTO nguoidung (email, matkhau, ten_nguoidung,gioitinh,ngaysinh) 
        VALUES ('$email', '$matkhau','$ten_nguoidung','$gioitinh','" . $datetime->format('Y-m-d H:i:s') . "')";
        if ($conn->query($insertQuery) === TRUE) {
            // Đăng ký thành công
            header("location:../TRANG_CANHAN/trangcanhan.php");
        } else {
            // Đăng ký không thành công
            echo 'Đăng ký không thành công. Vui lòng thử lại!';
        }
    }
}
