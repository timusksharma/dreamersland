<?php
session_start();

$login_key = false;
class LoginStatus
{
	private $con;
	function __construct()
	{
		include_once("./database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}
	public function userLogin($id,$email,$password)
	{ $email = mysqli_real_escape_string($this->con,$email);
		$pre_stmt = $this->con->prepare("SELECT id FROM cust_info WHERE id = ? AND email = ? AND password = ? LIMIT 1");
		$pre_stmt->bind_param("iss",$id,$email,$password);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if($result->num_rows>0)
		{
			$login_date = date("Y-m-d H:i:s");
			$pre_stmt = $this->con->prepare("UPDATE cust_info SET last_login = ? WHERE id = ? AND email = ?");
			$pre_stmt->bind_param("sis",$last_login,$id,$email);
			$result = $pre_stmt->execute() or die($this->con->error);
			
			return true;
		}
		return false;
	}	
		
}

$login = new LoginStatus;
if(isset($_SESSION["id"]) AND isset($_SESSION["name"]) AND isset($_SESSION["email"]) AND isset($_SESSION["password"]))
{
	$id = preg_replace("#[^0-9]#","",$_SESSION["id"]);
	$email = $_SESSION["email"];
	$password = $_SESSION["password"];
	$login_key = $login->userLogin($id,$email,$password);
}	
else{
	if(isset($_COOKIE["id"]) AND isset($_COOKIE["name"]) AND isset($_COOKIE["email"]) AND isset($_COOKIE["password"]))
	{
		$_SESSION["id"] = preg_replace("#[^0-9]#","",$_COOKIE["id"]);
		$_SESSION["email"] = $_COOKIE["email"];
		$_SESSION["password"] = $_COOKIE["password"];
		$_SESSION["name"]=$_COOKIE["name"];
		$login_key = $login->userLogin($_SESSION["id"],$_SESSION["email"],$_SESSION["password"]);
	}
}



//$obj = new LoginStatus();$result->num_rows
//$obj->userLogin("alexoscar\x00940@gmail*.com");

?>

