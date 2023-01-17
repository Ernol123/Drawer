<?php
session_start();
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
            <a href="" class="nav-item nav-item-active"><i class="fa-solid fa-house"></i> Home</a>
            <a href="add_drawer.php" class="nav-item"><i class="fa-solid fa-box-archive"></i> Add drawer</a>
            <?php if(!isset($_SESSION['user'])): ?>
            <a href="login.php" class="nav-item"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            <?php else: ?>
            <a href="logout.php" class="nav-item"><i class="fa-solid fa-right-to-bracket"></i> Logout</a>
            <?php endif; ?>

        </div>
    </nav>
    <main>
        <?php if(!isset($_SESSION['user'])): ?>
            <div class="info">
                <p class="error">To add a task or see yours, log in</p>
            </div>
        <?php else: ?>
            <?php
            $db = new PDO('mysql:host=localhost;dbname=drawer','root','');

            $stmt = $db->query("SELECT id FROM drawer.user WHERE username='{$_SESSION['user']}'");
            $data = $stmt->fetchAll();
        
            foreach($data as $d){
                $id = $d['id'];
            }

            $stmt = $db->query("SELECT * FROM drawer.to_do WHERE user_id='{$id}'");
            $data = $stmt->fetchAll();

            foreach($data as $d){
                $id = $d['id'];
                $title = $d['title'];
                $description = $d['description'];
                $active = $d['active'];

                if($active == 1){
                    $class='yellow';
                }
                else if($active == 2){
                    $class='green';
                }
                else if($active == 0){
                    $class='red';
                }

                ?>
                <div class="tasks">
                    <div class="title">
                        <h2 class="<?= $class ?>"><?= $title ?></h2>
                    </div>
                    <div class="description">
                        <p><?= $description ?></p>
                    </div>
                    <div class="buttons">
                        <?php if($active == 1){
                            ?>
                            <div>
                                <a class="cancel" href="config.php?id='<?= $id ?>'&action=0">Cancel</a>
                            </div>
                            <div>
                                <a class="done" href="config.php?id='<?= $id ?>'&action=2">Done</a>
                            </div>
                            <?php
                        }
                        else if($active == 2){
                            ?>
                            <div>
                                <a class="in-progres" href="config.php?id='<?= $id ?>'&action=1">In progres</a>
                            </div>
                            <div>
                                <a class="cancel" href="config.php?id='<?= $id ?>'&action=0">Cancel</a>
                            </div>
                            <?php
                        }
                        else if($active == 0){
                            ?>
                            <div>
                                <a class="in-progres" href="config.php?id='<?= $id ?>'&action=1">In progres</a>
                            </div>
                            <div>
                                <a class="done" href="config.php?id='<?= $id ?>'&action=2">Done</a>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
                
                <?php
            }    
            ?>
        <?php endif; ?>
    </main>
</body>
</html>