<!DOCTYPE html>
<html>
<head>
    <title>Tải lên ảnh đại diện mới</title>
</head>
<body>
    <h2>Tải lên ảnh đại diện mới</h2>
    <form action="upload_avatar.php" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar">
        <button type="submit" name="submit">Tải lên</button>
    </form>
</body>
</html>

<?php
// Kiểm tra xem người dùng đã gửi tệp lên chưa
if(isset($_FILES['avatar'])) {
    // Đường dẫn đến thư mục lưu trữ ảnh đại diện
    $target_dir = "uploads/";
    // Tạo tên tệp mới dựa trên thời gian để tránh trùng lặp
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    // Lấy phần mở rộng của tệp
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Kiểm tra xem tệp có phải là hình ảnh hay không
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if($check !== false) {
        // Kiểm tra kích thước tệp
        if ($_FILES["avatar"]["size"] > 500000) {
            echo "Xin lỗi, tệp của bạn quá lớn.";
        } else {
            // Di chuyển tệp tải lên vào thư mục lưu trữ
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                echo "Tệp ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " đã được tải lên thành công.";
            } else {
                echo "Xảy ra lỗi khi tải lên tệp.";
            }
        }
    } else {
        echo "Tệp của bạn không phải là hình ảnh.";
    }
}
?>
