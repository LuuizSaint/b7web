<?php
require "config.php";
$conn = connection();
$msg = "";
if (empty($_SESSION)) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $resValidate = validate($_POST);
    $resValidate ? true : $msg = "Preencha todos os campos!";
    $resPass = passConfirm($_POST);
    $resPass ? true : $msg = "As senhas não coincidem";
    if ($resValidate === true && $resPass === true) {
        $resCreate = create($_POST, $conn);
        if ($resCreate) {
            header("Location: dash.php");
            exit;
        }
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
    <form action="#" method="post" autocomplete="off">
        <label for="userName">Nome ou Apelido:</label><br>
        <input type="text" name="userName" placeholder="Seu nome ou apelido: "><br><br>
        <label for="email">E-Mail:</label><br>
        <input type="email" name="email" placeholder="Seu e-mail: " autocomplete="off"><br><br>
        <label for="pass">Senha:</label><br>
        <input type="password" name="pass" placeholder="Sua senha: " autocomplete="off"><br><br>
        <label for="pass2">Confirmar Senha:</label><br>
        <input type="password" name="pass2" placeholder="Confirmar sua senha: " autocomplete="off"><br><br>
        <p><?= $msg; ?></p>
        <input type="submit" value="Cadastrar"><br><br>
    </form>
    <a href="index.php">Sair</a>
</body>

</html>