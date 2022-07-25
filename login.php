<?php
// session_start();

if ( isset($_SESSION['apriori_tncs_id']) ) {
    header("location:index.php");
}

$login = 0;
if (isset($_GET['login'])) {
    $login = $_GET['login'];
}

if ($login == 1) {
    $komen = "Silahkan Login Ulang, Cek username dan Password Anda!!";
}

include_once "fungsi.php";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- <link rel=”icon” href=''> -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/tn1.png" />
    <title>Login TSkripsi</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="template/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="template/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="template/AdminLTE/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- <div class="login-logo">
            <a href="template/AdminLTE/index2.html"><b>Admin</b>LTE</a>
            
        </div> -->
        <!-- /.login-logo -->
        <div class="card card-login">
            <div class="card-body login-card-body">
            <!-- <img src="assets/images/logo/tn1.png" alt="AdminLTE Logo" class="brand-image img-circle img-logo-login" id="img-logo-login" style="opacity: .8"> -->
                <!-- <p class="login-box-msg">Sign in to start your session</p> -->
                <h3 class="login-box-msg" style="text-align: center;">Login</h3>
                <form method="post" action="cek-login.php">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <?php
                        if (isset($komen)) {
                        display_error("Login gagal.periksa kembali username dan password");                          }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-login">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- /.social-auth-links -->

                <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="template/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="template/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="template/AdminLTE/dist/js/adminlte.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <!-- <script>
$('.form-control').on('click', function(e){
  e.preventDefault();
//   $(this).css('border-color', '#c4996c');
$(this).toggleClass('color');
console.log('sdsd');
});


    </script> -->
</body>

</html>