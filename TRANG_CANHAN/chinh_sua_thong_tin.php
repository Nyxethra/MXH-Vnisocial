

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin cá nhân</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header text-center">Chỉnh sửa thông tin cá nhân</h5>
                    <div class="card-body">
                        <form id="editProfileForm">
                        <div class="form-group">
                            <label for="username">Tên người dùng</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên người dùng" maxlength="30">
                        </div>

                            <div class="form-group">
                                <label for="bio">Tiểu sử</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Nhập tiểu sử của bạn"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="location">Đang học tại</label>
                                <input type="text" class="form-control" id="school" name="school" placeholder="Nhập nơi đang học tại">
                            </div>
                            <div class="form-group">
                                <label for="location">Sống tại</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Nhập nơi sống tại">
                            </div>
                            <button type="button" class="btn btn-primary btn-block" onclick="saveProfile()">Lưu thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
session_start(); // Bắt đầu phiên session nếu chưa được khởi tạo

// Xác định user_id từ dữ liệu được gửi từ form hoặc từ session
$user_id = isset($_SESSION['ma_nguoidung']) ? $_SESSION['ma_nguoidung'] : (isset($_POST['ma_nguoidung']) ? $_POST['ma_nguoidung'] : null);

// Kiểm tra xem có dữ liệu được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem có dữ liệu tên người dùng được gửi từ form không
    if (isset($_POST["ten_nguoidung"]) && isset($_POST["tieusu"]) && isset($_POST["hoc_tai"]) && isset($_POST["song_tai"])) {
        // Lấy dữ liệu từ form
        $newUsername = $_POST["ten_nguoidung"];
        $bio = $_POST["tieusu"];
        $school = $_POST["hoc_tai"];
        $location = $_POST["song_tai"];

        // Kiểm tra độ dài của tên người dùng
        if (strlen($newUsername) > 30) {
            // Nếu tên người dùng dài hơn 30 ký tự, thông báo lỗi
            echo "Tên người dùng không được vượt quá 30 ký tự.";
        } else {
            // Kết nối đến cơ sở dữ liệu (thay đổi các thông số kết nối tùy theo cài đặt của bạn)
            $servername = "localhost";
            $username = "ten_nguoidung";
            $password = "matkhau";
            $database = "vnisocial";

            // Kết nối đến cơ sở dữ liệu
            $conn = new mysqli($servername, $username, $password, $database);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối không thành công: " . $conn->connect_error);
            }

            // Chuẩn bị câu lệnh SQL để cập nhật thông tin cá nhân trong cơ sở dữ liệu
            $sql = "UPDATE nguoidung SET ten_nguoidung='$newUsername', tieusu='$bio', hoc_tai='$school', song_tai='$location' WHERE ma_nguoidung='$user_id'";

            // Thực thi câu lệnh SQL và kiểm tra kết quả
            if ($conn->query($sql) === TRUE) {
                // Đóng kết nối
                $conn->close();
                // Chuyển hướng về trang cá nhân sau khi cập nhật thành công
                echo "<script>window.location.href = 'trangcanhan.php';</script>";
                exit(); // Dừng kịch bản để ngăn chặn mã HTML sau khi chuyển hướng
            } else {
                echo "Lỗi khi cập nhật thông tin cá nhân: " . $conn->error;
            }

            // Đóng kết nối
            $conn->close();
        }
    } else {
        // Nếu không có đủ dữ liệu được gửi từ form, thông báo lỗi
        echo "Không có đủ dữ liệu được gửi từ form.";
    }
}
?>


</body>
</html>
