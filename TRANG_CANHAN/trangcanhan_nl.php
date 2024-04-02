<?php

// Bộ mã PHP của bạn
include "suaavatar.php";
include "suaanhbia.php";






$hideChangeAvatar = '';
$hideChangeAnhBia = '';

if (isset($_GET['id2'])) {
    $user_id = $_GET['id2'];

    // Ẩn chức năng thay đổi avatar và ảnh bìa nếu tồn tại id2
    $hideChangeAvatar = 'display:none;';
    $hideChangeAnhBia = 'display:none;';
}

$sqlAvatar = "SELECT avatar FROM nguoidung WHERE ma_nguoidung ='$user_id'  LIMIT 1;";
$resultAvatar = mysqli_query($conn, $sqlAvatar);

$sqlAnhBia = "SELECT anhbia FROM nguoidung WHERE ma_nguoidung ='$user_id'  LIMIT 1;";
$resultAnhBia = mysqli_query($conn, $sqlAnhBia);

$sqlThongTin = "SELECT * FROM nguoidung WHERE ma_nguoidung='$user_id'";
$resultThongTin = $conn->query($sqlThongTin);

if ($resultAvatar) {
    if (mysqli_num_rows($resultAvatar) > 0) {
        $rowAvatar = mysqli_fetch_assoc($resultAvatar);
        $avatar = $rowAvatar['avatar'];
    } else {
        echo "Không có dữ liệu avatar.";
    }
} else {
    echo "Lỗi truy vấn avatar: " . mysqli_error($conn);
}

if ($resultAnhBia) {
    if (mysqli_num_rows($resultAnhBia) > 0) {
        $rowAnhBia = mysqli_fetch_assoc($resultAnhBia);
        $anhbia = $rowAnhBia['anhbia'];
    } else {
        echo "Không có dữ liệu ảnh bìa.";
    }
} else {
    echo "Lỗi truy vấn ảnh bìa: " . mysqli_error($conn);
}

