<?php
session_start();
$web = $_POST['web']??null;
$action=$_GET['action']??null;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$db = new PDO('mysql:host=localhost;dbname=drawer','root','');

if($web == 1){
    $email = $_POST['email']??null;
    $username = $_POST['username']??null;
    $password = $_POST['password']??null;

    $email_template = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/';
    $pass_template = '/^(?=.*[A-Z])(?=.*\d)\w{6,30}$/';

    $stmt = $db->query("SELECT * FROM drawer.user WHERE username='{$username}'");
    $data = $stmt->fetchAll();

    foreach($data as $d){
        $user = $d['user'];
    }

    $error=0;

    if($email==null||$username==null||$password==null){
        $error=1;
    }
    else if(!preg_match($email_template,$email)){
        $error=2;
    }
    else if(strlen($password)<6){
        $error=3;
    }
    else if(!preg_match($pass_template,$password)){
        $error=4;
    }
    else if(strlen($username)<4){
        $error=5;
    }
    else if($username == $user){
        $error=6;
    }
    else{
    $hashpass = password_hash($password, PASSWORD_DEFAULT);

    $Time = strtotime('+10 minutes');
    $date = date('Y-m-d H:i:s', $Time);
    $code = str_shuffle("qwertyuiopasdfghjklzxcvbnm1234567890");

    $mail = new PHPMailer();
    
    $mail->SMTPDebug = 0;                               // Enable verbose debug output
    
    $mail->CharSet = 'UTF-8';
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->IsSMTP();
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'kielcenamasie@gmail.com';                 // SMTP username
    $mail->Password = 'taujqfazzcfnzfod';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('drawer@gmail.com');
    $mail->addReplyTo('drawer@gmail.com');
    $mail->addAddress($email);               // Name is optional
    
    $mail->isHTML(true);                                  // Set email format to HTML
    
    $mail->Subject = 'Aktywacja konta o emailu: '.$email;
    $mail->Body    = 'localhost/Drawer/login.php?code='.$code;

    $mail->send();

    $db->query("INSERT INTO drawer.user VALUE(NULL, '{$email}', '{$username}', '{$hashpass}', '{$code}', '{$date}', 0)");
    }
    header('Location:register.php?error='.$error);
}
else if($web == 2){
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    $stmt = $db->query("SELECT * FROM drawer.user WHERE username='{$username}'");
    $data = $stmt->fetchAll();

    foreach($data as $d){
        $id = $d['id'];
        $passTotest = $d['password'];
        $date = $d['activation_time'];
        $code = $d['activation_code'];
        $active = $d['active'];
    }
    $date_now = date('Y-m-d H:i:s');

    if(password_verify($password,$passTotest)){
        if($_SESSION['code'] !== null){
            if($date_now<=$date && $code == $_SESSION['code']){
                $stmt = $db->query("UPDATE drawer.user SET active = 1 WHERE id = '{$id}'");
                session_unset($_SESSION['code']);
                $_SESSION['user'] = $username;
                header('Location:index.php');
            }
        }
        else if($active == 1){
            $_SESSION['user'] = $username;
            header('Location:index.php');
        }
    }
    else{
        header('Location:login.php?error=1');
    }
}
else if($web == 3){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user = $_SESSION['user'];
    $template = '(([A-Z])|([a-z])|([0-9]))';

    if((preg_match($template,$title))&&(preg_match($template,$title))){

        $stmt = $db->query("SELECT id FROM drawer.user WHERE username='{$user}'");
        $data = $stmt->fetchAll();
        
        foreach($data as $d){
            $id = $d['id'];
        }
        $stmt = $db->query("INSERT INTO drawer.to_do VALUES (NULL, '{$title}', '{$description}', 1, '{$id}')");
        
        header('Location:index.php');
    }
    else{
        header('Location:add_drawer.php?error=1');

    }
}
else if($action!==null){
    $id = $_GET['id'];

    $stmt = $db->query("UPDATE drawer.to_do SET active='{$action}' WHERE id=$id");
    header('Location:index.php');
}
?>