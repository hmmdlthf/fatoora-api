<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/utils/encrypt.php';

function session_check()
{
    session_start();
    if (isset($_SESSION['username'])) {
        if (time() - $_SESSION['login_time_stamp'] > (60 * 60)) {
            session_unset();
            session_destroy();
            header("Location: /dashboard-css.php");
        }
    } else {
        header("location: /index.php");
    }
}

function session_config($username, $password)
{
    session_start();
    $_SESSION['username'] = $username;

    $encrypt = new Encrytp();
    $password_encrypted = $encrypt->encrypt_string($password);
    $_SESSION['password'] = $password_encrypted;

    $_SESSION['login_time_stamp'] = time();
}

function session_get()
{
    session_start();
    $username = $_SESSION['username'];
    $encypt = new Encrytp();
    $d_password = $encypt->decrypt_string($_SESSION['password']);
    return ["username" => $username, "password" => $d_password];
}
