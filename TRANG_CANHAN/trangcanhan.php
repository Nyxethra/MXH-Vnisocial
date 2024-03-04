<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_trangcanhan.css">
    <title>Trang cá nhân của bạn</title>
    <style>
        .abc{
            display: flex;
            flex-direction: row;
        }
    </style>
</head>
<body>
    <!-- Thanh công cụ -->
    <?php include ('../BAR/Nav_Bar.php');?>
        <!-- phần giao diện chính -->
        <div class= "abc">
        <div class="main_interface"  >
                <div style="width:100%">
                    <img src="../img/pic.jpg"  class="anhbia">
                    <img src="../img/cat.jpg" class="profile_pic">
                    <div class="name"> 
                        <b>Nguyễn Hiếu</b><br>
                    </div>
                <div style="width:100% ; text-align:center ; background-color: white; border: solid 1px black">
                    <div class="menu_buttons">Dòng thời gian </div>
                    <div class="menu_buttons">Giới thiệu </div> 
                    <div class="menu_buttons">Bạn bè</div>
                    <div class="menu_buttons">Ảnh</div>
                    <div class="menu_buttons">Lưu trữ </div>
                </div>
                <!--phần kết bạn  -->
                <div class="friend_request" >
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
                                        <br/><br/>
                                        <a href="">Like</a> .<a href=""> Comments </a>. <span style="color:#999">21/12/2004</span>
                                    </div>
                                </div>
                                <div class="post">
                                <div>
                                    <div><img src="ban.jpg" style="width:75px; margin-right:4px; "></div>
                                    <div>
                                    <div style="font-weight: bold; color:black;">First user</div>
                                    Theo Trung tâm Dự báo khí tượng thuỷ văn quốc gia, khoảng chiều tối và đêm nay 26/2, đợt không khí lạnh tăng cường sẽ ảnh hưởng đến thời tiết Đông Bắc Bộ, một số nơi ở Tây Bắc Bộ và Bắc Trung Bộ. Gió đông bắc trong đất liền mạnh dần lên cấp 2-3, vùng ven biển cấp 3
                                        <br/><br/>
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
</body>
</html>