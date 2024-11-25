
<?php $uriSegments = end(explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))); ?>

<style type="text/css">

.pal20{ padding-left: 20px !important;}

.active{ font-weight: 600;color: #ffb115 !important;}  

.sidebar .metismenu .pal20 a::before{    background-color: #2b2e33!important;}

</style>

<div id="leftsidebar" class="sidebar">

  <div class="sidebar-scroll">

    <nav id="leftsidebar-nav" class="sidebar-nav">

      <ul id="main-menu" class="metismenu">

        

		<li class="tab081"> <a href="event.php"><i class="icon-settings"></i><span> Manage Event  </span></a></li>
		<li class="tab081"> <a href="publication.php"><i class="icon-settings"></i><span> Manage Publications  </span></a></li>

        <li><a href="logout.php" class="icon-menu"> <i class="icon-settings"></i> <span>Logout</span></a></li> 

      </ul>

    </nav>

  </div>

</div>

</div>

