<?php

$servername = "localhost"; 
$username ="root"; 
$password = ""; 
$database = "vnisocial";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

}

?>

<?php
// Kiểm tra xem yêu cầu có phải là POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem có dữ liệu được gửi từ form không
    if (isset($_POST["sender_id"]) && isset($_POST["user_id"])) {
        // Lấy dữ liệu từ form
        $sender_id = $_POST["sender_id"];
        $user_id = $_POST["user_id"];

        // Xóa yêu cầu kết bạn từ bảng yeucau_ketban
        $delete_request_sql = "DELETE FROM yeucau_ketban WHERE ma_nguoinhan = $user_id AND ma_nguoigui = $sender_id";
        if ($conn->query($delete_request_sql) === TRUE) {
            // Thêm bản ghi mới vào bảng banbe
            $add_friend_sql = "INSERT INTO banbe (ma_nguoidung1, ma_nguoidung2) VALUES ($user_id, $sender_id)";
            if ($conn->query($add_friend_sql) === TRUE) {
                // Thêm bản ghi mới vào bảng thongbao
                $add_notification_sql = "INSERT INTO thongbao (thongbao_tu, thongbao_den, noidung_thongbao) VALUES ($user_id, $sender_id,  'đã đồng ý kết bạn')";
                if ($conn->query($add_notification_sql) === TRUE) {
                    // Trả về phản hồi JSON thành công
                    $response = array("success" => true, "message" => "Đã chấp nhận yêu cầu kết bạn từ người dùng có ID $sender_id");
                    echo json_encode($response);
                } else {
                    // Trả về phản hồi JSON với thông báo lỗi nếu không thể thêm vào bảng thongbao
                    $response = array("success" => false, "message" => "Lỗi khi thêm vào bảng thongbao: " . $conn->error);
                    echo json_encode($response);
                }
            } else {
                // Trả về phản hồi JSON với thông báo lỗi nếu không thể thêm vào bảng banbe
                $response = array("success" => false, "message" => "Lỗi khi thêm vào bảng banbe: " . $conn->error);
                echo json_encode($response);
            }
        } else {
            // Trả về phản hồi JSON với thông báo lỗi nếu không thể xóa yêu cầu kết bạn từ bảng yeucau_ketban
            $response = array("success" => false, "message" => "Lỗi khi xóa yêu cầu kết bạn từ bảng yeucau_ketban: " . $conn->error);
            echo json_encode($response);
        }

        // Đóng kết nối đến cơ sở dữ liệu
        
    } else {
        // Trả về phản hồi JSON với thông báo lỗi nếu dữ liệu không hợp lệ
        $response = array("success" => false, "message" => "Dữ liệu không hợp lệ");
        echo json_encode($response);
    }
} else {
    // Trả về phản hồi JSON với thông báo lỗi nếu yêu cầu không phải là POST
    $response = array("success" => false, "message" => "Yêu cầu không hợp lệ");
    echo json_encode($response);
}

?>
