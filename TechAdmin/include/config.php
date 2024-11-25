<?php
error_reporting(0);
ob_start();
session_start();
date_default_timezone_set('Asia/Kolkata');

	define("HOST","localhost");
	define("USER","root");
	define("PASSWORD","");
	define("DATABASE","itcodetech_stlaw");

	$con = mysqli_connect(HOST,USER,PASSWORD,DATABASE);
	if(mysqli_connect_errno())
	{
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$wwwroot = "/projects/TechAdmin";
	$create_u = 'user_add';
	$view_u = 'user_show';
	$update_u = 'user_edit';
	$delete_u = 'user_remove';

	
	
function input($str)
{
 return trim(addslashes($str));
}

function output($str)
{
 return stripslashes($str);
}

function siri_drawNavigation($start,$total,$link)
{
	if(($start%100)==0)
	 {
	  $j=$start/10+1;
	 } 
	else if($start/100>=1){
	  $j=intval(($start/100))*10+1;
	 }
	 else
	 {
	 $j=1;
	 }
	 if((intval($start/100))>1)
	 {
	 $temp=intval(($start/100-1))*10*10;
	 }
	global $len; 
	$check=$total%$len;
	if($check >=1 ) $lim=intval(($total/$len))+1;
	else
	$lim=intval($total/$len);
	print '<div style="text-aling:center;">';
	$en = $start +$len;
	if($start==0){
	  if($total>0){
		 $start1=1;
	  }
	  else {
		$start1=0;
	  }
	}
	else {
	 $start1=$start+1;
	}
	if($en>$total)
	$en = $total;
	print "<font face=Verdana, Arial, Helvetica, sans-serif size=0 class='links1'>Showing  $start1  -  $en       of  $total   &nbsp;&nbsp;&nbsp;<a href='$link&start=0'>Go to First Record</a> &nbsp;&nbsp;</font><font face=Verdana, Arial, Helvetica, sans-serif size=1 class='links1'>" ; 
	
	if($en>$len)
	{
	$en1=$start-$len;
	
	print "<a href='$link&start=$en1' class='links1'>Previous</a>" ;
	}
	else
	print "Previous";
	print "</font>";
	
	$temp1=1;
			
	
	print "&nbsp;&nbsp;&nbsp;&nbsp;<font face=Verdana, Arial, Helvetica, sans-serif size=1 class='links1'>" ; 
	if($en<$total){
	$en2=$start+$len;
	print "<a href='$link&start=$en2' class='links1'>Next</a>" ;
	}
	else
	print "Next";
	print "</font></div>";
}
  




$expireAfter = 30;


if(isset($_SESSION['last_action'])){

    $secondsInactive = time() - $_SESSION['last_action'];
    

    $expireAfterSeconds = $expireAfter * 60;
    

    if($secondsInactive >= $expireAfterSeconds){

        session_unset();
        session_destroy();
    }
    
}


$_SESSION['last_action'] = time();
?>


