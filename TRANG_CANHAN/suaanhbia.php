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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["anhbia"])) {
    $anhbia = $_FILES["anhbia"];

    // Kiểm tra xem có lỗi xảy ra trong quá trình tải lên không
    if ($anhbia["error"] > 0) {
        echo "Lỗi tải lên ảnh: " . $anhbia["error"];
    } else {
        $uploadDir = "../IMG/gallery/";
        $uploadPath = $uploadDir . basename($anhbia["name"]);

        // Di chuyển tệp ảnh vào thư mục lưu trữ
        if ($anhbia["tmp_name"]) {
            // Lưu đường dẫn tệp ảnh anhbia vào cơ sở dữ liệu
            @move_uploaded_file($anhbia["tmp_name"], $uploadPath);
            $anhbia_n = $anhbia["name"];
            // $data_n = date("y-m-d h:i:s");
            // $timestamp = strtotime($data_n);
            // 1231312312.jpg 
            $query = "UPDATE nguoidung
            SET anhbia = '$anhbia_n'
            WHERE ma_nguoidung = '$ma_nguoidung'";
            mysqli_query($conn, $query);

            $_SESSION['thongbao'] = "Tải lên ảnh anhbia thành công!";
            header("location:trangcanhan.php");
            exit;
        } else {
            $_SESSION['thongbao'] = "Lỗi tải lên ảnh anhbia.";
            header("location:trangcanhan.php");
            exit;
        }
    }
}


// mysqli_close($conn);
