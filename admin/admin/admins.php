<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/admin/Admin.php';
require_once $ROOT . '/app/admin/AdminService.php';
require_once $ROOT . '/app/city/City.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$adminService = new AdminService();
$admins = $adminService->getAdmins();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins</title>
</head>

<body>
<button onclick="document.location = '/admin/admin/addAdmin.php'">Add Admin</button>
    <div class="admins">

        <?php foreach ($admins as $admin) { ?>
            <div class="admin">
                <div class="id"><?php echo "id: ". $admin->getId(); ?></div>
                <div class="fname"><?php echo "fname: ". $admin->getFname(); ?></div>
                <div class="lname"><?php echo "lname: ". $admin->getLname(); ?></div>
                <div class="email"><?php echo "email: ". $admin->getEmail(); ?></div>
                <div class="username"><?php echo "username: ". $admin->getUsername(); ?></div>
                <div class="password"><?php echo "password: ". $admin->getPassword(); ?></div>
                <div class="token"><?php echo "token: ". $admin->getToken(); ?></div>
                <div class="unique_id"><?php echo "unique_id: ". $admin->getUniqueId(); ?></div>
                <div class="no_attempts"><?php echo "no attempts: ". $admin->getNoAttempts(); ?></div>
                <div class="created_date"><?php echo "created at: ". $admin->getCreatedDate(); ?></div>
                <div class="last_login"><?php echo "last login: ". $admin->getLastLogin(); ?></div>
                <div class="is_verified"><?php echo "is verified: ". $admin->getIsVerified(); ?></div>
                <button onclick="document.location = '/admin/admin/deleteAdmin.php?id=<?php echo $admin->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/admin/updateAdmin.php?id=<?php echo $admin->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>