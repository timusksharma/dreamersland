<?php
include_once("../database/constants.php");
include_once("DBOperation.php");
include_once("manage.php");



//To get All_Parent_cats 
if(isset($_POST["getparent_cats"])){
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("catgries");
	
	foreach($rows as $row){
		
		echo "<div class='checkbox'>
		<label><input type='checkbox' cid='".$row["cid"]."' name='parent_cats[]' value='".$row["cid"]."' >".$row["cat_name"]."</label>
		</div>";
		
	}
	exit();
}

//To get All_child_cats 
if(isset($_POST["getchild_cats"])){
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("catgries");
	
	foreach($rows as $row){
		
		echo "<div class='checkbox'>
		<label><input type='checkbox' cid='".$row["cid"]."' name='child_cats[]' value='".$row["cid"]."' >".$row["cat_name"]."</label>
		</div>";
		
	}
	exit();
}

//To get Category 
if(isset($_POST["getCategory"])){
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("catgries");
	
	foreach($rows as $row){
		echo "<option value='".$row["cid"]."'>".$row["cat_name"]."</option>";
		
	}
	exit();
	
}

//To get Feature_cats 
if(isset($_POST["getFeature_cat"])){
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("catgries");
	
	foreach($rows as $row){
		
		echo "<div class='checkbox'>
		<label><input type='checkbox' cid='".$row["cid"]."' name='feature_cat[]' value='".$row["cat_name"]."' >".$row["cat_name"]."</label>
		</div>";
		
	}
	exit();
	
}

//Add Feature
if(isset($_POST["feature_name"]) AND isset($_POST["feature_cat"])){
	$obj = new DBOperation();
	$feature_cat = $_POST["feature_cat"];
	$count = COUNT($feature_cat);
	$categories ="";
	for($i=0;$i<$count;$i++)
	{
		$categories .= $feature_cat[$i]."**";
		
	}
	$categories = substr($categories,0,-2);
	
	$result = $obj->addFeature($_POST["feature_name"],$categories);
	//print_r($_POST["feature_cat"]);
	//echo $categories;
	echo $result;
	exit();
}








//Add Category
if(isset($_POST["category_name"]) AND isset($_POST["parent_cat"])){
	$obj = new DBOperation();
	
	$parent_cat = $_POST["parent_cats"];
	$count = COUNT($parent_cat);
	$categories ="";
	for($i=0;$i<$count;$i++)
	{
		$categories .= $parent_cat[$i]."**";
		
	}
	$categories = substr($categories,0,-2);
	
	$result = $obj->addCategory($_POST["parent_cat"],$categories,$_POST["category_name"]);
	echo $result;
	//echo $categories;
	exit();
}


//Fetch Brand 
if(isset($_POST["getBrand"])){
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("brnds");
	
	foreach($rows as $row){
		echo "<option value='".$row["bid"]."'>".$row["brnd_title"]."</option>";
		
	}
	exit();
	
}

//Add Brand
if(isset($_POST["brand_name"])){
	$obj = new DBOperation();
	$result = $obj->addBrand($_POST["brand_name"]);
	echo $result;
	exit();
}

//Size


if(isset($_POST["Select_Sizes"])){
 
 $obj = new DBOperation();
 
 $rows = $obj->getAllRecord("size_categries");

 if(!is_array($rows))
 {echo"NO_DATA";
	exit();
	}
 foreach($rows as $row){
		echo "<div class='checkbox'>
		<label><input type='checkbox' sid='".$row["id"]."' name='si_name[]' value='".$row["size_name"]."' >".$row["size_name"]."</label></div>";
	}
 
 exit();
}
if(isset($_POST["remaining"])){
	$selected_size = $_POST["remaining"];
	$sid= $_POST["sid"];

	for($i=0;$i<COUNT($_POST["remaining"]);$i++){
echo"<div class='checkbox' sid='".$sid[$i]."'>
		<label><input type='checkbox' sid='".$sid[$i]."' class='s_del' name='size_name[]' value='".$selected_size[$i]."' checked>".$selected_size[$i].": <input sid='".$sid[$i]."' type='text' name='size_val[]' class='form-control' placeholder='Enter Size Qty' required></label>
		</div>";


	}
	exit();
}



//Add Size
if(isset($_POST["size_n"])){
	$obj = new DBOperation();
	$result = $obj->addSize($_POST["size_n"]);
	echo $result;
	exit();
}

