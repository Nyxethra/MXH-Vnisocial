<?php

// var_dump($ma_nguoidung);
include "suaavatar.php";
include "suaanhbia.php";
include "thongtinnguoidung.php";

// hien thi avatar
$sql = "SELECT avatar FROM nguoidung where ma_nguoidung ='$user_id'  limit 1;";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Kiểm tra xem có bản ghi trả về hay không
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $avatar = $row['avatar'];
        // Tiếp tục xử lý thông tin avatar

        // echo "Avatar: " . $avatar;
    } else {
        echo "Không có dữ liệu avatar.";
    }
} else {
    echo "Lỗi truy vấn: " . mysqli_error($conn);
}

// hien thi anhbia
$sqli = "SELECT anhbia FROM nguoidung where ma_nguoidung ='$user_id'  limit 1;";
$result_n = mysqli_query($conn, $sqli);

if ($result) {
    // Kiểm tra xem có bản ghi trả về hay không
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result_n);
        $anhbia = $row['anhbia'];
        // Tiếp tục xử lý thông tin anhbia

        // echo "anhbia: " . $anhbia;
    } else {
        echo "Không có dữ liệu anhbia.";
    }
} else {
    echo "Lỗi truy vấn: " . mysqli_error($conn);
}

//thong tin nguoi dung
if (mysqli_num_rows($result_t) > 0) {
    $row = mysqli_fetch_assoc($result_t);
    $ten_nguoidung = $row['ten_nguoidung'];
    $tieusu = $row['tieusu'];
    $hoc_tai = $row['hoc_tai'];
    $mqh = $row['song_tai'];
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
    </style>
</head>

<body>
    <!-- Thanh công cụ -->

    <!-- phần giao diện chính -->
    <div class = "truoc_">
    <div class="abc">
        <div class="main_interface">
            <div style="width:100%">
                <div class="head__img">

                    <!-- <img src="img/pic.jpg" class="anhbia"> -->
                    <div class="anhbia">
                        <?php
                        if (mysqli_num_rows($result_n) > 0) {
                            $row = mysqli_fetch_assoc($result_n);
                            // var_dump($avatar);
                            // exit;
                        ?>
                            <img id="anhbia-img" src="IMG/gallery/<?= $anhbia ?>" class="anhbia">
                        <?php

                        } else {
                        ?>
                            <img id="anhbia-img" src="IMG/gallery/pic.jpg" class="anhbia">
                        <?php
                        } ?>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="file" name="anhbia" id="anhbia-input" accept="image/*" style="display:none">
                            <button type="button" id="edit-anhbia-btn" class="edit-anhbia">
                                <i class="fas fa-camera"></i>
                            </button>
                            <input type="submit" value="Lưu" id='show' style="display:none; float:right">
                        </form>
                    </div>
                    <div class="head__user" style="display:flex">

                        <div class="head__avatar">
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                // var_dump($avatar);
                                // exit;
                            ?>
                                <img id="avatar-img" src="IMG/<?= $avatar ?>" class="profile_pic">
                            <?php

                            } else {
                            ?>
                                <img id="avatar-img" src="IMG/gallery/ban.jpg" class="profile_pic">
                            <?php
                            } ?>

                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="file" name="avatar" id="avatar-input" accept="image/*" style="display:none">
                                <button type="button" id="edit-avatar-btn" class="edit-avatar">
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


                <!--phần kết bạn  -->
                <div class="friend_request">

                    <?php include("dexuatbanbe.php") ?>
                </div>
                <div class = "aaa" >
                    <!-- phần giới thiệu -->
                    <div class="gioithieu">
                        <div class="inside_gioithieu">
                            <div style="font-size :15px; color:black; text-align:center ">Gioi thieu</div>
                            <div>Tiểu sử<br>
                                <?php echo $tieusu ?>
                            </div>
                            <div>Đang học</div>
                            <?php echo $hoc_tai ?>
                            <div>Sống Tại</div>
                            <?php echo $mqh ?>
                        </div>
                    </div>
                    <!-- phần bài đăng -->
                    
                      
                        <div class = "db_tcn"> 
                        <?php include ("dang_bai/dangbai.php") ?>
                        </div>
                </div>
                
                        
                    
                        
                           <?php include ("baidang/baidang_tcn.php"); ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Phần bạn bè -->
        <div class="friend_bar">
            Người Liên Hệ<br>
            <div class="friends">
                <img src="ban.jpg" class="friend_img">
                <br>
                First user
            </div>
            <div class="friends">
                <img src="ban.jpg" class="friend_img">
                <br>
                First user

            </div>
            <div class="friends">
                <img src="ban.jpg" class="friend_img">
                <br>
                First user

            </div>
            <div class="friends">
                <img src="ban.jpg" class="friend_img">
                <br>
                First user

            </div>
            <div class="friends">
                <img src="ban.jpg" class="friend_img">
                <br>
                First user

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
    </script>
    <script>
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