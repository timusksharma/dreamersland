<?php
session_start();
include_once("../database/constants.php");
include_once("DBOperation.php");
date_default_timezone_set("Asia/Kolkata");


/*if(isset($_POST["getProducts"])){
	
$limit = 17;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno*$limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM products WHERE product_price BETWEEN 12000 AND 40000 LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	
	echo"<div class='row'>";
			$i=0;
					
	if(mysqli_num_rows($run_query)>0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id = $row["pid"];
			$pro_cat = $row["cid"];
			$pro_brand = $row["bid"];
			$pro_title = $row["product_name"];
			$pro_price = $row["product_price"];
			$pro_image = $row["pro_imgs"];
				echo"
			<div class='col-md-4'>
<div class='panel panel-info'>

<div class='panel-heading'>$pro_title</div>
<div class='panel-body'>
<img  src='product_images/$pro_image' style='width:150px; height:230px; '>
</div>
<div class='panel-heading'>
Rs.$pro_price.00
<button  pid='$pro_id' style='float:right;' id='product' class='btn btn-success btn-xs'>AddToCart</button>
</div>

</div>
</div>
			
			";
			
			if($i%4==0 AND $i!=0)
				{echo"</div>";
					echo"<div class='row'>";}
					
			echo"<div class='col-md-3  product-grid'>
<div class='image'>
<a href='#'>
<center>
<img src='images/$pro_image' class='img-responsive' style='max-height:154px; '>
</center>

<div class='overimage'>
<div class='detail'>View Details</div>
</div>
</a> 
</div>

<h4 class='text-center' style='font-size:1.5rem;'>$pro_title</h4>
<h5  style='font-size:1.8rem;padding-left:15px'>Rs.$pro_price</h5>

<a href = '#' pid='$pro_id' class='btn buy'>AddToCart</a>
</div>";
$i++;
		}
		
		}
		echo"</div>";
	}*/
	//Get Search Options
	if(isset($_POST["Get_Search"]))
	{
	$searchKeys =explode(" ",$_POST["search"]);
		$obj = new DBOperation();
		

	
		$condition="";
		for($i=0;$i<COUNT($searchKeys);$i++)
		{
			$condition .= "pro_search_keys Like '%".$searchKeys[$i]."%' AND ";
			
			
		}
		$condition = " WHERE ".substr($condition,0,-5)." LIMIT 8";
		
		$result = $obj->AllRecords("products",$condition);
		
		if(is_array($result))
		{
			for($i=0;$i<COUNT($result);$i++)
			{
				echo"<li class='search_k'><a href='product_page.php?proid=".$result[$i]['pid']."'>".$result[$i]['product_name']."</a></li>";
				echo"<hr>";
			}
		}else{
			echo $result;
		}
		
		//print_r($result);
		exit();
	}
	
	
	//Cancel Order
	if(isset($_POST["cancelOrder"]))
	{		
		$obj = new DBOperation();
		$result = $obj->update_record("orders",["order_id"=>$_POST['oid']],["p_status"=>"canceled"]);
		if($result=="UPDATED")
		{
			echo"cancel";
		}else{
			echo"NotCancel";
		}
		exit();
	}
	
	//Profile Page
	if(isset($_POST["getpage"]))
	{
		if(isset($_POST["pname"]))
		{
			$obj = new DBOperation();
			
			$result = $obj->getSelectedRecord("cust_info",$_SESSION['id'],"id");
			//print_r($result);
			$name = $result[0]['u_nme'];
			$email=$result[0]['email'];
			$mno=$result[0]['mobile'];
			if($_POST["pname"]=="profile")
			{
				echo"<h3>Profile Information</h3>
				<hr>
<form >


<div class='col-md-8'>
<div class='form-group'>
  <label>Name:</label>
  <input type='text' name='usr_name' class='form-control' id='usr_name' value='$name' disabled>
</div>
</div>

<div class='col-md-8'>
<div class='form-group'>
  <label>Email:</label>
  <input type='text' name='usr_email' class='form-control' id='usr_email' value='$email' disabled>
</div>
</div>

<div class='col-md-8'>
<div class='form-group'>
  <label>Mobile no:</label>
  <input type='text' name='usr_mbo' class='form-control' id='usr_mbo' value='$mno' disabled>
</div>
</div>
</form>
";		
			}
				else if($_POST["pname"]=="order")
			{
				echo"<h3>My Orders</h3><hr>
				<h4 style='color:red'>#You can Cancel your Order within 2hr after Successfully placing your Order</h4>
				
				";
				$obj = new DBOperation();
				$s = "user_id = ".$_SESSION['id'];
			
			$result = $obj->SelectedRecord("orders",$s);
			//print_r($result);
			echo"<table class='table table-bordered table-hover'>
    <thead>
      <tr>
        <th>Sno</th>
        <th>Product Name</th>
		<th>Extra Details</th>
        <th>Order Date</th>
		<th>Qty</th>
		<th>Delivery Time</th>
		<th>Action</th>
		<th>Status</th>
      </tr>
    </thead>
    <tbody>
	";
	
	if(is_array($result))
	{
		//print_r($result);
		for($i=0;$i<count($result);$i++)
		{	
		$orderTime = $result[$i]['time'];
		$orderCancelTime = floatval($orderTime) + 7200 ;
		$time=gettimeofday(true);
		
		echo"
		<tr>
        <td>", $i+1 ,"</td>
        <td>".$result[$i]['product_name']."</td>
        <td>".$result[$i]['extra']."</td>
		<td>".date("Y-m-d H:i:s A",$orderTime)."</td>
		<td>".$result[$i]['qty']."</td>
		<td>".$result[$i]['delivery_time']."</td>
		<td>";if(!($result[$i]['p_status']=="canceled") AND !($result[$i]['p_status']=='delivered') AND ($time < $orderCancelTime) ){echo"<a href='#' class='btn btn-danger btn-sm can' oid='".$result[$i]['order_id']."'>Cancel</a>";} echo"</td>
		<td>".$result[$i]['p_status']."</td>
      </tr>";
      
		}
		
	}
	
	  
	  echo"
    </tbody>
  </table>";
			}
				else if($_POST["pname"]=="address")
			{
				echo"<h3>Address Information</h3>
				<hr>
<form >

<div class='col-md-8'>
<div class='form-group'>
  <label>Address:</label>
  <input type='text' name='usr_address' class='form-control' id='usr_address' value='' disabled>
</div>
</div>
</form>";
			}
		}
		
		exit();
	}
	
	if(isset($_POST["getProducts"]))
	{	$obj = new DBOperation();
		
		$sizes="";
		$brnds="";
		$categories ="";
		$price="";
		//Filters
		//price
		if(isset($_POST['pricef']) AND isset($_POST['pricet']))
		{
			if($_POST['pricef']!="" OR $_POST['pricet']!="" )
			{
			$price = " AND ( product_price BETWEEN ".$_POST['pricef']." AND ".$_POST['pricet'] ." ) " ;
			}
		}
		
		//sizes
		if(isset($_POST['dat_size'])){
		$condition="";
		for($i=0;$i<COUNT($_POST["dat_size"]);$i++)
		{
			$condition .= "aval_size Like '%".$_POST["dat_size"][$i]["value"]."%' OR ";
			
			
		}
		$condition = " WHERE ".substr($condition,0,-4);
		
		$result_size = $obj->AllRecords("sizes",$condition);
		
		if(COUNT($result_size)>0)
		{
			for($i=0;$i<COUNT($result_size);$i++)
		{
			$sizes .= " pid = ".$result_size[$i]["pid"]." OR ";
			
			
		}
		$sizes =" AND (".substr($sizes,0,-4).")";
		}else{
			$sizes="";
		}
		}
		//brnds
		if(isset($_POST['dat_brnd'])){
		
		for($i=0;$i<COUNT($_POST["dat_brnd"]);$i++)
		{
			$brnds .= "bid = ".$_POST["dat_brnd"][$i]["value"]." OR ";
			
		}
		$brnds = " AND ( ".substr($brnds,0,-4)." ) ";
		}
		
		
		//echo $sizes;
	if(isset($_POST["dat_cate"]))
		{
			for($i=0;$i<COUNT($_POST["dat_cate"]);$i++)
		{
			$categories .= "cid = ".$_POST["dat_cate"][$i]["value"]." OR ";
			
		}	
		}else{
			$result = $obj->getSelectedRecord("catgries",$_POST["cid"],"cid");
	
		$arr = explode("**",$result[0]["total_childrns"]);
		$count = COUNT($arr);
		
		for($i=0;$i<$count;$i++)
		{
			$categories .= "cid = ".$arr[$i]." OR ";
			
		}
		}
	
		$categories = "WHERE (".substr($categories,0,-4)." ) ".$sizes.$brnds.$price;
		//echo $categories;
		
		$obj = new DBOperation();
		$result = $obj->manageRecordWidthPagination("products",$_POST["pageno"],$categories);
		$rows = $result["rows"];
		$pagination = $result["pagination"];
		
		echo"<div class='row'>";
			$i=0;
		if(count($rows)>0){
	 //$n=(($_POST["pageno"]-1)*5)+1;
	 foreach($rows as $row){
			$pro_id = $row["pid"];
			$pro_cat = $row["cid"];
			$pro_brand = $row["bid"];
			$pro_title = $row["product_name"];
			$pro_price = $row["product_price"];
			$pro_image = $row["pro_imgs"];
			if($i%4==0 AND $i!=0)
				{echo"</div>";
					echo"<div class='row'>";}
					
			echo"<div class='col-md-3  product-grid'>
<div class='image' pid='$pro_id'>
<a href='#'>
<center>
<img src='images/$pro_image' class='img-responsive' style='max-height:154px; '>
</center>

<div class='overimage'>
<div class='detail'>View Details</div>
</div>
</a> 
</div>

<h4 class='text-center' style='font-size:1.5rem;'>$pro_title</h4>
<h5  style='font-size:1.8rem;padding-left:15px'>Rs.$pro_price</h5>

<a href = '#' pid='$pro_id' id='product_cart' class='btn buy'>AddToCart</a>
</div>";
$i++;
	 }
		
	}
	echo"</div>";
	
	echo"<div class='col-md-12'>
<hr>
<div class='text-center'>
$pagination
</div>
</div>";

	exit();
	
	}
	
	
	
