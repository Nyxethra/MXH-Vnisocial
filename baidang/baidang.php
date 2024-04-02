<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Post</title>

    <!-- Thư viện FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* CSS để ẩn và thiết kế pop-up */
        .edit-popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            overflow: auto;
        }
        .container_baidang {
    margin-left: -7%;
    width: 97%;
    margin-top: 15%;
}

        .edit-popup-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            position: relative;
        }

        .edit-popup-close {
            color: #a72f2f;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .edit-popup-close:hover,
        .edit-popup-close:focus {
            color: black;
            text-decoration: none;
        }

        .custom-post {
            margin-top: 30px;
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background: white;
        }

        .custom-post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .edit-post {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
            color: #a72f2f;
            position: absolute;
            top: 0;
            right: 0;
        }

        .custom-user-info {
            display: flex;
            align-items: center;
        }

        .custom-user-avatar {
            margin-right: 10px;
        }

        .custom-user-details {
            display: flex;
            flex-direction: column;
        }

        .custom-post-date {
            margin-top: 5px;
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
            color: yellow;
        }

        .custom-post-actions .star.clicked {
            color: red;
        }

        .custom-user-details h3 {
            margin: 0;
            font-size: 21px;
        }

        .custom-user-avatar img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center;
        }

        .edit-post i.fa-cog {
            color: #a72f2f;
        }

        .custom-post-actions .star.liked {
            color: red;
        }

        .custom-user-details h3 {
            margin: 0;
            font-size: 21px;
        }

        .custom-user-avatar img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center;
        }

        /* Phần overlay pop-up chỉnh sửa */
        .edit-popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            overflow: auto;
        }

        /* Nội dung pop-up chỉnh sửa */
        .edit-popup-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Nút đóng pop-up */
        .edit-popup-close {
            color: #a72f2f;
            float: right;
            font-size: 30px;
            font-weight: bold;
        }

        .edit-popup-close:hover,
        .edit-popup-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="edit-popup-overlay" id="edit-popup-overlay">
        <div class="edit-popup-content">
            <span class="edit-popup-close" onclick="closeEditPopup()">&times;</span>
            <div id="edit-popup-content-container_baidang"></div>
        </div>
    </div>
    <div class="container_baidang">
    <?php
    // Kết nối vào cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'vnisocial');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Truy vấn lấy dữ liệu bài đăng
    // Truy vấn để lấy bài đăng mới nhất của bạn và tối đa 2 bài đăng của bạn bè
    $sql = "
            (SELECT 
                baidang.*, 
                nguoidung.ten_nguoidung, 
                nguoidung.avatar 
            FROM 
                baidang 
            INNER JOIN 
                nguoidung ON baidang.dang_boi = nguoidung.ma_nguoidung 
            WHERE 
                baidang.dang_boi = $user_id
            ORDER BY 
                baidang.thoigian_dang DESC
            LIMIT 
                1)
            UNION ALL
            (SELECT 
                baidang.*, 
                nguoidung.ten_nguoidung, 
                nguoidung.avatar 
            FROM 
                baidang 
            INNER JOIN 
                nguoidung ON baidang.dang_boi = nguoidung.ma_nguoidung 
            INNER JOIN 
                banbe ON (baidang.dang_boi = banbe.ma_nguoidung1 AND banbe.ma_nguoidung2 = $user_id)
                OR (baidang.dang_boi = banbe.ma_nguoidung2 AND banbe.ma_nguoidung1 = $user_id)
            WHERE
                baidang.dang_boi IN (
                    SELECT
                        ma_nguoidung1 AS ma_nguoidung
                    FROM
                        banbe
                    WHERE
                        ma_nguoidung2 = $user_id
                    UNION
                    SELECT
                        ma_nguoidung2 AS ma_nguoidung
                    FROM
                        banbe
                    WHERE
                        ma_nguoidung1 = $user_id
                )
            ORDER BY 
                RAND()  
            LIMIT 10)
        ";

    $result = $conn->query($sql);

    // Hiển thị bài đăng
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = "img/" . $row["image"];
    ?>
            <div class="custom-post">
                <div class="custom-post-header">
                    <div class="custom-user-info">
                        <div class="custom-user-avatar">
                            <?php
                            $avatarPath = "img/" . $row["avatar"];
                            echo '<img src="' . $avatarPath . '" alt="User Avatar">';
                            ?>
                        </div>
                        <div class="custom-user-details">
                        <h3>
    <a style="color:#333;" href="<?php echo ($row['dang_boi'] == $user_id) ? 'home.php?diden=trangcanhan' : 'home.php?diden=trangcanhan&id2=' . $row['dang_boi']; ?>" target="_blank" class="user-link">
        <span class="tnd"><?php echo $row["ten_nguoidung"]; ?></span>
    </a>
    <br>
