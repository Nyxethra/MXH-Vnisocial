<?php

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "vnisocial");

// Kiểm tra kết nối
if ($conn->connect_error){
  die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn nội dung thông báo từ cơ sở dữ liệu của người dùng hiện tại
$sql = "SELECT thongbao.noidung_thongbao, nguoidung.ten_nguoidung
FROM thongbao
JOIN nguoidung ON thongbao.thongbao_tu = nguoidung.ma_nguoidung
WHERE thongbao.thongbao_den = $user_id ORDER BY thoidiem_thongbao DESC;";

$result = $conn->query($sql);

// Kiểm tra và lấy nội dung thông báo
$notifications = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $notification_content = $row["ten_nguoidung"] . " " . $row["noidung_thongbao"];
    array_push($notifications, $notification_content);
  }
} else {
  // Nếu không có thông báo nào, đặt thông báo "Hiện tại chưa có thông báo"
  array_push($notifications, "Hiện tại chưa có thông báo");
}

// Đóng kết nối đến cơ sở dữ liệu

?>
