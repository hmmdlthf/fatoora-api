<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';

session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Academy | Admin Login</title>
    <?php require $ROOT . '/head/head.php' ?>

    <link rel="stylesheet" href="/scss/login.css">

</head>

<body>
    <div class="form__box">
        <div class="form__header">
            <div class="header__logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                </svg>
                <div class="logo__text">
                    <div class="line">
                        Online
                    </div>
                    <div class="line">
                        Academy
                    </div>
                </div>
                <div class="sub__text">Admin</div>
            </div>
        </div>
        <form action="<?php echo htmlspecialchars('authenticate.php'); ?>" method="post">
            <div class="form__group">
                <div class="form__control">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="username" id="username">
                </div>

            </div>
            <div class="form__group">
                <div class="form__control">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="password" id="password">
                </div>
            </div>

            <div class="form__group">
                <div class="form__control row">
                    <input type="checkbox" name="remember_me" id="remember_me">
                    <label for="remember_me">Remember Me</label>
                </div>
            </div>
            <div class="form__group">
                <div class="form__control">
                    <button type="submit" class="btn btn__primary">Login</button>
                </div>
            </div>
        </form>

    </div>

</body>

</html>