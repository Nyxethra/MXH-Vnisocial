<?php

// var_dump($ma_nguoidung);
include "suaavatar.php";
include "suaanhbia.php";


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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="trang_canhan/style_trangcanhan.css">c:\Users\Admin\Videos\Vnisocial_For_Vietnamese\dexuatbanbe.php
    <title>Trang cá nhân của bạn</title>
    <style>
        .abc {
            display: flex;
            flex-direction: row;
        }
    </style>
</head>

<body>
    <!-- Thanh công cụ -->

    <!-- phần giao diện chính -->
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
                        <!-- <div style="width: 654px;right:171px; text-align:center ; position: absolute; bottom: 153px;    ">
                            <div class="menu_buttons">Dòng thời gian </div>
                            <div class="menu_buttons">Giới thiệu </div>
                            <div class="menu_buttons">Bạn bè</div>
                            <div class="menu_buttons">Ảnh</div>
                            <div class="menu_buttons">Lưu trữ </div>
                        </div> -->
                        <div class="head__avatar">
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                // var_dump($avatar);
                                // exit;
                            ?>
                                <img id="avatar-img" src="IMG/gallery/<?= $avatar ?>" class="profile_pic">
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
                                <input type="submit" value="Lưu" id='show' >
                            </form>

                        </div>
                        <div class="info__user">
                            <p class="name__user">Nguyễn Hiếu</b>
                            <p class="total__friends">123</p>
                        </div>

                    </div>

                </div>


                <!--phần kết bạn  -->
                <div class="friend_request">

                    <?php include("dexuatbanbe.php") ?>
                </div>
                <div style="display :flex ">
                    <!-- phần giới thiệu -->
                    <div style="background-color:green; min-height:400px; flex:1">
                        <div class="inside_gioithieu">
                            <div style="font-size :15px; color:black; text-align:center">Gioi thieu</div>
                            <div>Tieu su<br>
                                Thich an choi nhung khong danh mat ban than
                            </div>
                        </div>
                    </div>
                    <!-- phần bài đăng -->
                    <div style="background-color:#aaa; min-height:400px; flex:2.5; padding:20px; padding-right:0px">
                        <div style="border: solid thin #aaa ;padding: 10px; background-color:white">
                            <div></div>
                            <br>
                        </div>
                        <div class="post_bar">
                            <div class="post">
                                <div>
                                    <div><img src="ban.jpg" style="width:75px; margin-right:4px; "></div>
                                    <div>
                                        <div style="font-weight: bold; color:black;flex:2">First user</div>
                                        Ngược lại với flex-grow, flex-shrink khiến cho các item co lại khi container được thay đổi độ rộng. Flex-shrink là thuộc tính Display Flex trong CSS có giá trị mặc định bằng 1. Như vậy khi container giảm độ rộng thì kích thước các item sẽ được thu hẹp lại bằng nhau.
                                        <br /><br />
                                        <a href="">Like</a> .<a href=""> Comments </a>. <span style="color:#999">21/12/2004</span>
                                    </div>
                                </div>
                                <div class="post">
                                    <div>
                                        <div><img src="ban.jpg" style="width:75px; margin-right:4px; "></div>
                                        <div>
                                            <div style="font-weight: bold; color:black;">First user</div>
                                            Theo Trung tâm Dự báo khí tượng thuỷ văn quốc gia, khoảng chiều tối và đêm nay 26/2, đợt không khí lạnh tăng cường sẽ ảnh hưởng đến thời tiết Đông Bắc Bộ, một số nơi ở Tây Bắc Bộ và Bắc Trung Bộ. Gió đông bắc trong đất liền mạnh dần lên cấp 2-3, vùng ven biển cấp 3
                                            <br /><br />
                                            <a href="">Like</a> .<a href=""> Comments </a>. <span style="color:#999">21/12/2004</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phần bạn bè -->
        <div class="friend_bar">
            Bạn bè<br>
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