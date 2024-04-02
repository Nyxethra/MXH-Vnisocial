<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/1.12.4/sweetalert2.min.css" integrity="sha512-R4+jpnl778pSWzCYwg41gTtdtYZNb3nx8Qk/9M3L5N1qU79qUffkGq9lQS38wQ1m139prU6T8w1oB4Nh9o" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/1.12.4/sweetalert2.min.js" integrity="sha512-n1U/pYmLwhY/Rbk5C56V2W56kRvm65xSUaEzFBdrF1zZdP9MqHmn5qNq7yNSuZ7iZYR/jOiI5IX43sULm9yA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    .container_dangbai {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    
    padding-right: 20px;
    padding-bottom: 20px;
    /* box-sizing: border-box; */
    flex-wrap: nowrap;
    padding-top: 80px;
}

    .baidang {
      width: 570px;
      height: 180px; /* Tăng chiều cao của baidang */
      border-radius: 50px; /* Tăng độ bo tròn của các góc */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 10px;
      box-sizing: border-box;
      background-color: #f0f0f0; /* Màu nền của baidang */
    }

    .phiatren, .phiaduoi {
      display: flex;
      justify-content: space-between;
    }

    .phiatren .ui.input {
      flex-grow: 5.5; /* Giảm kích thước của ô nhập liệu */
      background-color: #e0e0f0; /* Màu nền của ô nhập liệu */
      border-radius: 50px; /* Tăng độ bo tròn của ô nhập liệu */
    }

    .phiatren .ui.input input {
      background-color: #e0e0f0; /* Màu nền của ô nhập liệu */
      border-radius: 50px; /* Tăng độ bo tròn của ô nhập liệu */
    }

    .phiaduoi .ui.button {
      flex-grow: 1;
      background-color: transparent; /* Loại bỏ màu nền */
      border-radius: 50px; /* Tăng độ bo tròn của nút */
      font-size: 16px; /* Giảm kích thước chữ của nút */
    }

    .phiaduoi {
      justify-content: space-evenly; /* Đặt các item cách đều nhau */
    }

    .image.icon {
      color: blue; /* Màu của biểu tượng hình ảnh */
    }

    .smile.icon {
      color: orange; /* Màu của biểu tượng cảm xúc */
    }

    .divider {
      width: 100%;
      height: 1px;
      background-color: #ddd; /* Thay đổi màu sắc của đường ngang */
      margin: 10px 0;
      border-radius: 50px; /* Tăng độ bo tròn của đường ngang */
    }

    .ui.avatar.image {
      width: 50px; /* Tăng kích thước của hình ảnh đại diện */
      height: 50px; /* Tăng kích thước của hình ảnh đại diện */
      border-radius: 50%; /* Tăng độ bo tròn của hình ảnh đại diện */
    }
    /* Khung popup */

    
  </style>
</head>
<body>

<?php
 // Bắt đầu phiên làm việc

// Bao gồm tập lệnh kết nối cơ sở dữ liệu (thay thế bằng chi tiết kết nối thực tế của bạn)
$conn = new mysqli("localhost", "root", "", "vnisocial");

