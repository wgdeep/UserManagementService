<?php
require_once("include/config.php");
require_once("include/library.php");
if (empty($_SESSION['adminID']) && ($_SESSION['adminName'] == "")) {
    header("location:index.php");
    exit();
  }
$_SESSION['adminID'] = '';
$_SESSION['adminName'] = '';
session_destroy();	
?>
<script language="javascript">window.location.href=('index.php');</script>
<?php exit; ?>



