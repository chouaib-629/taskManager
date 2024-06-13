<?php
    // session_start();
    require_once 'includes/signup_func.inc.php'; // i can pass only the view functions
    require_once 'includes/login_func.inc.php'; // i can pass only the view functions
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login_style.css">
    <title>Task Manager | Authentfication</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="includes/signup.inc.php" method="post">
                <h1>Create Account</h1>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="pwd" placeholder="Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <button>Sign Up</button>
            </form>
            <?php
                check_signup_errors();
            ?>
        </div>

        <div class="form-container sign-in"> 
            <form action="includes/login.inc.php" method="post">
                <h1>Sign In</h1>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="pwd" placeholder="Password" required>
                <!-- TODO: add function for forgeted password -->
                <a href="">Forget your password?</a> 
                <button>Login</button>
            </form>
            <?php
                check_login_errors();
            ?> 
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personnel details to use all of site features</p>
                    <button class='hidden' id="login">Sign In</button>
                </div>
                
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personnel details to use all of site features</p>
                    <button class='hidden' id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>