if ($resultThongTin->num_rows > 0) {
    $rowThongTin = $resultThongTin->fetch_assoc();
    $ten_nguoidung = $rowThongTin['ten_nguoidung'];
    $tieusu = $rowThongTin['tieusu'];
    $hoc_tai = $rowThongTin['hoc_tai'];
    $mqh = $rowThongTin['song_tai'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="trang_canhan/style_trangcanhan.css">
    <title>Trang cá nhân của bạn</title>
    <style>
        .abc {
            display: flex;
            flex-direction: row;
            background: #f3f5f5;
        } 
        .post_bar .custom-post {
            margin-left: 0;
            margin-top: 100px;
            width: 110%;
            box-shadow: 9px 12px 28px rgba(0, 0, 0, 0.3);
            border: 1px solid;
        }

        .post_bar .container_baidang {
            margin: 0;
        }

        .post_bar .container_dangbai {
            padding: 0 20px 20px;
        }

        .gioithieu {
            text-align: center;
            margin-top: 10px;
            border-radius: 12%;
        }

        .inside_gioithieu {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333333;

        }

        .gioithieu_title {
            border-radius: 16%;
            margin-top: 0;
            height: 50px;
            padding: 10px;
            background-color: #a72f2f;
            font-size: 30px;
            font-weight: bold;
            color: #000000;
            margin-bottom: 10px;
        }

        .gioithieu_part {
            font-weight: bold;
            font-size: 24px;
            width: 90%;
            text-align: left;
            margin: 22px 0 22px 20px;
        }

        .text_gioithieu {
            margin: 10px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <!-- Thanh công cụ -->

    <!-- phần giao diện chính -->
    <div class="truoc_">
        <div class="abc">
            <div class="main_interface">
                <div style="width:100%">
                    <div class="head__img">
                        <div class="anhbia">
                            <?php if (mysqli_num_rows($resultAnhBia) > 0) : ?>
                                <img id="anhbia-img" src="IMG/gallery/<?= $anhbia ?>" class="anhbia">
                            <?php else : ?>
                                <img id="anhbia-img" src="IMG/gallery/pic.jpg" class="anhbia">
                            <?php endif; ?>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="file" name="anhbia" id="anhbia-input" accept="image/*" style="display:none">
                                <button type="button" id="edit-anhbia-btn" class="edit-anhbia" style="<?php echo $hideChangeAnhBia; ?>">
                                    <i class="fas fa-camera"></i>
                                </button>
                                <input type="submit" value="Lưu" id='show' style="display:none; float:right">
                            </form>
                        </div>
                        <div class="head__user" style="display:flex">
                            <div class="head__avatar">
                                <?php if (mysqli_num_rows($resultAvatar) > 0) : ?>
                                    <img id="avatar-img" src="IMG/<?= $avatar ?>" class="profile_pic">
                                <?php else : ?>
                                    <img id="avatar-img" src="IMG/gallery/ban.jpg" class="profile_pic">
                                <?php endif; ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="file" name="avatar" id="avatar-input" accept="image/*" style="display:none">
                                    <button type="button" id="edit-avatar-btn" class="edit-avatar" style="<?php echo $hideChangeAvatar; ?>">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                    <input type="submit" value="Lưu" id='show'>
                                </form>
                            </div>
                            <div class="info__user">
                                <p class="name__user"><?php echo $ten_nguoidung ?></b>
                            </div>
                        </div>
                    </div>
                    <div class="friend_request">
                        <?php include("dexuatbanbe.php") ?>
                    </div>
                    <div class="aaa">
                        <!-- Phần giới thiệu -->
                        <div class="gioithieu">
                            <div class="inside_gioithieu">
                                <div class="gioithieu_title"><i class="fa fa-info-circle" style="font-size: 17px; margin: 2px;color:black"></i> Giới thiệu</div>
                                <div class="gioithieu_part"><i class="fas fa-edit" style="font-size: 17px; margin: 2px;color:black"></i>Tiểu sử :
                                    <div class="text_gioithieu" style="float:right; margin:0;font-weight:normal"><?php echo $tieusu ?>
                                    </div>
                                </div>
                                <div class="gioithieu_part"><i class="fas fa-book-open" style="font-size: 17px; margin: 2px;color:black"></i>Đang học :
                                </div>
                                <div class="text_gioithieu"><?php echo $hoc_tai ?>
                                </div>
                                <div class="gioithieu_part"><i class="fas fa-home" style="font-size: 17px; margin: 2px;color:black"></i>Sống Tại :
                                </div>
                                <div class="text_gioithieu"><?php echo $mqh ?>
                                </div>
                            </div>
                        </div>












                        <div class="db_tcn">
                            <?php
                            $servername = "localhost"; // Tên máy chủ MySQL
                            $username = "root"; // Tên người dùng MySQL
                            $password = ""; // Mật khẩu của người dùng MySQL
                            $database = "vnisocial"; // Tên cơ sở dữ liệu MySQL

                            // Tạo kết nối đến cơ sở dữ liệu
                            $conn = new mysqli($servername, $username, $password, $database);

                            if (!isset($_GET['id2'])) {
                                echo '<div class="fsafafa">';
                                include("dang_bai/dangbai.php");
                                echo '</div>';

                                // Bao gồm cả file baidang_tcn.php
                                include("baidang/baidang_tcn.php");
                            } else {
                                $user_id3 = $_GET['id2'];
                                $sqlCheckFriendship = "SELECT * FROM banbe WHERE (ma_nguoidung1 = '$user_id3' AND ma_nguoidung2 = '$user_id2') OR (ma_nguoidung1 = '$user_id2' AND ma_nguoidung2 = '$user_id3')";
                                $resultCheckFriendship = mysqli_query($conn, $sqlCheckFriendship);
                                if ($resultCheckFriendship) {
                                    if (mysqli_num_rows($resultCheckFriendship) > 0) {
                                        include("baidang/baidang_tcn.php");
                                    } else {
                                        echo '<p class="thongbao">Không có bài viết để hiển thị</p>';
                                    }
                                } else {
                                    echo "Lỗi truy vấn kiểm tra bạn bè: " . mysqli_error($conn);
                                }
                            }
                            ?>
                        </div>



















                    </div>
                </div>
            </div>
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

        document.getElementById('edit-anhbia-btn').addEventListener('click', function() {
            document.getElementById('anhbia-input').click();
        });

        document.getElementById('anhbia-input').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('show').style.display = 'block';
                document.getElementById('anhbia-img').src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
</body>

</html>