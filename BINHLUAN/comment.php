<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vnisocial";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}
// Xử lý khi người dùng gửi bình luận
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    // Lấy dữ liệu từ form
    $noidung_binhluan = $_POST["noidung_binhluan"];
    
    // Kiểm tra nếu bình luận không rỗng
    if (!empty($noidung_binhluan)) {
        // Thực hiện truy vấn để lưu bình luận vào cơ sở dữ liệu
        $sql = "INSERT INTO binhluan (noidung_binhluan) VALUES ('$noidung_binhluan')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Bình luận đã được lưu thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Vui lòng nhập bình luận của bạn.";
    }
}

?>