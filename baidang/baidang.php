<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Thư viện FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .custom-post {
            margin-top: 30px;
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 570px;
        }

        .custom-user-info {
            display: flex;
            align-items: center;
            /* Căn chỉnh theo chiều dọc */
        }

        .custom-user-avatar {
            margin-right: 10px;
            /* Khoảng cách giữa avatar và thông tin người dùng */
        }

        .custom-user-details {
            display: flex;
            flex-direction: column;
            /* Xếp dọc các phần tử */
        }

        .custom-post-date {
            margin-top: 5px;
            /* Khoảng cách giữa tên người dùng và thời gian đăng bài */
        }

        .custom-post-content p {
            font-size: 16px;
            margin: 16px 0px 16px 0px;
        }

        .custom-post-image img {
            max-width: 100%;
            border-radius: 8px;
        }

        .custom-post-actions button {
            background-color: transparent;
            border: none;
            color: #333;
            margin-right: 10px;
        }

        .custom-post-actions .star {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
            /* Kích thước icon */
            color: yellow;
            /* Màu của icon mặc định */
        }

        .custom-post-actions .star.clicked {
            color: red;
            /* Màu của icon khi được click */
        }

        .custom-user-details h3 {
            margin: 0;
            font-size: 21px;
            /* Kích thước font nhỏ hơn */
        }

        .custom-user-avatar img {
            width: 45px;
            /* Độ rộng */
            height: 45px;
            /* Chiều cao */
            border-radius: 50%;
            /* Bo tròn */
            object-fit: cover;
            /* Đảm bảo hình ảnh không bị vỡ */
            object-position: center;
            /* Căn giữa */
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Kết nối vào cơ sở dữ liệu
        $conn = new mysqli('localhost', 'root', '', 'vnisocial');

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
 
        // Truy vấn lấy dữ liệu bài đăng
        $sql = "SELECT baidang.ma_baidang, baidang.*, nguoidung.ten_nguoidung, nguoidung.avatar 
                FROM baidang 
                INNER JOIN nguoidung ON baidang.dang_boi = nguoidung.ma_nguoidung 
                ORDER BY baidang.thoigian_dang 
                LIMIT 10";
        $result = $conn->query($sql);

        // Hiển thị bài đăng
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                // @var_dump($row['ma_baidang']);
                // Tạo đường dẫn hoàn chỉnh cho hình ảnh bài đăng
                $imagePath = "img/" . $row["image"];
        ?>
                <div class="custom-post">
                    <div class="custom-post-header">
                        <div class="custom-user-info">
                            <div class="custom-user-avatar">
                                <?php
                                // Tạo đường dẫn hoàn chỉnh cho avatar người dùng
                                $avatarPath = "img/" . $row["avatar"];
                                echo '<img src="' . $avatarPath . '" alt="User Avatar">';
                                ?>
                            </div>
                            <div class="custom-user-details">
                                <h3><?php echo $row["ten_nguoidung"]; ?></h3>
                                <p class="custom-post-date">Posted on <span class="custom-post-date"><?php echo $row["thoigian_dang"]; ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="custom-post-content">
                        <p><?php echo $row["noidung"]; ?></p>
                    </div>
                    <div class="custom-post-image"><img src="<?php echo $imagePath; ?>" alt="Post Image"></div>
                    <div class="custom-post-actions">
                        <button class="star" data-post-id="<?php echo $row['ma_baidang']; ?>"><i class="fas fa-star"></i></button>
                        <button id="comment-btn">Comment</button>
                        <?php

                        // @var_dump($row['ma_baidang']);
                        ?>
                        <script>
                            var commentBtn = document.getElementById("comment-btn");
                            // Lắng nghe sự kiện click của nút "Comment"
                            document.getElementById("comment-btn").addEventListener("click", function() {
                                // Lấy giá trị session của bài đăng

                                var ma_baidang = "<?php echo $row['ma_baidang']; ?>"; // Thay đổi $row['ma_baidang'] thành biến chứa giá trị session
                        //     <?php
                        // @var_dump($_SESSION['ma_baidang']);
                        // ?>

                        // Chuyển hướng tới trang bình luận với giá trị session được truyền qua URL query parameter
                        window.location.href = "../Vnisocial_For_Vietnamese/BINHLUAN/comment_layout.php?ma_baidang=" + ma_baidang;
                        // $_SESSION['ma_baidang']=$row['ma_baidang'];
                        });

                        </script>
                        <button>Share</button>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No posts found";
        }
        // Đóng kết nối
        // $conn->close();
        ?>


    </div>

    <!-- Thư viện Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Thư viện FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        // JavaScript để xử lý sự kiện click vào nút "Sao"
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    if (star.classList.contains('clicked')) {
                        star.classList.remove('clicked');
                    } else {
                        star.classList.add('clicked');
                    }
                });
            });
        });
    </script>

</body>

</html>