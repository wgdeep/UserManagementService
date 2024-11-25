<?php
class login{
function login(){
$this->db = new db;
}
function checklogin($user,$pass,$loginas)
{
  	$pass=md5($pass);
  	if($loginas=='a')
  	{
  		$condition = "where admin_email ='$user' and admin_password = '$pass'";
		$tbl       = 'admin';
		$idfld     = 'admin_id';
	}
	if($loginas !='a')
	{
  		$condition = "where user_email ='$user' AND user_password = '$pass' AND user_status ='Active'";
		$tbl       = 'backend_office_users';
		$idfld     = 'user_id';
	}
	/*
	if($loginas=='u')
	{
  		$condition="where user_email ='$user' and user_password = '$pass'";
		$tbl='backend_office_users';
		$idfld='user_id';
	}
	*/
	$reecord         = $this->db->runquery($tbl,$condition,'');
	$noofaffectedrow = $this->db->noofrow($reecord);
	if($noofaffectedrow >=1)
	{
		$getrecords     = $this->db->recordarray($reecord);
		$rolecondition  = "where user_type =".$getrecords[$idfld];
		$rolereecord    = $this->db->runquery('backend_office_roles',$rolecondition,'');
		$mainmenugetrolerecords=array();
		$submenugetrolerecords=array();
		while ($we=$this->db->recordarray($rolereecord)) {
			# code...
			$mainmenugetrolerecords[] = $we['main_menus'];
			$submenugetrolerecords[] = $we['sub_menus'];

		}
		

		$_SESSION['login']   = $user;
		$_SESSION['userid']   = $getrecords[$idfld];
		$_SESSION['loginid'] = $getrecords[$idfld];
		$_SESSION['loginas'] = $loginas;
		$_SESSION['mainmenu'] = $mainmenugetrolerecords;
		$_SESSION['submenu'] = $submenugetrolerecords;
		  header('Location: admin_page.php');  
	
		exit;
	}
	else
	{
	  header("Location: index.php?msg=m");
	  exit;
	}
}

function checksession()
{
	if(!isset($_SESSION['login']))
	   {
		 header('Location: index.php?l=2');
		 exit;
	   }
}

function logout(){
		session_destroy();
		session_unset($_SESSION["login"]);
		return 1;
}

function check_access_permission_level($accescode,$mno){	
	if(isset($_SESSION['loginas']) && $_SESSION['loginas']=='a'){
		$rval=1;
	}else{			
		    $mc="where id=".$accescode;
			$checkactsql = $this->db->runquery('backend_office_role_setting',$mc,'');
			$checkleftrs=$this->db->recordarray($checkactsql);
			$gh=$_SESSION['loginas'].'_permission';
		    $main_role=$checkleftrs[$gh];
			$main_role_array=explode(',',$main_role);
			if (in_array($mno, $main_role_array)) {  $rval=1; }	else  {  $rval=0; }
	}
	return $rval;
}



function check_main_menu_role($mno){	
	if(isset($_SESSION['loginas']) && $_SESSION['loginas']=='a'){
		$rval=1;
	}else{			
		    $main_role=$_SESSION['login_member_role']['main_menus'];
			$main_role_array=explode(',',$main_role);
			if (in_array($mno, $main_role_array)) {  $rval=1; }	else  {  $rval=0; }
	}
	return $rval;
}

function check_sub_menu_role($mno){	
	if(isset($_SESSION['loginas']) && $_SESSION['loginas']=='a'){
		$rval=1;
	}else{			
		    $main_role=$_SESSION['login_member_role']['sub_menus'];
			$main_role_array=explode(',',$main_role);
			if (in_array($mno, $main_role_array)) {  $rval=1; }	else  {  $rval=0; }
	}
	return $rval;
}

function check_role_permission($mno){	
	if(isset($_SESSION['loginas']) && $_SESSION['loginas']=='a'){
		$rval=1;
	}else{			
		    $main_role=$_SESSION['login_member_role']['sub_menu_features'];
			$main_role_array=explode(',',$main_role);
			if (in_array($mno, $main_role_array)) {  $rval=1; }	else  {  $rval=0; }
	}
	return $rval;
}

}

?>
