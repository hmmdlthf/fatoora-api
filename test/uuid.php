<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/user/User.php';

$user = new User();
$token = $user->generateToken();
$username = $user->generateUsername("testuser@gmail.com");
$uniqueId = $user->generateUniqueId();
$password = $user->generatePassword();



?>