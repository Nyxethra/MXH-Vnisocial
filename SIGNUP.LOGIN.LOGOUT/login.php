<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-KVZ4X6ZkGa5Pw4e2spzhpxQVdG0+PwT8/x8q+ABe3xooqZ1gA7p4hFjcqLoO6703X/71Xsm1+98olIw5W4f+sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNIsocial</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">

</head>
<body>
    <?php include("thanhbar_dangnhap.php")?>
<section>
    <div class="signup_body" style="background-color: #a72f2f;">
        <p class="acc_crt"style="color:white"><b>Đăng ký</b></p>
        <p class="free_hint" style="color:white">Mạng Xã Hội Mang Bản Sắc Việt.</p>
        <form class="signup_form" method="POST" action="dangki.php">
    <div>
        <input  class="firstname" type="text" name="firstname" placeholder="Họ" required>
        <input  class="lastname" type="text" name="lastname" placeholder="Tên" required>
        <input  class="email" type="email" name="email" placeholder="Điền email của bạn" required>
        <input  class="password" type="password" name="matkhau" placeholder="Mật khẩu" required>
        <input  class="password2" type="password" name="matkhau2" placeholder="Xác nhận mật khẩu" required>
    </div>
    <div class="form-group">
        <label class="birthday">Ngày sinh</label>
        <input type="date" id="ngaysinh" required>
        <!-- Ba trường ẩn để chứa giá trị ngày, tháng và năm -->
        <input type="hidden" name="ngay" id="ngay">
        <input type="hidden" name="thang" id="thang">
        <input type="hidden" name="nam" id="nam">
    </div>
    <div class="form-group">
        <p class="birthday" > Giới tính</p>
        <select class="gender" name="gioitinh" required>
            <option value="nam">Nam</option>
            <option value="nu">Nữ</option>
        </select>
    </div>
    <div class="form-group">
        <p class="agreement">Nhấn đăng ký đồng nghĩa với việc bạn đã đồng ý với các <a href="#">điều khoản</a>.</p>
        <button class="signup" type="submit">Đăng ký</button>
    </div>
</form>
<script>
// Bắt sự kiện khi submit form
$(".signup_form").submit(function(event) {
    // Ngăn chặn việc submit form mặc định
    event.preventDefault();

    // Lấy giá trị ngày sinh từ trường input
    var ngaysinhValue = document.getElementById('ngaysinh').value;

    // Phân tách giá trị ngày, tháng và năm
    var parts = ngaysinhValue.split("-");
    var ngay = parts[2];
    var thang = parts[1];
    var nam = parts[0];

    // Gán giá trị vào các trường input ẩn
    document.getElementById('ngay').value = ngay;
    document.getElementById('thang').value = thang;
    document.getElementById('nam').value = nam;

    // Submit form
    this.submit();
});
</script>

    </div>
    <img class="logonen" src="../img/logo_nen.jpg" style="position: absolute; top: 133px; left: 529px; width: 700px;">
</section>
</body>
<script>
        
        // Bắt sự kiện khi nhấn nút Đăng ký
        $(".signup_form").submit(function(event) {
            var isValid = true;
            // Kiểm tra các ô input xem có trống không
            $(this).find("input").each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    return false; // Thoát khỏi vòng lặp nếu có một ô trống
                }
            });
            // Kiểm tra ô ngày sinh
            if ($("#ngaysinh").val() === "Ngày/Tháng/Năm") {
                isValid = false;
            }
            // Kiểm tra ô giới tính
            if ($(".gender").val() === "") {
                isValid = false;
            }
            // Nếu có ô nào trống, ngăn chặn việc submit form
            if (!isValid) {
                event.preventDefault();
                alert("Vui lòng điền đầy đủ thông tin.");
            }
        });
</script>

</html>
