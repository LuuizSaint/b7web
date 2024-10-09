<?php
require "config.php";
$conn = connection();

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $infoResult = userInfo($userId, 'users', $conn);
} else {
    header('location: index.php');
}
?>

<form action="update.php" method="post" autocomplete="none">
    <input type="hidden" name="id" value="<?= $userId; ?>">

    <label for="userName">Nome: </label><br>
    <input type="text" name="userName" value="<?= $infoResult->userName; ?>"><br><br>

    <label for="email">E-mail: </label><br>
    <input type="email" name="email" value="<?= $infoResult->email; ?>"><br><br>

    <input type="submit" value="Atualizar">

</form>