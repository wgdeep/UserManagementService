<?php

include_once("./TechAdmin/include/config.php");

include_once("./TechAdmin/include/library.php");



?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Society To Harmonise Aspirations for Responsible Engagement | Events</title>
  <meta name="author" content="Web Godam">
  <meta name="description" content="Society for Harmonising Aspirations for Responsible Engagement">
  <meta name="keywords" content="Society for Harmonising Aspirations for Responsible Engagement">
  <meta name="robots" content="INDEX,FOLLOW">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
  <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/fontawesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <?php include('assets/include/header.php'); ?>
  <style>
    .blog-body {
      color: #fff;
      font-size: 16px;
      line-height: 30px;
    }

    .blog-style2 .blog-title {
      font-size: 18px;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .blog-style2 .blog-meta a {
      color: #000;
      display: inline-block;
      font-size: 16px;
      margin-right: 10px;
      font-weight: 500;
    }

    .color_white {
      color: #000;
      text-align: justify;
    }

    .color_white:hover {
      color: #fff;
    }

    .color_white:focus {
      color: #fff;
    }

    .blog-style2 .blog-meta a {
      color: #000;
      font-size: 15px;
    }

    .blog-style2 .blog-body {
      padding: 10px;
    }

    .blog-style2 .blog-img {

      border: 1px solid #e5e1e1;
      box-shadow: 1px 2px 10px #b9b6b6;
    }
  </style>



  <div class="breadcumb-wrapper" data-bg-src="assets/img/subpage-header-bg.jpg">
    <div class="container z-index-common">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title">Events</h1>
        <div class="breadcumb-menu-wrap">
          <ul class="breadcumb-menu">
            <li><a href="index.php">Home</a></li>
            <li>Events</li>
          </ul>
        </div>
      </div>
    </div>
  </div>


  <section class="vs-blog-wrapper space-top space-extra-bottom">
    <div class="container">
      <div class="row">
        <div class="row pb-10">
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


            <div class="col-md-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
              <div class="vs-blog blog-style2 layout2">
                <div class="blog-img"><a href="event_details.php?url=<?php echo $data['url']; ?>"><img src="./TechAdmin/data/event/banner/<?php echo $data['banner_image'] ?>" alt="Blog Image" class="w-100"></a></div>

                <div class="blog-body">
                  <div class="blog-date">
                    <a href="event_details.php?url=<?php echo $data['url']; ?>"><?php echo $data['date'] ?></a>
                  </div>

                  <div class="blog-content">

                    <h3 class="blog-title h5">
                      <a href="event_details.php?url=<?php echo $data['url']; ?>"><?php echo $data['title'] ?></a>
                    </h3>

                    <div class="blog-meta">
                      <a href="event_details.php?url=<?php echo $data['url']; ?>"><i class="fas fa-user"></i> Presented By SHARE </a>
                      <a href="event_details.php?url=<?php echo $data['url']; ?>"><i class="fas fa-location"></i><?php echo  $data['venue'] ?></a>
                    </div>


                    <a href="event_details.php?url=<?php echo $data['url']; ?>" class="icon-btn style4"><i class="far fa-long-arrow-right"></i></a>

                  </div>

                </div>

              </div>
            </div>



          <?php  }   ?>
        </div>



      </div>
  </section>


  <?php include('assets/include/footer.php'); ?>

  <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/layerslider.utils.js">
  </script>
  <script src="assets/js/layerslider.transitions.js"></script>
  <script src="assets/js/layerslider.kreaturamedia.jquery.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>