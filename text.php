<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $targetDir = "uploads/"; // Thư mục lưu trữ tệp tin
    $targetFile = $targetDir . basename($_FILES["file"]["name"]); // Đường dẫn đầy đủ đến tệp tin được tải lên

    // Kiểm tra kiểu tệp tin hợp lệ
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($fileType, $allowedTypes)) {
        echo "Chỉ được phép tải lên các tệp tin JPG, JPEG, PNG, GIF.";
        exit;
    }

    // Kiểm tra kích thước tệp tin
    $maxFileSize = 5 * 1024 * 1024; // Giới hạn kích thước tệp tin (đơn vị: byte)
    if ($_FILES["file"]["size"] > $maxFileSize) {
        echo "Kích thước tệp tin vượt quá giới hạn cho phép (5MB).";
        exit;
    }

    // Di chuyển tệp tin vào thư mục lưu trữ
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "Tải lên tệp tin thành công!";
    } else {
        echo "Lỗi trong quá trình tải lên tệp tin.";
    }
}
?>

<!-- Mẫu biểu mẫu HTML cho việc tải lên tệp tin -->
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Tải lên">
</form>