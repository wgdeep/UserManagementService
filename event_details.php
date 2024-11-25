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
  </style>

</head>

<body>
  <?php include('assets/include/header.php'); ?>


  <div class="breadcumb-wrapper" data-bg-src="assets/img/subpage-header-bg.jpg">
    <div class="container z-index-common">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title"><?php echo $rows['title'] ?></h1>
        <div class="breadcumb-menu-wrap">
          <ul class="breadcumb-menu">
            <li><a href="index.php"> Home</a></li>
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
                <img class="d-block w-100" src="./TechAdmin/data/event/banner/<?php echo $rows['banner_image'] ?>" alt="First slide">
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
                    <div class="media-img"><a href="event_details.php?url=<?php echo $data['url']; ?>"><img src="./TechAdmin/data/event/banner/<?php echo $data['banner_image'] ?>" alt="Blog Image"></a></div>
                    <div class="media-body">
                      <h4 class="post-title"><a class="text-inherit" href="event_details.php?url=<?php echo $data['url']; ?>"><?php echo $data['title'] ?></a></h4>

                      <div class="recent-post-meta"><a href="event_details.php?url=<?php echo $data['url']; ?>"><?php echo $data['date'] ?></a></div>
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