<?php

include_once("./TechAdmin/include/config.php");

include_once("./TechAdmin/include/library.php");

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Society To Harmonise Aspirations for Responsible Engagement</title>
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
  <style>
    .space .align-self-center p {
      text-align: justify;
      font-size: 15px;
      font-weight: 500;
      color: #000;
      line-height: 1.3;
    }

    .space .align-self-center ul li {
      color: #000000;
      padding-bottom: 10px;
      font-weight: normal;
      font-size: 15px;
      line-height: 1.4;
    }
  </style>

</head>

<body>
  <?php include('assets/include/header.php'); ?>
  <div class="breadcumb-wrapper" data-bg-src="assets/img/subpage-header-bg.jpg">
    <div class="container z-index-common">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title">About Us</h1>
        <div class="breadcumb-menu-wrap">
          <ul class="breadcumb-menu">
            <li><a href="index.php">Home</a></li>
            <li>About Us</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <section class="space">
    <div class="container">

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


      $sql = "SELECT * FROM purpose ORDER BY id ASC LIMIT $page_index, $limit";

      $qry = mysqli_query($con, $sql);

     $data = mysqli_fetch_array($qry) 
      ?>
        <div class="row">
          <div class="col-lg-5 mb-40 mb-lg-0 wow fadeInUp" data-wow-delay="0.2s">
            <div class="img-box1">

              <div class="img-2"><img src="assets/img/about/about-1-2.jpg" alt="About image"></div>

            </div>
          </div>
          <div class="col-lg-7 align-self-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="sec-line"></div>
            <span class="sec-subtitle"><?php echo $data['sub_title'] ?></span>
            <h2 class="sec-title"><?php echo $data['title'] ?></h2>
            <?php
              echo $data['description'];
            ?>
          </div>
        </div>




    </div>
  </section>

  <?php include('assets/include/footer.php'); ?>

  <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/layerslider.utils.js"></script>
  <script src="assets/js/layerslider.transitions.js"></script>
  <script src="assets/js/layerslider.kreaturamedia.jquery.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>