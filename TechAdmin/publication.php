<?php


require_once("include/config.php");

require_once("include/library.php");



if (isset($_REQUEST['del_id']) && $_REQUEST['del_id'] != '' && $_REQUEST['img_Path'] != '') {

    deleteDataWithImg($con, 'publication', $_REQUEST['del_id'], $_REQUEST['img_Path']);

    echo "<script>window.location = '" . $wwwroot . "/publication.php?act=del';</script>";

    exit();
}



date_default_timezone_set("Asia/Kolkata");

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
    <meta name="csrf-token" content="22L2XEuVkyArsNxlWA9Eta0oPNeFipVYrysTArfC">
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
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/datatable-extension.css">
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
        .img-fluid {
            max-width: 90%;
            height: auto;
        }
    </style>

</head>

<body>
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
                <div class="page-title" style="margin:0px;">
                    <div class="row">
                        <div class="col-sm-6 ps-0">
                            <h3><b> Publication </b><?php if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'del') {
                                                        echo '<span style="color:green;float:right;">Deleted successfully</span>';
                                                    } else if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'add') {
                                                        echo '<span style="color:green;float:right;">Added successfully</span>';
                                                    }else if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'settingAdd') {
                                                        echo '<span style="color:green;float:right;">Setting Added successfully</span>';
                                                    } else if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'edit') {
                                                        echo '<span style="color:green;float:right;">Updated successfully</span>';
                                                    } else if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'status') {
                                                        echo '<span style="color:green;float:right;">Changed successfully</span>';
                                                    } ?></h3>
                        </div>
                        <div class="col-sm-6 ps-0">
                            <div class="btn-showcase text-end">
                                <a class="btn btn-primary" style="color: white;margin-bottom: 0px;margin-right: 0px;"" href=" add_publication.php">Add Publication</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid extra_data">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dt-ext table-responsive theme-scrollbar">
                                    <table class="display" id="tableshowid">
                                        <thead>
                                            <tr>
                                                <th><input name="product_all" class="checked_all" type="checkbox"></th>

                                                <th>Action</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Venue</th>
                                                <th>Media</th>
                                                <th>Banner</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>

                                        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />

                                        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" />

                                        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

                                        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

                                        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

                                        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

                                        <script>
                                            $(document).ready(function() {

                                                $('#tableshowid').DataTable({

                                                    "columnDefs": [{
                                                        "orderable": false,
                                                        "targets": 0
                                                    }],

                                                    dom: 'Blfrtip',

                                                    pageLength: 10,

                                                    buttons: [

                                                        'excelHtml5'

                                                    ],

                                                    aLengthMenu: [10, 20, 50, 100, 500],

                                                    "processing": true,

                                                    "serverSide": true,

                                                    "ajax": {

                                                        url: "ajaxdataload/allpublication.php",

                                                        type: "post"

                                                    },

                                                    'columns': [

                                                        {
                                                            data: 'id'
                                                        },
                                                        {
                                                            data: 'action'
                                                        },
                                                        {
                                                            data: 'title'
                                                        },
                                                        {
                                                            data: 'date'
                                                        },
                                                        {
                                                            data: 'venue'
                                                        },
                                                        {
                                                            data: 'media'
                                                        },
                                                        {
                                                            data: 'banner'
                                                        },
                                                        {
                                                            data: 'edate'
                                                        },
                                                        {
                                                            data: 'etime'
                                                        }

                                                    ]

                                                });

                                            });
                                        </script>



                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container-fluid Ends-->
                </div>
                <!-- footer start-->
                <?php include('include/footer.php'); ?>
            </div>
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
    <script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/jszip.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/buttons.colVis.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/pdfmake.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/vfs_fonts.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.autoFill.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.select.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/buttons.html5.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/buttons.print.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.responsive.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.keyTable.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.colReorder.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.scroller.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/custom.js"></script>
    <script src="assets/js/tooltip-init.js"></script>
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
                        _token: '22L2XEuVkyArsNxlWA9Eta0oPNeFipVYrysTArfC',
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