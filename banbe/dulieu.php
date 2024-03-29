<?php
// Tạo mảng dữ liệu
$data = array(
    "name" => "John Doe",
    "email" => "johndoe@exadddddddddddddddmple.com",
    "age" => 30
);

// Chuyển đổi mảng sang JSON
$json = json_encode($data);

// Phản hồi về dưới dạng JSON
echo $json;
?>
