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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Trang cá nhân của bạn</title>
    <style>
        .abc {
            display: flex;
            flex-direction: row;
            background: #f3f5f5;
        }

        .friend_bar {
            flex: 0.5;
            background-color: #a72f2f;
            margin-left: 30px;
            margin-top: 50px;
            color: rgb(255 255 255);
            padding: 8px;
            width: 18%;
            position: fixed;
            top: 30px;
            right: 0;
            box-sizing: border-box;
            padding-left: 50px;
            border-radius: 10px;
            /* Đặt bán kính cho góc bo tròn */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Thêm đổ bóng */
            transition: all 0.3s ease;
            /* Thêm hiệu ứng chuyển đổi cho các thuộc tính */
        }

        .friend_bar:hover {
            transform: translateY(-5px);
            /* Di chuyển lên một chút khi di chuột qua */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Tăng độ sâu của đổ bóng */
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
            border-radius: 0;
            margin-top: 0;
            height: 50px;
            padding: 10px;
            background-color: #a72f2f;
            font-size: 20px;
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

        .friend_request .ui.card,
        .ui.cards>.card {
            height: 200px;
            width: 300px;
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

                        <!-- Phần Ảnh bìa -->
                        <div class="anhbia">
                            <?php if (mysqli_num_rows($resultAnhBia) > 0) : ?>
                                <img id="anhbia-img" src="IMG/gallery/<?= $anhbia ?>" class="anhbia">
                            <?php else : ?>
                                <img id="anhbia-img" src="IMG/gallery/anhbia.jpg" class="anhbia">
                            <?php endif; ?>
                            <form action="" name="bbb" method="POST" enctype="multipart/form-data">
                                <input type="file" name="anhbia" id="anhbia-input" accept="image/*" style="display:none">
                                <button type="button" id="edit-anhbia-btn" class="edit-anhbia" style="<?php echo $hideChangeAnhBia; ?>">
                                    <i class="fas fa-camera" style="border:solid 3px"></i>
                                </button>
                                <input type="submit" value="Lưu" id='show' style="display:none; float:right">
                            </form>
                        </div>
                        <div class="head__user" style="display:flex">
                            <div class="head__avatar">
                                <?php if (mysqli_num_rows($resultAvatar) > 0) : ?>
                                    <img id="avatar-img" src="IMG/<?= $avatar ?>" class="profile_pic">
                                <?php else : ?>
                                    <img id="avatar-img" src="IMG/gallery/nguoidung.jpg" class="profile_pic">
                                <?php endif; ?>
                                <form action="" name="bbab" method="POST" enctype="multipart/form-data">
                                    <input type="file" name="avatar" id="avatar-input" accept="image/*" style="display:none">
                                    <button type="button" id="edit-avatar-btn" class="edit-avatar" style="<?php echo $hideChangeAvatar; ?>">
                                        <i class="fas fa-camera" style="margin:0;"></i>
                                    </button>
                                    <input type="submit" value="Lưu"  id='show'>
                                </form>
                            </div>
                            <div class="info__user">
                                <p class="name__user"><?php echo $ten_nguoidung ?></b>
                            </div>
                        </div>
                    </div>
                    <div class="friend_request">
                        <?php include("banbe/dexuatbanbe.php") ?>
                    </div>
                    <!-- Phần giới thiệu -->
                    <div class="gioithieu" style=" background-color:#ccc">
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
                            <div class="text-center mt-3">
                                <button class="btn btn-sm btn-outline-primary" onclick="window.location.href='TRANG_CANHAN/chinh_sua_thong_tin.php'">Chỉnh sửa thông tin cá nhân</button>
                            </div>
                        </div>
                    </div>


                    <div class="db_tcn">
                        <?php
                        

                        if (!isset($_GET['id2'])) {
                            echo '<div class="fsafafa"> <div>';
                            include("dang_bai/dangbai.php");
                            echo '</div><div>';

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
    <div class="col-md-4">
        <div class="friend_bar">
            <h3>Bạn bè</h3>
            <?php
            $sqlFriends = "SELECT * FROM banbe WHERE ma_nguoidung1 = '$user_id' OR ma_nguoidung2 = '$user_id'";
            $resultFriends = mysqli_query($conn, $sqlFriends);
            if ($resultFriends) {
                while ($rowFriend = mysqli_fetch_assoc($resultFriends)) {
                    $friendId = ($rowFriend['ma_nguoidung1'] != $user_id) ? $rowFriend['ma_nguoidung1'] : $rowFriend['ma_nguoidung2'];
                    $sqlFriendInfo = "SELECT * FROM nguoidung WHERE ma_nguoidung = '$friendId'";
                    $resultFriendInfo = mysqli_query($conn, $sqlFriendInfo);
                    if ($resultFriendInfo && mysqli_num_rows($resultFriendInfo) > 0) {
                        $rowFriendInfo = mysqli_fetch_assoc($resultFriendInfo);
            ?>
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?php echo $rowFriendInfo['avatar']; ?>" class="profile_pic2 rounded-circle mr-2" width="5" height="5">
                            <span><?php echo $rowFriendInfo['ten_nguoidung']; ?></span>
                        </div>
            <?php
                    }
                }
            }
            ?>
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