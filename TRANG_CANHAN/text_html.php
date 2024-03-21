<?php
session_start();

include "text_chinhsua.php";

// sua anh avatar

$sql = "SELECT avatar FROM nguoidung where ma_nguoidung = 1 limit 1";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Lỗi câu truy vấn SQL";
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        .profile-picture {
            position: relative;
            display: inline-block;
        }

        .profile-picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .edit-avatar {
            position: absolute;
            bottom: 10px;
            right: 16px;
            background-color: #4267B2;
            color: #fff;
            border: none;
            padding: 3px 8px;
            cursor: pointer;
        }

        .edit-avatar:hover {
            background-color: #29487d;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_SESSION['thongbao'])) {
        echo $_SESSION['thongbao'];
        unset($_SESSION['thongbao']);
    }
    ?>
    <div class="profile-picture">
        <?php

        if (isset($result)) {
        if( $row = mysqli_fetch_assoc($result)) {
        ?>
            <img id="avatar-img" src="../IMG/gallery/<?= $row['avatar'] ?>" class="profile_pic">
        <?php
        }  
        } else {
            ?>
            <img id="avatar-img" src="../IMG/gallery/ban.jpg" class="profile_pic">
        <?php
        }?>


        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="avatar" id="avatar-input" accept="image/*" style="display:none">
            <button type="button" id="edit-avatar-btn" class="edit-avatar">
                <i class="fas fa-camera"></i>
            </button>
            <input type="submit" value="Lưu" id='show' style="display:none">
        </form>

    </div>
    <script>
        document.getElementById('edit-avatar-btn').addEventListener('click', function() {
            document.getElementById('avatar-input').click();
        });

        document.getElementById('avatar-input').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('show').style.display = 'block';
                document.getElementById('avatar-img').src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>

</body>

</html>