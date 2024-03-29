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
            echo "Bình luận đã được lưu thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Vui lòng nhập bình luận của bạn.";
    }
}

// Xử lý yêu cầu sửa bình luận
if (isset($_POST['edit_comment'])) {
    $commentId = $_POST['comment_id'];
    $editedComment = $_POST['edited_comment'];

    // Thực hiện câu truy vấn để cập nhật bình luận trong cơ sở dữ liệu
    $sql = "UPDATE binhluan SET noidung_binhluan = '$editedComment' WHERE ma_binhluan = '$commentId'";
    $result = $conn->query($sql);

    if ($result) {
        echo "Cập nhật bình luận thành công";

        // Có thể chuyển hướng hoặc hiển thị thông báo thành công
    } else {
        echo "Cập nhật bình luận thất bại";

        // Có thể chuyển hướng hoặc hiển thị thông báo lỗi
    }
}

// Xử lý yêu cầu xóa bình luận
if (isset($_POST['delete_comment'])) {
    $commentId = $_POST['comment_id'];

    // Thực hiện câu truy vấn để xóa bình luận khỏi cơ sở dữ liệu
    $sql = "DELETE FROM binhluan WHERE ma_binhluan = '$commentId'";
    $result = $conn->query($sql);

    if ($result) {
        echo "Xóa bình luận thành công";

        // Có thể chuyển hướng hoặc hiển thị thông báo thành công
    } else {
        echo "Xóa bình luận thất bại";
        // Có thể chuyển hướng hoặc hiển thị thông báo lỗi
    }
}

// Sau khi xử lý yêu cầu sửa hoặc xóa bình luận, bạn có thể chuyển hướng người dùng hoặc hiển thị thông báo thành công.
// ...
