<?php
require 'bootstrap.php';
use config\User;
session_start();

function setFlash($key, $message) {
    if(!isset($_SESSION['flash'][$key])) {
        $_SESSION['flash'][$key] = '<div>'.$message.'</div>';
    }
}
function getFlash($key) {
    if(isset($_SESSION['flash'][$key])) {
        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        
        return $message;
    }
    return '';
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $empty = false;
    foreach ($_REQUEST as $key => $value) {
        if(empty($_REQUEST[$key])) {
            $empty = true;
        }
    }

    if($empty) {
        setFlash('emptyFields', 'Preencha todos os campos!');
        header('Location: '. $_SERVER['PHP_SELF']);
        exit();
    }

    $username = $_POST['username'];
    $useremail = $_POST['useremail'];

    $user = new User;
    $sendMail = $user->create($username, $useremail);
    if($sendMail) {
        setFlash('success', 'Verifique seu email!');
        header('Location: '. $_SERVER['PHP_SELF']);
        exit();
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form method="post">
            <?= getFlash('emptyFields'); ?>
            <?= getFlash('success'); ?>
            <?= getFlash('mailError'); ?>
            <input type="text" name="username" id="" placeholder="Seu Nome: " require>
            <input type="email" name="useremail" id="" placeholder="Seu Email: " require>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>