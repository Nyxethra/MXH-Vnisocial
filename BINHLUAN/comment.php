<?php
include "db_connection.php";
// Xử lý khi người dùng gửi bình luận

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Lấy dữ liệu từ form
    $ma_nguoidung = isset($_GET["ma_nguoidung"]) ? $_GET["ma_nguoidung"] : '';
    $noidung_binhluan = isset($_POST["noidung_binhluan"]) ? $_POST["noidung_binhluan"] : '';
    $ma_baidang = isset($_GET['ma_baidang']) ? $_GET['ma_baidang'] : '';
// @var_dump($ma_nguoidung);
// @var_dump($ma_baidang);
// @var_dump($noidung_binhluan);
    // Kiểm tra nếu bình luận không rỗng
    if (!empty($noidung_binhluan)) {
        // Thực hiện truy vấn để lưu bình luận vào cơ sở dữ liệu
        $sql = "INSERT INTO binhluan (binhluan_boi, ma_baidang, noidung_binhluan, thoidiem_binhluan)
        VALUES ('$ma_nguoidung', '$ma_baidang', '$noidung_binhluan', current_timestamp())";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Bình luận đã được lưu!')</script>;";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Vui lòng nhập bình luận của bạn.";
    }
}
