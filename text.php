<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        .profile-picture {
            position: relative;
            display: inline-block;
        }

        .profile-picture img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .edit-avatar {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #4267B2;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        .edit-avatar i {
            margin-right: 5px;
        }

        .edit-avatar:hover {
            background-color: #29487d;
        }
    </style>
</head>
<body>

        <div class="profile-intro-content">
            <div class="profile-picture">
                <form method="POST" enctype="multipart/form-data">
                <img id="avatar-img" class="profile_pic">
                <input type="file" id="avatar-input" accept="image/*" style="display:none">
                <button id="edit-avatar-btn" class="edit-avatar">
                    <i class="fas fa-camera"></i>
                </button>
                </form>
            </div>
        </div>


    <script>
        document.getElementById('edit-avatar-btn').addEventListener('click', function() {
            document.getElementById('avatar-input').click();
        });

        document.getElementById('avatar-input').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatar-img').src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
</body>
</html>