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
    background-color: rgba(0, 0, 0, 0.5); /* Màu nền mờ */
    z-index: 999; /* Đảm bảo pop-up hiển thị trên cùng */
    overflow: auto;
}

.edit-popup-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.edit-popup-close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.edit-popup-close:hover,
.edit-popup-close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.custom-post {
    margin-top: 30px;
    margin-bottom: 30px;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: 570px;
    background: white;
    margin-left: 41px;
}

                .custom-post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative; /* Thêm thuộc tính position để tạo vùng chứa cho icon */
        }

        .edit-post {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
            color: #a72f2f; /* Màu của icon */
            position: absolute; /* Thiết lập vị trí tuyệt đối */
            top: 0; /* Đẩy nút lên đỉnh header */
            right: 0; /* Đẩy nút sang phải cùng */
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
            /* Màu của biểu tượng bánh răng */
        .edit-post i.fa-cog {
            color: #a72f2f; /* Màu #a72f2f */
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
        background-color: rgba(0, 0, 0, 0.5); /* Màu nền mờ */
        z-index: 999; /* Đảm bảo pop-up hiển thị trên cùng */
        overflow: auto;
    }
         /* Nội dung pop-up chỉnh sửa */
    .edit-popup-content {
        background-color: #fff;
        margin: 5% auto; /* Hiển thị pop-up ở giữa màn hình */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Chiều rộng pop-up */
        max-width: 600px; /* Chiều rộng tối đa của pop-up */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Nút đóng pop-up */
    .edit-popup-close {
        color: #aaa;
        float: right;
        font-size: 28px;
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
        <div id="edit-popup-content-container"></div>
    </div>
</div>

 
        <div class="container">
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
                                <h3><a style="color:#333;" href='home.php?diden=trangcanhan_nl&id2=" . urlencode($row["ma_nguoidung"]) . "' target='_blank' class='user-link'><span class='tnd'> <?php echo$row["ten_nguoidung"];?></span></a><br></h3>
                                <p class="custom-post-date">Posted on <span class="custom-post-date"><?php echo $row["thoigian_dang"]; ?></span></p>
                            </div>
                            <div class="custom-post-actions">
                                     <button class="edit-post" data-post-id="<?php echo $row['ma_baidang']; ?>"><i class="fas fa-cog" style="color: #a72f2f;"></i></button>
                                </div>
                        </div>
                    </div>
                    <div class="custom-post-content">
                        <p><?php echo $row["noidung"]; ?></p>
                    </div>
                    <div class="custom-post-image"><img src="<?php echo $imagePath; ?>" alt="Post Image"></div>
                    <div class="custom-post-actions">
                        <button class="star" data-ma_baidang="<?php echo $row['ma_baidang']; ?>"><i class="fas fa-star"></i></button>
                        <button class="like-post" data-ma_baidang="<?php echo $row['ma_baidang']; ?>">
                            <i class="fas fa-thumbs-up" style="color: #a72f2f;"></i>
                            <span class="like-count">(<?php echo $row['luong_like']; ?>)</span>
                            </button>
                            <button id="comment-btn" data-ma_nguoidung="<?php echo $row['ma_baidang']?>" data-ma_baidang="<?php echo $row['ma_baidang']?>">
                              <i class="fas fa-comment"style="color: #a72f2f;"></i> <!-- Assuming you're using Font Awesome -->
                            </button>
                            <button>
                             <i class="fas fa-share"style="color: #a72f2f;"></i> <!-- Assuming you're using Font Awesome -->
                            </button>

                    </div>
                </div>
        <?php
            }
        } else {
            echo "No posts found";
        }
        ?>
    </div>

    <!-- Thư viện Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Thư viện FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
            // Thêm sự kiện click cho nút "Comment"
            const commentButtons = document.querySelectorAll('.comment-btn');
            commentButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const ma_nguoidung = button.getAttribute('data-ma_nguoidung');
                    const ma_baidang = button.getAttribute('data-ma_baidang');
                    window.location.href = 'BINHLUAN/comment.php?ma_nguoidung=' + ma_nguoidung + '&ma_baidang=' + ma_baidang;
                });
            });

            // Thêm sự kiện click vào nút like và chỉnh sửa
document.addEventListener('DOMContentLoaded', function() {
    // Thêm sự kiện click vào nút like
    const likeButtons = document.querySelectorAll('.like-post');
    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const ma_baidang = button.getAttribute('data-ma_baidang');
            fetch('baidang/add_like.php?ma_baidang=' + ma_baidang)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        button.classList.toggle('liked');
                        // Update số lượt like sau khi đã like hoặc bỏ like
                        const likeCountElement = button.parentNode.querySelector('.like-count');
                        if (likeCountElement) {
                            likeCountElement.innerText = data.likeCount;
                        }
                    } else {
                        console.error(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
});
          
            // JavaScript để mở và đóng pop-up
            function openEditPopup(ma_baidang) {
                fetch('baidang/edit_post.php?ma_baidang=' + ma_baidang)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('edit-popup-content-container').innerHTML = data;
                        document.getElementById('edit-popup-overlay').style.display = 'block';
                    })
                    .catch(error => console.error('Error:', error));
            }

            function closeEditPopup() {
                document.getElementById('edit-popup-overlay').style.display = 'none';
            }
        </script>
</body>

</html>