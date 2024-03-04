<!DOCTYPE html>
<html>
<head>
    <style>
        .comment-form textarea {
            width: 100%;
            height: 80px;
            resize: vertical;
        }

        .comment-form button {
            margin-top: 10px;
        }

        .comment-list {
            margin-top: 20px;
        }

        .comment {
            background: #f1f1f1;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include("comment.php")?>;
    <?php include ("../DANG_BAI/dangbai.php")?>
    <div class="binhluan-form">
        <h3>Thêm bình luận</h3>
        <form method="post" action="">
            <textarea name="noidung_binhluan" placeholder="Nhập bình luận của bạn"></textarea>
            <button type="submit">Gửi</button>
        </form>
    </div>

    <div class="binhluan-list">
        <h3>Danh sách bình luận</h3>
        <?php
        // Hiển thị danh sách bình luận
        $sql = "SELECT * FROM binhluan ORDER BY ma_binhluan DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='binhluan'>" . $row["noidung_binhluan"] . "</div>";
            }
        } else {
            echo "Chưa có bình luận nào.";
        }
        ?>
    </div>
</body>
</html>