<?php 
include("bar/thanhbentrai.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách yêu cầu kết bạn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
    margin-top: 35px;
    padding: 17px;
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-left: 10%;
}
        .user-info {
            display: flex;
            align-items: center;
            flex: 1;
        }
        .user-info div {
            margin-left: 10px;
        }
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .btn-group {
    display: flex;
    align-items: baseline;
    flex-direction: column;
}
        .btn-accept, .btn-reject {
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-accept {
            background-color: #4caf507d;
            color: white;
            border: none;
            margin-right: 10px;
        }
        .btn-reject {
    background-color: #bd726d;
    color: white;
    border: none;
    margin-top: 10px;
}
        .user-info div {
    margin-left: 10px;
    display: flex;
    align-content: center;
    justify-content: space-around;
    flex-direction: column;
    flex-wrap: nowrap;
    align-items: flex-start;
}
.user-avatar {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    margin-right: 20px;
}
    </style>
</head>
<body>
    <div class="container">
        <ul>
            <?php
                // Kết nối với cơ sở dữ liệu
                $conn = new mysqli('localhost', 'root', '', 'vnisocial');
                // Kiểm tra kết nối
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // Lấy ID người dùng hiện tại
                // Đây là ID người dùng hiện tại, bạn có thể thay đổi hoặc lấy từ session

                // Truy vấn dữ liệu từ bảng yeucau_ketban và kết hợp với bảng nguoidung để lấy thông tin người muốn kết bạn
                $sql = "SELECT nguoidung.*, yeucau_ketban.status FROM nguoidung INNER JOIN yeucau_ketban ON nguoidung.ma_nguoidung = yeucau_ketban.ma_nguoigui WHERE yeucau_ketban.ma_nguoinhan = $user_id";
                $result = $conn->query($sql);
                // Hiển thị danh sách người muốn kết bạn
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li>";
                        echo "<div class='user-info'>";
                        echo "<img class='user-avatar' src='" . $row["avatar"] . "'>";
                        echo "<div>";
                        echo "<span class='tnd'><strong>" . $row["ten_nguoidung"] . "</strong></span><br>";
                        echo "<span class='st'>Sống tại " . $row["song_tai"] . "</span><br>";
                        echo "<span class='ts'> " . $row["tieusu"] . "</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='btn-group'>";
                        echo "<button class='btn-accept' onclick='acceptRequest(" . $row["ma_nguoidung"] . ")'>Đồng ý</button>";
                        echo "<button class='btn-reject' onclick='rejectRequest(" . $row["ma_nguoidung"] . ")'>Từ chối</button>";
                        echo "</div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li>Hiện không có ai muốn kết bạn với bạn.</li>";
                }
                $conn->close();
            ?>
        </ul>
    </div>
    <script>
        function acceptRequest(userId) {
            // Viết code xử lý đồng ý yêu cầu kết bạn ở đây
            alert("Đã đồng ý yêu cầu kết bạn từ người dùng có ID " + userId);
        }

        function rejectRequest(userId) {
            // Viết code xử lý từ chối yêu cầu kết bạn ở đây
            alert("Đã từ chối yêu cầu kết bạn từ người dùng có ID " + userId);
        }
    </script>
</body>
</html>
