<?php

require_once("include/config.php");
require_once("include/library.php");
require_once("include/header.php");

$error = '';
if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Add People") {
    addPeople($con, $_REQUEST, $error);
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
        label {
            margin-bottom: .5rem;
            margin: 20px 0px 0px 10px;
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
                            <div class="col-sm-6 ps-0">
                                <h3 style="padding-bottom: 14px;margin-left: 15px;">Add People</h3>
                            </div>

                            <!-- Container-fluid starts-->
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body add-post">
                                            <form class="row needs-validation" method="post" action="" novalidate="" enctype="multipart/form-data">
                                                <div class="col-sm-6">
                                                    <label for="validationCustom01">Title:</label>
                                                    <input class="form-control" id="validationCustom01" type="text"
                                                        placeholder="Post Title" name="title" required="">
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="validationCustom01">Post1:</label>
                                                    <input class="form-control" id="validationCustom01" type="text"
                                                        placeholder="Enter Post1" name="post1">
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="validationCustom01">Post2:</label>
                                                    <input class="form-control" id="validationCustom01" type="text"
                                                        placeholder="Enter Post2" name="post2">
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div> 
                                                <div class="col-sm-6">
                                                    <label for="validationCustom01">Post3:</label>
                                                    <input class="form-control" id="validationCustom01" type="text"
                                                        placeholder="Enter Post3" name="post3">
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="validationCustom01">Mail:</label>
                                                    <input class="form-control" id="validationCustom01" type="text"
                                                        placeholder="Post Mail" name="mail">
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="validationCustom01">Image:</label>
                                                    <input type="file" name="attached_image" id="image" class="form-control" multiple>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="email-wrapper">
                                                        <div class="theme-form">
                                                            <div class="mb-3">
                                                                <label>Description:</label>
                                                                <textarea id="text-box" name="description" cols="10" rows="2"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-showcase text-end">
                                                    <button class="btn btn-primary" name="submit" value="Add People" type="submit">Add</button>
                                                </div>

                                            </form>

                                        </div>
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