//Add Product
/*
if(isset($_POST["added_date"]) AND isset($_POST["product_name"])){
	$obj = new DBOperation();
	$feature_n = $_POST["feature_name"];
	$feature_v = $_POST["feature_val"];
	$count = COUNT($_POST["feature_name"]);
	$detail ="";
	if($_FILES['file']['name'] !=''){
		return "okk";
	}
	for($i=0;$i<$count;$i++)
	{
		$detail .= $feature_n[$i]."--".$feature_v[$i]."**";
	}
	$detail = substr($detail,0,-2);
	
	$result = $obj->addProduct($_POST["select_cat"],$_POST["select_brand"],$_POST["product_name"],$_POST["product_price"],$_POST["product_qty"],$_POST["pro_desc"],$detail,$_POST["pro_keywords"],$_POST["added_date"]);
	echo $result;
	exit();
}
*/
if(isset($_POST["added_date"]) AND isset($_POST["product_name"])){
	//echo"hello";
	$obj = new DBOperation();
	$feature_n = $_POST["feature_name"];
	$feature_v = $_POST["feature_val"];
	
	
	$count = COUNT($_POST["feature_name"]);
	
	$detail ="";
	$file_name="";
	
if($_FILES['file']['name'] !='')
{ 
	$explode = explode(".",$_FILES['file']['name']);
	$extension = strtolower(end($explode));
	$allowed_type = array("jpg","jpeg","png","gif");
	$uploadOk = 1;
	
	$check = getimagesize($_FILES["file"]["tmp_name"]);
	//print_r($check);
	//exit();
    if($check == false) {
      return "<script>alert('File is not an image.')</script>";
	  exit();
    } 
	// Check file size
if ($_FILES["file"]["size"] > 200000) {
    return "<script>alert('Sorry, your file is too large.')</script>";
	exit();
    
}
	if(in_array($extension,$allowed_type))
	{
		$new_name = rand().".".$extension;
		$file_name = $new_name;
		$path = "../../images/".$new_name;
		//$path2 = $D."/images/".$new_name;
		if(move_uploaded_file($_FILES['file']['tmp_name'],$path))
		{
			//echo $path;
		}
		
	}else{
		echo'<script>alert("Invalid File Formate")</script>';
		exit();
	}
}else{
	echo'<script>alert("Please Select File")</script>';
	exit();
}

for($i=0;$i<$count;$i++)
	{
		$detail .= $feature_n[$i]."--".$feature_v[$i]."**";
	}
	$detail = substr($detail,0,-2);
	
	if(isset($_POST["size_name"])){
	$size_n = $_POST["size_name"];
	$size_v = $_POST["size_val"];
	$count2 = COUNT($_POST["size_name"]);
	$sizes = "";
	for($i=0;$i<$count2;$i++)
	{
		$sizes .= $size_n[$i]."--".$size_v[$i]."**";
	}
	$sizes = substr($sizes,0,-2);
	$extra="sizes";
	}
	else{
		$sizes="0";
		$extra="";
	}
	
	$result = $obj->addProduct($_POST["select_cat"],$_POST["select_brand"],$_POST["product_name"],$_POST["product_price"],$_POST["product_qty"],$_POST["pro_desc"],$detail,$_POST["pro_keywords"],$file_name,$_POST["added_date"],$sizes,$extra);
	echo $result;
	exit();

}



//Manage Category

if(isset($_POST["manageCategory"])){
	$m = new Manage();
 $result = $m->manageRecordWidthPagination("catgries",$_POST["pageno"]);
 $rows = $result["rows"];
 $pagination = $result["pagination"];
 if(count($rows)>0){
	 $n=(($_POST["pageno"]-1)*5)+1;
	 foreach($rows as $row){
		 
		?>
		<tr>
      <th scope="row"><?php echo $n;?></th>
      <td><?php echo $row["category"];?></td>
      <td><?php echo $row["parent"];?></td>
	  <td><?php echo $row["total_par"];?></td>
	  <td><?php echo $row["total_childrns"];?></td>
	  <td><a href="#" class="btn btn-success btn-sm">Active</a>
	  </td>
	  <td><a href="#" data-toggle="modal" data-target="#form_category" eid="<?php echo $row['cid'];?>" class="btn btn-info btn-sm edit_cat">Edit</a>
	  <a href="#" did="<?php echo $row['cid'];?>" class="btn btn-danger btn-sm del_cat">Delete</a>
	  </td>
    </tr>
<?php		
	$n++; }
	 ?>
	 <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
	 
	 <?php
	 //echo $pagination;
	 exit();
 }
}


//Delete Category

if(isset($_POST["deleteCategory"])){
	$m = new Manage();
	$result = $m->deleteRecord("catgries","cid",$_POST["id"]);
	echo $result;
}
//Update Category
if(isset($_POST["updateCategory"])){
	$m = new Manage();
	$result = $m->getSingleRecord("catgries","cid",$_POST["id"]);
	echo json_encode($result);
	exit();
}


