<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';

jwt_start(['admin_role']);

// The token is valid, so send the response back to the user
echo ("token valid <br>");
echo ("protected data <br>");
