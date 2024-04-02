<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang cá nhân - Vnisocial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/1.12.4/sweetalert2.min.css" integrity="sha512-R4+jpnl778pSWzCYwg41gTtdtYZNb3nx8Qk/9M3L5N1qU79qUffkGq9lQS38wQ1m139prU6T8w1oB4Nh9o" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/1.12.4/sweetalert2.min.js" integrity="sha512-n1U/pYmLwhY/Rbk5C56V2W56kRvm65xSUaEzFBdrF1zZdP9MqHmn5qNq7yNSuZ7iZYR/jOiI5IX43sULm9yA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" integrity="sha512-SnY1e0uVjum1HoCV5krFfTnNCb5x4P3eblm3Wy+t9mRXFtz6q97CRfSsGb1HNwBDbx3YbgA8D9V6gQISgHRTyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" integrity="sha512-UatOnW3LW1SyNPrQYsbngp7DhbR89t5os0E3gZMnBy/01LLqGo7HHg7fjyLvXPT6iL51zjKtCY9db5oXe2KPMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .swal2-actions {
            display: none;
        }
        .cropper-container {
            position: relative;
            width: 100%;
            height: auto;
            margin: 20px auto;
        }

        /* Style for the crop box */
        .cropper-crop {
            display: block;
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            top: 0;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px dashed rgba(255, 255, 255, 0.8);
            outline: 1px solid rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
</body>

</html>
<script>
        // Initiate cropper on image container
        const image = document.getElementById('avatar-preview');
        const cropper = new Cropper(image, {
            aspectRatio: 1, // Ratio 1:1 for square avatar
            viewMode: 1, // Restrict to the container
            crop: function(e) {
                // Output the result data for cropping image.
                console.log(e.detail.x);
                console.log(e.detail.y);
                console.log(e.detail.width);
                console.log(e.detail.height);
                console.log(e.detail.rotate);
                console.log(e.detail.scaleX);
                console.log(e.detail.scaleY);
            },
        });

        // Listen to file input change event
        document.getElementById('avatar-input').addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    image.src = e.target.result;

                    // Check if the image size exceeds the limit
                    if (file.size > 1000000) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Kích thước ảnh vượt quá giới hạn (1MB). Vui lòng chọn ảnh khác.',
                        });
                        cropper.replace('');
                    } else {
                        // Set the cropper with the loaded image
                        cropper.replace(e.target.result);
                    }
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
<?php



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["avatar"])) {
    $avatar = $_FILES["avatar"];

    // Kiểm tra xem có lỗi xảy ra trong quá trình tải lên không
    if ($avatar["error"] > 0) {
        echo "Lỗi tải lên ảnh: " . $avatar["error"];
    } else {
        $uploadDir = "IMG/";
        $uploadPath = $uploadDir . basename($avatar["name"]);

        // Di chuyển tệp ảnh vào thư mục lưu trữ
        if ($avatar["tmp_name"]) {
            // Lưu đường dẫn tệp ảnh avatar vào cơ sở dữ liệu
            @move_uploaded_file($avatar["tmp_name"], $uploadPath);
            $avatar_n = $avatar["name"];
            // $data_n = date("y-m-d h:i:s");
            // $timestamp = strtotime($data_n);
            // 1231312312.jpg 
            $query = "UPDATE nguoidung
            SET avatar = '$avatar_n'
            WHERE ma_nguoidung = '$user_id'";
            mysqli_query($conn, $query);

            $_SESSION['thongbao'] = "Tải lên ảnh avatar thành công!";
            echo "<script>
        Swal.fire({
            title: 'Đổi ảnh avatar thành công!',
            text: '',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            timer: 1400,
            
        });
    </script>";
        } else {
            $_SESSION['thongbao'] = "Lỗi tải lên ảnh avatar.";
            echo "<script>
            Swal.fire({
                title: 'Đổi ảnh avatar thất bại!',
                text: '',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                timer: 1400,
                
            });
        </script>";
        }
    }
}

?>

