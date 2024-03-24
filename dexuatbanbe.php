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
        .container {
            display: flex;
            justify-content: space-between;
            flex-direction: row; 
            flex-wrap: nowrap;
            overflow-x: auto;
            width: 100%;
            margin: auto;
            position: relative; /* Thêm thuộc tính này để định vị các nút cuộn */
        }

        .ui.card {
            flex: 0 0 auto;
            margin: 1em;
            height: 150px;
        }

        .scroll-button {
            position: absolute; /* Thay đổi từ fixed thành absolute */
            top: 50%; /* Đặt nút ở giữa theo chiều dọc */
            transform: translateY(-50%); /* Điều chỉnh vị trí của nút để nó ở chính xác giữa */
        }

        .scroll-left {
            left: 0; /* Đặt nút cuộn trái ở bên trái */
        }

        .scroll-right {
            right: 0; /* Đặt nút cuộn phải ở bên phải */
        }
    </style>

</head> 
<body>
    <div class="container">
        <?php
            // Kết nối với cơ sở dữ liệu
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "database";

            // Tạo kết nối
            $conn = mysqli_connect("localhost", "root", "", "vnisocial");

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Truy vấn dữ liệu từ bảng nguoidung
            $sql = "SELECT ten_nguoidung, email FROM nguoidung";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Duyệt qua mỗi hàng dữ liệu
                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="ui card">
                        <div class="image">
                            <img src="">
                        </div>
                        <div class="content">
                            <div class="header">' . $row["ten_nguoidung"] . '</div>
                            <div class="description">' . $row["email"] . '</div>
                        </div>
                        <div class="ui two bottom attached buttons">
                            <div class="ui button">
                                Kết bạn 
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "Không có kết quả";
            }
  
            $conn->close();
        ?>
        <!-- Thêm hai nút cuộn vào trong .container -->
        <button class="ui icon button scroll-button scroll-left"><i class="left arrow icon"></i></button>
        <button class="ui icon button scroll-button scroll-right"><i class="right arrow icon"></i></button>
    </div>

    <script>
        $(document).ready(function() {
            $('.scroll-left').click(function() {
                var container = $('.container');
                container.animate({
                    scrollLeft: container.scrollLeft() - 300
                }, 500);
            });

            $('.scroll-right').click(function() {
                var container = $('.container');
                container.animate({
                    scrollLeft: container.scrollLeft() + 300
                }, 500);
            });
        });
    </script>
</body>
</html>