

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bố cục menu trái</title>
    <style>
        .menu-trai {
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    width: 285px;
    background-color: #f5f5f5;
    padding: 61px 11px 0 17px;
}
.custom-user-details h3 {
    margin: 0;
    font-size: 19px;
}
body{background: #f5f5f5;}
html {
    background: #f5f5f5;
}

.btn-trang-ca-nhan, .btn-yeu-cau-ket-ban {
    width: 100%;
    padding: 10px;
    margin-top: 27px;
    border: 1px solid #f5f5f5;
    border-radius: 5px;
    text-align: center;
    font-size: 16px;
    cursor: pointer;
}

        .btn-trang-ca-nhan {
            background-color: #f5f5f5;
    color: #000;
        }

        .btn-yeu-cau-ket-ban {
    background-color: #f5f5f5;
    color: #000;
}

        .btn-trang-ca-nhan:hover, .btn-yeu-cau-ket-ban:hover {
            background-color: #ddd;
        }
        h3 {
    color: black;
}
.custom-user-avatar img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
    object-position: center;
}
.custom-user-info {
    display: flex;
    align-items: center;
}
.custom-user-details h3 {
    margin-left: 13px;
    
}
    </style>
</head>
<body>
    <?php 

        $result = $conn->query($sql);
        $sqlnd = "SELECT *
        FROM nguoidung
        WHERE ma_nguoidung = $user_id;";
        $resultnd = $conn->query($sqlnd);

        $rownguoidung= $resultnd->fetch_assoc();

    ?>
    <div class="menu-trai">
        <a href="index.php?diden=trangcanhan">
        <button class="btn-trang-ca-nhan">
            <div class="custom-user-info">
                            <div class="custom-user-avatar">
                                <?php
                                // Tạo đường dẫn hoàn chỉnh cho avatar người dùng
                                $avatarPath = "IMG/" . $rownguoidung["avatar"];
                                echo '<img src="' . $avatarPath . '" alt="User Avatar">';
                                ?>
                            </div>
                            <div class="custom-user-details">
                                <h3 style =" font-size: 17px;"><?php echo $rownguoidung["ten_nguoidung"]; ?></h3>
                                
                            </div>
                        </div>
                        </button>
        </a>
        <a href="index.php?diden=trangchu">
            <button class="btn-yeu-cau-ket-ban">
            <div class="custom-user-info">
                            <div class="custom-user-avatar">
                            <img src="IMG/newsfeed.png" alt="User Avatar">
                            </div>
                            <div class="custom-user-details">
                                <h3 style =" font-size: 17px;">Bảng Tin</h3>
                                
                            </div>
                        </div>
                    </button>
        </a>
        <a href="index.php?diden=dsyeucau">
            <button class="btn-yeu-cau-ket-ban">
            <div class="custom-user-info">
                            <div class="custom-user-avatar">
                            <img src="IMG/add-friend.png" alt="User Avatar">
                            </div>
                            <div class="custom-user-details">
                                <h3 style =" font-size: 17px;">Yêu cầu kết bạn</h3>
                                
                            </div>
                        </div>
                    </button>
        </a>
        <a href="index.php?diden=dsbanbe">
            <button class="btn-yeu-cau-ket-ban">
            <div class="custom-user-info">
                            <div class="custom-user-avatar">
                            <img src="IMG/friends.png" alt="User Avatar">
                            </div>
                            <div class="custom-user-details">
                                <h3 style =" font-size: 17px;">Danh sách bạn bè</h3>
                                
                            </div>
                        </div>
                    </button>
        
       
    </div>
</body>
</html>

<?php
$html = ob_get_clean();
echo $html;
?>
