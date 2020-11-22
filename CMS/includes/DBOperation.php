<?php

class DBOperation
{
	private $con;
	function __construct(){
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}
	public function addCategory($parent,$parent_cats,$child_cats,$cat){
		$pre_stmt = $this->con->prepare("INSERT INTO `catgries`( `p_cat`, `total_par`,`total_childrns`,`cat_name`, `status`) VALUES (?,?,?,?,?)");
		$status = 1;
		$pre_stmt->bind_param("isssi",$parent,$parent_cats,$child_cats,$cat,$status);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result){
			return "CATEGORY_ADDED";
		}else{
			return 0; 
		}
	}
	
	public function addFeature($feature_name,$feature_cat){
		$feature_name = mysqli_real_escape_string($this->con,$feature_name);
		$feature_cat = mysqli_real_escape_string($this->con,$feature_cat);
		$pre_stmt = $this->con->prepare("INSERT INTO `feature`( `parent_cats`, `feature_name`) VALUES (?,?)");
		
		$pre_stmt->bind_param("ss",$feature_cat,$feature_name);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result){
			return "FEATURE_ADDED";
		}else{
			return 0; 
		}
	}
	
	
	public function addBrand($brand_name){
		$pre_stmt = $this->con->prepare("INSERT INTO `brnds`(`brnd_title`, `status`) VALUES (?,?)");
		$status = 1;
		$pre_stmt->bind_param("si",$brand_name,$status);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result){
			return "BRAND_ADDED";
		}else{
			return 0; 
		}
		exit();
	}
	
	public function addSize($size_name){
		$pre_stmt = $this->con->prepare("INSERT INTO `size_categries`(`size_name`) VALUES (?)");
		$pre_stmt->bind_param("s",$size_name);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result){
			return "SIZE_ADDED";
		}else{
			return 0; 
		}
		exit();
	}
	
	
	public function addProduct($cid,$bid,$pro_name,$price,$stock,$proDesc,$pro_detail,$pro_keywords,$pro_img,$date,$sizes,$extra){
		
		$pre_stmt = $this->con->prepare("INSERT INTO `products`
		(`cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`,`pro_desc`,`pro_detail`,`pro_search_keys`,`pro_imgs`,`extra`, `p_status`) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
		
		
		$status = 1;
		$pre_stmt->bind_param("iisdissssssi",$cid,$bid,$pro_name,$price,$stock,$date,$proDesc,$pro_detail,$pro_keywords,$pro_img,$extra,$status);
		$result=$pre_stmt->execute() or die($this->con->error);
		$lastid=mysqli_insert_id($this->con);
		//return mysqli_insert_id($this->con);
		if($result){
			if($sizes!="0"){
				//return mysqli_insert_id($this->con);
			$pre_stmt = $this->con->prepare("INSERT INTO sizes (`pid`,`aval_size`) VALUES (?,?)");
		$pre_stmt->bind_param("is",$lastid,$sizes);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result){
			return "NEW_PRODUCT_ADDED.....!";
		}
			}
			else{
				return "NEW_PRODUCT_ADDED";
			}
			
		}else{
			return 0; 
		}
		exit();
	}
	
	
	public function getAllRecord($table){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table);
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
	
	public function getSelectedRecord($table,$condition,$key){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$key." LIKE '%".$condition."%'");
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
}

//$opr = new DBOperation();
//echo $opr->addCategory(1,"Mobiles");
//echo"</pre>";
//print_r($opr->getAllRecord("categories"));
//echo"</pre>";

?>