//Brands

if(isset($_POST["GetBrands"]))
{	
	$obj = new DBOperation();
	$result = $obj->getSelectedRecord("brnds",1,"status");
	if(count($result)>0){
		echo"
		<a href='#brand' style='font-size:16px;' data-toggle='collapse' style='text-decoration:none;'>Brand   <span class='glyphicon glyphicon-plus' style='float:right'></span></a>
		<div class='nav collapse in size'id='brand'>
		<form style='font-size:16px; padding-left:20px;' id='form_brnd'>

";
		for($i=0;$i<count($result);$i++)
		{
			$brndName = $result[$i]["brnd_title"];
			$bid = $result[$i]["bid"];
			echo"<div class='checkbox'><label><input type='checkbox' class='brd' name='brd[]' value='$bid'>$brndName</label></div>";
			
		}
		echo"</form>
			</div>
			<hr>
			";
		
	}
	exit();
}
	//Categories
	if(isset($_POST["getCatgries"]))
	{	
		$obj = new DBOperation();
		$result = $obj->getSelectedRecord("catgries",$_POST["cid"],"cid");
		
		if($result[0]["total_childrns"]!="")
		{
		$arr = explode("**",$result[0]["total_childrns"]);
		$count = COUNT($arr);
		
		$categories ="";
		for($i=0;$i<$count;$i++)
		{
			$categories .= "cid = ".$arr[$i]." OR ";
		}
		$categories = substr($categories,0,-4);
		$result = $obj->SelectedRecord("catgries",$categories);
		
		if(count($result)>0){
		echo"<a href='#category' style='font-size:16px;' data-toggle='collapse' style='text-decoration:none;'>Categories   <span class='glyphicon glyphicon-plus' style='float:right'></span></a>
		<div class='nav collapse in size'id='category' >
		<form style='font-size:16px; padding-left:20px;' id='form_cate'>
		";
		for($i=0;$i<count($result);$i++)
		{
			$catName = $result[$i]["cat_name"];
			$cid = $result[$i]["cid"];
			echo"<div class='checkbox'><label><input type='checkbox'class='cate' name='cate[]' value='$cid'>$catName</label></div>";	
		}
		echo"
		</form>
		</div>
		<hr>";
		
		}
		}
		
		exit();
	}
	
	//Sizes
	if(isset($_POST["GetSizes"]))
	{	
		$obj = new DBOperation();
		$result = $obj->AllRecords("size_categries","");
		
		if(count($result)>0)
		{
			echo"<a href='#new' style='font-size:16px;' data-toggle='collapse' style='text-decoration:none;'>Size   <span class='glyphicon glyphicon-plus' style='float:right'></span></a>
			<div class='nav collapse in size'id='new'>
			<form class='form-group form-horizontal'style='font-size:16px; padding-left:20px;' id='form_size'>";
			for($i=0;$i<COUNT($result);$i++)
			{
				$sizeName = $result[$i]["size_name"];
				echo" <div class='checkbox' >
					<label><input type='checkbox' class='size_cat' name='size_cat[]' value='$sizeName'>$sizeName</label>
					</div>";
			}
			echo"</form></div><hr>";
		}
		
		exit();
	}
	
	
