<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<style>
    .profile-introduction {
  background-color: #f1f1f1;
  padding: 20px;
}

.profile-intro-content {
  display: flex;
  align-items: center;
}

.profile-picture img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
}

.profile-info {
  margin-left: 20px;
}

.profile-info h3 {
  margin: 0;
}

.profile-actions {
  margin-top: 10px;
}

.edit-profile, .add-friend {
  background-color: #4267B2;
  color: #fff;
  border: none;
  padding: 8px 16px;
  margin-right: 10px;
  cursor: pointer;
}

.edit-profile:hover, .add-friend:hover {
  background-color: #29487d;
}
</style>
<body>
<div class="profile-introduction">
  <h2>Giới thiệu</h2>
  <div class="profile-intro-content">
    <div class="profile-picture">
      <img src="path_to_profile_picture.jpg" alt="Profile Picture">
    </div>
    <div class="profile-info">
      <h3>Tên của bạn</h3>
      <p>Thông tin cá nhân khác về bạn</p>
      <div class="profile-actions">
        <button class="edit-profile">Chỉnh sửa thông tin</button>
        <button class="add-friend">Thêm bạn bè</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
