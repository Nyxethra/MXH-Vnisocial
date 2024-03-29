<?php
// Kiểm tra xem yêu cầu có phải là phương thức POST không
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Kiểm tra xem có tham số ma_baidang được gửi đến không
    if (isset($_GET['ma_baidang'])) {
        // Lấy ma_baidang từ tham số GET
        $ma_baidang = $_GET['ma_baidang'];
        // Giả sử rằng thich_boi là ID của người dùng đang thực hiện hành động like,
        // bạn cần thay đổi phần này để lấy ID của người dùng từ hồ sơ người dùng hoặc bất kỳ phương thức nào khác
        $thich_boi = 1; // ID của người dùng đang thực hiện hành động like

        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli('localhost', 'root', '', 'vnisocial');

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Kiểm tra xem người dùng đã thích bài đăng này trước đó chưa
        $sql_check_like = "SELECT * FROM thich WHERE thich_boi = $thich_boi AND ma_baidang = $ma_baidang";
        $result_check_like = $conn->query($sql_check_like);

        if ($result_check_like->num_rows > 0) {
            // Nếu đã like, trả về kết quả là đã like
            echo json_encode(array("success" => false, "isLiked" => true));
        } else {
            // Nếu chưa like, thêm lượt thích và trả về kết quả là đã like thành công
            $sql_insert_like = "INSERT INTO thich (thich_boi, ma_baidang) VALUES ('$thich_boi', '$ma_baidang')";
            if ($conn->query($sql_insert_like) === TRUE) {
                echo json_encode(array("success" => true, "isLiked" => true));
            } else {
                echo json_encode(array("success" => false, "message" => "Error adding like: " . $conn->error));
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
