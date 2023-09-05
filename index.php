<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS | Login</title>

    <link rel="stylesheet" href="/sccs/styles.css">
    <link rel="stylesheet" href="/sccs/common.css">
    <link rel="stylesheet" href="/sccs/login.css">

    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
</head>

<body>

    <!-- signin box -->
    <div class="login__box" id="login__box">
        <div class="header">
            <div>شركة امتياز لخدمات التموين</div>
            <div>emtyaz for catering company</div>
            <div>رقم ضريبة القيمة المضافة</div>
        </div>
        <form action="login/loginProcess.php" method="post">
            <div class="login__message d-none" id="login__message">
                Failed! Wrong User id or password
            </div>
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
                    <button type="submit" class="btn">Login</button>
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