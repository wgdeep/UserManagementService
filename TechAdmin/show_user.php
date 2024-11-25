<?php

require_once("include/config.php");
require_once("include/library.php");
require_once("include/header.php");

$error = '';
$wwwroot = "/projects/TechAdmin";
if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Add People") {
    addPeople($con, $_REQUEST, $error);
}


if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Edit People") {
    updatePeople($con, $_REQUEST, $error);
}


if (isset($_REQUEST['show_id']) && $_REQUEST['show_id'] != '') {
    $edit_id = $_REQUEST['show_id'];
    $userinfo = viewData($con, 'user', $edit_id);
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
    <meta name="csrf-token" content="xq1sRXci9mJD7CPntesosEA0EJxzvhPdwg6knEKt">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>Cion - Premium Admin Template</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
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
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/select2.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/dropzone.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="preload" as="style" href="build/assets/style-BY0q3M5K.css" />
    <link rel="stylesheet" href="build/assets/style-BY0q3M5K.css" data-navigate-track="reload" />
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/toastr.min.css">

    <style>
        /* From Uiverse.io by Praashoo7 */
        /* From Uiverse.io by mi-series */
        /* Body */
        .container {
            display: grid;
            grid-template-columns: auto;
            gap: 0px;
        }

        hr {
            height: 1px;
            background-color: #E5C7C5;
            border: none;
        }

        .card {
            width: 400px;
            background: #F4E2DE;
            box-shadow: 0px 187px 75px rgba(0, 0, 0, 0.01), 0px 105px 63px rgba(0, 0, 0, 0.05), 0px 47px 47px rgba(0, 0, 0, 0.09), 0px 12px 26px rgba(0, 0, 0, 0.1), 0px 0px 0px rgba(0, 0, 0, 0.1);
        }

        .title {
            width: 100%;
            height: 40px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 20px;
            border-bottom: 1px solid #E5C7C5;
            font-weight: 700;
            font-size: 20px;
            color: #000000;
        }

        /* Cart */
        .cart {
            border-radius: 19px 19px 0px 0px;
        }

        .cart .steps {
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .cart .steps .step {
            display: grid;
            gap: 10px;
        }

        .cart .steps .step span {
            font-size: 13px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 8px;
            display: block;
        }

        .cart .steps .step p {
            font-size: 15px;
            font-weight: 600;
            color: #000000;
        }

        /* Promo */
        .promo form {
            display: grid;
            grid-template-columns: 1fr 80px;
            gap: 10px;
            padding: 0px;
        }

        .input_field {
            width: auto;
            height: 36px;
            padding: 0 0 0 12px;
            border-radius: 5px;
            outline: none;
            border: 1px solid #E5C7C5;
            background-color: #F4E2DE;
            transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
        }

        .input_field:focus {
            border: 1px solid transparent;
            box-shadow: 0px 0px 0px 2px #F3D2C9;
            background-color: #F4E2DE;
        }

        .promo form button {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 10px 18px;
            gap: 10px;
            width: 100%;
            height: 36px;
            background: #F3D2C9;
            box-shadow: 0px 0.5px 0.5px #F3D2C9, 0px 1px 0.5px rgba(239, 239, 239, 0.5);
            border-radius: 5px;
            border: 0;
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            color: #000000;
        }

        /* Checkout */
        .payments .details {
            display: grid;
            grid-template-columns: 10fr 1fr;
            padding: 0px;
            gap: 5px;
        }

        .payments .details span:nth-child(odd) {
            font-size: 12px;
            font-weight: 600;
            color: #000000;
            margin: auto auto auto 0;
        }

        .payments .details span:nth-child(even) {
            font-size: 13px;
            font-weight: 600;
            color: #000000;
            margin: auto 0 auto auto;
        }

        .checkout .footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 10px 10px 20px;
            background-color: #ECC2C0;
        }

        .price {
            position: relative;
            font-size: 22px;
            color: #2B2B2F;
            font-weight: 900;
        }

        .checkout .checkout-btn {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 150px;
            height: 36px;
            background: #F3D2C9;
            box-shadow: 0px 0.5px 0.5px #E5C7C5, 0px 1px 0.5px rgba(239, 239, 239, 0.5);
            border-radius: 7px;
            border: 1px solid #ECC2C0;
            color: #000000;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
        }
    </style>

</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <!-- Page Header Start-->


        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper" style="margin-top: 0px;">
            <!-- Page Sidebar Start-->
            <?php

            require_once("include/sidebarmenu.php");
            ?>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title" style="margin-top: 0px;">
                        <div class="row">
                            <div class="container">
                                <div class="card cart">
                                    <label class="title"><?php echo $userinfo['user_name'] ?></label>
                                    <div class="steps">
                                        <div class="step">
                                            <div>
                                                <?php
                                                if ($userinfo['status'] > 0) {
                                                    $status = 'Active';
                                                    $color = 'success';
                                                } else {
                                                    $status = 'Inactive';
                                                    $color = 'danger';
                                                }
                                                ?>
                                                <label for="status">Status: </label>
                                                <button id="status" type="button" class="btn btn-<?php echo $color ?>"><?php echo $status ?></button>
                                                <p style="margin-top: 20px;"><?php echo $userinfo['user_email'] ?></p>
                                            </div>
                                            <hr>
                                            <p style="margin-top: 20px;">Role: <?php echo $userinfo['role'] ?></p>
                                            <hr>
                                        </div>
                                    </div>
                                    <!-- Container-fluid Ends-->
                                </div>
                                <!-- footer start-->
                                <?php include('include/footer.php'); ?>
                            </div>
                        </div>
                        <!-- latest jquery-->
                        <script src="assets/js/jquery.min.js"></script>
                        <!-- Bootstrap js-->
                        <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
                        <!-- feather icon js-->
                        <script src="assets/js/icons/feather-icon/feather.min.js"></script>
                        <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
                        <!-- scrollbar js-->
                        <script src="assets/js/scrollbar/simplebar.js"></script>
                        <script src="assets/js/scrollbar/custom.js"></script>
                        <!-- Sidebar jquery-->
                        <script src="assets/js/config.js"></script>
                        <!-- Plugins JS start-->
                        <script src="assets/js/sidebar-menu.js"></script>
                        <script src="assets/js/slick/slick.min.js"></script>
                        <script src="assets/js/slick/slick.js"></script>
                        <script src="assets/js/header-slick.js"></script>
                        <script src="assets/js/editor/ckeditor/ckeditor.js"></script>
                        <script src="assets/js/editor/ckeditor/adapters/jquery.js"></script>
                        <script src="assets/js/dropzone/dropzone.js"></script>
                        <script src="assets/js/dropzone/dropzone-script.js"></script>
                        <script src="assets/js/select2/select2.full.min.js"></script>
                        <script src="assets/js/select2/select2-custom.js"></script>
                        <script src="assets/js/email-app.js"></script>
                        <script src="assets/js/form-validation-custom.js"></script>
                        <!-- Plugins JS Ends-->
                        <!-- Theme js-->
                        <script src="assets/js/script.js"></script>
                        <script src="assets/js/theme-customizer/customizer.js"></script>

                        <!-- toastr js -->
                        <script src="assets/js/toastr.min.js"></script>

                        <script>
                            $(document).ready(function() {
                                $(document).on('change', '.toggle-status', function() {
                                    let status = $(this).prop('checked') ? 1 : 0;
                                    let url = $(this).data('route');
                                    let clickedToggle = $(this);
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: {
                                            status: status,
                                            _token: 'xq1sRXci9mJD7CPntesosEA0EJxzvhPdwg6knEKt',
                                        },
                                        success: function(data) {
                                            clickedToggle.prop('checked', status);
                                            toastr.success("Status Updated Successfully");
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(error)
                                        }
                                    });
                                });
                            });
                        </script>


                        <script>
                            $(document).ready(function() {
                                $('.toastr-message').each(function() {
                                    var messageType = $(this).data('type');
                                    var messageText = $(this).text();
                                    toastr.options = {
                                        "closeButton": false,
                                        "progressBar": true,
                                        "extendedTimeOut": 0,
                                        "timeOut": 0,
                                    };

                                    switch (messageType) {
                                        case 'success':
                                            toastr.success(messageText);
                                            break;
                                        case 'error':
                                            toastr.error(messageText);
                                            break;
                                        case 'info':
                                            toastr.info(messageText);
                                            break;
                                        case 'warning':
                                            toastr.warning(messageText);
                                            break;
                                        default:
                                            toastr.info(messageText);
                                    }
                                });
                            });
                        </script>

</body>

</html>