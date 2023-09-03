<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/admin/Admin.php';
require_once $ROOT . '/app/admin/AdminService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$adminService = new AdminService();
$adminService->update($_GET['id'], $_POST['fname'], $_POST['lname']);
echo ("update Successfull");

?>