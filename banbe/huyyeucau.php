<?php
// Kiểm tra xem yêu cầu có phải là POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem có dữ liệu được gửi từ form không
    if (isset($_POST["friend_id"]) && isset($_POST["user_id"])) {
        // Lấy dữ liệu từ form
        $friend_id = $_POST["friend_id"];
        $user_id = $_POST["user_id"];

        // Xóa bản ghi từ bảng banbe
        $delete_friend_sql = "DELETE FROM banbe WHERE (ma_nguoidung1 = $user_id AND ma_nguoidung2 = $friend_id) OR (ma_nguoidung1 = $friend_id AND ma_nguoidung2 = $user_id)";
        if ($conn->query($delete_friend_sql) === TRUE) {
            // Trả về phản hồi JSON thành công
            $response = array("success" => true, "message" => "Đã xóa bạn bè giữa người dùng có ID $user_id và người dùng có ID $friend_id");
            echo json_encode($response);
        } else {
            // Trả về phản hồi JSON với thông báo lỗi nếu không thể xóa bản ghi từ bảng banbe
            $response = array("success" => false, "message" => "Lỗi khi xóa từ bảng banbe: " . $conn->error);
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
