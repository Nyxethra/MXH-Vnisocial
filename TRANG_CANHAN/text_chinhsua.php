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
        // echo ;
        // exit;
        // Đường dẫn lưu trữ tệp ảnh avatar
        $uploadDir = "img/gallery/";
        $uploadPath = $uploadDir . basename($avatar["name"]);

        // Di chuyển tệp ảnh vào thư mục lưu trữ
        if ($avatar["tmp_name"]) {
            // Lưu đường dẫn tệp ảnh avatar vào cơ sở dữ liệu
         @move_uploaded_file($avatar["tmp_name"], $uploadPath);
         $avatar_n=$avatar["name"];
            $query = "INSERT INTO nguoidung (avatar) VALUES('$avatar_n')";
            mysqli_query($conn, $query);

            $_SESSION['thongbao'] ="Tải lên ảnh avatar thành công!";
            header("location:text_html.php");
            exit;
        } else {
            $_SESSION['thongbao'] = "Lỗi tải lên ảnh avatar.";
            header("location:text_html.php");
            exit;
        }
    }

$sql = "SELECT * FROM users ORDER BY id DESC;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Lỗi câu truy vấn SQL";
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<a href='#'>";
        echo "<div style='background-image: url(img/gallery/" . $row['avatar'] . ");'></div>";
        echo "</a>";
    }
}



}


mysqli_close($conn);
?>