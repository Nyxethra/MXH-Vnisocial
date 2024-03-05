<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="profile-intro-content">
    <div class="profile-picture">
        <img id="avatar-img" class="profile_pic">
        <form action="text_chinhsua.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="avatar" id="avatar-input" accept="image/*" style="display:none">
            <input type="text" name="username" placeholder="Tên người dùng">
            <button type="button" id="edit-avatar-btn" class="edit-avatar">
                <i class="fas fa-camera"></i> Chỉnh sửa ảnh đại diện
            </button>
            <input type="submit" value="Lưu" style="display: none;">
        </form>
    </div>
</div>
</body>
</html>
