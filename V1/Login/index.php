<?php
require 'config.php';
$conn = connection();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="validade.php" method="post">
        <label for="">Login: </label><br>
        <input type="email" name="email" placeholder="E-Mail: "><br><br>

        <label for="password">Senha: </label><br>
        <input type="password" name="password" placeholder="Senha: "><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>

</html>