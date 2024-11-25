<?php

include_once("./TechAdmin/include/config.php");

include_once("./TechAdmin/include/library.php");

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
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
  <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/fontawesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
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
  </style>
</head>

<body>
  <?php include('assets/include/header.php'); ?>
  <div class="breadcumb-wrapper" data-bg-src="assets/img/subpage-header-bg.jpg">
    <div class="container z-index-common">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title">People</h1>
        <div class="breadcumb-menu-wrap">
          <ul class="breadcumb-menu">
            <li><a href="index.php">About Us</a></li>
            <li>People</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <section class="space-top space-extra-bottom">
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


      $sql = "SELECT * FROM people ORDER BY id ASC LIMIT $page_index, $limit";

      $qry = mysqli_query($con, $sql);

      while ($data = mysqli_fetch_array($qry)) {
      ?>
        <div class="row justify-content-center">
          <div class="col-xl-12 wow fadeInUp wow-animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <div class="team-box">
              <div class="team-box__shape"></div>
              <div class="team-box__img"><img src="TechAdmin/data/people/<?php echo $data['image'] ?>"></div>
              <!-- <div class="team-box__img"><img src="assets/img/team/R.-K.-Mathur.jpg"></div> -->
              <div class="media-body">
                <h2 class="team-box__name">
                  <?php echo $data['title'] ?>
                </h2>
                <span class="team-box__degi"> <?php echo $data['post1'] ?><br> <?php echo $data['post2'] ?> </span>
                <p class="team-box__text">
                  <?php
                  $decodedDescription = html_entity_decode($data['description']);
                  $cleanedDescription = strip_tags($decodedDescription);

                  echo $cleanedDescription;
                  ?>
                </p>
                <a href="mailto:<?php echo $data['mail'] ?>" class="team-box__mail"><?php echo $data['mail'] ?></a>


              </div>
            </div>
          </div>
        </div>
      <?php  }   ?>
    </div>

    <div class="row">
      <div class="col-xs-12 text-center">
        <div class="heading mt-75" style="margin-top: 30px;">

          <?php

          $all_data = mysqli_query($con, "select count(*) from people");
          $user_count = mysqli_fetch_row($all_data);   // say total count 9  
          $total_records = $user_count[0];   //9
          $total_pages = ceil($total_records / $limit);    // 9/3=  3
          if ($page >= 2) {
            echo "<a href='people.php?page=" . ($page - 1) . "' class='btn  customBtn2'>Previous</a>";
          }

          if ($page < $total_pages) {
            echo " <a href='people.php?page=" . ($page + 1) . "' class='btn customBtn2'>NEXT</a>";
          }

          ?>
        </div>
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