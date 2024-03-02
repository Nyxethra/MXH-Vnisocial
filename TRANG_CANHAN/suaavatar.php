<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa ảnh đại diện</title>
</head>
<body>
    <h2>Tải lên ảnh đại diện mới</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar">
        <button type="submit" name="submit">Tải lên ảnh đại diện</button>
    </form>
</body>
</html>

<?php
// Kiểm tra xem người dùng đã tải lên ảnh hay chưa
if(isset($_POST["submit"])) {
    // Đường dẫn lưu trữ ảnh đại diện trên máy chủ
    $target_dir = "uploads/avatars/";
    // Tạo đường dẫn mới cho ảnh đại diện
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    // Di chuyển tệp tải lên vào thư mục đích
    move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
    
    // Thực hiện các công việc khác như lưu đường dẫn vào cơ sở dữ liệu
}
?>
