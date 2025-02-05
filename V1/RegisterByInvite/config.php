<?php
function connection()
{
    $dns = "mysql:dbname=lr_clientes;host=localhost;";
    $dbUser = "root";
    $dbPass = "";
    try {
        $pdo = new PDO($dns, $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}
function create($infoUser, $conn, $table = 'users')
{
    $userName = $infoUser['userName'];
    $userEmail = $infoUser['email'];
    $userPass = md5($infoUser['pass']);
    $sql = "INSERT INTO $table(userName, email, password) VALUES(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $userName,
        $userEmail,
        $userPass
    ]);
    $_SESSION['id'] = $conn->lastInsertId();
    if ($stmt->rowCount() == 1) {

        return true;
    }
    return false;
}
function login($values, $conn, $table = 'users')
{
    $sql = "SELECT * FROM $table WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $values['email'],
        md5($values['pass'],)
    ]);
    if ($stmt->rowCount() == 1) {
        $infoUser = $stmt->fetch();
        $_SESSION['id'] = $infoUser->id;
        return true;
    }
    return false;
}
function info($id, $conn, $table = 'users')
{
    $sql = "SELECT * FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    if ($stmt->rowCount() == 1) {
        return $stmt->fetch();
    }
    return false;
}
function validate($arr)
{
    foreach ($arr as $i) {
        if (strlen($i) == 0) {
            return false;
        }
    }
    return true;
}
function passConfirm($arr)
{
    if ($arr['pass'] === $arr['pass2']) {
        return true;
    }
    return false;
}
