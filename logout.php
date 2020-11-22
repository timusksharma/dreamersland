<?php
session_start();

if(isset($_SESSION["id"]) AND isset($_SESSION["name"]) AND isset($_SESSION["email"]) AND isset($_SESSION["password"])){
	session_destroy();
	
}
if(isset($_COOKIE["id"]) AND isset($_COOKIE["name"]) AND isset($_COOKIE["email"]) AND isset($_COOKIE["password"]))
	{
	/*setcookie("id","",strtotime("+1 day"),"/","","",TRUE);
				setcookie("name","",strtotime("+1 day"),"/","","",TRUE);
				setcookie("email","",strtotime("+1 day"),"/","","",TRUE);
				setcookie("password","",strtotime("+1 day"),"/","","",TRUE);
	*/
	setcookie("id",$_COOKIE["id"],strtotime("-2 day"),"/","","",TRUE);
				setcookie("name",$_COOKIE["name"],strtotime("-2 day"),"/","","",TRUE);
				setcookie("email",$_COOKIE["email"],strtotime("-2 day"),"/","","",TRUE);
				setcookie("password",$_COOKIE["password"],strtotime("-2 day"),"/","","",TRUE);
				unset($_COOKIE["id"]);
				unset($_COOKIE["name"]);
				unset($_COOKIE["email"]);
				unset($_COOKIE["password"]);
				
	
	}
	header("location:login.php");

?>