<?php

require_once("include/config.php");
require_once("include/library.php");

$error = '';
if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Add Event") {
    addEvent($con, $_REQUEST, $error);
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
                                <h3>Add Event</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body add-post">
                                    <form class="row needs-validation" action="" method="POST" novalidate="" enctype="multipart/form-data">


                                        <div class="col-sm-6 mb-1">
                                            <label for="title">Title:</label>
                                            <input class="form-control" id="title" type="text" placeholder="Post Title" name="title" required="">
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <label for="url">URL:</label>
                                            <input class="form-control" id="url" type="text" placeholder="URL" name="url">
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>

                                        <script>
                                            document.getElementById('title').addEventListener('input', function() {
                                                const title = this.value.trim();
                                                const urlField = document.getElementById('url');
                                                const words = title.split(/\s+/); // Split by spaces
                                                let url = '';

                                                if (words.length === 1) {
                                                    // Single word: add hyphen between each letter
                                                    url = words[0].split('').join('-');
                                                } else if (words.length === 2) {
                                                    // Two words: concatenate first and second words with hyphen
                                                    url = words.join('-');
                                                } else if (words.length > 2) {
                                                    // More than two words: use first and last words
                                                    url = words[0] + '-' + words[words.length - 1];
                                                }

                                                // Update the URL field
                                                urlField.value = url.toLowerCase(); // Lowercase for URL formatting
                                            });
                                        </script>

                                        <div class="col-sm-6 mb-3">
                                            <label for="validationCustom01">Date:</label>
                                            <input class="form-control" id="validationCustom01" type="text"
                                                placeholder="Post Date" name="date">
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="validationCustom01">Venue:</label>
                                            <input class="form-control" id="validationCustom01" type="text"
                                                placeholder="Post Venue" name="venue">
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">Banner</span></div>
                                                <input type="file" name="attached_banner" id="banner" class="form-control" style="border-left-width: 0px;margin-left: calc(var(--bs-border-width) * 3);" multiple>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">Gallery</span></div>
                                                <input type="file" name="attached_images[]" id="image" class="form-control" style="border-left-width: 0px;margin-left: calc(var(--bs-border-width) * 3);" multiple>
                                            </div>
                                        </div>


                                        <div class="col-sm-12 email-wrapper">
                                            <div class="theme-form">
                                                <div class="mb-3">
                                                    <label>Description:</label>
                                                    <textarea id="editor1" name="description" cols="10" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>






                                        <div class="btn-showcase text-end">
                                            <button class="btn btn-primary" name="submit" value="Add Event" type="submit">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright 2024 © Web Godam.</p>
                        </div>
                        <div class="col-md-6">
                            <p class="float-end mb-0">Hand crafted &amp; made with
                                <svg class="footer-icon">
                                    <use href="assets/svg/icon-sprite.svg#heart"></use>
                                </svg>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
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




    <!-- Plugins JS start-->
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/editor/ckeditor/ckeditor.js"></script>
    <script src="assets/js/editor/ckeditor/adapters/jquery.js"></script>
    <script src="assets/js/editor/ckeditor/styles.js"></script>
    <script src="assets/js/editor/ckeditor/ckeditor.custom.js"></script>
    <script src="assets/js/slick/slick.min.js"></script>
    <script src="assets/js/slick/slick.js"></script>
    <script src="assets/js/header-slick.js"></script>
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
                    type: "PUT",
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

        //         CKEDITOR.editorConfig = function( config ) {
        // 	config.language = 'es';
        // 	config.uiColor = '#F7B42C';
        // 	config.height = 300;
        // 	config.toolbarCanCollapse = true;
        //     config.colorButton_enableAutomatic =true;
        // };

        // $(document).ready(function() {

        // $("#ext-box").Editor(

        //     config.colorButton_enableAutomatic =true
        // );

        // });
    </script>

</body>

</html>