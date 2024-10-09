<?php
require "config.php";
$conn = connection();

$userInfo = $_POST;
$updateResult = update($userInfo, 'users', $conn);

if ($updateResult >= 1) {
    header('location: index.php');
}
