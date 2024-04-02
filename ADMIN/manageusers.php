
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
            display: flex;
            padding-left: 250px; 
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
            padding: 10px 0;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: all 0.3s ease;
            text-align: center;
            line-height: 40px;
        }
        
        .sidebar a:hover {
            background-color: #c0392b;
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
        .container {
        display: flex;
        justify-content: center;
        flex-direction: row; 
        flex-wrap: wrap;
        width: calc(100% - 250px); /* Chiều rộng của .container bằng 100% trừ đi chiều rộng của thanh sidebar */
        margin: auto; /* Đưa .container ra giữa màn hình */
         }

        .ui.card {
        flex: 0 0 30%; /* Đảm bảo rằng mỗi dòng có tối đa 3 khung hình */
        margin: 1em; 
        height: 270px; /* Cố định chiều cao của khung hình */
            }
        .ui button {
            background: #c0392b;
        }
      
</style>

</head>
<body>
  

    <div class="sidebar">
        <div class="admin-info">
            <h2><i class="fas fa-user"></i> Admin </h2>
            <p><i class="fas fa-crown"></i> Role: Administrator</p>
        </div>
        <a href="index.php"><i class="fas fa-tachometer-alt"></i> Trang chủ </a>
        <a href="#" class="active"><i class="fas fa-users"></i> Quản lý nguời Dùng </a>
        <a href="layoutadmin.php"><i class="fas fa-sign-out-alt"></i> Đăng Xuất </a>
    </div>

    </div>
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
        $sql = "SELECT ten_nguoidung, email, ma_nguoidung FROM nguoidung";
        $result = $conn->query($sql);
       
        if ($result->num_rows > 0) {
        // Duyệt qua mỗi hàng dữ liệu
        echo '<div class="container">';
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
                    <div class="ui button delete-btn" data-user-id="' . $row["ma_nguoidung"] . '">Xóa Tài Khoản</div>
                </div>
            </div>';
        }
        
        } else {
        echo "Không có kết quả ";
        }
  
        

?>
<script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            var user_id = $(this).data('user-id');
            if (confirm("Bạn có chắc chắn muốn xóa tài khoản này không?")) {
                $.ajax({
                    url: 'delete_user.php', // Đường dẫn đến script xử lý xóa tài khoản ở phía máy chủ
                    method: 'POST',
                    data: { user_id: user_id },
                    success: function(response) {
                        alert("Tài khoản đã được xóa thành công.");
                        location.reload(); // Tải lại trang sau khi xóa thành công
                    },
                    error: function(xhr, status, error) {
                        alert("Đã xảy ra lỗi: " + error);
                    }
                });
            }
        });
    });
</script>

</body>
</html>