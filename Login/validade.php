<?php
require 'config.php';
session_start();
if (empty($_SESSION['id'])) {
    header('Location: index.php');
}

$validateResult = validate($_POST);

if ($validateResult) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $resulLogin = login($email, $pass, 'users');

    if ($resulLogin) {
        $_SESSION['id'] = $resulLogin->id;
        header('Location: dash.php');
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
