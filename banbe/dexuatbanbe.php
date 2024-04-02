<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN | VNISOCIAL - Quản Lý Nguời Dùng </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.js"></script>

    <style>
        .container_dxbb {
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
            width: 100%;
            margin-top: 40px;
            position: relative;
            background: #f3f5f5;
            overflow-x: hidden;
        }

        .ui.card {
            flex: 0 0 auto;
            margin: 1cm;
            height: 150px;
        }

        .scroll-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .scroll-left {
            left: 0;
            /* Đặt nút cuộn trái ở bên trái */
        }

        .scroll-right {
            right: 0;
            /* Đặt nút cuộn phải ở bên phải */
        }

        .ui.card:first-child {
            margin-top: 14px;
        }

        button.ui.icon.button.scroll-button.scroll-left {
            position: absolute;
            left: 56px;
            top: 91%;
        }

        button.ui.icon.button.scroll-button.scroll-right {
            position: absolute;
            right: 17.5%;
            top: 91%;
        }

        .image {
            display: flex;
            /* Sử dụng flexbox để căn chỉnh hình ảnh */
            justify-content: center;
            /* Căn chỉnh hình ảnh theo trục ngang */
            align-items: center;
            /* Căn chỉnh hình ảnh theo trục dọc */
            width: 40%;
            /* Chiều rộng của div image bằng với chiều rộng của div cha */
            height: auto;
            /* Chiều cao tự động điều chỉnh tùy thuộc vào tỷ lệ chiều rộng */

        }
    </style>

</head>

<body>
    <div class="dxbb">
        <div class="container_dxbb">
            <?php
            // Kết nối với cơ sở dữ liệu
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "database";


            $conn = mysqli_connect("localhost", "root", "", "vnisocial");

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }


            // Truy vấn dữ liệu từ bảng nguoidung
            $sql = "SELECT ma_nguoidung, ten_nguoidung, avatar FROM nguoidung WHERE ma_nguoidung != $user_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Duyệt qua mỗi hàng dữ liệu
                while ($row = $result->fetch_assoc()) {
                    $avatar = "IMG/" . $avatar = $row["avatar"];
                    echo '
                    <div class="ui card">
                        <div class="image">
                        <img src="' . $avatar . '">
                        </div>
                        <div class="content">
                            <div class="header">' . $row["ten_nguoidung"] . '</div>
                         
                        </div>
                        <div class="ui two bottom attached buttons">
                <button class="ui button btn-ketban" onclick="guiYeuCauKetBan( ' . $row["ma_nguoidung"] . ',' . $user_id . ')">
                    Kết bạn
                </button>
            </div>  
                                </div>
                                    <script>
                function guiYeuCauKetBan(friend_id, user_id) {
                // Chuyển đổi friend_id thành số nguyên 
                friend_id = parseInt(friend_id);

                // Gửi yêu cầu kết bạn bằng AJAX
                $.ajax({
                url: "banbe/yeucau.php",
                method: "POST",
                data: {
                    friend_id: friend_id,
                    user_id: user_id
                },
                success: function(response) {
                    // Parse response as JSON
                    var jsonResponse = JSON.parse(response);
                    
                    // Xử lý kết quả phản hồi từ server
                    if (jsonResponse.success) {
                        alert("Yêu cầu kết bạn đã được gửi.");
                    } else {
                        alert(jsonResponse.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi nếu có
                    alert("Có lỗi xảy ra: " + error);
                }
                });
                }
                </script>';
                }
            } else {
                echo "Không có kết quả";
            }

            
            ?>
            <script>
                $(document).ready(function() {
                    $('.btn-ketban').click(function() {
                        $(this).closest('.ui.card').fadeOut();
                    });
                });
            </script>
            <!-- Thêm hai nút cuộn vào trong .container_dxbb -->
        </div>
        <button class="ui icon button scroll-button scroll-left"><i class="left arrow icon"></i></button>
        <button class="ui icon button scroll-button scroll-right"><i class="right arrow icon"></i></button>
    </div>

    <script>
        $(document).ready(function() {
            $('.scroll-left').click(function() {
                var container_dxbb = $('.container_dxbb');
                container_dxbb.animate({
                    scrollLeft: container_dxbb.scrollLeft() - 300
                }, 500);
            });

            $('.scroll-right').click(function() {
                var container_dxbb = $('.container_dxbb');
                container_dxbb.animate({
                    scrollLeft: container_dxbb.scrollLeft() + 300
                }, 500);
            });
        });
    </script>
</body>

</html>