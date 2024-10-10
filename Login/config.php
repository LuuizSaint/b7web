<?php

function connection()
{
    $dns = "mysql:host=localhost;dbname=lr_clientes;";
    $dbUser = "root";
    $dbPass = "";

    try {
        $pdo = new PDO($dns, $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo;
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}

function All($table)
{
    $conn = connection();

    $sql = "SELECT * FROM $table";
    $sql = $conn->query($sql);
    return $sql->fetch();
}

function find($field, $value, $table)
{
    $conn = connection();

    $sql = "SELECT * FROM $table WHERE $field = ?";
    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $value
    ]);

    if ($stmt->rowCount() >= 1) {
        return $stmt->fetch();
    } else {
        return false;
    }
}

function create($infoUser, $table)
{
    $conn = connection();

    $sql = "INSERT INTO $table(userName, email, password) VALUES(?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $infoUser['userName'],
        $infoUser['email'],
        md5($infoUser['password'])

    ]);

    if ($stmt->rowCount() >= 1) {
        return true;
    } else {
        return false;
    }
}

function update($userId, $infoUser, $table)
{
    $conn = connection();

    $sql = "UPDATE $table SET userName = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $infoUser['userName'],
        $infoUser['email'],
        $userId
    ]);

    if ($stmt->rowCount() >= 1) {
        return true;
    } else {
        return false;
    }
}

function delete($userId, $table)
{
    $conn = connection();

    $sql = "DELETE FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $userId
    ]);

    if ($stmt->rowCount() == 1) {
        return true;
    } else {
        return false;
    }
}

function validate($infoFields)
{
    foreach ($infoFields as $field) {
        if (strlen($field) <= 0) {
            return false;
        }
    }

    return true;
}

function login($email, $pass, $table)
{
    $conn = connection();

    $sql = "SELECT * FROM $table WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $email,
        md5($pass)
    ]);

    if ($stmt->rowCount() == 1) {
        return $stmt->fetch();
    } else {
        return false;
    }
}
