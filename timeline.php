<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_trangcanhan.css">
    <title>Bai Dang</title>
</head>
<body>
    <!-- Thanh công cụ -->
    <div class="thanhbar">
        <div style='width :800px; margin:auto; font-size:30px'>
        <img src="VNISocial.png" class="logo">
        <input type="text" class="searchbox" id="timkiem" placeholder="Tìm kiếm" >
        <img src="VNISocial.png" class="avatar" >
        </div>
    </div>
    <div style="display:flex; background-color:#aaa" >
        <!-- phần giao diện chính -->
        <div class="main_interface">
                <div style="display :flex">
                    <!-- phần giới thiệu -->
                    <div style="background-color:yellow; min-height:200px; flex:0.5; font-size:20px; color:white; text-align:center">
                        <img src="cat.jpg" class="profile_pic" style="margin-top:100px">
                        Nguyễn Hiếu
                    </div>
                    <!-- phần bài đăng -->
                    <div style="background-color:#aaa; min-height:200px; flex:2.5; padding:20px; padding-right:0px">
                        <div style="border: solid thin #aaa ;padding: 10px; background-color:white">
                        
                        <textarea placeholder="Bạn đang nghĩ gì?" style="width:939px; height:76px"></textarea>
                        <input class="post button" type="submit" value="Đăng">
                        <br>
                        </div>
                        <div class="post_bar">
                            <div class="post">
                                <div>
                                    <div><img src="ban.jpg" style="width:75px; margin-right:4px; ">
                                    </div>
                                    <div>
                                    <div style="font-weight: bold; color:black;flex:2">First user
                                    </div>
                                        Ngược lại với flex-grow, flex-shrink khiến cho các item co lại khi container được thay đổi độ rộng. Flex-shrink là thuộc tính Display Flex trong CSS có giá trị mặc định bằng 1. Như vậy khi container giảm độ rộng thì kích thước các item sẽ được thu hẹp lại bằng nhau.
                                        <br/><br/>
                                        <a href="">Like</a> .<a href=""> Comments </a>. <span style="color:#999">21/12/2004</span>
                                    </div>
                                </div>
                                <div class="post">
                                <div>
                                    <div><img src="ban.jpg" style="width:75px; margin-right:4px; ">
                                    </div>
                                    <div>
                                    <div style="font-weight: bold; color:black;">First user
                                    </div>
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
    
    </div>
</body>
</html>