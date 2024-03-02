<!DOCTYPE html>
<html>
<head>
    <title>Tải lên ảnh bìa mới</title>
</head>
<body>Tải lên ảnh bìa mới</h2>
    <form action="upload_cover.php" method="post" enctype="multipart/form-data">
    <input type="file" name="cover">
    <button type="submit" name="submit">Tải lên ảnh bìa</button>
</form>
</body>
</html>


<?php
// Kiểm tra xem người dùng đã tải lên ảnh hay chưa
if(isset($_POST["submit"])) {
    // Đường dẫn lưu trữ ảnh bìa trên máy chủ
    $target_dir = "uploads/covers/";
    // Tạo đường dẫn mới cho ảnh bìa
    $target_file = $target_dir . basename($_FILES["cover"]["name"]);
    // Di chuyển tệp tải lên vào thư mục đích
    move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file);
    
}
?>
