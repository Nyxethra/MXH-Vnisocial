<?php

//Kết nối cơ sở dữ liệu
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'vnisocial';

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["avatar"])) {
    $avatar = $_FILES["avatar"];

    // Kiểm tra xem có lỗi xảy ra trong quá trình tải lên không
    if ($avatar["error"] > 0) {
        echo "Lỗi tải lên ảnh: " . $avatar["error"];
    } else {
        $uploadDir = "img/";
        $uploadPath = $uploadDir . basename($avatar["name"]);

        // Di chuyển tệp ảnh vào thư mục lưu trữ
        if ($avatar["tmp_name"]) {
            // Lưu đường dẫn tệp ảnh avatar vào cơ sở dữ liệu
            @move_uploaded_file($avatar["tmp_name"], $uploadPath);
            $avatar_n = $avatar["name"];
            // $data_n = date("y-m-d h:i:s");
            // $timestamp = strtotime($data_n);
            // 1231312312.jpg 
            $query = "UPDATE nguoidung
            SET avatar = '$avatar_n'
            WHERE ma_nguoidung = '$user_id'";
            mysqli_query($conn, $query);

            $_SESSION['thongbao'] = "Tải lên ảnh avatar thành công!";
            header("location:trangcanhan.php");
            exit;
        } else {
            $_SESSION['thongbao'] = "Lỗi tải lên ảnh avatar.";
            header("location:trangcanhan.php");
            exit;
        }
    }
}


// mysqli_close($conn);
