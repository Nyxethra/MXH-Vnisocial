<?php
// Kiểm tra xem post_id có tồn tại không
if(isset($_GET['ma_baidang'])) {
    $post_id = $_GET['ma_baidang'];

    // Kết nối vào cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'vnisocial');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Truy vấn lấy thông tin của bài viết cần chỉnh sửa
    $sql = "SELECT * FROM baidang WHERE ma_baidang = $post_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Hiển thị form chỉnh sửa bài viết
        ?>
        <form method="post" action="update_post.php">
            <input type="hidden" name="ma_baidang" value="<?php echo $row['ma_baidang']; ?>">
            <div class="form-group">
                <label for="content">Nội dung: </label>
                <textarea class="form-control" id="content" name="content" rows="5"><?php echo $row['noidung']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </form>
        <?php
    } else {
        echo "Post not found.";
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Post ID is missing.";
}
?>
