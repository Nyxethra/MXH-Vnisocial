<!DOCTYPE html>
<html>
<head>
  <title>Example Page</title>
  <script>
    function gohome(personalPageURL, homePageURL) {
      var foundPersonalPage = false;
      var foundHomePage = false;

      for (var i = window.history.length - 1; i >= 0; i--) {
        if (window.history[i] !== undefined) {
          var url = window.history[i].toString();

          if (url.includes(personalPageURL)) {
            foundPersonalPage = true;
            window.location.href = url;
            break;
          } else if (url.includes(homePageURL)) {
            foundHomePage = true;
            window.location.href = url;
            break;
          }
        }
      }

      if (!foundPersonalPage && !foundHomePage) {
        console.log("Trang không tìm thấy trong lịch sử duyệt web");
      }
    }
  </script>
</head>
<body>
  <button onclick="gohome('https://www.google.com/chrome', 'https://www.youtube.com')">Trở về</button>

  <h1>Example Page</h1>
  <p>This is an example page.</p>
</body>
</html>