//Update Record after getting data
if(isset($_POST["update_category"])){
	$m = new Manage();
	$id = $_POST["cid"];
	$name = $_POST["update_category"];
	$parent = $_POST["parent_cat"];
	
	$parent_cat = $_POST["parent_cats"];
	$count = COUNT($parent_cat);
	$categories ="";
	for($i=0;$i<$count;$i++)
	{
		$categories .= $parent_cat[$i]."**";
		
	}
	$categories = substr($categories,0,-2);
	
	
	$child_cat = $_POST["child_cats"];
	$count = COUNT($child_cat);
	$childcategories ="";
	for($i=0;$i<$count;$i++)
	{
		$childcategories .= $child_cat[$i]."**";
		
	}
	$childcategories = substr($childcategories,0,-2);
	
	
	
	
	$result = $m->update_record("catgries",["cid"=>$id],["p_cat"=>$parent,"total_par"=>$categories,"total_childrns"=>$childcategories,"cat_name"=>$name,"status"=>1]);
	echo $result;
	exit();
}


//---------------Brand-----------------------

//Manage Brand

if(isset($_POST["manageBrand"])){
	$m = new Manage();
 $result = $m->manageRecordWidthPagination("brnds",$_POST["pageno"]);
 $rows = $result["rows"];
 $pagination = $result["pagination"];
 if(count($rows)>0){
	 $n=(($_POST["pageno"]-1)*5)+1;
	 foreach($rows as $row){
		 
		?>
		<tr>
      <th scope="row"><?php echo $n;?></th>
      <td><?php echo $row["brnd_title"];?></td>
	  <td><a href="#" class="btn btn-success btn-sm">Active</a>
	  </td>
	  <td><a href="#" data-toggle="modal" data-target="#form_brand" eid="<?php echo $row['bid'];?>" class="btn btn-info btn-sm edit_brand">Edit</a>
	  <a href="#" did="<?php echo $row['bid'];?>" class="btn btn-danger btn-sm del_brand">Delete</a>
	  </td>
    </tr>
<?php		
	$n++; }
	 ?>
	 <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
	 
	 <?php
	 //echo $pagination;
	 exit();
 }
}

//Delete Brand

if(isset($_POST["deleteBrand"])){
	$m = new Manage();
	$result = $m->deleteRecord("brnds","bid",$_POST["id"]);
	echo $result;
}

//Update Brand
if(isset($_POST["updateBrand"])){
	$m = new Manage();
	$result = $m->getSingleRecord("brnds","bid",$_POST["id"]);
	echo json_encode($result);
	exit();
}

//Update Record after getting data
if(isset($_POST["update_brand"])){
	$m = new Manage();
	$id = $_POST["bid"];
	$name = $_POST["update_brand"];

	$result = $m->update_record("brnds",["bid"=>$id],["brnd_title"=>$name,"status"=>1]);
	echo $result;
	exit();
}


//----------------Products----------------
if(isset($_POST["manageProduct"])){
	$m = new Manage();
 $result = $m->manageRecordWidthPagination("products",$_POST["pageno"]);
 $rows = $result["rows"];
 $pagination = $result["pagination"];
 if(count($rows)>0){
	 $n=(($_POST["pageno"]-1)*5)+1;
	 foreach($rows as $row){
		 
		?>
		<tr>
      <th scope="row"><?php echo $n;?></th>
      <td><?php echo $row["product_name"];?></td>
	  <td><?php echo $row["cat_name"];?></td>
	  <td><?php echo $row["brnd_title"];?></td>
	  <td><?php echo $row["product_price"];?></td>
	  <td><?php echo $row["product_stock"];?></td>
	  <td><?php echo $row["added_date"];?></td>
	  
	  <td><a href="#" class="btn btn-success btn-sm">Active</a>
	  </td>
	  <td><a href="#" data-toggle="modal" data-target="#form_products" eid="<?php echo $row['pid'];?>" class="btn btn-info btn-sm edit_product">Edit</a>
	  <a href="#" did="<?php echo $row['pid'];?>" class="btn btn-danger btn-sm del_product">Delete</a>
	  </td>
    </tr>
<?php		
	$n++; }
	 ?>
	 <tr><td colspan="9"><?php echo $pagination; ?></td></tr>
	 
	 <?php
	 //echo $pagination;
	 exit();
 }
}

//Delete Product
if(isset($_POST["deleteProduct"])){
	$m = new Manage();
	$result = $m->deleteRecord("products","pid",$_POST["id"]);
	echo $result;
}

