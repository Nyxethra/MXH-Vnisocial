<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="text_style.css">
</head>
<body>
<?php
    include("text1.php");
    // if(($_SERVER)['REQUEST_METHOD']=='POST')
    // {
    //     $signup = new Signup();
    //     $result= $signup -> evaluate($_POST);

    //     if($result != ""){
    //     //     //co the dung 
    //     //     echo "<div style='text-align:center; font-size:12px; color:white;background-color:grey'>";
    //     //     echo " <br>Nhung thong tin con thieu <br><br>";
    //     //     echo $result;
    //     //     echo "</div>";
    //     }
    //     else
    //     {
    //         header("Location:login.php");
    //     }
    
    // }
?>
<h2>Sign in/up Form</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="Post " action="">
                <h1>Create Account</h1>
                <span>or use your email for registration</span>
                <input type="text" name="ten_nguoidung" placeholder="Name" />
                <input type="email"name="email" placeholder="Email" />
                <input type="password" name="matkhau" placeholder="Password" />
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#">
                <h1>Sign in</h1>

                <span>or use your account</span>
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />

                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
    </script>