if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Lấy dữ liệu từ form

  // Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Lấy dữ liệu từ form
  $content = "";
  $image = "";

  if (isset($_POST['content'])) {
    $content = htmlspecialchars($_POST['content']);
  }

  if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
  }

  // Kiểm tra xem cả hai biến $content và $image đều không rỗng
  if (!empty($content) || !empty($image['name'])) {
    // Lấy thông tin người đăng bài từ phiên làm việc
    $dang_boi = $_SESSION['ma_nguoidung']; // Đây là giả định 'ma_nguoidung' là trường ID của người dùng trong bảng 'nguoidung'

    // Tải ảnh (thay thế bằng logic xử lý ảnh của bạn)
    $image_name = '';
    if (!empty($image['name'])) {
      $image_name = uniqid() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
      $image_path = "IMG/" . $image_name;
      if (!move_uploaded_file($image['tmp_name'], $image_path)) {
        $image_name = '';
      }
    }

    // Chuẩn bị câu lệnh SQL
    $sql = "INSERT INTO baidang (dang_boi, noidung, image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $dang_boi, $content, $image_name);

    if ($stmt->execute()) {
      $success_message = "Đăng bài thành công!";
    } else {
      $error_message = "Đăng bài thất bại.";
    }

    if (isset($error_message)) {
      // Hiển thị thông báo lỗi
      echo "<script>
          Swal.fire({
              title: 'Lỗi!',
              text: '$error_message',
              icon: 'error',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Đóng'
          });
      </script>";
    } else if (isset($success_message)) {
      // Hiển thị thông báo thành công
      echo "<script>
          Swal.fire({
              title: 'Thành công!',
              text: '$success_message',
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Đóng'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'url-cua-trang-chuyen-huong'; // Thay thế 'url-cua-trang-chuyen-huong' bằng URL thực tế bạn muốn chuyển hướng tới
            }
          });
      </script>";
    }
  } else {
    // $error_message = "Vui lòng nhập nội dung hoặc chọn hình ảnh để đăng bài.";

    // Hiển thị thông báo lỗi
    // echo "<script>
    //     Swal.fire({
    //         title: 'Lỗi!',
    //         text: '$error_message',
    //         icon: 'error',
    //         confirmButtonColor: '#3085d6',
    //         confirmButtonText: 'Đóng'
    //     });
    // </script>";
  }
}
}
?>
<?php
        // Kết nối vào cơ sở dữ liệu
        $conn = new mysqli('localhost', 'root', '', 'vnisocial');

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT avatar, ten_nguoidung
        FROM nguoidung
        WHERE ma_nguoidung = $user_id; ";
 
        $result = $conn->query($sql);
        ?>

<?php
                while($row=$result->fetch_assoc())
                {
            ?>

  <div class="container_dangbai">
    <div class="ui segment baidang">
      <div class="phiatren">
        <img class="ui avatar image" src="img/<?php echo $row["avatar"]; ?>">
        <?php
                }
            ?>
        <div class="ui input">
          <input type="text" placeholder="Nhập nội dung tại đây..." name="content">
        </div>
      </div>
      <div class="divider">.</div> <div class="phiaduoi">
        <button class="ui icon button a" id="insert-media">
          <i class="image icon"></i>
          Ảnh/video
        </button>
        <button class="ui icon button">
          <i class="smile outline icon a"></i>
          Cảm xúc/hoạt động
        </button>
      </
      </div>
  </div>

  <script>
