<?php
// Kiểm tra xem ma_baidang đã được gửi từ form không
if(isset($_GET['ma_baidang'])) {
    $ma_baidang = $_GET['ma_baidang'];

    // Kết nối vào cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'vnisocial');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Truy vấn lấy thông tin của bài viết cần chỉnh sửa
    $sql = "SELECT * FROM baidang WHERE ma_baidang = $ma_baidang";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!-- Hiển thị form chỉnh sửa -->
        <form action="baidang/update_post.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="ma_baidang" value="<?php echo $ma_baidang; ?>">
            <!-- Hiển thị nội dung bài viết -->
            <textarea name="noidung_moi" width: 550px;height: 206px;resize: none;><?php echo $row['noidung']; ?> </textarea>
            <!-- Hiển thị ảnh hiện tại (nếu có) -->
            <?php if(!empty($row['image'])): ?>
                <img src="<?php echo $row['image']; ?>" alt="Post Image">
                <!-- Thêm nút để người dùng xóa ảnh hiện tại -->
                <label>Xóa ảnh hiện tại:</label>
                <input type="checkbox" name="xoa_anh" value="1">
            <?php endif; ?>
            <!-- Trường để người dùng chọn và tải lên ảnh mới -->
            <label>Chọn ảnh mới:</label>
            <input type="file" name="anh_moi">
            <!-- Nút "Lưu" để gửi dữ liệu form -->
            <button type="submit">Lưu</button>
        </form>
        <?php
    } else {
        echo "Bài viết không tồn tại.";
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Thiếu ID bài viết.";
}
?>
