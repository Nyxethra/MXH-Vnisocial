<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trang của tôi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <style>
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      padding-right: 20px;
      padding-bottom: 20px;
      box-sizing: border-box;
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
  </style>
</head>
<body>
  <div class="container">
    <div class="ui segment baidang">
      <div class="phiatren">
        <img class="ui avatar image" src="avatar.png">
        <div class="ui input">
          <input type="text" placeholder="Nhập nội dung tại đây...">
        </div>
      </div>
      <div class="divider"></div> <div class="phiaduoi">
        <button class="ui icon button" id="insert-media">
          <i class="image icon"></i>
          Ảnh/video
        </button>
        <button class="ui icon button">
          <i class="smile outline icon"></i>
          Cảm xúc/hoạt động
        </button>
      </
      </div>
  </div>

  <script>
    $(document).ready(function(){
      $(".ui.input input, .ui.icon.button").click(function(e){
        e.stopPropagation(); // Ngăn chặn sự kiện click lan truyền
        Swal.fire({
          title: 'Đăng bài',
          html: '<form action="post_create.php" method="post" enctype="multipart/form-data"><div class="popup"> <div class="tren"> <h2>Tạo bài đăng</h2><button class="ui icon button"><i class="close icon"></i></button></div><div class="duoi"><div class="item"><img class="ui avatar image" src="avatar.png"><span class="username">Tên người dùng</span></div><div class="item"><textarea name="content" placeholder="Nhập nội dung bài viết..."></textarea></div><div class="item"><span>Thêm vào bài viết của bạn</span><input type="file" class="ui icon button  id="image" name="image"><i class="image outline icon"></i></button></div><div class="item"><button type="submit" class="ui red button">Đăng bài</button></div></div></div></form>',
          width: '60%',
          heightAuto: false,
          padding: '3em',
          background: '#f0f0f0',
          backdrop: `
            rgba(255,255,255,0.4)
            no-repeat
          `,
          customClass: {
            popup: 'custom-popup'
          }
        });
      });

      // Xử lý sự kiện click cho nút chèn hình ảnh hoặc video
      $("#insert-media").click(function(e) {
        e.stopPropagation(); // Ngăn chặn sự kiện click lan truyền
        // Thêm mã xử lý cho việc chèn hình ảnh hoặc video tại đây
        // Ví dụ: Hiển thị một cửa sổ popup cho phép người dùng chọn hình ảnh hoặc video từ máy tính của họ
        Swal.fire({
          title: 'Chèn hình ảnh hoặc video',
          text: 'Chức năng này đang được phát triển.',
          icon: 'info',
          confirmButtonText: 'OK'
        });
      });
    });
  </script>

  <style>
    .custom-popup {
      height: 70%; // Tăng chiều cao của popup
    }

    .popup {
      display: flex;
      flex-direction: column;
      height: 70%;
      width: 60%;
      background-color: #f0f0f0;
      padding: 20px;
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

    .duoi .item span {
      margin-right: 10px;
    }

    .duoi .item .ui.icon
    .ui.icon.button {
      margin-right: 5px;
    }

    .duoi .item .ui.red.button {
      width: 100%;
    }
  </style>
</body>
</html>
