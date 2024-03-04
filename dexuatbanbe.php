<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> <!-- Semantic UI yêu cầu jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            min-height: 100vh;
            margin: 0;
        }

        .ui.card {
            width: 300px; /* Điều chỉnh chiều rộng của thẻ card theo mong muốn */
            margin-top: auto; /* Đặt margin-top: auto để đẩy thẻ xuống phía dưới */
        }
    </style>
</head>
<body>
    <div class="ui card">
        <div class="image">
            <img src="pic.jpg" alt="User Image">
        </div>
        <div class="content">
            <div class="header">Nguyễn Hải Đăng</div>
            <div class="description">
                3 bạn chung
            </div>
        </div>
        <div class="ui two bottom attached buttons">
            <div class="ui button">
                <i class="add icon"></i>
                Kết Bạn
            </div>
            
        </div>
    </div>
    <div class="ui popup">
        <div class="header">User Rating</div>
        <div class="ui star rating" data-rating="3"></div>
    </div>
</body>
</html>
