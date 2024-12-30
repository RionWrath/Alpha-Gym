<!DOCTYPE html>  
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Registration</title>
    <link rel="stylesheet" href="./css/register.css">
   
</head>

<body>
<header>
        <nav>
            <div class="container">
                <div class="company-logo">
                    <h1>Alpha Gym</h1>
                </div>
                <div class="menu-item">
                    <li><a href="login_user.php">Login</a></li>
                    <li><a href="index.html">Home</a></li>
                </div>
            </div>
        </nav>
    </header>
    <H2>REGISTRATION MEMBERSHIP</H2>

    <!-- Formulir untuk pendaftaran keanggotaan -->
    <form action="simpan_data_user.php" method="post" enctype="multipart/form-data">

        <label for="email">Email:</label>
        <input type="text" name="email" required>
        
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="text" name="password" required>

        <button type="submit">Register</button>
        <a href="login_user.php">Have an Account? Login Now</a>

    </form>

    <!-- Tambahkan elemen atau styling sesuai kebutuhan -->
</body>

</html>


