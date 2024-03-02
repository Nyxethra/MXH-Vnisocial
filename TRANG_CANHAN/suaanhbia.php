<!DOCTYPE html>
<html>
<head>
    <title>Tải lên ảnh bìa mới</title>
</head>
<body>
    <h2>Tải lên ảnh bìa mới</h2>
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
    // Lấy phần mở rộng của tệp
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Kiểm tra xem tệp có phải là hình ảnh hay không
    $check = getimagesize($_FILES["cover"]["tmp_name"]);
    if($check !== false) {
        // Cho phép tải lên nếu tệp là hình ảnh
        move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file);
        echo "Tải lên ảnh bìa thành công.";
    } else {
        echo "Tệp không phải là ảnh.";
    }
}
?>
