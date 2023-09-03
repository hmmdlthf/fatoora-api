<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/teacher/TeacherService.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $rememberMe = test_input($_POST['remember_me']);

    echo $username . "<br>";
    echo $password . "<br>";
    echo $rememberMe . "<br>";

    $teacherService = new TeacherService();
    $teacherService->verifyPassword($username, $password);
    echo ("success");
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars('authenticate2.php');?>" method="post">
        <input type="text" name="username" placeholder="username" id="">
        <input type="password" name="password" placeholder="password" id="">
        <label for="remember_me">Remember Me</label>
        <input type="checkbox" name="remember_me" id="remember_me">
        <button type="submit">Login</button>
    </form>
    
</body>
</html>