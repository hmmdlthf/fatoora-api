<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS | Login</title>

    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
</head>

<body>
    <div class="container-fluid vh-100 d-flex justify-content-center">

        <div class="row align-content-center p-3" style="max-width: 350px;">

            <!-- signin box -->
            <div class="col-12" id="login__box">
                <div class="row g-2 mb-5">
                    <div class="col-12">
                        <h1 class="title">Login</h1>
                    </div>
                    <div class="col-12 d-none" id="login__message">
                        <div class="alert alert-danger" role="alert" id="msg">
                
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" placeholder="ex:Jhon@gmail.com" id="email" />
                    </div>
                    <div class="col-12">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" placeholder="***********" id="password" />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100" onclick="Login();">login</button>
                    </div>
                </div>

                <!-- footer -->
                <div class="row">
                    <div class="col-12 text-center">
                        <div>&copy;2023 EMTYAZ iTECH SYSTEMS&trade;</div>
                        <div>ALL Rights Reserved</div>
                        <div>Version 3.0</div>
                    </div>
                </div>
                <!--footer -->

            </div>
            <!-- signin box -->
        </div>
    </div>




    <script src="js/script.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>