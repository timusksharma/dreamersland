<?php
session_start();

include_once("../database/constants.php");
include_once("user.php");

//For Login Processing
if(isset($_POST["log_e"]) AND isset($_POST["log_p"])){
	$user = new User();
	$table="cust_info";
	$result = $user->userLogin($table,strtolower($_POST["log_e"]),$_POST["log_p"]);
	echo $result;
	
	exit();
}
//verify Email
if(isset($_POST["check_email"])){
	$user = new User();
	$table="cust_info";
	
	$result = $user->emailExists($table,$_POST["email"]);
	echo $result;
	exit();
}
//verify Mobile
if(isset($_POST["check_mob"])){
	$user = new User();
	$table="cust_info";
	
	$result = $user->mnoExists($table,$_POST["mno"]);
	echo $result;
	exit();
}


//For Registeration processing
if(isset($_POST["u_name"]) AND isset($_POST["email"])){
	$user = new User();
	$table="cust_info";
	$act_code = time().md5($_POST["email"]).rand(50000,1000000);
	$act_code = str_shuffle($act_code);
	$result = $user->createUserAccount($table,trim($_POST["u_name"]),strtolower(trim($_POST["email"])),$_POST["pass"],trim($_POST["mno"]),$act_code);
//	echo $result;
	
	
	if($result>0){
		
		$username = explode("@",$_POST["email"]);
		$userdir=$username[0];
		if(!file_exists("../user/$userdir".$result)){
		mkdir("../user/$userdir".$result,0755);
		}
		
		if ($user->send_activation_code($_POST["email"],$act_code,$result))
		{
			//echo "email_send_success";
			exit();
		}
		
		}
	
	exit();
}



?>