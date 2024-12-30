<?php
session_start();

if (isset($_SESSION['error_message'])) {
    echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
    unset($_SESSION['error_message']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <header>
        <nav>
            <div class="container">
                <div class="company-logo">
                    <h1>Alpha Gym</h1>
                </div>
                <div class="menu-item">
                    <li><a href="register_akun.php">Register</a></li>
                    <li><a href="index.html">Home</a></li>
                </div>
            </div>
        </nav>
    </header>

    <h1>ALPHA GYM LOGIN</h1>
    <section class="banner-container" id="home">
        <div class="logo"></div>
        <div class="login-block">
            <h1>Login</h1>
            <?php if (isset($error) && $error): ?>
                <p style="color: red;">Login failed. Please check your username and password.</p>
            <?php endif; ?>
           
            <form action="validasi_login.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Submit</button>
            </form>
            <li><a href="register_akun.php">Don't have an account? Register Now</a></li>
        </div>
    </section>

  

</body>

</html>
