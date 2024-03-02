<?php 
$host='localhost';
$username='root';
$password='';
$db='vnisocial';

$connection= mysqli_connect($host,$username,$password,$db);
$email="khanhkhnah";
$ten_nguoidung="khanhsakdja";

$query ="insert into nguoidung(email, ten_nguoidung) values ('$email', '$ten_nguoidung')";
echo $query;
mysqli_query($connection,$query);