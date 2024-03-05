<?php
session_start();

// Hủy bỏ tất cả các biến phiên làm việc
$_SESSION = array();

// Hủy bỏ phiên làm việc
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập sau khi đăng xuất
header('Location: layoutadmin.php');
exit();
?>