//Update Product
if(isset($_POST["updateProduct"])){
	$m = new Manage();
	$result = $m->getSingleRecord("products","pid",$_POST["id"]);
	echo json_encode($result);
	exit();
}

//Update Record after getting data
if(isset($_POST["update_product"])){
	$m = new Manage();
	$id = $_POST["pid"];
	$name = $_POST["update_product"];
	$cat = $_POST["select_cat"];
	$brand = $_POST["select_brand"];
	$price = $_POST["product_price"];
	$qty = $_POST["product_qty"];
	$date = $_POST["added_date"];
	$result = $m->update_record("products",["pid"=>$id],["cid"=>$cat,"bid"=>$brand,"product_name"=>$name,"product_price"=>$price,"product_stock"=>$qty,"added_date"=>$date]);
	
	
	
	echo $result;
	exit();
}


if(isset($_POST["Select_Features"]) AND (isset($_POST["cat"]))){
 //echo $_POST["cat"];
 
 $obj = new DBOperation();
 
 $rows = $obj->getSelectedRecord("feature",$_POST["cat"],"parent_cats");
 if(!is_array($rows))
 {echo"NO_DATA";
	exit();
	}
 foreach($rows as $row){
		echo "<div class='checkbox'>
		<label><input type='checkbox' fid='".$row["id"]."' name='s_name[]' value='".$row["feature_name"]."' >".$row["feature_name"]."</label></div>";
	}
 //echo COUNT($rows);
 //print_r($rows);
 
 /*"<div class='checkbox' fid='".$row["id"]."'>
		<label><input type='checkbox' fid='".$row["id"]."' class='f_del' name='feature_name[]' value='".$row["feature_name"]."' checked>".$row["feature_name"].": <input fid='".$row["id"]."' type='text' name='feature_val[]' class='form-control' placeholder='Enter Feature Value'></label>
		</div>"*/
 exit();
}
if(isset($_POST["remain"])){
	$selected_cat = $_POST["remain"];
	$fid= $_POST["fid"];
	for($i=0;$i<COUNT($_POST["remain"]);$i++){
echo"<div class='checkbox' fid='".$fid[$i]."'>
		<label><input type='checkbox' fid='".$fid[$i]."' class='f_del' name='feature_name[]' value='".$selected_cat[$i]."' checked>".$selected_cat[$i].": <input fid='".$fid[$i]."' type='text' name='feature_val[]' class='form-control' placeholder='Enter Feature Value' required></label>
		</div>";


	}
}



//-------------------------Feature--------------------------------------
//Manage Feature

if(isset($_POST["manageFeature"])){
	$m = new Manage();
 $result = $m->manageRecordWidthPagination("feature",$_POST["pageno"]);
 $rows = $result["rows"];
 $pagination = $result["pagination"];
 if(count($rows)>0){
	 $n=(($_POST["pageno"]-1)*5)+1;
	 foreach($rows as $row){
		 
		?>
		<tr>
      <th scope="row"><?php echo $n;?></th>
      <td><?php echo $row["feature_name"];?></td>
      <td><?php echo str_replace("**",", ",$row["parent_cats"]);?></td>
	  
	  <td><a href="#" data-toggle="modal" data-target="#form_feature" eid="<?php echo $row['id'];?>" class="btn btn-info btn-sm edit_feat">Edit</a>
	  <a href="#" did="<?php echo $row['id'];?>" class="btn btn-danger btn-sm del_feat">Delete</a>
	  </td>
    </tr>
<?php		
	$n++; }
	 ?>
	 <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
	 
	 <?php
	 //echo $pagination;
	 exit();
 }
}


//Delete Feature

if(isset($_POST["deleteFeature"])){
	$m = new Manage();
	$result = $m->deleteRecord("feature","id",$_POST["id"]);
	echo $result;
}

//Update Feature
if(isset($_POST["updateFeature"])){
	$m = new Manage();
	$result = $m->getSingleRecord("feature","id",$_POST["id"]);
	echo json_encode($result);
	exit();
}


//Update Record after getting data
if(isset($_POST["update_feature"])){
	$m = new Manage();
	$id = $_POST["fid"];
	$name = $_POST["update_feature"];
	$feature_cat = $_POST["feature_cat"];
	$count = COUNT($feature_cat);
	$categories ="";
	for($i=0;$i<$count;$i++)
	{
		$categories .= $feature_cat[$i]."**";
		
	}
	$categories = substr($categories,0,-2);
	
   $result = $m->update_record("feature",["id"=>$id],["parent_cats"=>$categories,"feature_name"=>$name]);
	echo $result;
	//print_r($feature_cat);
	//echo $categories;
	exit();
}


?>