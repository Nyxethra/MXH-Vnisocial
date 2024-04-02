<?php
// Kiểm tra xem yêu cầu có phải là phương thức GET không
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Kiểm tra xem có tham số ma_baidang được gửi đến không
    if (isset($_GET['ma_baidang'])) {
        // Lấy ma_baidang từ tham số GET
        $ma_baidang = $_GET['ma_baidang'];
        // Giả sử rằng thich_boi là ID của người dùng đang thực hiện hành động like,
        // bạn cần thay đổi phần này để lấy ID của người dùng từ hồ sơ người dùng hoặc bất kỳ phương thức nào khác
        $thich_boi = 1; // ID của người dùng đang thực hiện hành động like

    
        // Kiểm tra xem người dùng đã like bài đăng này trước đó chưa
        $sql_check_like = "SELECT * FROM thich WHERE thich_boi = $thich_boi AND ma_baidang = $ma_baidang";
        $result_check_like = $conn->query($sql_check_like);

        // Kiểm tra xem câu truy vấn có lỗi không
        if ($result_check_like === FALSE) {
            echo json_encode(array("success" => false, "message" => "Error: " . $conn->error));
        } else {
            // Nếu câu truy vấn không có lỗi
            if ($result_check_like->num_rows > 0) {
                // Nếu đã like, xóa like
                $sql_delete_like = "DELETE FROM thich WHERE thich_boi = $thich_boi AND ma_baidang = $ma_baidang";
                if ($conn->query($sql_delete_like) === TRUE) {
                    // Trả về thông báo thành công
                    echo json_encode(array("success" => true, "isLiked" => false));
                } else {
                    echo json_encode(array("success" => false, "message" => "Error deleting like: " . $conn->error));
                }
            } else {
                // Nếu chưa like, thêm like
                $sql_add_like = "INSERT INTO thich (thich_boi, ma_baidang) VALUES ($thich_boi, $ma_baidang)";
                if ($conn->query($sql_add_like) === TRUE) {
                    // Trả về thông báo thành công
                    echo json_encode(array("success" => true, "isLiked" => true));
                } else {
                    echo json_encode(array("success" => false, "message" => "Error adding like: " . $conn->error));
                }
            }
        }

        // Đóng kết nối
        $conn->close();
    } else {
        // Thiếu tham số ma_baidang, trả về thông báo lỗi
        echo json_encode(array("success" => false, "message" => "Post ID is missing."));
    }
} else {
    // Yêu cầu không hợp lệ, trả về thông báo lỗi
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
?>
