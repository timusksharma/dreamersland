<?php


class verify_email
{
	private $con;
	function __construct()
	{
		include_once("./database/db.php");
		$db = new Database();
		$this->con = $db->connect();
		
	}
	public function activation($email,$act,$id){
		$pre_stmt = $this->con->prepare("SELECT u_nme,act_status FROM cust_info WHERE (id=? AND email =? AND act_code =?) LIMIT 1");
		$pre_stmt->bind_param("iss",$id,$email,$act);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$row = $result->fetch_assoc();
		$name =	$row["u_nme"];
		$status = $row["act_status"];
		//here we will check if user is already activated
		//here we will check database column activated if it is 0 means user is not activated
		if($status == '0')
		{
		  $x = $this->con->prepare("UPDATE cust_info SET act_status = '1' WHERE email =? AND id=? ");
		  $x->bind_param("si",$email,$id);
		  $x->execute() or die($this->con->error);
		  echo $name."  Your Account is Activated Successfull..!"; 
		  exit();
		}
		else if($status == '1'){
		echo $name."  your account is Already Activated..!";
	}
		
	}
}
if(isset($_REQUEST["ACTIVATION_CODE"]) AND isset($_REQUEST["uid"])AND isset($_REQUEST["ue"])){
	$uid = $_REQUEST["uid"];
	$ue = $_REQUEST["ue"];
	$act_code = $_REQUEST["ACTIVATION_CODE"];
    $obj = new verify_email();
	$obj->activation($ue,$act_code,$uid);
	exit();
}


?>