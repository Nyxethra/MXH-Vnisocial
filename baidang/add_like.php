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

        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli('localhost', 'root', '', 'vnisocial');

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Chuẩn bị câu truy vấn SQL để kiểm tra xem người dùng đã thích bài đăng này trước đó chưa
        $sql_check_like = "SELECT * FROM thich WHERE thich_boi = $thich_boi AND ma_baidang = $ma_baidang";

        // Thực thi câu truy vấn
        $result_check_like = $conn->query($sql_check_like);

        // Kiểm tra xem câu truy vấn có lỗi không
        if ($result_check_like === FALSE) {
            echo json_encode(array("success" => false, "message" => "Error: " . $conn->error));
        } else {
            // Nếu câu truy vấn không có lỗi, kiểm tra xem người dùng đã like bài đăng này chưa
            if ($result_check_like->num_rows > 0) {
                // Nếu đã like, trả về kết quả là đã like
                echo json_encode(array("success" => true, "isLiked" => true));
            } else {
                // Nếu chưa like, trả về kết quả là chưa like
                echo json_encode(array("success" => true, "isLiked" => false));
            }

            // Sau khi kiểm tra, cập nhật số lượt "Like" và trả về số lượt "Like" mới
            $sql_like_count = "SELECT COUNT(*) AS likeCount FROM thich WHERE ma_baidang = $ma_baidang";
            $result_like_count = $conn->query($sql_like_count);
            if ($result_like_count->num_rows > 0) {
                $row_like_count = $result_like_count->fetch_assoc();
                $likeCount = $row_like_count['likeCount'];
                // Trả về số lượt "Like" mới trong kết quả JSON
                echo json_encode(array("success" => true, "isLiked" => false, "likeCount" => $likeCount));
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

// // JavaScript để xử lý sự kiện click vào nút "Sao"
// document.addEventListener('DOMContentLoaded', function() {
//     const stars = document.querySelectorAll('.star');
//     stars.forEach(star => {
//         star.addEventListener('click', function() {
//             if (star.classList.contains('clicked')) {
//                 star.classList.remove('clicked');
//             } else {
//                 star.classList.add('clicked');
//             }
//         });
//     });
// });

?>
