

<!DOCTYPE html>
<html>
<head>
<title>ADMIN | VNISOCIAL</title>
</head>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #fbf6e4;
      font-family: "Roboto", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;      
    }
    .formngoai {
       img {
        width: 100px; /* Điều chỉnh kích thước hình ảnh */
        height: 100px;
      }
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 300px;
      padding: 30px;
      background: red;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
      border-radius:2%;
    }
    .formInput, button {
      width: 100%;
      padding: 15px;
      margin-bottom: 15px;
      box-sizing: border-box;
      font-size: 14px;
      font-family: 'Roboto', sans-serif;
      outline: 0;
      border: 0;
    }
    .formInput {
      background: #f2f2f2;
    }
    button {
      color: #FFFFFF;
      background: #c91212;
      text-transform: uppercase;
      cursor: pointer;
      transition: all 0.3 ease;
    }
    button:hover, button:active, button:focus {
      background: dimgray;
    }
    a {
      color: black;
      text-decoration: none;
    }
  </style>
</head>
<body> 
  <div class="formngoai">
    <img src="../IMG/logo.png">
    <form action="loginadmin.php" method="post">
      <input type="text" placeholder="Email" class="formInput" name="email"/>
      <input type="password" placeholder="Mật khẩu" class="formInput" name="matkhau"/>
      <button>Đăng nhập</button>
      <hr width="100%" />
    </form>
  </div>
</body>
</html>
