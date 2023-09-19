<?php

if (isset($_POST['submit'])) {
    $ROOT = $_SERVER["DOCUMENT_ROOT"];
    require_once $ROOT . '/pos/vendor/autoload.php';
    require_once $ROOT . '/pos/app/user/User.php';
    require_once $ROOT . '/pos/login/utils.php';
    
    $user = new User();
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (!isset($username) || !isset($password)) {
        $error_message = "Fill all the fields";
    }
    
    try {
        $check = $user->checkForPassword($username, $password);
    } catch (Exception $e) {
        $error_message = "Login failed! wrong login or password";
    }
    
    if ($check) {
        session_config($username, $password);
        header('Location: /pos/dashboard-css.php');
    } else {
        $error_message = "Login failed! wrong login or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS | Login</title>

    <link rel="stylesheet" href="sccs/styles.css">
    <link rel="stylesheet" href="sccs/common.css">
    <link rel="stylesheet" href="sccs/login.css">

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>

    <!-- signin box -->
    <div class="login__box" id="login__box">
        <div class="header">
            <img src="images/EmtyazLogo.png" alt="">
        </div>
        <form action="index.php" method="post">
            <?php if (!empty($error_message)) { ?>
                <div class="login__message" id="login__message">
                    Failed! Wrong User id or password
                </div>
            <?php } ?>
            <div class="form__group">
                <div class="form__control">
                    <input type="text" name="username" id="username">
                </div>
                <div class="form__control">
                    <input type="password" name="password" id="password">
                </div>
            </div>
            <div class="form__group">
                <div class="form__control">
                    <button type="submit" name="submit" class="btn">Login</button>
                </div>
            </div>
        </form>

        <!-- footer -->
        <div class="footer">
            <div>&copy;2023 EMTYAZ iTECH SYSTEMS&trade;</div>
            <div>ALL Rights Reserved</div>
            <div>Version 3.0</div>
        </div>
        <!--footer -->

    </div>
    <!-- signin box -->

    <script src="js/script.js"></script>
</body>

</html>