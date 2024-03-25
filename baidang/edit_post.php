<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Chỉnh sửa bài đăng</h2>
        <?php
        // Kiểm tra xem post_id có tồn tại không
        if(isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];

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
                    <input type="hidden" name="post_id" value="<?php echo $row['ma_baidang']; ?>">
                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea class="form-control" id="content" name="content" rows="5"><?php echo $row['noidung']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
    </div>
</body>
</html>
