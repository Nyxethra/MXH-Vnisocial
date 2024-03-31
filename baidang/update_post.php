<?php
if(isset($_POST['ma_baidang'], $_POST['noidung_moi'])) {
    $ma_baidang = $_POST['ma_baidang'];
    $noidung_moi = $_POST['noidung_moi'];

    $conn = new mysqli('localhost', 'root', '', 'vnisocial');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Xóa ảnh nếu được chọn
    if(isset($_POST['xoa_anh']) && $_POST['xoa_anh'] == 1) {
        $stmt_select_image = $conn->prepare("SELECT image FROM baidang WHERE ma_baidang = ?");
        $stmt_select_image->bind_param("i", $ma_baidang);
        $stmt_select_image->execute();
        $stmt_select_image->store_result();
        if ($stmt_select_image->num_rows > 0) {
            $stmt_select_image->bind_result($image_path);
            $stmt_select_image->fetch();
            unlink($image_path); // Xóa ảnh từ thư mục lưu trữ
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
    if (!$stmt_update_content->execute()) {
        echo "Error updating record: " . $stmt_update_content->error;
    }

    // Tải lên ảnh mới
    if(isset($_FILES['anh_moi']) && $_FILES['anh_moi']['error'] === UPLOAD_ERR_OK) {
        $temp_name = $_FILES['anh_moi']['tmp_name'];
        $target_path = "uploads/";
        $new_image_name = $target_path . basename($_FILES['anh_moi']['name']);

        $image_info = getimagesize($temp_name);
        if($image_info !== false) {
            if(move_uploaded_file($temp_name, $new_image_name)) {
                $stmt_update_image = $conn->prepare("UPDATE baidang SET image = ? WHERE ma_baidang = ?");
                $stmt_update_image->bind_param("si", $new_image_name, $ma_baidang);
                if (!$stmt_update_image->execute()) {
                    echo "Error updating record: " . $stmt_update_image->error;
                }
            } else {
                echo "Xin lỗi vì đã xảy ra sự cố upload hình ảnh";
            }
        } else {
            echo "File không phải là ảnh hợp lệ";
        }
    }

  // Đóng kết nối
  $conn->close();

  // Báo thành công và chuyển hướng người dùng
  echo "<script>alert('Cập nhật thành công!');</script>";
  header("Location: .../HOME.php");
  exit();
} else {
  echo "Thiếu thông tin cần thiết.";
}
?>
