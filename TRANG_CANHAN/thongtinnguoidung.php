<?php

$ten="SELECT * FROM nguoidung where ma_nguoidung='$user_id'";
$result_t = $conn->query($ten);

$thongtin="SELECT * FROM tt_nguoidung where ma_nguoidung='$user_id'";
$result_tt = $conn->query($thongtin);

?>