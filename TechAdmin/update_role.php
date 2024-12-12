<?php

require_once("include/config.php");
require_once("include/library.php");
require_once("include/header.php");

$error = '';

if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Edit Role") {
    updateRole($con, $_REQUEST, $error);
}

if (isset($_REQUEST['edit_id']) && $_REQUEST['edit_id'] != '') {
    $edit_id = $_REQUEST['edit_id'];
    $roleinfo = editData($con, 'role', $edit_id);
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
            margin: 0px 0px 10px 0px;
        }

        .per-label {
            margin-bottom: .5rem;
            margin: 0px 20px 0px 0px;
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
                                <h3 style="padding-bottom: 14px;margin-left: 15px;">Update Role</h3>
                            </div>

                            <!-- Container-fluid starts-->
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body add-post">
                                            <form class="row needs-validation" method="post" action="" novalidate="" enctype="multipart/form-data">
                                                <input class="form-control" id="Role" type="hidden"
                                                    placeholder="Enter Role" name="id" value="<?php echo $roleinfo['id'] ?>" required="">
                                                <div class="col-sm-6">
                                                    <label for="Role">Role Name:</label>
                                                    <input class="form-control" id="Role" type="text"
                                                        placeholder="Enter Role" name="role_name" value="<?php echo $roleinfo['role_name'] ?>" required="">
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <fieldset>
                                                        <legend class="mt-4">Permission:</legend>
                                                        <div class="permission-card">
                                                            <p>Banner</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" name="permission[banner_show]" value="banner_show" id="banner_show" <?php
                                                                    echo $roleinfo['banner_show'] > 0 ? 'checked' : '';
                                                                    ?>>
                                                                    <label class="form-check-label per-label" for="banner_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" name="permission[banner_add]" value="banner_add" id="banner_add" <?php
                                                                    echo $roleinfo['banner_add'] > 0 ? 'checked' : '';
                                                                    ?>>
                                                                    <label class="form-check-label per-label" for="banner_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" name="permission[banner_edit]" value="banner_edit" id="banner_edit" <?php
                                                                    echo $roleinfo['banner_edit'] > 0 ? 'checked' : '';
                                                                    ?>>
                                                                    <label class="form-check-label per-label" for="banner_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['banner_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[banner_remove]" value="banner_remove" id="banner_remove">
                                                                    <label class="form-check-label per-label" for="banner_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="permission-card">
                                                            <p>Latest Update</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['latest_show'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[latest_show]" value="latest_show" id="latest_show">
                                                                    <label class="form-check-label per-label" for="latest_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['latest_add'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[latest_add]" value="latest_add" id="latest_add">
                                                                    <label class="form-check-label per-label" for="latest_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['latest_edit'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[latest_edit]" value="latest_edit" id="latest_edit">
                                                                    <label class="form-check-label per-label" for="latest_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['latest_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[latest_remove]" value="latest_remove" id="latest_remove">
                                                                    <label class="form-check-label per-label" for="latest_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="permission-card">
                                                            <p>People</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['people_show'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[people_show]" value="people_show" id="people_show">
                                                                    <label class="form-check-label per-label" for="people_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['people_add'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[people_add]" value="people_add" id="people_add">
                                                                    <label class="form-check-label per-label" for="people_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['people_edit'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[people_edit]" value="people_edit" id="people_edit">
                                                                    <label class="form-check-label per-label" for="people_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['people_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[people_remove]" value="people_remove" id="people_remove">
                                                                    <label class="form-check-label per-label" for="people_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="permission-card">
                                                            <p>Purpose</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['purpose_show'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[purpose_show]" value="purpose_show" id="purpose_show">
                                                                    <label class="form-check-label per-label" for="purpose_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['purpose_add'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[purpose_add]" value="purpose_add" id="purpose_add">
                                                                    <label class="form-check-label per-label" for="purpose_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['purpose_edit'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[purpose_edit]" value="purpose_edit" id="purpose_edit">
                                                                    <label class="form-check-label per-label" for="purpose_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['purpose_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[purpose_remove]" value="purpose_remove" id="purpose_remove">
                                                                    <label class="form-check-label per-label" for="purpose_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="permission-card">
                                                            <p>Event</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['event_show'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[event_show]" value="event_show" id="event_show">
                                                                    <label class="form-check-label per-label" for="event_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['event_add'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[event_add]" value="event_add" id="event_add">
                                                                    <label class="form-check-label per-label" for="event_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['event_edit'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[event_edit]" value="event_edit" id="event_edit">
                                                                    <label class="form-check-label per-label" for="event_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['event_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[event_remove]" value="event_remove" id="event_remove">
                                                                    <label class="form-check-label per-label" for="event_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="permission-card">
                                                            <p>Publication</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['publication_show'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[publication_show]" value="publication_show" id="publication_show">
                                                                    <label class="form-check-label per-label" for="publication_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['publication_add'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[publication_add]" value="publication_add" id="publication_add">
                                                                    <label class="form-check-label per-label" for="publication_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['publication_edit'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[publication_edit]" value="publication_edit" id="publication_edit">
                                                                    <label class="form-check-label per-label" for="publication_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['publication_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[publication_remove]" value="publication_remove" id="publication_remove">
                                                                    <label class="form-check-label per-label" for="publication_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="permission-card">
                                                            <p>Reports</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['reports_show'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[reports_show]" value="reports_show" id="reports_show">
                                                                    <label class="form-check-label per-label" for="reports_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['reports_add'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[reports_add]" value="reports_add" id="reports_add">
                                                                    <label class="form-check-label per-label" for="reports_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['reports_edit'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[reports_edit]" value="reports_edit" id="reports_edit">
                                                                    <label class="form-check-label per-label" for="reports_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['reports_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[reports_remove]" value="reports_remove" id="reports_remove">
                                                                    <label class="form-check-label per-label" for="reports_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['form'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[form]" value="form" id="form">
                                                                    <label class="form-check-label per-label" for="form">
                                                                        Form
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="permission-card">
                                                            <p>SEO</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['seo_show'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[seo_show]" value="seo_show" id="seo_show">
                                                                    <label class="form-check-label per-label" for="seo_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['seo_add'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[seo_add]" value="seo_add" id="seo_add">
                                                                    <label class="form-check-label per-label" for="seo_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['seo_edit'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[seo_edit]" value="seo_edit" id="seo_edit">
                                                                    <label class="form-check-label per-label" for="seo_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['seo_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[seo_remove]" value="seo_remove" id="seo_remove">
                                                                    <label class="form-check-label per-label" for="seo_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="permission-card">
                                                            <p>User Management</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['user_show'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[user_show]" value="user_show" id="user_show">
                                                                    <label class="form-check-label per-label" for="user_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['user_add'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[user_add]" value="user_add" id="user_add">
                                                                    <label class="form-check-label per-label" for="user_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['user_edit'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[user_edit]" value="user_edit" id="user_edit">
                                                                    <label class="form-check-label per-label" for="user_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['user_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[user_remove]" value="user_remove" id="user_remove">
                                                                    <label class="form-check-label per-label" for="user_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="permission-card">
                                                            <p>Role Management</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['role_show'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[role_show]" value="role_show" id="role_show">
                                                                    <label class="form-check-label per-label" for="role_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['role_add'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[role_add]" value="role_add" id="role_add">
                                                                    <label class="form-check-label per-label" for="role_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['role_edit'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[role_edit]" value="role_edit" id="role_edit">
                                                                    <label class="form-check-label per-label" for="role_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['role_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[role_remove]" value="role_remove" id="role_remove">
                                                                    <label class="form-check-label per-label" for="role_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="permission-card">
                                                            <p>Setting</p>
                                                            <div class="d-flex flex-wrap" style="margin: 2px 2px 25px 2px;">
                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['setting_show'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[setting_show]" value="setting_show" id="setting_show">
                                                                    <label class="form-check-label per-label" for="setting_show">
                                                                        Show
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['setting_add'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[setting_add]" value="setting_add" id="setting_add">
                                                                    <label class="form-check-label per-label" for="setting_add">
                                                                        Add
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['setting_edit'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[setting_edit]" value="setting_edit" id="setting_edit">
                                                                    <label class="form-check-label per-label" for="setting_edit">
                                                                        Edit
                                                                    </label>
                                                                </div>

                                                                <div class="form-check" style="margin-right: 15px; margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" <?php
                                                                    echo $roleinfo['setting_remove'] > 0 ? 'checked' : '';
                                                                    ?> name="permission[setting_remove]" value="setting_remove" id="setting_remove">
                                                                    <label class="form-check-label per-label" for="setting_remove">
                                                                        Remove
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6">

                                                    <label for="exampleSelect1" class="form-label">Status</label>
                                                    <select class="form-select" name="status" id="exampleSelect1">
                                                        <?php if ($roleinfo['status'] == '1') { ?>
                                                            <option value="1" selected>Active</option>
                                                            <option value="0">Inactive</option>
                                                        <?php } else { ?>
                                                            <option value="1">Active</option>
                                                            <option value="0" selected>Inactive</option>
                                                        <?php } ?>
                                                    </select>

                                                </div>


                                                <div class="btn-showcase text-end">
                                                    <button class="btn btn-primary" name="submit" value="Edit Role" type="submit">Add</button>
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