$(document).ready(function() {
  $(".ui.input input, .ui.icon.button.a").click(function(e) {
    e.stopPropagation(); // Ngăn chặn sự kiện click lan truyền

    Swal.fire({
      title: 'Đăng bài',
      html: '<?php $conn = new mysqli('localhost', 'root', '', 'vnisocial'); if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } $sql = "SELECT avatar, ten_nguoidung FROM nguoidung WHERE ma_nguoidung = $user_id; "; $result = $conn->query($sql); ?><div class="popup1">' + '<div class="tren">' + '<h2>Tạo bài đăng</h2>' + '<button class="ui icon button"><i class="close icon"></i></button>' + '</div>' + '<form action="" name ="abcd" method="post" enctype="multipart/form-data"><div class="duoi"><div class="item"><?php while($row=$result->fetch_assoc()){?><img class="ui avatar image" src="img/<?php echo $row["avatar"];?>"><span class="username"><?php echo $row['ten_nguoidung']; ?></span><?php }?></div><div class="item"><textarea name="content" placeholder="Nhập nội dung bài viết..."></textarea></div><div class="item"><span>Thêm hình ảnh/video vào bài viết của bạn</span><div class="image-preview"><img id="image_preview" src="" alt="Hình ảnh được chọn"></div><button type="button" class="ui icon_img button" id="image"> <i class="material-icons">add_photo_alternate</i>  </button> <input type="file" id="image_input" name="image" style="display: none;"></div><div class="item"><button type="submit" name="dangbai_button" class="ui red button">Đăng bài</button></div></div></div></form>',
      width: '100%',
      heightAuto: false,
      padding: '3em',
      background: 'rgba(0, 0, 0, 0.5)',
      backdrop: `
rgba(255,255,255,0.4)
no-repeat
`,
      customClass: {
        popup: 'custom-popup1'
      }
    });

    // Xử lý sự kiện click vào nền đen xung quanh pop-up
    $(".swal2-container").click(function(e) {
      // Kiểm tra xem nơi click có phải là pop-up hay không
      if (!$(e.target).closest('.popup1').length) {
        // Nếu không phải, ẩn pop-up đi
        Swal.close();
      }
    });

    const imageButton = document.getElementById('image');
    const imageInput = document.getElementById('image_input');
    const imagePreview = document.getElementById('image_preview');

    imageButton.addEventListener('click', () => {
      imageInput.click();
    });

    imageInput.addEventListener('change', function() {
      const reader = new FileReader();
      reader.onload = function(e) {
        imagePreview.src = e.target.result;
      };
      reader.readAsDataURL(this.files[0]);
    });

    // Xử lý sự kiện khi click vào nút "Ẩn pop-up"
    $(".ui.icon.button").click(function() {
      Swal.close(); // Ẩn pop-up
    });
  });
});
</script>




  <style>
    .custom-popup1 {
      height: 100%;  
    }
    .close.icon {
  position: absolute; /* Đặt vị trí của phần tử con là tuyệt đối */
  top: 3px; /* Điều chỉnh khoảng cách từ trên xuống */
  right: 3px; /* Điều chỉnh khoảng cách từ phải sang trái */
}
.swal2-confirm.swal2-styled{
  display: none;
}
    .popup1 {
      display: flex;
      flex-direction: column;
      height: 70%;
      width: 40%;
      background-color: #f0f0f0;
      
      border-radius: 10px;
    }

    .tren {
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 18%;
      border-bottom: 1px solid #ddd;
    }

    .tren h2 {
      font-size: 16px;
      margin: 0;
    }

    .tren .ui.icon.button {
      margin-right: 10px;
      position: relative;
    }

    .duoi {
      display: flex;
      flex-direction: column;
      height: 82%;
    }

    .duoi .item {
      display: flex;
      align-items: center;
      padding: 5px 0;
    }

    .duoi .item:first-child {
      padding-top: 10px;
    }

    .duoi .item .ui.avatar.image {
      margin-right: 10px;
    }

    .duoi .item .username {
      font-size: 14px;
    }

    .duoi .item textarea {
      height: 100px;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ddd;
    }

    .duoi .item img {
    /* width: 58px; */
    height: 102px;
    object-fit: cover;
}

    .duoi .item .ui.icon
    .ui.icon.button {
      margin-right: 5px;
    }

    .duoi .item .ui.red.button {
      width: 100%;
    }
    .popup1 {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 500px;
  background-color: #fff;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  z-index: 9999;
}

/* Thanh tiêu đề */
.tren {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border-bottom: 1px solid #ccc;
}

.tren h2 {
  font-size: 20px;
  font-weight: bold;
}

.tren .ui.icon.button {
  padding: 0;
  cursor: pointer;
}

.tren .ui.icon.button i.close.icon {
  color: #999;
}

/* Nội dung bài đăng */
.duoi {
  padding: 10px;
}

.duoi .item {
  display: flex;
  margin-bottom: 10px;
  position: relative;
}


button#image {
    width: 58px;
    height: 100px;
}

.duoi .item .username {
  font-weight: bold;
  margin-left: 10px;
  line-height: 30px;
}

.duoi .item textarea {
  width: 100%;
  height: 100px;
  resize: none;
  padding: 10px;
  border: 1px solid #ccc;
  outline: none;
}

.duoi .item span {
  display: inline-block;
  padding: 5px 10px;

  margin-right: 10px;
  border-radius: 5px;
}

.duoi .item .ui.icon.button {
  padding: 0;
  cursor: pointer;
}

.duoi .item .ui.icon.button i {
  color: #ccc;
}

.duoi .item button.ui.red.button {
  background-color: #e74c3c;
  color: #fff;
  padding: 5px 10px;
  border: none;
  cursor: pointer;
}
.swal2-actions {
    display: none;
}

  </style>
</body>
</html>
