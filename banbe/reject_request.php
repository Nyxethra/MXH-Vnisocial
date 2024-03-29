<?php
// Kiểm tra xem yêu cầu POST có tồn tại không
if (isset($_POST["sender_id"]) && isset($_POST["user_id"])) {
    // Lấy dữ liệu gửi từ trình duyệt
    $sender_id = $_POST["sender_id"];
    $user_id = $_POST["user_id"];

    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'vnisocial');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Xóa yêu cầu kết bạn từ bảng yeucau_ketban
    $sql = "DELETE FROM yeucau_ketban WHERE ma_nguoigui = $sender_id AND ma_nguoinhan = $user_id";
    if ($conn->query($sql) === TRUE) {
        $response = array("success" => true, "message" => "Xóa yêu cầu kết bạn thành công", "user_name" => $user_name);
        echo json_encode($response);
    } else {
        $response = array("success" => false, "message" => "Lỗi: " . $conn->error);
        echo json_encode($response);
    }

    // Đóng kết nối
    $conn->close();
} else {
    $response = array("success" => false, "message" => "Yêu cầu POST không hợp lệ");
    echo json_encode($response);
}
?>
