<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "ten_nguoidung";
$password = "matkhau";
$dbname = "vnisocial";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Xử lý yêu cầu cập nhật thông tin cá nhân
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["ten_nguoidung"];
    $new_name = $_POST["new_name"];
    $new_email = $_POST["new_email"];
    $new_address = $_POST["new_address"];

    // Cập nhật thông tin cá nhân trong cơ sở dữ liệu
    $sql_update = "UPDATE users SET name = '$new_name', email = '$new_email', address = '$new_address' WHERE id = $user_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Thông tin cá nhân đã được cập nhật thành công";
    } else {
        echo "Lỗi khi cập nhật thông tin cá nhân: " . $conn->error;
    }
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Thông Tin Cá Nhân</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #a72f2f;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cập Nhật Thông Tin Cá Nhân</h2>
        <form action="update_profile.php" method="post">
            <label for="new_name">Họ và Tên:</label>
            <input type="text" id="new_name" name="new_name" required>

            <label for="new_email">Email:</label>
            <input type="email" id="new_email" name="new_email" required>

            <label for="new_address">Địa chỉ:</label>
            <textarea id="new_address" name="new_address" rows="3"></textarea>

            <!-- Thêm trường ẩn để chứa ID người dùng -->
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            <input type="submit" value="Lưu Thay Đổi">
        </form>
    </div>
</body>
</html>