if(isset($_POST["addToProduct"])){
	//echo 
	if(isset($_SESSION["id"]))
	{
		if(isset($_POST["selected_size"])){
			$size = $_POST["selected_size"];
			if($size=="0"){
			$size="none";
		}
		}
		else{
			$size="empty";
		}
		if(isset($_POST["selected_qty"]))
		{
			$qty = $_POST["selected_qty"];
		}else{
			$qty = 1;
		}
		
	$user_id=$_SESSION["id"];
	$p_id=$_POST["proId"];
	$obj = new DBOperation();
	$result = $obj->addTocart($p_id,$user_id,$size,$qty);
	echo $result;
		
}else{
	echo"NOT_LOGIN";
}
}

	if(isset($_POST["cart_count"]) && isset($_SESSION["id"])){
	$uid = $_SESSION["id"];
	$obj = new DBOperation();
	$result = $obj->cartCount($uid);
	echo $result;
	exit();
	
}

if(isset($_POST["suscribe_email"])){
	$user_email=$_POST["suscribe_email"];
	$obj = new DBOperation();
	$result = $obj->suscribe($user_email);
	echo $result;
	exit();
}


if(isset($_POST["getpro"]))
{
	$obj = new DBOperation();
	$result = $obj->getSelectedRecord("products",$_POST['pid'],"pid");
	$pro_id = $_POST['pid'];
	$pro_title = $result[0]["product_name"];
	$pro_price = $result[0]["product_price"];
	$pro_stock = $result[0]["product_stock"];
	$pro_desc = $result[0]["pro_desc"];
	$pro_details=$result[0]["pro_detail"];
	$proimg=explode("**",$result[0]["pro_imgs"]);
	$pro_ex = $result[0]["extra"];
	
	//echo(COUNT($proimg));
	
	echo"<div class='col-md-6 pro' id='getpro' style='padding:10px;border:1px solid #ccc;'>
	<div id='m_Carousel' class='carousel slide' data-interval='false' data-ride='carousel'>
				<div class='col-md-2'>
				<ul class='nav nav-pills'>";
				for($i=0;$i<COUNT($proimg);$i++)
					{
						echo"<li data-target='#m_Carousel' data-slide-to='".$i."' class='nav-item active'><a href='#' class='nav-link'><img src='images/$proimg[$i]' alt='' style='max-height:75px;max-width:75px;'></a></li>";
						//echo$proimg[$i];
					}
			echo"	</ul>
				</div>
				<div class='col-md-8'>
				
				<div class='carousel-inner'>";
				
				for($i=0;$i<COUNT($proimg);$i++)
				{
					echo"<div class='item carousel-item active' id='pro'>
						<img src='images/$proimg[$i]' alt='' >	
						</div>";
					
					}
					
				echo"</div>
				</div>
			</div>
			</div>";
			
			
			
			echo"<div class='col-md-6' id='pro_details'><h3>$pro_title</h3>
			";
			if($pro_stock>0)
			{
			echo"
		<h5 style='color:green;'>#in Stock</h5>";
			}
			else{
				echo"
		<h5 style='color:Red;'>#Not Available</h5>";
			}
		echo"
		<h2><b>Rs $pro_price<b></h2>
		";
		if($pro_ex=="sizes"){
		echo"
		<div class='col-md-3'>
		
		<div class='form-group'>
			<label >Size</label>
			<select class='form-control' id='select_size' name='select_size'>
			<option value='0'>Select Size</option>
			";
			
			
				$obj2 = new DBOperation();
				$result2 = $obj2->getSelectedRecord("sizes",$pro_id,"pid");
				$x = explode('**',$result2[0]['aval_size']);
				for($i=0;$i<sizeof($x);$i++){
				$s= explode("--",$x[$i]);
				echo"<option value='$s[0]'>".$s[0]."</option>";
				}
			
			echo"
			</select>
			
		
			
		</div>
		
		</div>
		";
		}
		echo"
		<div class='col-md-3'>
		<div class='form-group'>
			<label>Qty</label>
			<select class='form-control' id='select_qty' name='select_qty'>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>
		</div>
		</div>
		
		<p><br></p>
		<p><br></p>
		<p><br></p>
		";
		if($pro_stock>0){
			
		echo"
	
		<button type='button' pid='$pro_id' id='productCart' class='btn btn-success'>Add To Cart</button>
		";
		}else{
			echo"
	
		<button type='button' pid='$pro_id' id='productCart' class='btn btn-success' disabled>Add To Cart</button>
		";
		}
		
		echo"<p><br></p>
		";
		echo"	<ul class='navbar navbar-default nav' style=''>
<li>
<a href='#de' style='font-size:16px;' data-toggle='collapse' style='text-decoration:none;'>Delivery Details   <span class='glyphicon glyphicon-plus' style='float:right'></span></a>
<div class='nav collapse in' id='de'>
<br>
      <div id = 'slider-3'style='margin-left:10px;margin-right:10px'></div>
	  <p style='padding-left:20px;'>
       #Delivery Within 12Hours
      </p>

</div>
</li>
<hr>
<li>
<a href='#des' style='font-size:16px;' data-toggle='collapse' style='text-decoration:none;'>Product Description   <span class='glyphicon glyphicon-plus' style='float:right'></span></a>

<div class='nav collapse in size'id='des' style='padding:20px;font-size:14px;font-weight:500;'>
<p>$pro_desc</p>
</div>

</li>
<hr>
<li>
<a href='#details' style='font-size:16px;' data-toggle='collapse' style='text-decoration:none;'>Product Details   <span class='glyphicon glyphicon-plus' style='float:right'></span></a>

<div class='nav collapse in size'id='details' style='padding-left:20px;font-size:14px;font-weight:500;'>
";

$x = explode('**',$pro_details);

for($i=0;$i<sizeof($x);$i++){
	$s= explode("--",$x[$i]);
	echo"<br>".$s[0]." : ".$s[1];
	}

echo"
</div>

</li>



<hr>
<li>
<a href='#re' style='font-size:16px;' data-toggle='collapse' style='text-decoration:none;'>Return Policy  <span class='glyphicon glyphicon-plus' style='float:right'></span></a>

<div class='nav collapse in size'id='re' style='padding-left:20px;font-size:14px;'>
<p>No Return<br>
Only You can Exchange Within 1 day.<br>
For Exchange You Have To Complain or Message Within 5hr</p>
</div>

</li>
</ul>";
		echo"
		</div>";
		
		
	//for($i=0;$i<COUNT($proimg);$i++)
//	{
	//	echo$proimg[$i];
	//}
	exit();
}
//Carousel

