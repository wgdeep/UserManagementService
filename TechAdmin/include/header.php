<?php
if (empty($_SESSION['ID']) && ($_SESSION['Name'] == "")) {
  header("location:index.php");
  exit();
}
?>
<!doctype html>
<html lang="en">

<head>
  <title> Admin | Queries System | Web Godam</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="shortcut icon" type="x-icon" href="https://www.webgodam.com/images/logo_header.png" />
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/animate.min.css">
  <link rel="stylesheet" href="assets/css/color_skins.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/sweetalert.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/editor.css">
  <script src="assets/js/libscripts.bundle.js"></script>
  <style type="text/css">
    .main-logo-icon {
      display: none;
    }

    .theme-blue.menu-icon .main-logo-icon {
      display: block;
    }

    .theme-blue.menu-icon .main-logo {
      display: none;
    }

    .menu-icon .navbar-fixed-top .container-fluid .navbar-brand {
      width: 50px;
      padding: 10px 5px;
    }

    .theme-blue .navbar-brand {
      background: #ffb115;
    }
  </style>
</head>

<body class="theme-blue">
  <div id="wrapper">
    <nav class="navbar navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-right">
          <ul class="list-unstyled clearfix mb-0">
            <li>
              <div class="navbar-btn btn-toggle-show">
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
              </div>
              <a href="javascript:void(0);" class="btn-toggle-fullwidth btn-toggle-hide"><i class="fa fa-bars"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="loader"></div>
    </div>
    <!-- Loader ends-->
    <!-- tap on top starts-->

    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row" style="margin-right: calc(0.5 * var(--bs-gutter-x));"">
      

        <div class="nav-right col-auto pull-right right-header p-0 ms-auto">
          <ul class="nav-menus">
            <li class="profile-nav onhover-dropdown pe-0 py-0">
              <div class="d-flex align-items-center profile-media"><img class="b-r-25"
                  src="assets/images/dashboard/profile.png" alt="">
                <div class="flex-grow-1 user" style="margin-left: 1px;border-right-width: 0px;border-right-style: solid;margin-right: 40px;"><span>Tech</span>
                  <p class="mb-0 font-nunito">admin
                    <svg>
                      <use href="assets/svg/icon-sprite.svg#header-arrow-down">
                      </use>
                    </svg>
                  </p>
                </div>
              </div>
              <ul class="profile-dropdown onhover-show-div">
                <li><a href="./user_logout.php"><i data-feather="log-in"> </i><span>Log out</span></a></li>
                <!-- <form action="logout" method="POST" class="d-none" id="logout-form">
                  <input type="hidden" name="_token" value="22L2XEuVkyArsNxlWA9Eta0oPNeFipVYrysTArfC" autocomplete="off">
                </form> -->
              </ul>
            </li>
          </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
          <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">name</div>
            </div>
            </div>
          </script>
        <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
      </div>
    </div>