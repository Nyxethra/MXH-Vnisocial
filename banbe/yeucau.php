<?php
// Kết nối CSDL
$pdo = new PDO('mysql:host=localhost;dbname=vnisocial', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user_id = $_POST['user_id'];
$friend_id = $_POST['friend_id'];


// Lấy thông tin người gửi
$stmt = $pdo->prepare("SELECT ten_nguoidung FROM nguoidung WHERE ma_nguoidung = ?");
$stmt->execute([$user_id]);
$user_name = $stmt->fetchColumn();

// Tạo bản ghi mới trong bảng `yeucau_ketban`
$sql = "INSERT INTO yeucau_ketban (ma_nguoigui, ma_nguoinhan, status) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id, $friend_id, 'Đã gửi']);

// Tạo bản ghi mới trong bảng `thongbao`
$sql = "INSERT INTO thongbao (thongbao_tu, noidung_thongbao, thongbao_den, thoidiem_thongbao) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([ $user_id, " Đã gửi lời mới kết bạn cho bạn ",$friend_id, date('Y-m-d H:i:s')]);

// Phản hồi về dưới dạng JSON
$response = array("success" => true, "message" => "Yêu cầu kết bạn đã được gửi.");
echo json_encode($response);
?>





