<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location:index.php');
}
$error = $_GET['error']??null;
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
            <a href="" class="nav-item nav-item-active"><i class="fa-solid fa-box-archive"></i> Add drawer</a>
            <a href="login.php" class="nav-item"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
        </div>
    </nav>
    <div class="form">
        <form action="config.php" method="post">
            <div class="logo">
                <i class="fa-solid fa-box-archive"></i>
                <?php if($error == 1): ?>
                <p class="error">Title and description cannot be empty</p>
                <?php else: ?>
                <p>Welcome to DRAWER</p>
                <?php endif; ?>
            </div>
            <div class="div-input">
                <input type="text" name="title" placeholder="Title" >
            </div>
            <br>
            <div class="div-textarea">
                <textarea name="description" id="" cols="30" rows="10" placeholder="  Description"></textarea>
            </div>
            <br>
            <button name="web" value="3" type="submit">Add</button>
        </form>
    </div>

</body>
</html>