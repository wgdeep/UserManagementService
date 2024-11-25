<?php
include_once("./TechAdmin/include/config.php");

include_once("./TechAdmin/include/library.php");

$error = '';

if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Add Form") {
  if (!empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['phone']) && !empty($_REQUEST['message'])) {
    addFormReport($con, $_REQUEST, $error);
  }
}
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/fontawesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <?php include('assets/include/header.php'); ?>
  <style>
    @media (min-width: 1200px) {
      .container {
        width: 1290px;
      }
    }

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

    .service-box-list {
      padding: 20px 20px 50px;
      max-width: 100%;
      min-height: 300px;
    }
  </style>



  <div class="breadcumb-wrapper" data-bg-src="assets/img/subpage-header-bg.jpg">
    <div class="container z-index-common">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title">Reports</h1>
        <div class="breadcumb-menu-wrap">
          <ul class="breadcumb-menu">
            <li><a href="index.php">Home</a></li>
            <li>Reports</li>
          </ul>
        </div>
      </div>
    </div>
  </div>


  <section class="vs-blog-wrapper space-top space-extra-bottom">
    <div class="container">
      <div class="row pb-10">

        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">

          <?php
          $sql = "SELECT * FROM report ORDER BY id ASC";

          $qry = mysqli_query($con, $sql);

          while ($data = mysqli_fetch_array($qry)) {
          ?>
            <a href="#" data-toggle="modal" data-target="#myModal"> <img src="TechAdmin/data/report/image/<?php echo $data['image'] ?>" width="100%" /> </a>
          <?php  }   ?>

        </div>        
        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
<!-- 
        <form action="" method="POST">
            <div class="row gx-20">
              <div class="col-md-12 form-group">
                <input type="text" placeholder="Your Name" id="name" name="name" class="form-control style4" required>
              </div>
              <div class="col-md-12 form-group">
                <input type="email" placeholder="Your Email" id="email" name="email" class="form-control style4" required>
              </div>
              <div class="col-md-12 form-group">
                <input type="number" placeholder="Phone No" id="phone" name="phone" class="form-control style4" required>
              </div>
              <div class="form-group col-12">
                <textarea placeholder="Message" id="message" name="message" class="form-control style4" required></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit" value="Add Form" style="margin-bottom: 20px;">Add Form</button>
              </div>
            </div>
          </form> -->

        </div>
      </div>
    </div>
    </div>
  </section>

  <!-- https://itcodetech.com/projects/assets/SHARE_Recommendations_BD.pdf -->

  <div id="myModal" class="modal modal-md fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Download report</h4>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <div class="row gx-20">
              <div class="col-md-12 form-group">
                <input type="text" placeholder="Your Name" id="name" name="name" class="form-control style4" required>
              </div>
              <div class="col-md-12 form-group">
                <input type="email" placeholder="Your Email" id="email" name="email" class="form-control style4" required>
              </div>
              <div class="col-md-12 form-group">
                <input type="number" placeholder="Phone No" id="phone" name="phone" class="form-control style4" required>
              </div>
              <div class="form-group col-12">
                <textarea placeholder="Message" id="message" name="message" class="form-control style4" required></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit" value="Add Form" style="margin-bottom: 20px;">Add Form</button>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>


  <?php include('assets/include/footer.php'); ?>

  <!-- Modal -->


  <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/layerslider.utils.js">
  </script>
  <script src="assets/js/layerslider.transitions.js"></script>
  <script src="assets/js/layerslider.kreaturamedia.jquery.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>