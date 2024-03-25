<?php
session_start();

$user_id = $_SESSION['ma_nguoidung'];

if(!isset($user_id)){
   header('location:SIGNUP.LOGIN.LOGOUT/login.php');
}; 
?>

    <?php include ('BAR/Nav_Bar.php');?>

    <?php
session_start();

$user_id = $_SESSION['ma_nguoidung'];

if(!isset($user_id)){
   header('location: SIGNUP.LOGIN.LOGOUT/login.php');
   exit(); // Kết thúc xử lý nếu chưa đăng nhập
}

include ('BAR/Nav_Bar.php');

// Kết nối vào cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'vnisocial');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn để lấy danh sách bạn bè của người dùng hiện tại
$query_friends = "SELECT ma_nguoidung1, ma_nguoidung2 FROM banbe WHERE ma_nguoidung1 = $user_id OR ma_nguoidung2 = $user_id";

$result_friends = $conn->query($query_friends);

// Mảng để lưu trữ danh sách ID của bạn bè
$friend_ids = array();

// Lấy danh sách ID của bạn bè
if ($result_friends->num_rows > 0) {
    while ($row = $result_friends->fetch_assoc()) {
        if ($row['ma_nguoidung1'] == $user_id) {
            $friend_ids[] = $row['ma_nguoidung2'];
        } else {
            $friend_ids[] = $row['ma_nguoidung1'];
        }
    }
}

// Nếu không có bạn bè nào, hiển thị thông báo
if (empty($friend_ids)) {
    echo "<p>Bạn chưa có bạn bè nào.</p>";
} else {
    // Chuyển mảng thành chuỗi để sử dụng trong truy vấn SQL
    $friend_ids_str = implode(",", $friend_ids);

    // Truy vấn để lấy các bài đăng của bạn bè
    $query_posts = "SELECT * FROM baidang WHERE dang_boi IN ($friend_ids_str) ORDER BY thoigian_dang DESC";

    $result_posts = $conn->query($query_posts);

    // Hiển thị các bài đăng của bạn bè
    if ($result_posts->num_rows > 0) {
        while ($row_post = $result_posts->fetch_assoc()) {
            // Hiển thị bài đăng
            echo "<div class='post'>";
            echo "<p>{$row_post['noidung']}</p>";
            echo "<img src='{$row_post['image']}' alt='Post Image'>";
            echo "</div>";
        }
    } else {
        echo "<p>Không có bài đăng từ bạn bè.</p>";
    }
}

// Đóng kết nối
$conn->close();
?>
 
    <?php 
        if (isset($_GET["pid"])){
            $id=$_GET["pid"];
            switch ($id){
              // case 0:
              //   include("view/public_dichvu.php");
              //   break;
              case 1: 
                include("TRANG_CANHAN/trangcanhan.php");
                break;
              case 0:
                include("subhome.php");
                break;
          }
        }else {include("subhome.php");}
    ?> 
  </body>
</html>
 