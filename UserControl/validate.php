<?php
require "config.php";
$conn = connection();
$userInfo = $_POST;

function validate($userInfo, $conn)
{
    foreach ($userInfo as $info) {
        if (strlen($info) == 0) {
            echo "Campo vazio!";
            return false;
        }
    }

    $createResult = create($userInfo, 'users', $conn);
    if ($createResult >= 1) {
        return true;
    } else {
        return false;
    }
}

$validateResult = validate($userInfo, $conn);
if ($validateResult) {
    header('location: index.php');
} else {
    header('location: create.php');
}
