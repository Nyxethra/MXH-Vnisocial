<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Base styles */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif; /* Similar to Facebook's font */
    }

    .navbar {
      height: 50px;
      background-color: #a72f2f; /* Facebook blue */
      display: flex;
      align-items: center;
      padding: 0 20px;
    }

    .navbar-logo {
  flex-basis: 200px; /* Set a fixed width */
}
   

    .navbar-search input {
      background-color: #f0f2f5;
      border: none;
      border-radius: 20px;
      padding: 5px 10px;
      width: 300px;
      height: 30px;
      font-size: 14px;
      color: #000; /* Black text */
    }

    .navbar-icons {
      display: flex;
      gap: 20px; margin-right: 40px; margin-left: 50px;
    }

    .navbar-icons i {
      color: white;
      font-size: 24px;
    }

    .navbar-links {
      display: flex;
      align-items: center;
      margin-left: auto; /* Align links to the right */
    }

    .navbar-links a {
      color: white;
      margin: 0 10px;
      text-decoration: none;
      font-size: 14px;
    }

    .navbar-links a:hover {
      text-decoration: underline;
    }

    .navbar-search {
  margin-left: 10px; /* Adjust the value for desired distance */
}
  
  </style>
</head>
<body>
  <div class="navbar">
    <div class="navbar-logo">
      <img src="logo.png" alt="Vnisocial Logo">
    </div>
    <div class="navbar-search">
      <input type="text" placeholder="Search Vnisocial">
    </div>
    <div class="navbar-links">
      <a class="abc" href="#">Trang chủ</a>
      <a class="abc "href="#">Trang cá nhân</a>
    </div>
    <div class="navbar-icons">
      <i class="fab fa-facebook-messenger"></i>
      <i class="far fa-bell"></i>
    </div>
  </div>

  </body>
</html>
