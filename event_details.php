<?php

include_once("./TechAdmin/include/config.php");

include_once("./TechAdmin/include/library.php");

if (isset($_GET['url'])) {
  $event_url = $_GET['url'];
  $sql = "select * FROM `event` where url='" . $event_url . "'";
  $run = mysqli_query($con, $sql);
  $rows = mysqli_fetch_assoc($run);
}

?>



<!doctype html>


<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Society To Harmonise Aspirations for Responsible Engagement | About Us</title>
  <meta name="author" content="Web Godam">
  <meta name="description" content="Society for Harmonising Aspirations for Responsible Engagement">
  <meta name="keywords" content="Society for Harmonising Aspirations for Responsible Engagement">
  <meta name="robots" content="INDEX,FOLLOW">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
  <link rel="icon" href="../assets/img/favicon.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/app.min.css">
  <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">

  <style>
    .team-box__name {
      margin-bottom: 0px;
    }

    .team-box__degi {
      line-height: 1.3;
      display: block;
      margin-bottom: 12px;
      text-transform: capitalize;
    }

    .team-box__text {
      text-align: justify;
      line-height: 1.4;
    }

    .blog-content p {
      text-align: justify !important;
      padding-top: 20px;
    }

    .blog-style4 .share-links:after,
    .blog-style4:after {
      background-color: #97ae9b00;
    }

    .space-extra,
    .space-extra-bottom {
      padding-bottom: 0px;
      padding-top: 0px;
    }

    .breadcumb-title {
      font-size: 42px;
      margin-top: 30px;
    }

    .header-logo img {
      max-width: 420px;
      height: auto;
      margin-top: -70px;
    }

    .footer-layout2 .footer-top {
      padding-bottom: 320px;
      margin-bottom: -305px;
    }

    .newsletter-style1 p {
      color: #ffffff;
      margin-top: -30px;
      position: relative;
    }

    .ls-custom-arrow {
      display: none;
    }

    .latest-box {
      width: 100%;
      max-width: 377px;
      height: 400px;
      position: absolute;
      z-index: 9999;
      background: #fff;
      bottom: -250px;
      right: 28px;
      border-radius: 25px;
    }


    .latest-box h4 {
      font-size: 26px;
      text-align: center;
      margin-top: 25px;
    }

    .vs-header .vs-btn,
    .vs-btn.ls-vs-btn {
      background-color: #07a4a2;
    }

    .team-box__shape {
      background-color: #07a4a2;
    }

    .team-box__img {
      width: 250px;
      height: 250px;
    }
  </style>

</head>