function carousel($cat,$title,$sub,$id)
{
	$obj = new DBOperation();
	$result = $obj->getSelectedRecord("catgries",$cat,"cid");
	
	$arr = explode("**",$result[0]["total_childrns"]);
	$count = COUNT($arr);
	$categories ="";
	for($i=0;$i<$count;$i++)
	{
		$categories .= "cid = ".$arr[$i]." OR ";
		
	}
	$categories = substr($categories,0,-4);
	//echo $categories;
	$obj = new DBOperation();
	$result = $obj->SelectedRecord("products",$categories);
	echo"
	<div class='container-fluid' style='margin-left:10px;margin-right:10px;background-color:#fff; margin-top:20px; box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);'>
	<div class='row' >
	<h2>".$title." <b>".$sub."</b></h2>
	<a href='#' class='btn btn-primary getAllRelated' cid='$cat' style='margin-bottom:10px;float:right; margin-right:10px'>View All</a>
	<div class='col-md-12'>
	<div id='".$id."' class='carousel slide' data-ride='carousel' data-interval='0'>
		";
		
		echo"<ol class='carousel-indicators'>";
		echo"<li data-target='#".$id."' data-slide-to='0' class='active'></li>";
		if(COUNT($result)>4)
		{
		for($i=1;$i<COUNT($result)/4;$i++)
		{echo"<li data-target='#".$id."' data-slide-to='".(int)$i."' ></li>";
			
		}
		}
		echo"</ol>";
		echo"<div class='carousel-inner'>";
		echo"<div class='item carousel-item active'>
				<div class='row'>";
				
			for($i=1;$i<=count($result);$i++)
			{
				$pro_id = $result[$i-1]["pid"];
			$pro_cat = $result[$i-1]["cid"];
			$pro_brand = $result[$i-1]["bid"];
			$pro_title = $result[$i-1]["product_name"];
			$pro_price = $result[$i-1]["product_price"];
			$pro_image = $result[$i-1]["pro_imgs"];
				echo"<div class='col-sm-3' style='margin-bottom:10px'>
							<div class='thumb-wrapper'>
							
								<div class='img-box' pid='$pro_id'>
									<img src='images/$pro_image' class='img-responsive img-fluid' alt='' title=''>
									<div class='overly'>
										<div class='detail'>View Details</div>
									</div>

								</div>
								
								<div class='thumb-content'>
									<a href='#' class='title' pid='$pro_id'><h4>$pro_title</h4></a>
									<p class='item-price'><span>Rs $pro_price</span></p>
									<a href='#' pid='$pro_id' id='product_cart' class='btn btn-primary'>Add to Cart</a>
								</div>						
							</div>
						</div>";
						if($i%4 == 0 && $i!=count($result))
						{
							echo"</div>";
							echo"</div>";
							echo"<div class='item carousel-item '>
							<div class='row'>";
						}
			}
			echo"</div>";
			echo"</div>";
			echo"</div>";
		if(COUNT($result)>5)
		{
			echo"			<a class='carousel-control left carousel-control-prev' href='#".$id."' data-slide='prev'>
				<i class='fa fa-angle-left'></i>
		<p>Prev</p>				
			</a>
			<a class='carousel-control right carousel-control-next' href='#".$id."' data-slide='next'>
				<i class='fa fa-angle-right'></i>
				<p>Next</p>
			</a>";
		}
		echo"</div>
		</div>
	</div>
</div>
";
}


