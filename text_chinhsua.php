<?php

//Kết nối cơ sở dữ liệu
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'text';

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
}

// Xử lý yêu cầu tải lên ảnh avatar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["avatar"])) {
    $avatar = $_FILES["avatar"];

    // Kiểm tra xem có lỗi xảy ra trong quá trình tải lên không
    if ($avatar["error"] > 0) {
        echo "Lỗi tải lên ảnh: " . $avatar["error"];
    } else {
        // Đường dẫn lưu trữ tệp ảnh avatar
        $uploadDir = "text_chinhsua/avatar/";
        $uploadPath = $uploadDir . basename($avatar["name"]);

        // Di chuyển tệp ảnh vào thư mục lưu trữ
        if (move_uploaded_file($avatar["tmp_name"], $uploadPath)) {
            // Lưu đường dẫn tệp ảnh avatar vào cơ sở dữ liệu
            $username = $_POST["username"];
            $query = "UPDATE users SET avatar='$uploadPath' WHERE username='$username'";
            mysqli_query($conn, $query);

            echo "Tải lên ảnh avatar thành công!";
        } else {
            echo "Lỗi tải lên ảnh avatar.";
        }
    }
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>