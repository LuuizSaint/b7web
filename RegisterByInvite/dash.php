<?php
require "config.php";
$conn = connection();
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: create.php");
    exit;
}
$infoUser = info($_SESSION['id'], $conn);
if ($infoUser === false) {
    $msg = "Ocorreu um erros inesperado!";
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
    <h1>Bem Vindo a Área Restrita!</h1>
    <h2>DASHBOARD</h2>
    <hr>
    <h2>Nome/Apelido: <?= $infoUser->userName; ?></h2>
    <h2>E-Mail: <?= $infoUser->email; ?> </h2>
    <hr>
    <a href="logout.php">Sair da Conta</a>
</body>

</html>