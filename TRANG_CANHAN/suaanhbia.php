
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["cover_photo"])) {
    $coverPhoto = $_FILES["cover_photo"];

    // Kiểm tra xem có lỗi xảy ra trong quá trình tải lên không
    if ($coverPhoto["error"] > 0) {
        echo "Lỗi tải lên ảnh: " . $coverPhoto["error"];
    } else {
        // Đường dẫn lưu trữ tệp ảnh bìa
        $uploadDir = "uploads/cover_photos/";
        $uploadPath = $uploadDir . basename($coverPhoto["name"]);

        // Di chuyển tệp ảnh vào thư mục lưu trữ
        if (move_uploaded_file($coverPhoto["tmp_name"], $uploadPath)) {
            echo "Tải lên ảnh bìa thành công!";
        } else {
            echo "Lỗi tải lên ảnh bìa.";
        }
    }
}
?>