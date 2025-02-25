<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <!-- Thư viện Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Thư viện SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
session_start();

// Khai báo biến để lưu thông báo lỗi
$error_msg = "";


   
// Kiểm tra xem người dùng đã gửi biểu mẫu đăng ký chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị từ biểu mẫu đăng ký
    $email = $_POST['email'];
    $matkhau = $_POST['matkhau'];
    $firstname = $_POST['firstname'];
    $lastname =$_POST['lastname'];
    $gioitinh = $_POST['gioitinh'];
    $ngay = $_POST['ngay'];
    $thang = $_POST['thang'];
    $nam = $_POST['nam'];
    $ten_nguoidung= ucfirst($firstname) ." ". ucfirst($lastname);
  // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
  $check_email_query = "SELECT * FROM nguoidung WHERE email = '$email'";
  $check_email_result = $conn->query($check_email_query);
  if ($check_email_result->num_rows > 0) {
      // Nếu email đã tồn tại, hiển thị thông báo lỗi
      $error_msg = "Email đã được sử dụng. Vui lòng chọn một email khác.";
  } else {
      // Nếu email chưa tồn tại, tiếp tục quá trình đăng ký
      // Kiểm tra nếu ngày, tháng, năm không rỗng và đúng định dạng
      if (!empty($ngay) && !empty($thang) && !empty($nam)) {
          // Tạo chuỗi ngày tháng hợp lệ
          $dateString = $nam . '-' . $thang . '-' . $ngay;
          
          // Chuyển đổi chuỗi thành kiểu dữ liệu datetime
          $datetime = new DateTime($dateString);
          
          // Tính tuổi từ ngày sinh của người dùng
          $today = new DateTime();
          $tuoi = $today->diff($datetime)->y;
          
          // Kiểm tra tuổi có lớn hơn hoặc bằng 15 không
          if ($tuoi >= 15) {
              // Thực hiện truy vấn để thêm người dùng mới vào cơ sở dữ liệu
              $insertQuery = "INSERT INTO nguoidung (email, matkhau, ten_nguoidung, gioitinh, ngaysinh) 
              VALUES ('$email', '$matkhau', '$ten_nguoidung', '$gioitinh', '" . $datetime->format('Y-m-d H:i:s') . "')";
              
              if ($conn->query($insertQuery) === TRUE) {
                
                  // Đăng ký thành công
                  echo "<script>
                      Swal.fire({
                          title: 'Đăng ký thành công!',
                          icon: 'success',
                          confirmButtonColor: '#28a745',
                          confirmButtonText: 'Đóng'
                      }).then(() => {
                          window.location.href = '../index.php'; // Chuyển hướng sau khi nhấn nút 'Đóng'
                      });
                  </script>";
              } else {
                  // Đăng ký không thành công, gán thông báo lỗi
                  $error_msg = "Đăng ký không thành công. Vui lòng thử lại!";
              }
          } else {
              // Nếu tuổi dưới 15 tuổi, gán thông báo lỗi và không tiếp tục thực hiện đăng ký
              $error_msg = "Bạn phải đủ 15 tuổi trở lên để đăng ký.";
          }
      } else {
          // Nếu ngày, tháng, năm không hợp lệ, hiển thị thông báo lỗi
          $error_msg = "Ngày sinh không hợp lệ.";
      }
  }
}

// Hiển thị thông báo lỗi bằng SweetAlert nếu có lỗi
if (!empty($error_msg)) {
  echo "<script>
      Swal.fire({
          title: 'Lỗi!',
          text: '$error_msg',
          icon: 'error',
          confirmButtonColor: '#d33',
          confirmButtonText: 'Đóng'
      }).then(() => {
          window.location.href = 'login.php'; // Chuyển hướng về trang login.php
      });
  </script>";
}
?>
</body>
</html>