<?php

$password = 'TestPassword';
$userPassword = hash("sha256", $password);
echo("$userPassword");