</h3>
                            <p class="custom-post-date">Posted on <span class="custom-post-date"><?php echo $row["thoigian_dang"]; ?></span></p>
                        </div>
                    </div>
                </div>
                <div class="custom-post-content">
                    <p><?php echo $row["noidung"]; ?></p>
                </div>
                <?php if (!empty($row["image"]) && file_exists("img/" . $row["image"])) { ?>
                    <div class="custom-post-image">
                        <?php
                        $imagePath = "img/" . $row["image"];
                        echo '<img src="' . $imagePath . '" alt="Post Image">';
                        ?>
                    </div>
                <?php } ?>


                <div class="custom-post-actions">
                    <div class="custom-post-actions">
                        <button class="like-post" data-ma_baidang="<?php echo $row['ma_baidang']; ?>">
                            <?php
                            // Hiển thị số lượt like nếu có
                            if ($row['luong_like'] > 0) {
                                echo '<span class="like-count">(' . $row['luong_like'] . ')</span>';
                            }
                            ?>
                            <i class="fas fa-thumbs-up" style="color: #a72f2f;"></i>
                        </button>

                        <?php
                        // Ép kiểu integer
                        $changeTypeBd = (int)$row['ma_baidang'];
                        $maNd = $_SESSION['ma_nguoidung'];
                        ?>
                        <button onclick="handleOnclick(<?php echo $changeTypeBd; ?>, <?php echo $maNd; ?>)">
                            <i class="fas fa-comment" style="color: #a72f2f;"></i>
                        </button>
                        <button>
                            <i class="fas fa-share" style="color: #a72f2f;"></i>
                        </button>

                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "Không có bài viết để hiển thị";
    }
    ?>
</div>


    <!-- Thư viện Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Thư viện FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        //su kien binh luan
        const handleOnclick = (a, b) => {
            const ma_baidang = a
            const ma_nguoidung = b
            window.location.href = `BINHLUAN/comment_layout.php?ma_nguoidung=${ma_nguoidung}&ma_baidang=${ma_baidang}`;
        }

        // Thêm sự kiện click vào nút like
const likeButtons = document.querySelectorAll('.like-post');
likeButtons.forEach(button => {
    button.addEventListener('click', function() {
        const ma_baidang = button.getAttribute('data-ma_baidang');
        const isLiked = button.classList.contains('liked');

        // Gửi yêu cầu đến add_like.php để thêm hoặc xóa like
        fetch('baidang/add_like.php?ma_baidang=' + ma_baidang + '&isLiked=' + isLiked)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.classList.toggle('liked');

                    const likeCountElement = button.querySelector('.like-count');
                    if (likeCountElement) {
                        likeCountElement.innerText = '(' + data.luong_like + ')';
                    }

                    if (button.classList.contains('liked')) {
                        button.innerHTML = '<i class="fas fa-thumbs-up" style="color: red;"></i>';
                    } else {
                        button.innerHTML = '<i class="fas fa-thumbs-up" style="color: #a72f2f;"></i>';
                    }
                } else {
                    console.error(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });
});

</script>
</body>

</html>
