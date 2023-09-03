<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/admin/AdminService.php";

$token = $_GET['token'];
$email = $_GET['email'];

$adminService = new AdminService();
$adminService->verify($email, $token);
echo ("sucessfully verified");