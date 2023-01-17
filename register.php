<?php
$error=$_GET['error']??null;
if($error!==null){
    if($error == 0){
        $error = "Confirm your email in your mailbox";
    }
    else if($error == 1){
        $error = "Please complete all fields";
    }
    else if($error == 2){
        $error = "Enter a valid email";
    }
    else if($error == 3){
        $error = "The password must be at least 6 characters long";
    }
    else if($error == 4){
        $error = "The password must contain at least one capital letter and one number";
    }
    else if($error == 5){
        $error = "Username must be at least 4 characters long";
    }
    else if($error == 6){
        $error = "There is already a user with the specified username";
    }
}


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
                <?php if($error === null): ?>
                <p>Welcome to DRAWER</p>
                <?php else: ?>
                <p class="error"><?= $error ?></p>
                <?php endif ?>
            </div>
            <div class="div-input">
                <i class="fa-solid fa-at"></i>
                <input type="text" name="email" placeholder="Email" >
            </div>
            <br>
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
            <button name="web" value="1" type="submit">Sign up</button>
            <div class="form-ref">
                <a class="ref-left" href="login.php">Sign in</a>
            </div>
        </form>
    </div>

</body>
</html>