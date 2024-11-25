<?php
class db {
function db(){
	ini_set('display_errors', 0);
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	if($_SERVER['HTTP_HOST']=="localhost")
	{
		define('DB_HOST','localhost');
   		define('DB_DATABASE', 'amerisafe');
    	define('DB_USERNAME', 'root');//root
    	define('DB_PASSWORD', '');
		define('SITE_ROOT','http://localhost/amerisafe');
	}
	else
	{
		define('DB_HOST','localhost');
   		define('DB_DATABASE', 'amerisaf_demo');
    	define('DB_USERNAME', 'amerisaf_demo');//root
    	define('DB_PASSWORD', 'ajit!@#$1234');
		define('SITE_ROOT','https://amerisafe.online/demo/');
	}  
}
function runquery($tbl,$condition,$sort=''){
		$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		 $runedquery= $mysqli->query("select * from ".$tbl." ".$condition." ".$sort );
		return $runedquery;
}
function runjoinquery($q){
		$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		 $runedquery= $mysqli->query($q);
		return $runedquery;
}
function noofrow($runningsql){
		$row=$runningsql->num_rows;
		return $row;
}
function recordobject($runningsql)
	{
	$recordob=	mysql_fetch_object($runningsql);
	return $recordob;
	}
function recordarray($runningsql)
	{
		$recordarr=	$runningsql->fetch_array(MYSQLI_BOTH);
	return $recordarr;
	}
function uploadfile($src,$desi)
	{
	$uploadfile =	move_uploaded_file($src, $desi);;
	return $uploadfile;
	}
################### Some useful functions ####################
function getSeoURL($url)
{
	$url = str_replace(" ","-",$url);
	$url = str_replace("_","-",$url);
	$url = preg_replace('/[^a-z0-9-]*/i','',$url);
	return strtolower($url);
}
}
define('SYMB', '$ ');

?>