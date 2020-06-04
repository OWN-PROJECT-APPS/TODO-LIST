<?php
    session_start();
    if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])):
        header('location:todos.php');
        exit();
    endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Todo List For Any User">
    <meta name="author" content="Chliah Younes">
    <meta name="keywords" content="Activites,Todos">
    <link rel="stylesheet" href="/assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="shortcut icon" href="./assets/image/trading-stocks.jpg" type="image/x-icon">
    <title>Welcom In Todo List Logi Page</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-4 position-fixed bg-light shadow-md form-window rounded px-3">
                <h3 class="text-info text-center p-2 m-4 ">Welcome Sir</h3>
                <form action="" method="POST" id="form-login">

                    <div class="form-group m-2">
                        <div class="input-group">
                            <span class="text-primary py-1 px-2 border "><i class="far fa-envelope"></i></span>
                            <input type="text" name="email" id="username" placeholder="Your Email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group m-2">
                        <div class="input-group">
                            <span class="text-danger py-1 px-2 border"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" id="password" placeholder="Your Password"
                                class="form-control">

                        </div>

                    </div>
                    <div class="form-group m-2 mt-4">
                        <div class="input-group">

                            <input type="submit" name="login" id="send-button"
                                class="form-control bg-primary text-white" value="Login">

                        </div>

                    </div>
                    <a href="#" class="text-primary float-right mt-4 register" data-link=".register-form"
                        data-current-form=".form-window">You Don't Have Account ? Register </a>

                </form>
            </div>
        </div>

        <section class="register-form w-25 position-fixed bg-light p-4 rounded text-center">
            <h4 class="text-dark text-center p-2 ">Register For Free Account</h4>
            <form action="" method="post" id="registerform">

                <div class="form-group">
                    <div class="input-group">
                        <span class="text-primary py-1 px-2 border" for="fullname"><i
                                class="fas fa-user-edit"></i></span>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="text-primary py-1 px-2 border" for="registeremail"><i
                                class="far fa-envelope"></i></span>
                        <input type="email" name="registeremail" id="registeremail" class="form-control"
                            placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="text-danger py-1 px-2 border" for="registerpassword"><i
                                class="fas fa-key"></i></span>
                        <input type="password" name="registerpassword" id="registerpassword" class="form-control"
                            placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="text-danger py-1 px-2 border" for="registerpasswordconf"><i
                                class="fas fa-check-double"></i></span>
                        <input type="password" name="registerpassword_confirmation" id="registerpasswordconf"
                            class="form-control" placeholder="Reapet Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="submit" name="register" id="register" value="Register"
                            class="form-control btn-success">
                    </div>
                </div>

            </form>
            <span data-login-form=".form-window" data-register-form=".register-form" class="go-back"><i
                    class="fas fa-arrow-circle-left  text-primary bg-light d-inline-block mt-4"></i></span>
            <div class="alert alert-danger alert-dismissible fade show mt-3 register-error text-center" role="alert">
                <strong class="message d-block"></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </section>
    </div>
    <section class="alert notify position-fixed"></section>
    <script src="./assets/js/jquery.min.js" crossorigin="anonymous"></script>
    <script src="./assets/js/app.js" crossorigin="anonymous"></script>
</body>

</html>