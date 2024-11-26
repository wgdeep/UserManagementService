<?php
require_once("include/config.php");
require_once("include/library.php");
if (isset($_POST['submit']) && $_POST['submit'] == 'register') {
    Register($con, $_POST, $error);
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cion admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cion admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>Cion - Premium Admin Template</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&amp;family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,200;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700;1,6..12,800;1,6..12,900;1,6..12,1000&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="preload" as="style" href="build/assets/style-BY0q3M5K.css" />
    <link rel="stylesheet" href="build/assets/style-BY0q3M5K.css" data-navigate-track="reload" />
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .show-hide {
            cursor: pointer;
        }
    </style>

</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        <div><a class="logo" href="login.html"><img class="img-fluid for-light"
                                    src="assets/images/logo/logo-1.png" alt="looginpage"><img
                                    class="img-fluid for-dark" src="assets/images/logo/logo.png"
                                    alt="looginpage"></a></div>


                        <div id="logerr_msg">
                            <!-- <?php if (isset($error) && $error != "") echo '<span style="color:red;">' . $error . '</span>';
                                    else echo ''; ?> -->
                            <?php if (isset($error) && $error != "") echo '<a href="/projects/TechAdmin/index.php" style="color:red;margin-left: 5px;">Already have an account? Click here to <button class="btn btn-primary btn-sm btn-block bg-green" style="margin-bottom: 5px;">LOGIN</button> </a>';
                            else echo '<a style="margin-bottom: 7px;margin-left: 7px;" href="/projects/TechAdmin/index.php" class="btn btn-primary btn-sm btn-block bg-green">LOGIN</a>'; ?>
                        </div>

                        <div class="login-main">
                            <form class="theme-form" action="" method="post">

                                <h3>Register to account</h3>
                                <p>Enter your details to register</p>

                                <div class="form-group">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input type="text" name="user_name" class="form-control" id="name" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="register_email" class="col-form-label">Email Address</label>
                                    <input type="email" name="user_email" class="form-control" id="register_email" value="" placeholder="Enter Email" required>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input type="password" name="password" class="form-control" id="signin-password" placeholder="Password" required>
                                        <!-- Eye icon that toggles between 'eye' and 'eye-slash' -->
                                        <div class="show-hide" onclick="togglePassword()">
                                            <i class="fa fa-eye" id="toggle-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-end">
                                    <a class="text-muted" href="password/reset.html">Forgot password?</a>
                                    <div class="text-end mt-3">
                                        <button type="submit" name="submit" value="register" class="btn btn-primary btn-lg btn-block bg-green">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <p>Tracking System | Web Godam © 2021. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function togglePassword() {
            var passwordField = document.getElementById('signin-password');
            var toggleIcon = document.getElementById('toggle-icon');

            // Toggle the type of the input
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye'); // Remove the 'eye' icon
                toggleIcon.classList.add('fa-eye-slash'); // Add the 'eye-slash' icon
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash'); // Remove the 'eye-slash' icon
                toggleIcon.classList.add('fa-eye'); // Add the 'eye' icon
            }
        }
    </script>
    <!-- latest jquery-->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
</body>



</html>