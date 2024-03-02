<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "vnisocial";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn số lượng thông báo từ bảng notifications
$sql = "SELECT COUNT(*) AS total FROM notifications";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Lấy số lượng thông báo từ kết quả truy vấn
  $row = $result->fetch_assoc();
  $notification_count = $row["total"];
} else {
  $notification_count = 0; // Nếu không có thông báo nào, đặt số lượng thông báo là 0
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();

?>