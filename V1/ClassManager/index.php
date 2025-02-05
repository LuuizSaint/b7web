<?php
require 'User.php';

$user = new Usuario(2);
echo $user->getName();

$user->delete();
?>