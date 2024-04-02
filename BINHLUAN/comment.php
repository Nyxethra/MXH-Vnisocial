<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    
</body>
</html>
<?php
include "db_connection.php";
// Xử lý khi người dùng gửi bình luận

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Lấy dữ liệu từ form
    $ma_nguoidung = isset($_GET["ma_nguoidung"]) ? $_GET["ma_nguoidung"] : '';
    $noidung_binhluan = isset($_POST["noidung_binhluan"]) ? $_POST["noidung_binhluan"] : '';
    $ma_baidang = isset($_GET['ma_baidang']) ? $_GET['ma_baidang'] : '';

    // Kiểm tra nếu bình luận không rỗng
    if (!empty($noidung_binhluan)) {
        // Thực hiện truy vấn để lưu bình luận vào cơ sở dữ liệu
        $sql = "INSERT INTO binhluan (binhluan_boi, ma_baidang, noidung_binhluan, thoidiem_binhluan)
        VALUES ('$ma_nguoidung', '$ma_baidang', '$noidung_binhluan', current_timestamp())";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Lưu bình luận thành công',
                showConfirmButton: false,
                timer: 1500,
                });</script>";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>
        Swal.fire({
            position: 'center',
            
            title: 'Vui lòng nhập bình luận của bạn',
            showConfirmButton: false,
            timer: 1500,
            });</script>";
    }
}
//kiểm tra nhấn nút sửa
if (isset($_POST['update_comment'])) {
    $ma_baidang = isset($_GET['ma_baidang']) ? $_GET['ma_baidang'] : '';

    $commentId = $_POST['comment_id'];
    $editedComment = $_POST['edited_comment'];

    // Thực hiện câu truy vấn để cập nhật bình luận trong cơ sở dữ liệu
    $sql = "UPDATE binhluan SET noidung_binhluan = '$editedComment' WHERE ma_binhluan = '$commentId'";
    $result = $conn->query($sql);

    if ($result) {
        // Hiển thị thông báo thành công bằng JavaScript

        echo "<script>
        Swal.fire('Đã được chỉnh sửa!');
     </script>";
    } else {
        // Hiển thị thông báo thất bại bằng JavaScript
        echo "<script>
        alert('Cập nhật bình luận thất bại!');
        window.location.href = 'comment_layout.php?ma_baidang=$ma_baidang&ma_nguoidung=$ma_nguoidung';
        </script>";
    }

}
// Hiển thị biểu mẫu chỉnh sửa bình luận
if (isset($_GET['comment_id'])) {
    $ma_nguoidung = isset($_GET["ma_nguoidung"]) ? $_GET["ma_nguoidung"] : '';
    $noidung_binhluan = isset($_POST["noidung_binhluan"]) ? $_POST["noidung_binhluan"] : '';
    $ma_baidang = isset($_GET['ma_baidang']) ? $_GET['ma_baidang'] : '';

    $commentId = $_GET['comment_id'];

    // Thực hiện câu truy vấn để lấy thông tin bình luận từ cơ sở dữ liệu
    $sql = "SELECT * FROM binhluan WHERE ma_binhluan = '$commentId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $commentContent = $row['noidung_binhluan'];

        // Hiển thị biểu mẫu chỉnh sửa bình luận với nội dung bình luận ban đầu
        echo "
        <form method='post' action=''>
            <textarea name='edited_comment'>$commentContent</textarea>
            <input type='hidden' name='comment_id' value='$commentId'>
            <button type='submit' name='update_comment'>Cập nhật</button>
            <button type='button' onclick='goBack()'>Trở về</button>
        </form>
        <script>
            function goBack() {
                window.location.href = 'comment_layout.php?ma_baidang=$ma_baidang&ma_nguoidung=$ma_nguoidung';
            }
        </script>";
    } else {
        echo "Không tìm thấy bình luận";
        // Có thể chuyển hướng hoặc hiển thị thông báo lỗi
    }
}
