<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/teacher/TeacherService.php";

$token = $_GET['token'];
$email = $_GET['email'];

$teacherService = new TeacherService();
$teacherService->verify($email, $token);
echo ("sucessfully verified");