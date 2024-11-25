<?php
session_start();
include("connection_db.php");

include("loginlogout.php");

include("add_update_delete_changestatus.php");
include("pagination.php");
$indb = new db;
function productcategoryname($id){
$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect to the database");
$prodname=mysqli_fetch_array(mysqli_query($connection,"select product_title from product where id='".$id."'"),MYSQLI_BOTH);
$categoryname=$prodname['product_title'];
return $categoryname;
}
function vendorname($id){
$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect to the database");
$vendorname=mysqli_fetch_array(mysqli_query($connection,"select vendor_title from vendor where id='".$id."'"),MYSQLI_BOTH);
$vendorname=$vendorname['vendor_title'];
return $vendorname;
}

function getFileName($url)
{
	$url = str_replace(" ","-",$url);
	$url = str_replace("_","-",$url);
	$url = preg_replace('/[^a-z0-9.-]*/i','',$url);
	return strtolower($url);
}

function generate_password( $length = 12 )
{
//$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $password = substr(str_shuffle($chars),0,$length );
  return $password;
}

function clean($string)
{
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   return strtolower(preg_replace('/-+/', '-',$string)); // Replaces multiple hyphens with single one.
}
?>