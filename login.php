<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Us!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="header1">
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="controller/signup_controller.php" method="post" enctype="multipart/form-data">
            <h1>Create Account</h1>
            <div class="social-icons">
                <a href="#" class="icon" onclick="showWarning('Google')"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#" class="icon" onclick="showWarning('Facebook')"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon" onclick="showWarning('GitHub')"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon" onclick="showWarning('LinkedIn')"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span>
            <input type="text" name="username" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="signup">Sign Up</button>
        </form>
        </div>
        <div class="form-container sign-in">
            <form action="controller/signin_controller.php" method="POST">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon" onclick="showWarning('Google')"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon" onclick="showWarning('Facebook')"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon" onclick="showWarning('GitHub')"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon" onclick="showWarning('LinkedIn')"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="#">Forget Your Password?</a>
                <button type="submit" name="Login">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Long time no see!</h1>
                    <p>Enter the arena! Sign in to unleash your gaming potential.</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hola, Gamers!</h1>
                    <p>Enhance your setup! Sign up now to level up.</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('promo').addEventListener('click', function() {
            window.location.href = 'membership.html';
        });
    </script>
    <script src="javascript/login.js"></script>
</body>

</html>
