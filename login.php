<?php
session_start();
$code = $_GET['code'] ?? null;
$_SESSION['code'] = $code;

$error = $_GET['error'] ?? null;

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drawer</title>

    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css">

    <script src="https://kit.fontawesome.com/eb8ef8cb9f.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <div class="nav-elements">
            <a href="index.php" class="nav-item"><i class="fa-solid fa-house"></i> Home</a>
            <a href="add_drawer.php" class="nav-item"><i class="fa-solid fa-box-archive"></i> Add drawer</a>
            <a href="" class="nav-item nav-item-active"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
        </div>
    </nav>
    <div class="form">
        <form action="config.php" method="post">
            <div class="logo">
                <i class="fa-solid fa-box-archive"></i>
                <?php if($error == 1){ ?>
                <p class="error">Incorrect login or password</p>
                <?php }else if($code === null){ ?>
                <p>Welcome to DRAWER</p>
                <?php }else{ ?>
                <p class="error">Log in with the previously entered data</p>
                <?php } ?>
            </div>
            <div class="div-input">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" placeholder="Username" >
            </div>
            <br>
            <div class="div-input">
                <i class="fa-solid fa-key"></i>
                <input type="password" name="password" placeholder="Password" >
            </div>
            <br>
            <button name="web" value="2" type="submit">Sign in</button>
            <div class="form-ref">
                <a class="ref-left" href="register.php">Sign up</a>
                <a class="ref-right" href="">Forgot password?</a>
            </div>
        </form>
    </div>

</body>
</html>