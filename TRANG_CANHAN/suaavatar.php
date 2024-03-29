<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang của tôi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/1.12.4/sweetalert2.min.css" integrity="sha512-R4+jpnl778pSWzCYwg41gTtdtYZNb3nx8Qk/9M3L5N1qU79qUffkGq9lQS38wQ1m139prU6T8w1oB4Nh9o" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/1.12.4/sweetalert2.min.js" integrity="sha512-n1U/pYmLwhY/Rbk5C56V2W56kRvm65xSUaEzFBdrF1zZdP9MqHmn5qNq7yNSuZ7iZYR/jOiI5IX43sULm9yA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .swal2-actions {
            display: none;
        }
    </style>
</head>

<body>
</body>

</html>

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
        $uploadDir = "IMG/";
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
            echo "<script>
        Swal.fire({
            title: 'Đổi ảnh avatar thành công!',
            text: '',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            timer: 1400,
            
        });
    </script>";
        } else {
            $_SESSION['thongbao'] = "Lỗi tải lên ảnh avatar.";
            echo "<script>
            Swal.fire({
                title: 'Đổi ảnh avatar thất bại!',
                text: '',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                timer: 1400,
                
            });
        </script>";
        }
    }
}

?>

