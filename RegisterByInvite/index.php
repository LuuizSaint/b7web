<?php
require 'config.php';
$conn = connection();
session_start();
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $resValidate = validate($_POST);
    if ($resValidate === true) {
        $resLogin = login($_POST, $conn);
        if ($resLogin) {
            header("Location: dash.php");
            exit;
        } else {
            $msg = "E-mail ou senha inválidos!";
        }
    } else {
        $msg = "Preencha todos os campos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="#" method="post">
        <label for="email">E-Mail:</label><br>
        <input type="email" name="email" placeholder="Seu e-mail: "><br><br>

        <label for="pass">Senha: </label><br>
        <input type="password" name="pass" placeholder="Sua senha: "><br><br>

        <p><?= $msg; ?></p>

        <input type="submit" value="Entrar"><br><br>
    </form>
    <a href="create.php">Cadastrar-se</a>
</body>

</html>