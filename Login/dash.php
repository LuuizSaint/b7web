<?php
require 'config.php';
session_start();
if (empty($_SESSION['id'])) {
    header('Location: index.php');
}

$infoUser = find('id', $_SESSION['id'], 'users');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>BEM VINDO AO DASH!</h1>
    <h3><?= $infoUser->userName; ?></h3>
    <h3><?= $infoUser->email; ?></h3>
</body>

</html>