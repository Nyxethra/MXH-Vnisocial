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
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 25%;
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
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .request-info {
            font-weight: bold;
        }
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .btn-accept, .btn-reject {
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-accept {
            background-color: #4CAF50;
            color: white;
            border: none;
            margin-right: 10px;
        }
        .btn-reject {
            background-color: #f44336;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách yêu cầu kết bạn</h1>
        <ul>
            <?php
                // Kết nối với cơ sở dữ liệu
                $conn = new mysqli('localhost', 'root', '', 'vnisocial');
                // Kiểm tra kết nối
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // Lấy ID người dùng hiện tại
                ; // Đây là ID người dùng hiện tại, bạn có thể thay đổi hoặc lấy từ session

                // Truy vấn dữ liệu từ bảng yeucau_ketban và kết hợp với bảng nguoidung để lấy thông tin người muốn kết bạn
                $sql = "SELECT yeucau_ketban.*, nguoidung.ten_nguoidung, nguoidung.avatar FROM yeucau_ketban INNER JOIN nguoidung ON yeucau_ketban.ma_nguoinhan = nguoidung.ma_nguoidung WHERE yeucau_ketban.ma_nguoigui = $user_id";
                $result = $conn->query($sql);
                // Hiển thị danh sách người muốn kết bạn
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li>";
                        echo "<img class='user-avatar' src='" . $row["avatar"] . "'>";
                        echo "<span class='request-info'>" . $row["ten_nguoidung"] . "</span> muốn kết bạn với bạn.";
                        echo "<button class='btn-accept' onclick='acceptRequest(" . $row["ma_nguoigui"] . ")'>Đồng ý</button>";
                        echo "<button class='btn-reject' onclick='rejectRequest(" . $row["ma_nguoigui"] . ")'>Từ chối</button>";
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
