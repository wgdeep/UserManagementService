<?php
require_once("include/config.php");
require_once("include/library.php");
if (empty($_SESSION['ID']) && ($_SESSION['Name'] == "")) {
    header("location:login.php");
    exit();
  }
  $inactiveQry = mysqli_query($con, "update user set status = '0' where id = '".$_SESSION['ID']."'");
$_SESSION['ID'] = '';
$_SESSION['Name'] = '';
session_destroy();	
?>
<script language="javascript">window.location.href=('login.php');</script>
<?php exit; ?>
