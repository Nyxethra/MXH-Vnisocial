<!DOCTYPE html>
<html>

<head>
    <title>Bảng pop-up đăng nhập sai</title>
    <style>
        /* CSS cho bảng pop-up */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .popup-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <button onclick="showPopup()">Đăng nhập sai</button>

    <!-- Bảng pop-up -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="hidePopup()">&times;</span>
            <h3>Thông báo</h3>
            <p>Thông tin đăng nhập không chính xác. Vui lòng thử lại.</p>
        </div>
    </div>

    <script>
        // JavaScript để hiển thị và ẩn bảng pop-up
        function showPopup() {
            document.getElementById('popup').style.display = 'block';
        }

        function hidePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</body>

</html>