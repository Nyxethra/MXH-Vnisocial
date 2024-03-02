<?php
// Bắt đầu phiên làm việc
session_start();

// Hủy bỏ tất cả các session
session_unset();

// Hủy bỏ phiên làm việc
session_destroy();

// Chuyển hướng người dùng đến trang chủ hoặc trang đăng nhập
header("Location: index.php"); // Thay thế 'index.php' bằng trang mà bạn muốn chuyển hướng sau khi đăng xuất
exit;
?>