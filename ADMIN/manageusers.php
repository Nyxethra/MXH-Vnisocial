
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN | VNISOCIAL - Quản Lý Nguời Dùng </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }
        
        .sidebar {
            background-color: #e74c3c;
            color: #fff;
            width: 250px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            overflow-x: hidden;
            padding-top: 20px;
        }
        
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: all 0.3s ease;
        }
        
        .sidebar a:hover {
            background-color: #c0392b;
        }
        
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .admin-info {
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        .admin-info h2 {
            margin-bottom: 5px;
        }

        .admin-info p {
            margin-top: 5px;
            font-size: 14px;
        }

        /* Manage Users Page Specific Styles */
        .user-list {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .user-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 200px; /* Chiều rộng cố định của mỗi khung người dùng */
            height: 200px; /* Chiều cao cố định của mỗi khung người dùng */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .user-item:hover {
            background-color: #f9f9f9;
        }

        .user-item .user-name {
            font-weight: bold;
        }

        .user-item .user-email {
            color: #888;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="admin-info">
            <h2><i class="fas fa-user"></i> Admin Name</h2>
            <p><i class="fas fa-crown"></i> Role: Administrator</p>
        </div>
        <a href="index.php"><i class="fas fa-tachometer-alt"></i> Trang chủ </a>
        <a href="#" class="active"><i class="fas fa-users"></i> Quản lý nguời Dùng </a>
        <a href="#"><i class="fas fa-cog"></i> Cài Đặt </a>
        <a href="layoutadmin.php"><i class="fas fa-sign-out-alt"></i> Đăng Xuất </a>
    </div>

    <div class="content">
        <h1>Quản Lý Người Dùng</h1>
        
            
            <!-- Add more user items dynamically or fetch from database -->
        </div>
    </div>
    <?php
            // Kết nối với cơ sở dữ liệu
            $conn = mysqli_connect("localhost", "root", "", "vnisocial");

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Truy vấn dữ liệu người dùng
            $sql = "SELECT * FROM nguoidung";
            $result = $conn->query($sql);

            // Kiểm tra và hiển thị dữ liệu
            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $tenNguoiDung = $row["ten_nguoidung"];
            $email = $row["email"];
            ?>
            <div class="user-list">
                <div class="user-item">
                    <p class="user-name"><?php echo $tenNguoiDung; ?></p>
                    <p class="user-email"><?php echo $email; ?></p>

                </div>

        

        <?php
    }
} else {
    echo "Không có người dùng nào trong cơ sở dữ liệu.";
}
            // Đóng kết nối
            $conn->close();
     ?>
</body>
</html>