if(isset($_POST["getcar"]))
{
	carousel(1,"Mens","Fashion","mcarousel1");
	include_once("../modules/banner.php");
	carousel(3,"Electronics","","mcarousel2");
	include_once("../modules/banner.php");
	//carousel(1,"Mens","Fashion");
	//echo COUNT($result)/3;
	//print_r($result);
	
	
	
}
//Get The Delivery Details
if(isset($_POST["deleveryDetails"])){
	$obj = new DBOperation();
			
			$result = $obj->getSelectedRecord("cust_info",$_SESSION['id'],"id");
			//print_r($result);
			$name = $result[0]['u_nme'];
			$email=$result[0]['email'];
			$mno=$result[0]['mobile'];
			$address = $result[0]['address'];

				echo"

<div class='col-md-8'>
<div class='form-group'>
  <label>Name:</label>
  <input type='text' name='usr_name' class='form-control' id='usr_name' value='$name' disabled>
</div>
</div>

<div class='col-md-8'>
<div class='form-group'>
  <label>Email:</label>
  <input type='text' name='usr_email' class='form-control' id='usr_email' value='$email' disabled>
</div>
</div>

<div class='col-md-8'>
<div class='form-group'>
  <label>Mobile no:</label>
  <input type='text' name='usr_mbo' class='form-control' id='usr_mbo' value='$mno' disabled>
</div>
</div>";				

if(empty($address))
{
echo"

<div class='col-md-8'>
<div class='form-group'>
  <label>Address:</label>
  <input type='text' name='usr_address' class='form-control' id='usr_address' value='' placeholder='Delivery Address'>
</div>
</div>
";
}else{
echo"

<div class='col-md-8'>
<div class='form-group'>
  <label>Address:</label>
  <input type='text' name='usr_address' class='form-control' id='usr_address' value='$address' disabled>
</div>
</div>
";	
}

		
		exit();
	
}
//Get Cart Product
if(isset($_POST["cart_checkout"])){
	$uid = $_SESSION["id"];
	$obj = new DBOperation();
	$result = $obj->getSelectedRecord("cart",$uid,"user_id");
	if(is_array($result)){
	$count = COUNT($result);}
	else{$count=0;}
if($count>0){
		$no=1;
		$total_amt = 0;
	//	echo($count);
			for($i=0;$i<$count;$i++)
			{
				$id = $result[$i]["id"];
			$pro_id = $result[$i]["p_id"];
			$pro_name = $result[$i]["pro_name"];
			$pro_image = $result[$i]["pro_image"];
			$pro_price = $result[$i]["price"];
			$qty = $result[$i]["qty"];
			$total = $result[$i]["total_amount"];
			$extra = $result[$i]["extra"];
			$price_array = array($total);
			$total_sum = array_sum($price_array);
			$total_amt = $total_amt +$total_sum;
			$p = $i+1;
			
			echo"<div class='row'>
			<div class='col-md-1'><div class='checkbox'>
  <label><input type='checkbox' class='pro_duct' name='product[]' pid='$pro_id' value='$pro_id'>Product $p</label>
</div></div>
<div class='col-md-2'>
<div class='btn-group'>
<a href='#' remove_id='$id' class='btn btn-danger remove'><span class='glyphicon glyphicon-trash'></span></a>
<a href='#' update_id='$pro_id' class='btn btn-primary update'><span class='glyphicon glyphicon-ok-sign'></span></a>
</div>
</div>
<div class='col-md-2' max-height='60px' max-width='50px' ><img src='images/$pro_image' max-width='50px' height='60px' ></div>
<div class='col-md-2 pro_nme' pid='$pro_id' >$pro_name</div>";

if($extra == ""){echo"<div class='col-md-2 extra' pid='$pro_id'>None</div>";}
else {
	if($extra=="none"){$val="0";}
	else{$val=$extra;}
	echo"
		<div class='col-md-2'>
		
		<div class='form-group'>
			<label >Size</label>
			<select class='form-control extra' pid='$pro_id' id='select_size-$pro_id' name='select_size[]' >
			<option value='0'>Select Size</option>
			";
			
			
				$obj2 = new DBOperation();
				$result2 = $obj2->getSelectedRecord("sizes",$pro_id,"pid");
				$x = explode('**',$result2[0]['aval_size']);
				for($f=0;$f<sizeof($x);$f++){
				$s= explode("--",$x[$f]);
				echo"<option value='$s[0]'"; if($val==$s[0])echo"selected='selected'";   echo">".$s[0]."</option>";
				}
			
			echo"
			</select>
			
		
			
		</div>
		
		</div>
		";
}

echo"
<div class='col-md-1'><input type='text' name='qty[]' class='form-control qty' pid='$pro_id' id='qty-$pro_id' value='$qty' ></div>
<div class='col-md-1'><input type='text' class='form-control price' pid='$pro_id'   id='price-$pro_id' value='$pro_price'disabled></div>
<div class='col-md-1'><input type='text' class='form-control total' pid='$pro_id' id='total-$pro_id' value='$total' disabled></div>

</div>
<hr>";
			
			}
			
			echo"
			<div class='row'>
<div class='col-md-8'><div class='form-group'>
  <label>Select Payment Method</label>
  <select class='form-control' id='payment' name='payment'>
    <option value=''>Select</option>
	<option value='cash'>Cash On Delivery</option>
    <option value='paytm'>Paytm On Delivery</option>
  </select>
</div></div>
<div class='col-md-2'><a href='#' id='placeorder' class='btn btn-success'>Place Order</a></div>
<b>Total $total_amt</b>
</div>";
		
}else{
	echo"<h1>Your Cart is Empty..!</h1>";
	echo"<a href='#' id='backtoshop'class='btn btn-primary btn-lg'>Go To Shopping Page</a>";
	echo"<div class='row'>
<b style='float:right;padding-right:30px;'>Total Rs 0.00</b>
</div>";
}

	
exit();
}



