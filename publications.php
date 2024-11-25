<?php

include_once("./TechAdmin/include/config.php");

include_once("./TechAdmin/include/library.php");

?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Society To Harmonise Aspirations for Responsible Engagement | Publications</title>
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
	<style>
		.sec-title2 {
			font-size: 25px !important;
		}

		.about-text1 {
			line-height: 24px;
		}

		.sec-pills {
			color: #1e2b56;
		}

		.date_content {
			font-weight: 600;
		}

		.date_content span {
			color: #ff3f00;
			font-weight: 600;
		}
	</style>
	<?php include('assets/include/header.php'); ?>

	<div class="breadcumb-wrapper" data-bg-src="assets/img/subpage-header-bg.jpg">
		<div class="container z-index-common">
			<div class="breadcumb-content">
				<h1 class="breadcumb-title">Publications</h1>
				<div class="breadcumb-menu-wrap">
					<ul class="breadcumb-menu">
						<li><a href="index.html">Home</a></li>
						<li>Publications</li>
					</ul>
				</div>
			</div>
		</div>
	</div>


	<section class="space">
		<div class="container">


			<!--------------publications------------------------>
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

			
			$sql = "SELECT * FROM publication ORDER BY display_order ASC LIMIT $page_index, $limit";

			$qry = mysqli_query($con, $sql);

			while ($data = mysqli_fetch_array($qry)) {
			?>
				<div class="row gx-60 pt-5">

					<div class="col-xl-4 mb-30 mb-xl-0 wow fadeInUp" data-wow-delay="0.3s">
						<div class="img-box5">
							<div class="img-1"> <a href="<?php echo $data['url'] ?>" target="_blank"><img src="./TechAdmin/data/publication/banner/<?php echo $data['banner_image'] ?>" alt="bangladesh-protest "> </a></div>
							<div class="shape-1"></div>
						</div>
					</div>

					<div class="col-xl-8 wow fadeInUp" data-wow-delay="0.4s">

						<div class="space_content">
							<div class="sec-pills">
								<div class="date_content"><?php echo $data['media'] ?> <span> <?php echo $data['date'] ?></span> </div>
							</div>
							<a href="<?php echo $data['url'] ?>" target="_blank">
								<span class="sec-subtitle3"><?php echo $data['venue'] ?> </span>
								<h2 class="sec-title2 mb-2 mb-xxl-3 pb-1"> <?php echo $data['title'] ?></h2>

								<p class="about-text1 mb-xxl-4 pb-2"><?php echo $data['description'] ?></p>
							</a>
							<div class="row align-items-center justify-content-end flex-row-reverse mt-4 mt-xxl-5">
								<div class="col-sm-auto"><a href="<?php echo $data['url'] ?>" target="_blank" class="vs-btn style7">read More</a></div>
							</div>
						</div>

					</div>

				</div>
			<?php  } 	?>
			<!--------------publications----------------------->



			<!--  -->
			</div>


			<div class="row">
				<div class="col-xs-12 text-center">
					<div class="heading mt-75" style="margin-top: 30px;">

						<?php

						$all_data = mysqli_query($con, "select count(*) from publication");
						$user_count = mysqli_fetch_row($all_data);   // say total count 9  
						$total_records = $user_count[0];   //9
						$total_pages = ceil($total_records / $limit);    // 9/3=  3
						if ($page >= 2) {
							echo "<a href='publications.php?page=" . ($page - 1) . "' class='btn  customBtn2'>Previous</a>";
						}

						if ($page < $total_pages) {
							echo " <a href='publications.php?page=" . ($page + 1) . "' class='btn customBtn2'>NEXT</a>";
						}

						?>
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