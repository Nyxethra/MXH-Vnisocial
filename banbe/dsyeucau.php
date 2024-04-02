<?php include("bar/thanhbentrai.php"); ?>

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
    margin-right: 20px;
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
            font-size: 18px;
        }
        .btn-reject {
            background-color: #bd726d;
            color: white;
            border: none;
            margin-top: 10px;
            font-size: 17px;
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
    width: 90px;
    height: 92px;
    border-radius: 50%;
    margin-right: 10px;
}
.user-link {
    text-decoration: none; /* Không gạch chân mặc định */
    color: inherit; /* Sử dụng màu kế thừa hoặc đặt màu cụ thể */
}

.user-link:hover {
    text-decoration: underline; /* Thêm gạch chân khi hover */
}
    </style>
</head>
<body>
    <div class="container">
        <ul>
            <?php
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
                        echo "<img class='user-avatar' src='img/" . $row["avatar"] . "'>";
                        echo "<div>";
                        echo "<a href='index.php?diden=trangcanhan_nl&id2=" . urlencode($row["ma_nguoidung"]) . "' target='_blank' class='user-link'><span class='tnd'><strong>" . $row["ten_nguoidung"] . "</strong></span></a><br>";
                        echo "<span class='st'>Sống tại " . $row["song_tai"] . "</span><br>";
                        echo "<span class='ts'> " . $row["tieusu"] . "</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='btn-group'>";
                        echo "<button class='btn-accept' onclick='acceptRequest(" . $user_id . ", " . $row["ma_nguoidung"] . ")'>Đồng Ý</button>";
                        echo "<button class='btn-reject' onclick='rejectRequest(" . $user_id . ", " . $row["ma_nguoidung"] . ")'>Từ Chối</button>";
                        echo "</div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li>Hiện không có lời mời kết bạn nào.</li>";
                }
                
            ?>
        </ul>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function acceptRequest(user_id, sender_id) {
    $.ajax({
        url: "banbe/accept_request.php",
        method: "POST",
        data: { user_id: user_id, sender_id: sender_id },
        success: function(response) {
            // Parse response as JSON
            var jsonResponse = JSON.parse(response);
            
            // Xử lý kết quả phản hồi từ server
            if (jsonResponse.success) {
                alert("Đã đồng ý kết bạn ");
                // Tự động tải lại trang
                location.reload();
            } else {
                alert(jsonResponse.message);
                // Tùy chọn: có thể thêm location.reload(); ở đây nếu muốn tải lại trang dù có lỗi
            }
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi nếu có
            alert("Có lỗi xảy ra: " + error);
            // Tự động tải lại trang sau khi thông báo lỗi
            location.reload();
        }
    });
} 



function rejectRequest(user_id, sender_id) {
    $.ajax({
        url: "banbe/reject_request.php",
        method: "POST",
        data: { user_id: user_id, sender_id: sender_id },
        success: function(response) {
            // Parse response as JSON
            var jsonResponse = JSON.parse(response);
            
            // Xử lý kết quả phản hồi từ server
            if (jsonResponse.success) {
                alert("Đã từ chối kết bạn ");
                // Tự động tải lại trang
                location.reload();
            } else {
                alert(jsonResponse.message);
                // Tùy chọn: có thể thêm location.reload(); ở đây nếu muốn tải lại trang dù có lỗi
            }
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi nếu có
            alert("Có lỗi xảy ra: " + error);
            // Tự động tải lại trang sau khi thông báo lỗi
            location.reload();
        }
    }); 
} 




    </script>
</body>
</html>
