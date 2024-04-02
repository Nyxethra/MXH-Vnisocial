<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chỉnh sửa bài đăng</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/1.12.4/sweetalert2.min.css" integrity="sha512-R4+jpnl778pSWzCYwg41gTtdtYZNb3nx8Qk/9M3L5N1qU79qUffkGq9lQS38wQ1m139prU6T8w1oB4Nh9o" crossorigin="anonymous" referrerpolicy="no-referrer">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/1.12.4/sweetalert2.min.js" integrity="sha512-n1U/pYmLwhY/Rbk5C56V2W56kRvm65xSUaEzFBdrF1zZdP9MqHmn5qNq7yNSuZ7iZYR/jOiI5IX43sULm9yA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

<?php


if(isset($_POST['ma_baidang'], $_POST['noidung_moi'])) {
    $ma_baidang = $_POST['ma_baidang'];
    $noidung_moi = $_POST['noidung_moi'];

    // Xóa ảnh nếu được chọn
    if(isset($_POST['xoa_anh']) && $_POST['xoa_anh'] == 1) {
        $stmt_select_image = $conn->prepare("SELECT image FROM baidang WHERE ma_baidang = ?");
        $stmt_select_image->bind_param("i", $ma_baidang);
        $stmt_select_image->execute();
        $stmt_select_image->store_result();
        if ($stmt_select_image->num_rows > 0) {
            $stmt_select_image->bind_result($image_path);
            $stmt_select_image->fetch();
            @unlink($image_path); // Xóa ảnh từ thư mục lưu trữ
        }
        $stmt_delete_image = $conn->prepare("UPDATE baidang SET image = NULL WHERE ma_baidang = ?");
        $stmt_delete_image->bind_param("i", $ma_baidang);
        if (!$stmt_delete_image->execute()) {
            echo "Error updating record: " . $stmt_delete_image->error;
        }
    }

    // Cập nhật nội dung mới
    $stmt_update_content = $conn->prepare("UPDATE baidang SET noidung = ? WHERE ma_baidang = ?");
    $stmt_update_content->bind_param("si", $noidung_moi, $ma_baidang);
    $update_content_result = $stmt_update_content->execute();

    // Tải lên ảnh mới
    $image_upload_success = true;
    if(isset($_FILES['anh_moi']) && $_FILES['anh_moi']['error'] === UPLOAD_ERR_OK) {
        $temp_name = $_FILES['anh_moi']['tmp_name'];
        $target_path = "../IMG/";
        $new_image_name = $target_path . basename($_FILES['anh_moi']['name']);

        $image_info = getimagesize($temp_name);
        if($image_info !== false) {
            if(move_uploaded_file($temp_name, $new_image_name)) {
                $stmt_update_image = $conn->prepare("UPDATE baidang SET image = ? WHERE ma_baidang = ?");
                $stmt_update_image->bind_param("si", $new_image_name, $ma_baidang);
                if (!$stmt_update_image->execute()) {
                    $image_upload_success = false;
                    echo "Error updating record: " . $stmt_update_image->error;
                }
            } else {
                $image_upload_success = false;
                echo "Xin lỗi vì đã xảy ra sự cố upload hình ảnh";
            }
        } else {
            $image_upload_success = false;
            echo "File không phải là ảnh hợp lệ";
        }
    }

    // Kiểm tra xem cả hai thao tác cập nhật nội dung và ảnh có thành công không
    if ($update_content_result && $image_upload_success) {
        // Nếu cả hai đều thành công, hiển thị thông báo thành công và chuyển hướng
        echo "<script>
            Swal.fire({
                title: 'Cập nhật thành công!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.back();
                }
            });
        </script>";
    } else {
        // Nếu có lỗi xảy ra trong quá trình cập nhật, hiển thị thông báo lỗi
        echo "<script>
            Swal.fire({
                title: 'Đã xảy ra lỗi!',
                text: 'Không thể cập nhật bài đăng.',
                icon: 'error',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    // Đóng kết nối
    $conn->close();

} else {
    echo "Thiếu thông tin cần thiết.";
}
?>

</body>
</html>
