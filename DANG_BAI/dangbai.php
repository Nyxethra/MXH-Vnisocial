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
        <img class="ui avatar image" src="img/may_dep.jpg">
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
        html: '<div class="popup">'+'<div class="tren">'+'<h2>Tạo bài đăng</h2>'+'<button class="ui icon button"><i class="close icon"></i></button>'+'</div>'+'<form action="Dang_bai/post_create.php" method="post" enctype="multipart/form-data"><div class="duoi"><div class="item"><img class="ui avatar image" src="img/may_dep.jpg"><span class="username">Tên người dùng</span></div><div class="item"><textarea name="content" placeholder="Nhập nội dung bài viết..."></textarea></div><div class="item"><span>Thêm vào bài viết của bạn</span><input type="file" class="ui icon_img button  id="image" name="image"><i class="image outline icon"></i></button></div><div class="item"><button type="submit" class="ui red button">Đăng bài</button></div></div></div></form>',
        width: '100%',
        heightAuto: false,
        padding: '3em',
        background: 'rgba(0, 0, 0, 0.5)',
        backdrop: `
          rgba(255,255,255,0.4)
          no-repeat
        `,
        customClass: {
          popup: 'custom-popup'
        }
      });

      // Xử lý sự kiện click vào nền đen xung quanh pop-up
      $(".swal2-container").click(function(e){
        // Kiểm tra xem nơi click có phải là pop-up hay không
        if (!$(e.target).closest('.popup').length) {
          // Nếu không phải, ẩn pop-up đi
          Swal.close();
        }
      });

      // Xử lý sự kiện khi click vào nút "Ẩn pop-up"
      $(".ui.icon.button").click(function(){
        Swal.close(); // Ẩn pop-up
      });
    });
  });
</script>



  <style>
    .custom-popup {
      height: 100%; // Tăng chiều cao của popup
    }
    .close.icon {
  position: absolute; /* Đặt vị trí của phần tử con là tuyệt đối */
  top: 3px; /* Điều chỉnh khoảng cách từ trên xuống */
  right: 3px; /* Điều chỉnh khoảng cách từ phải sang trái */
}
.swal2-confirm.swal2-styled{
  display: none;
}
    .popup {
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
