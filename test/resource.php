<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';

$jwt = $_COOKIE['jwt'];
echo ("$jwt <br>");

if (!$jwt) {
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
JWT::$leeway += 60;
$token = JWT::decode((string)$jwt, new Key($secretKey, 'HS512'));
$now = new DateTimeImmutable();
$serverName = "localhost:3000";

if ($token->iss !== $serverName || // check if the server name is the sever name we gave when created the jwt - opposite true
    $token->nbf > $now->getTimestamp() || // check if the 'nbf'(nob before) is > than the current time - opposite true
    $token->exp < $now->getTimestamp()) // check if the 'exp'(expire) is < than current time - opposite true
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

// The token is valid, so send the response back to the user
echo ("token valid <br>");
echo ("protected data <br>");
