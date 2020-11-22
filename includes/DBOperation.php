<?php

class DBOperation
{
	private $con;
	function __construct(){
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}
	
	
		public function manageRecordWidthPagination($table,$pno,$condition){
		$a = $this->pagination($this->con,$table,$pno,20,$condition);
		if($table == "catgries"){
			$sql = "SELECT p.cid, p.cat_name as category,c.cat_name as parent ,p.status FROM catgries p LEFT JOIN catgries c ON p.p_cat = c.cid ".$a["limit"];
			
		}else if($table == "products"){
			$sql = "SELECT * FROM products ".$condition." ".$a["limit"];
			
		}
		else{
			$sql = "SELECT * FROM ".$table." ".$a["limit"];
		}
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
				
			}
		}
		return ["rows"=>$rows,"pagination"=>$a["pagination"]];
		
	}
	private function pagination($con,$table,$pno,$n,$condition){
	$query = $con->query("SELECT COUNT(*) as rows FROM ".$table." ".$condition);
	$row = mysqli_fetch_assoc($query);
	//$totalRecords = 100000;
	$pageno = $pno;
	$numberOfRecordsPerPage = $n;

	$last = ceil($row["rows"]/$numberOfRecordsPerPage);

	$pagination = "<ul class='pagination'>";

	if ($last != 1) {
		if ($pageno > 1) {
			$previous = "";
			$previous = $pageno - 1;
			$pagination .= "<li class='page-item'><a class='page-link' href='#' pn='".$previous."' style='color:#333;'> Previous </a></li>";
		}
		for($i=$pageno - 5;$i< $pageno ;$i++){
			if ($i > 0) {
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
			}
			
		}
		$pagination .= "<li class='page-item'><a class='page-link' pn='".$pageno."' href='#' style='color:#333;'> $pageno </a></li>";
		for ($i=$pageno + 1; $i <= $last; $i++) { 
			$pagination .= "<li class='page-item'><a class='page-link' href='#' pn ='".$i."'> ".$i." </a></li>";
			if ($i > $pageno + 4) {
				break;
			}
		}
		if ($last > $pageno) {
			$next = $pageno + 1;
			$pagination .= "<li class='page-item'><a class='page-link' href='#' pn='".$next."' style='color:#333;'> Next </a></li></ul>";
		}
	}
//LIMIT 0,10
	//LIMIT 20,10
	$limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;

	return ["pagination"=>$pagination,"limit"=>$limit];
}

public function suscribe($user_email){
	$pre_stmt = $this->con->prepare("SELECT * FROM suscriptions WHERE usr_email = ? ");
		$pre_stmt->bind_param("s",$user_email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if($result->num_rows > 0)
		{
			echo"Already Suscribed.";
		}
		else{
			$pre_stmt = $this->con->prepare("INSERT INTO `suscriptions` (`usr_email`) VALUES (?)");
			$pre_stmt->bind_param("s",$user_email);
			$result= $pre_stmt->execute() or die($this->con->error);
		if($result){
			echo "You Have Successfully Suscribed..!!";
		}else{
			echo"Please Try Again";
			}
}
}

public function addTocart($p_id,$user_id,$selected_size,$selected_qty){
		
		$pre_stmt = $this->con->prepare("SELECT * FROM cart WHERE p_id = ? AND user_id = ? ");
		$pre_stmt->bind_param("ii",$p_id,$user_id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if($result->num_rows > 0)
		{
		return"Already_Added";

		}
		else{
			
			$pre_stmt = $this->con->prepare("SELECT * FROM products WHERE pid = ? LIMIT 1 ");
			$pre_stmt->bind_param("i",$p_id);
			$pre_stmt->execute() or die($this->con->error);
		 $result = $pre_stmt->get_result();
		$rows = array();
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$rows = $row;
			}
			//return $rows;
			//print_r($rows);
			// echo $rows["product_name"];
			$pro_name = $rows["product_name"];
			$pro_image = $rows["pro_imgs"];
			$qty= $selected_qty;
			$price = $rows["product_price"];
			$total_amount = $rows["product_price"];
			$extra = $rows["extra"];
			if($selected_size=="empty")
			{
			if($extra == "")
				$size = "";
			else{
				$size = "none";
			}
			}else{
				$size = $selected_size;
			}
			
			$pre_stmt = $this->con->prepare("INSERT INTO `cart` (`p_id`,`user_id`,`pro_name`,`pro_image`,`extra`,`qty`,`price`,`total_amount`) VALUES (?,?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("iisssiii",$p_id,$user_id,$pro_name,$pro_image,$size,$qty,$price,$total_amount);
		$result= $pre_stmt->execute() or die($this->con->error);
		if($result){
			echo "ADDED TO CART";
		}else{
			return 0; 
			}
		}else{
		return "NO_DATA";
		}
		
	}
			
			
			
			/**/
		}
		
		public function cartCount($user_id){
			$pre_stmt = $this->con->prepare("SELECT * FROM cart WHERE  user_id = ? ");
		$pre_stmt->bind_param("i",$user_id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		echo $result->num_rows;
		
			
		}
		
		public function getSelectedRecord($table,$condition,$key){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$key." = ".$condition);
		$pre_stmt->execute() or die($this->con->error);
		 $result = $pre_stmt->get_result();
		$rows = array();
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}
	
	public function SelectedRecord($table,$where){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$where);
		$pre_stmt->execute() or die($this->con->error);
		 $result = $pre_stmt->get_result();
		$rows = array();
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}
	public function AllRecords($table,$where){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." ".$where);
		$pre_stmt->execute() or die($this->con->error);
		 $result = $pre_stmt->get_result();
		$rows = array();
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}
	
	public function update_record($table,$where,$fields){
$sql = "";
$condition = "";
foreach ($where as $key => $value) {
// id = '5' AND m_name = 'something'
$condition .= $key . "='" . $value . "' AND ";
}
$condition = substr($condition, 0, -5);
foreach ($fields as $key => $value) {
//UPDATE table SET m_name = '' , qty = '' WHERE id = '';
$sql .= $key . "='".$value."', ";
}
$sql = substr($sql, 0,-2);
$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
if(mysqli_query($this->con,$sql)){
	return "UPDATED";
}
}
	public function deleteRecord($table,$pk,$id){
		$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
			$pre_stmt->bind_param("i",$id);
			$result = $pre_stmt->execute() or die($this->con->error);
			if($result){
				return "DELETED";
			}
	}
	
	public function placeOrder($uid,$pid,$qty,$extra,$time,$payment,$pro_name){
	
			$status="pending";
			$pre_stmt = $this->con->prepare("INSERT INTO `orders`(`user_id`, `product_id`,`product_name`, `qty`, `extra`, `time`, `payment_method`, `p_status`) VALUES (?,?,?,?,?,?,?,?)");
			$pre_stmt->bind_param("iisissss",$uid,$pid,$pro_name,$qty,$extra,$time,$payment,$status);
			$result= $pre_stmt->execute() or die($this->con->error);
		if($result){
			return "Success_Order";
		}else{
			echo"Please Try Again";
			}

}
}
	
	
	
	
?>