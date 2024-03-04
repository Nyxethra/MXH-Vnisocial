<?php



// Bao gồm tập lệnh kết nối cơ sở dữ liệu (thay thế bằng chi tiết kết nối thực tế của bạn)
$conn = new mysqli("localhost", "root", "", "vnisocial");

if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Lấy dữ liệu từ form
  $content = htmlspecialchars($_POST['content']);
  $image = $_FILES['image'];

  // Tải ảnh (thay thế bằng logic xử lý ảnh của bạn)
  $image_name = '';
  if (!empty($image['name'])) {
    $image_name = uniqid() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
    $image_path = "../IMG/" . $image_name;
    if (!move_uploaded_file($image['tmp_name'], $image_path)) {
      $image_name = '';
    }
  }

  // Chuẩn bị câu lệnh SQL
  $sql = "INSERT INTO baidang (dang_boi, noidung, image) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iss", $_SESSION['email'], $content, $image_name);

  if ($stmt->execute()) {
    $success_message = "Đăng bài thành công!";
  } else {
    $error_message = "Đăng bài thất bại.";
  }

  if (isset($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
  } else if (isset($success_message)) {
    echo "<p style='color: green;'>$success_message</p>";
  }
}

?>
