<style>
body {
  background: lightgray;
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
button {
  font-family: 'Roboto', sans-serif;
  text-transform: uppercase;
  outline: 0;
      background: #c91212;
      width: 100%;
      border: 0;
      padding: 15px;
      color: #FFFFFF;
      font-size: 14px;
      -webkit-transition: all 0.3 ease;
      transition: all 0.3 ease;
      cursor: pointer;
}
button:hover,button:active,button:focus {
  background: dimgray
}
.formngoai {
  width: 360px;
  padding: 4% 0 0;
  margin: auto;
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  border-radius:2%;
}
.formInput {
  font-family: 'Roboto', sans-serif;
      outline: 0;
      background: #f2f2f2;
      width: 100%;
      border: 0;
      margin: 0 0 15px;
      padding: 15px;
      box-sizing: border-box;
      font-size: 14px;
}
a {
  color: black;
  text-decoration: none;
}
</style>
<div style="margin-top:7%">
<h1 style="text-align:center;"> Vnisocial </h1>
<div class="formngoai">
  <form action="loginadmin.php" method="post">
    <input type="text" placeholder="Email" class="formInput" name="email"/>
    <input type="password" placeholder="Mật khẩu" class="formInput" name="matkhau"/>
    <button>Đăng nhập</button>
    <hr  width="100%"  />
  </form>
</div>