//Update Record after getting data
if(isset($_POST["updateProduct"])){
	//echo"Hello";
	//exit();
		$obj = new DBOperation();
		$uid = $_SESSION["id"];
	$pid = $_POST["updateId"];
	$qty = $_POST["qty"];
	$price = $_POST["price"];
	$total = $_POST["total"];
	if(isset($_POST["updatedsize"])){$size=$_POST["updatedsize"];if($size=="0"){$size="none";}}else{$size="";}

	$result = $obj->update_record("cart",["user_id"=>$uid,"p_id"=>$pid],["qty"=>$qty,"price"=>$price,"total_amount"=>$total,"extra"=>$size]);
	if($result=="UPDATED"){
		echo"<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Product is Updated in the Cart..!</b>
	</div>";
	}
	
	exit();
}



if(isset($_POST["removeFromCart"])){
	$pid = $_POST["removeId"];
	$obj = new DBOperation();
	$result = $obj->deleteRecord("cart","id",$pid);
		
		if($result=="DELETED"){
		echo"<div class='alert alert-danger'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Product is Removed from Cart Continue Shopping..!</b>
	</div>";
	}
	exit();
}
if(isset($_POST["product_page_cart"])){
	if(isset($_SESSION["id"]))
	{
		if(isset($_POST["selected_size"])){
			$size = $_POST["selected_size"];
			if($size=="0"){
			$size="none";
		}
		}
		else{
			$size="";
		}
		if(isset($_POST["selected_qty"]))
		{
			$qty = $_POST["selected_qty"];
		}else{
			$qty = 1;
		}
		
	$user_id=$_SESSION["id"];
	$p_id=$_POST["proId"];
	$obj = new DBOperation();
	$result = $obj->addTocart($p_id,$user_id,$size,$qty);
	
	if($result == "Already_Added"){
		$result2 = $obj->update_record("cart",["user_id"=>$user_id,"p_id"=>$p_id],["qty"=>$qty,"extra"=>$size]);
		if($result2=="UPDATED")
		{
			
		}
		
	}
		
}else{
	echo"NOT_LOGIN";
}
	exit();
}

if(isset($_POST["PlaceOrder"]))
{	date_default_timezone_set("Asia/Kolkata");
	$uid = $_SESSION["id"];
	$pid=$_POST["products"];
	$qty=$_POST["qty"];
	$extra=$_POST["extra"];
	$time=gettimeofday(true);
	$payment=$_POST["payment"];
	$address=$_POST["address"];
	$pro_name = $_POST["pro_nme"];
	$obj = new DBOperation();
	for($i=0;$i<Count($pid);$i++)
	{
		
		$result = $obj->placeOrder($uid,$pid[$i],$qty[$i],$extra[$i],$time,$payment,$pro_name[$i]);
	}
	
	if($result =="Success_Order")
	{
		$result2 = $obj->update_record("cust_info",["id"=>$uid],["address"=>$address]);
		for($i=0;$i<Count($pid);$i++)
	{
	$result2 = $obj->deleteRecord("cart","p_id",$pid[$i]);
	
	}
	echo $result;
	}	
	exit();
	}
	

?>