<?php
function connection()
{
    $dns = "mysql:dbname=lr_clientes;host=localhost";
    $dbUser = "root";
    $dbPass = "";
    try {
        $pdo = new PDO($dns, $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    } catch (PDOException $e) {
        return "ERROR: " . $e->getMessage();
    }
}

function all($table, $conn)
{
    $sql = "SELECT * FROM $table";
    $sql = $conn->query($sql);
    return $sql;
}

function create($userInfo, $table, $conn)
{
    $sql = "INSERT INTO $table(userName, email, password) VALUES(?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $userInfo['userName'],
        $userInfo['email'],
        md5($userInfo['password'])
    ]);

    return $stmt->rowCount();
}

function delete($userId, $table, $conn)
{
    $sql = "DELETE FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->execute([$userId]);

    return $stmt->rowCount();
}


function userInfo($userId, $table, $conn)
{
    $sql = "SELECT * FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);

    return $stmt->fetch();
}

function update($userInfo, $table, $conn)
{
    $sql = "UPDATE $table SET userName = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $userInfo['userName'],
        $userInfo['email'],
        (int)$userInfo['id']
    ]);

    return $stmt->rowCount();
}
