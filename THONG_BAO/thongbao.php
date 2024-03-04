<?php

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "vnisocial");

// Kiểm tra kết nối
if ($conn->connect_error){
  die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn nội dung thông báo từ cơ sở dữ liệu
$sql = "SELECT nguoidung.ten_nguoidung, thongbao.noidung_thongbao 
        FROM thongbao 
        INNER JOIN nguoidung ON thongbao.thongbao_tu = nguoidung.ma_nguoidung 
        WHERE thongbao_tu != '$user_id' 
        ORDER BY thoidiem_thongbao DESC";

$result = $conn->query($sql);

// Kiểm tra và lấy nội dung thông báo
$notifications = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $notification_content = $row["ten_nguoidung"] . " " . $row["noidung_thongbao"];
    array_push($notifications, $notification_content);
  }
} else {
  echo "Không có thông báo mới";
}

// Truy vấn số lượng thông báo từ bảng notifications
$sql = "SELECT COUNT(*) AS tong_tb FROM thongbao";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Lấy số lượng thông báo từ kết quả truy vấn
  $row = $result->fetch_assoc();
  $notification_count = $row["tong_tb"];
} else {
  $notification_count = 0; // Nếu không có thông báo nào, đặt số lượng thông báo là 0
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>