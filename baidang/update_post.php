<?php
// Kiểm tra xem mã bài đăng và nội dung mới đã được gửi từ form không
if(isset($_POST['ma_baidang']) && isset($_POST['noidung_moi'])) {
    $ma_baidang = $_POST['ma_baidang'];
    $noidung_moi = $_POST['noidung_moi'];

    // Kết nối vào cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'vnisocial');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Xử lý xóa ảnh nếu được chọn
    if(isset($_POST['xoa_anh']) && $_POST['xoa_anh'] == 1) {
        // Truy vấn để lấy đường dẫn của ảnh cần xóa
        $sql = "SELECT image FROM baidang WHERE ma_baidang = $ma_baidang";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $image_path = $row['image'];
            // Xóa ảnh từ thư mục hoặc lưu trữ nơi khác nếu cần
            // Ví dụ:
            // unlink($image_path);
        }
        // Cập nhật cột image trong cơ sở dữ liệu thành NULL hoặc giá trị rỗng tùy theo cấu trúc của bạn
        $sql_delete_image = "UPDATE baidang SET image = NULL WHERE ma_baidang = $ma_baidang";
        if ($conn->query($sql_delete_image) === FALSE) {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Xử lý cập nhật nội dung mới
    $sql_update_content = "UPDATE baidang SET noidung = '$noidung_moi' WHERE ma_baidang = $ma_baidang";
    if ($conn->query($sql_update_content) === FALSE) {
        echo "Error updating record: " . $conn->error;
    }

    // Xử lý tải lên ảnh mới (nếu được chọn)
    if(isset($_FILES['anh_moi']) && $_FILES['anh_moi']['error'] === UPLOAD_ERR_OK) {
        $temp_name = $_FILES['anh_moi']['tmp_name'];
        $target_path = "uploads/"; // Đường dẫn đến thư mục lưu trữ ảnh mới
        $new_image_name = $target_path . basename($_FILES['anh_moi']['name']);

        // Di chuyển tệp tải lên vào thư mục lưu trữ
        if(move_uploaded_file($temp_name, $new_image_name)) {
            // Cập nhật đường dẫn ảnh mới vào cơ sở dữ liệu
            $sql_update_image = "UPDATE baidang SET image = '$new_image_name' WHERE ma_baidang = $ma_baidang";
            if ($conn->query($sql_update_image) === FALSE) {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Xin lỗi vì đã xảy ra sự cố upload hình ảnh";
        }
    }

    // Đóng kết nối
    $conn->close();

    // Chuyển hướng người dùng trở lại trang chủ hoặc trang chi tiết bài viết sau khi đã chỉnh sửa thành công
    header("Location: HOME.php");
    exit();
} else {
    echo "Thiếu thông tin cần thiết.";
}
?>
