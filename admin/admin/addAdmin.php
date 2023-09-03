<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>

    <link rel="stylesheet" href="/scss/style.css">
    <link rel="stylesheet" href="/scss/form.css">
    <link rel="stylesheet" href="/scss/login.css">
</head>

<body>
    <div class="form__box">
        <form action="addAdminProcess.php" method="post">
            <div class="form__group">
                <div class="form__control">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" id="email">
                </div>
            </div>
            <div class="form__group">
                <div class="form__control">
                    <label for="secret">Enter secret</label>
                    <input type="password" name="secret" placeholder="Secret" id="secret">
                </div>
            </div>
            <div class="form__group">
                <div class="form__control">
                    <button type="submit" class="btn btn__primary">Add Admin</button>
                </div>
            </div>

        </form>
    </div>

</body>

</html>