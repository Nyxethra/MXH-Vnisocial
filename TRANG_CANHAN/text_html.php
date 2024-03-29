<button id="comment-btn">Comment</button>
<?php
$row['ma_baidang'] = 3;

?>
<script>
    document.getElementById('comment-btn').addEventListener('click', function() {
     
    // Lắng nghe sự kiện click của nút "Comment"
    // console.log(ma_baidang);
    // commentBtn.addEventListener("click", function() {
        // Lấy giá trị session của bài đăng
        var ma_baidang = "<?php echo $row['ma_baidang']; ?>"; // Thay đổi $row['ma_baidang'] thành biến chứa giá trị session

        // Chuyển hướng tới trang bình luận với giá trị session được truyền qua URL query parameter
        window.location.href = "../BINHLUAN/text_chinhsua.php?ma_baidang=" + ma_baidang;
        // $_SESSION['ma_baidang']=$row['ma_baidang'];
    });
</script>