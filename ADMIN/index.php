<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN | VNISOCIAL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.js"></script>

    <style>
        body {  
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
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
        
    </style>
</head>
<body>
<img class="logonen" src="../img/logo_nen.jpg" style="position: absolute; top: 120px; left: 250px ;">
    <div class="sidebar">
        <div class="admin-info">
            <h2><i class="fas fa-user"></i> Admin       </h2>
            <p><i class="fas fa-crown"></i> Role: Administrator</p>
        </div>
        <a href="#"><i class="fas fa-tachometer-alt"></i> TRANG CHỦ</a>
        <a href="manageusers.php"><i class="fas fa-users"></i> QUẢN LÝ NGƯỜI DÙNG</a>
        <a href="logoutadmin.php"><i class="fas fa-sign-out-alt"></i> ĐĂNG XUẤT</a>
    </div>

    <div class="content">
        <h1>CHÀO MỪNG ĐẾN VỚI TRANG QUẢN TRỊ CỦA VNISOCIAL</h1> 
        
        <!-- Your content goes here -->
    </div>
</body>
</html>
