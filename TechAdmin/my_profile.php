<?php

require_once("include/config.php");
require_once("include/library.php");

$spanError = '';
$error = '';
if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Update Profile") {

    $profile_id = $_SESSION['ID'];
    $userinfo = mysqli_fetch_assoc(mysqli_query($con, "select * from user where id = '" . $profile_id . "'"));
    $old_password = trim($userinfo['user_password']);
    $input_password = trim(md5($_REQUEST['old_password']));
    if ($input_password == $old_password) {
        updateProfile($con, $_REQUEST, $error);
    } else {
        $spanError   = 'Incorrect old password.';
    }
}

$imageinfo = viewData($con, 'user', $_SESSION['ID']); 
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
            margin: 0px 0px 10px 0px;
        }

        .per-label {
            margin-bottom: .5rem;
            margin: 0px 20px 0px 0px;
        }

        .show-hide {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Loader starts-->

    <!-- Page Header Start-->
    <?php
    require_once("include/header.php");
    ?>
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
                            <h3 style="padding-bottom: 14px;margin-left: 15px;"><?php echo $_SESSION['Name'] ?></h3>
                        </div>

                        <!-- Container-fluid starts-->
                        <div class="container-fluid">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body add-post">
                                        <form class="row needs-validation" method="post" action="" novalidate="" enctype="multipart/form-data">

                                            <input type="hidden" name="id" value="<?php echo $_SESSION['ID']; ?>">

                                            <div class="col-sm-6">
                                                <label for="Name">Name:</label>
                                                <input class="form-control" style="margin-bottom: 10px;" id="Name" type="text"
                                                    placeholder="Enter Name" name="user_name" value="<?php echo $_SESSION['Name'] ?>" required="">
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="Email">Email:</label>
                                                <input class="form-control" style="margin-bottom: 10px;" id="Email" type="text"
                                                    placeholder="Enter Email" name="user_email" value="<?php echo $_SESSION['Email'] ?>" required="">
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>

                                            <input type="hidden" name="role_name" value="<?php echo $_SESSION['Role'] ?>">
                                            <input type="hidden" name="status" value="<?php echo $_SESSION['Status'] ?>">

                                            <div class="col-sm-6">
                                                <label for="Old">Old Password:</label>
                                                <input class="form-control" style="margin-bottom: 10px;" id="Old" type="password" name="old_password" required="" autocomplete="off">
                                                <div class="valid-feedback">Looks good!</div>
                                                <?php
                                                if ($spanError) {  ?>
                                                    <div class="feedback"><span style="color: red;"><?php echo $spanError ?> </span></div>
                                                <?php } ?>

                                            </div>

                                            <div class="col-sm-6">
                                                <label for="New">New Password:</label>
                                                <input class="form-control" style="margin-bottom: 10px;" id="New" type="password"
                                                    placeholder="Enter Password" name="new_password" required="">


                                                <div class="valid-feedback">Looks good!</div>
                                            </div>




                                            <div class="col-sm-6" style="padding-top: 15px;padding-left: 0px;left: 15px;"">
                                                    <div class=" input-group mb-3">
                                                <div class="input-group-prepend" style="padding-left: -0.25rem;border-left-style: solid;margin-left: 13px;border-left-width: 0px;"><span class="input-group-text">Profile Image</span></div>
                                                <div class="card form-control" style="display: flex; flex-direction:row;margin-left: calc(var(--bs-border-width) * 17);padding-right: 4.75rem;border-right-width: 1px;">
                                                    <?php
                                                    
                                                    $Image = $imageinfo['image'];
                                                    if (!empty($Image)) {
                                                        $imagePath = "./data/user/image/" . $Image;
                                                        echo "<a class='socialContainerBanner'><img id='bannerImg' width='150' class='socialSvg instagramSvg' src='$imagePath' alt='Image'></a>";
                                                    } else {
                                                        echo "<p style='margin-left: 25px;margin-bottom: 0rem;'>No banner image available.</p>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <input class="col-sm-6" type="hidden" name="existing_image" value="<?php echo htmlspecialchars($Image); ?>">
                                    </div>

                                    <div class="col-sm-6" style="padding-left: 0px;padding-bottom: 15px;">
                                        <input style="padding-left: 10px;padding-top: 10px;border-left-width: 0px;margin-left: 15px;" type="file" name="attached_image" id="image" class="form-control">
                                    </div>




                                    <div class="btn-showcase text-end">
                                        <button class="btn btn-primary mt-3" name="submit" value="Update Profile" type="submit">Update</button>
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