<body>
  <div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
      <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
      <div class="mobile-logo"><a href="/projects/index.php"><img src="../assets/img/logo-2.png" alt="SHARE"></a></div>
      <div class="vs-mobile-menu">

        <ul>
          <li class="menu-item-has-children"><a href="/projects/index.php"><span class="has-new-lable">Home</span></a> </li>
          <li class="menu-item-has-children"><a href="/projects/purpose.php">About Us</a>
            <ul class="sub-menu">
              <li><a href="/projects/purpose.php">Purpose</a></li>
              <li><a href="/projects/people.php">People</a></li>
            </ul>
          </li>
          <li class="menu-item-has-children"><a href="/projects/event.php"><span class="has-new-lable">Events</span></a> </li>
          <li class="menu-item-has-children"><a href="/projects/publications.php">Publications & News</a></li>
          <li class="menu-item-has-children"><a href="/projects/reports.php">Reports</a></li>
          <li class="menu-item-has-children"><a href="/projects/contact_us.php">Contact us</a></li>
        </ul>
      </div>
    </div>
  </div>
  <header class="vs-header header-layout2">
    <div class="header-top">
      <div class="container">
        <div class="row justify-content-between align-items-center">
          <div class="col d-none d-lg-block">
            <div class="header-links">
              <ul>
                <!--li><i class="fal fa-envelope-open-text"></i><a href="mailto:office@theshare.in">office@theshare.in</a></li>
              <li><i class="far fa-map-marker-alt"></i>Noida, Uttar Pradesh.</li-->
              </ul>
            </div>
          </div>
          <!--div class="col-auto">
          <div class="header-dropdown"><a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-globe"></i>English</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
              <li><a href="#">German</a> <a href="#">French</a> <a href="#">Italian</a> <a href="#">Latvian</a> <a href="#">Spanish</a> <a href="#">Greek</a></li>
            </ul>
          </div>
        </div-->
          <div class="col-auto">
            <div class="header-social"><span class="social-label">Get In Touch:</span>
              <a href="https://www.facebook.com/profile.php?id=61564442941071" target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a href="https://www.linkedin.com/company/share-society-to-harmonise-aspirations-for-responsible-engagement/posts/?feedView=all" target="_blank"><i class="fab fa-linkedin"></i></a>
              <!--a href="#"><i class="fab fa-youtube"></i></a> 
          	<a href="#"><i class="fab fa-instagram"></i></a-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="sticky-wrapper">
      <div class="sticky-active">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-auto">
              <div class="header-logo"><a href="/projects/index.php"><img src="../assets/img/logo.png" alt="SHARE"></a></div>
            </div>
            <div class="col-auto col-xl text-xl-center">
              <nav class="main-menu menu-style1 d-none d-lg-block">
                <ul>
                  <li><a href="/projects/index.php"><span class="has-new-lable">Home</span></a> </li>
                  <li><a href="/projects/purpose.php">About Us</a>
                    <ul class="sub-menu">
                      <li><a href="/projects/purpose.php">Purpose</a></li>
                      <li><a href="/projects/people.php">People</a></li>
                    </ul>
                  </li>
                  <li><a href="/projects/event"><span class="has-new-lable">Events</span></a> </li>
                  <li><a href="/projects/publications.php">Publications & News</a></li>
                  <li><a href="/projects/reports.php">Reports</a></li>
                </ul>
              </nav>
              <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fal fa-bars"></i></button>
            </div>

            <div class="col-auto d-none d-xl-block"><a href="/projects/contact_us.php" class="vs-btn">Contact Us</a></div>
          </div>
        </div>
      </div>
    </div>
  </header>


  <div class="breadcumb-wrapper" data-bg-src="../assets/img/subpage-header-bg.jpg">
    <div class="container z-index-common">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title"><?php echo $rows['title'] ?></h1>
        <div class="breadcumb-menu-wrap">
          <ul class="breadcumb-menu">
            <li><a href="/projects/index.php"> Home</a></li>
            <li>Events</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <section class="vs-blog-wrapper blog-wrap1 space-top space-extra-bottom">
    <div class="container">

      <div class="row gx-xl-5 gx-50">

        <div class="col-lg-8">


          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="../TechAdmin/data/event/banner/<?php echo $rows['banner_image'] ?>" alt="First slide">
              </div>



            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>


          <div class="blog-content">


            <?php echo $rows['description']  ?>


          </div>




        </div>




        <div class="col-lg-4">
          <aside class="sidebar-area sidebar-style2">

            <div class="widget">
              <h3 class="widget_title">latest updates </h3>
              <div class="recent-post-wrap">




                <?php
                $limit = 12;  //set  Number of entries to show in a page.
                // Look for a GET variable page if not found default is 1.        
                if (isset($_GET["page"])) {
                  $page  = $_GET["page"];
                } else {
                  $page = 1;
                }
                //determine the sql LIMIT starting number for the results on the displaying page  
                $page_index = ($page - 1) * $limit;      // 0

                $sql = "SELECT * FROM event limit $page_index, $limit  ";
                $qry = mysqli_query($con, $sql);

                while ($data = mysqli_fetch_array($qry)) {
                ?>


                  <div class="recent-post">
                    <div class="media-img"><a href="/projects/event/<?php echo urlencode($data['url']); ?>"><img src="../TechAdmin/data/event/banner/<?php echo $data['banner_image'] ?>" alt="Blog Image"></a></div>
                    <div class="media-body">
                      <h4 class="post-title"><a class="text-inherit" href="/projects/event/<?php echo urlencode($data['url']); ?>"><?php echo $data['title'] ?></a></h4>

                      <div class="recent-post-meta"><a href="/projects/event/<?php echo urlencode($data['url']); ?>"><?php echo $data['date'] ?></a></div>
                    </div>
                  </div>



                <?php  }   ?>





              </div>
            </div>

          </aside>
        </div>

      </div>


    </div>


    </div>
    </div>
  </section>


  <footer class="footer-wrapper footer-layout2">
    <div class="footer-top" data-bg-src="../assets/img/bg/footer-bg-1-2.jpg">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-10 col-xl-8">
            <div class="newsletter-style1">
              <div class="newsletter-icon"><i class="fal fa-envelope-open-text"></i></div>
              <p>We appeal to you to join hands with us and be an active stakeholder in this journey of growth, inclusiveness and societal harmonisation by being an esteemed patron of SHARE and help us build our corpus to fulfill this joint aspiration.</p>
            </div>
            <div class="footer_res_dis"> <a href="mailto:office@theshare.in" class="footer-mail">office@theshare.in</a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="widget-area">
        <div class="row justify-content-between">
          <div class="col-xl-4">
            <div class="widget footer-widget">
              <div class="footer-about">
                <div class="copyright-logo"><a href="/projects/index.php"><img src="../assets/img/logo-dark.png" alt="logo" style="max-width:280px;"></a></div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="widget widget_nav_menu footer-widget">
              <h3 class="widget_title">Quicks Links</h3>
              <div class="row">
                <div class="col-auto">
                  <div class="menu-all-pages-container">
                    <ul class="menu">
                      <li><a href="/projects/index.php">Home</a></li>
                      <li><a href="/projects/event">Events</a></li>
                      <li><a href="/projects/purpose.php">Purpose</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="menu-all-pages-container">
                    <ul class="menu">
                      <li><a href="/projects/people.php">People</a></li>
                      <li><a href="/projects/publications.php">Publications</a></li>
                      <li><a href="/projects/contact_us.php">Contact Us</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="widget footer-widget">
              <h3 class="widget_title">Contact Us</h3>
              <div class="footer-about">

                <a href="mailto:office@theshare.in" class="footer-mail">office@theshare.in</a>
              </div>
              <div class="header-social">
                <a href="https://www.facebook.com/profile.php?id=61564442941071" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.linkedin.com/company/share-society-to-harmonise-aspirations-for-responsible-engagement/posts/?feedView=all" target="_blank"><i class="fab fa-linkedin"></i></a>
                <!--a href="#"><i class="fab fa-youtube"></i></a> 
            <a href="#"><i class="fab fa-instagram"></i></a-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright-wrap">
      <div class="container">
        <div class="row align-items-center justify-content-between">

          <div class="text-center col-lg-auto">
            <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> 2024 <a href="#">The SHARE</a> - All Rights Reserved By <a href="https://www.webgodam.com" target="_blank">WG</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a href="javascript:void(0)" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>

  <script src="../assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/js/layerslider.utils.js">
  </script>
  <script src="../assets/js/layerslider.transitions.js"></script>
  <script src="../assets/js/layerslider.kreaturamedia.jquery.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>