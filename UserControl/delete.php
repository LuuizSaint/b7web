<?php
require "config.php";
$conn = connection();
$userId = $_GET['id'];

$deleteResult = delete($userId, 'users', $conn);

if ($deleteResult >= 1) {
    header('location: index.php');
}
