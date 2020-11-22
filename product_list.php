<?php
include_once("./includes/login_status.php");
if(!isset($_REQUEST["c_id"]) )
{
	header("location:index.php");
	exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dreamersland</title>

<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

<link href="https://fonts.googleapis.com/css?family=Oswald:300,400|Roboto:300,400,700" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="stylesheet" href="bootstrap/css/bootstrap3.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap3.min.js"></script>


<link href = "bootstrap/css/jquery-ui.min.css"
         rel = "stylesheet">
<script src = "bootstrap/js/jquery-ui.min.js"></script>
  
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/mobile.css">


<script src="js/get.js"></script>
<script src="js/header.js"></script>

	  <!-- Javascript -->
      <script>
         $(function() {
            $( "#m_slider" ).slider({
               range:true,
               min: 0,
               max: 2000,
               values: [250,500],
               slide: function( event, ui ) {
                  $( "#m_price" ).val( "Rs" + ui.values[ 0 ] + " - Rs" + ui.values[ 1 ] );
               }
            });
            $( "#m_price" ).val( "Rs" + $( "#m_slider" ).slider( "values", 0 ) +
               " - Rs" + $( "#m_slider" ).slider( "values", 1 ) );
         });
      </script>





<style>
/*Product*/

/*Product Grid*/
.pro_con .product-grid{
	padding-bottom:20px;
	padding-top:20px;
}
.product-grid:hover{
 box-shadow: 0 3px 16px 0 rgba(0,0,0,.11);
}
.pro_con .image{
	position: relative;
}
.pro_con .overimage{
	position:absolute;
	top:0;
	bottom:0;
	left:0;
	right:0;
	height:100%;
	width:100%;
	opacity:0;
	transition:.5s ease;
	background-color:rgba(67,68,68,0.7);
}
.pro_con .image:hover .overimage{
	opacity:1;
}
.pro_con .detail{
	color:#fff;
	font-size:20px;
	position:absolute;
	top:50%;
	left:50%;
	transform:translate(-50%, -50%);
	-ms-transform:translate(50%,-50%);
}
.pro_con .buy{
	background-color:transparent;
	color:#434444;
	border-radius:0;
	border:1px solid #434444;
	width:100%;
	margin-top:20px;
}
.pro_con .buy:hover{
	background-color:#434444;
	color:#fff;
}



@media only screen and  (min-width: 992px) {
     #pro_c{
		 width:99.9999%;
	 }

 

}

</style>
<link rel="stylesheet" href="css/loader.css">

</head>
<body>


<!--Header Starts-->
<div class="loder_back"><div class="loder"></div></div>

<?php
include_once("./modules/header.php");
?>
<!--Header Ends-->


<!--Products-->
<div class="container-fluid" style="margin-top:10px; ">
<div class="row" >

<!--Filters-->
<div class="col-md-3" id="pc">
<ul class="navbar navbar-default nav" style="">
<h3 style="padding-left:15px;">Filters</h3>
<hr>
<li>
<a href="#p" style="font-size:16px;" data-toggle="collapse" style="text-decoration:none;">Price   <span class="glyphicon glyphicon-plus" style="float:right"></span></a>
<div class="nav collapse in" id="p">
<br>
      <div id = "slider-3"style="margin-left:10px;margin-right:10px"></div>
	  <p class="text-center">
         <input type = "text" id = "price" 
            style = "border:0; color:#b9cd6d; font-weight:bold;">
			<div class="form-group">
			<div class="col-xs-6">
<label>Price :</label>
  <input type="text" class="form-control" name="from" id="from">	
	</div>
  <div class="col-xs-6">
  <label>To:</label>
  <input type="text" class="form-control" name="to" id="to">
  </div>
  </div>
      </p>

</div>
</li>

<hr>

<li id="catgries">
</li>
<li id="brands">
</li>
<li id='size_fil'>
</li>






</ul>
</div>
<!--Filters End-->

<!--Product List-->
<div class="pro_con">
<div class="col-md-9"style="">

<div class="row" id="pro_c" style="background:#fff;">

<div class="col-xs-6">
<h3 style="padding-left:20px;">Products</h3>
</div>
<div class="col-xs-6" style="padding-top:20px;">

<a href="#" id="m_f" class="btn btn-info btn-md " onclick="openFilter()"style="float:right">Filters</a>
</div>
<p><br></p>
<p><br></p>

<hr>
<div id="get_productS"></div>
<!--

<div class="col-md-3  product-grid">
<div class="image">
<a href="#">
<center>
<img src="products/watch.jpg" class="img-responsive" style="height:154px;">
</center>

<div class="overimage">
<div class="detail">View Details</div>
</div>
</a> 
</div>

<h4 class="text-center" style="font-size:1.5rem;">Apple Watch Series 3 Aluminium</h4>
<h5  style="font-size:1.8rem;padding-left:15px">Rs 15000.00</h5>

<a href = "#" class="btn buy">BUY</a>
</div>





<div class="col-md-3  product-grid">
<div class="image">
<a href="#">
<center>
<img src="SSS/1.jpg" class="img-responsive" style="height:154px;">
</center>

<div class="overimage">
<div class="detail">View Details</div>
</div>
</a> 
</div>

<h4 class="text-center" style="font-size:1.5rem;">Apple Watch Series 3 Aluminium</h4>
<h5  style="font-size:1.8rem;padding-left:15px">Rs 15000.00</h5>

<a href = "#" class="btn buy">BUY</a>
</div>




<div class="col-md-3  product-grid">
<div class="image">
<a href="#">
<center>
<img src="SSS/2.jpg" class="img-responsive" style="height:154px;">
</center>

<div class="overimage">
<div class="detail">View Details</div>
</div>
</a> 
</div>

<h4 class="text-center" style="font-size:1.5rem;">Apple Watch Series 3 Aluminium</h4>
<h5  style="font-size:1.8rem;padding-left:15px">Rs 15000.00</h5>

<a href = "#" class="btn buy">BUY</a>
</div>





<div class="col-md-3  product-grid">
<div class="image">
<a href="#">
<center>
<img src="SSS/3.jpg" class="img-responsive" style="height:154px;">
</center>

<div class="overimage">
<div class="detail">View Details</div>
</div>
</a> 
</div>

<h4 class="text-center" style="font-size:1.5rem;">Apple Watch Series 3 Aluminium</h4>
<h5  style="font-size:1.8rem;padding-left:15px">Rs 15000.00</h5>

<a href = "#" class="btn buy">BUY</a>
</div>




<div class="col-md-3  product-grid">
<div class="image">
<a href="#">
<center>
<img src="SSS/4.jpg" class="img-responsive" style="height:154px;">
</center>

<div class="overimage">
<div class="detail">View Details</div>
</div>
</a> 
</div>

<h4 class="text-center" style="font-size:1.5rem;">Apple Watch Series 3 Aluminium</h4>
<h5  style="font-size:1.8rem;padding-left:15px">Rs 15000.00</h5>

<a href = "#" class="btn buy">BUY</a>
</div>



<div class="col-md-3  product-grid">
<div class="image">
<a href="#">
<center>
<img src="SSS/5.jpg" class="img-responsive" style="height:154px;">
</center>

<div class="overimage">
<div class="detail">View Details</div>
</div>
</a> 
</div>

<h4 class="text-center" style="font-size:1.5rem;">Apple Watch Series 3 Aluminium</h4>
<h5  style="font-size:1.8rem;padding-left:15px">Rs 15000.00</h5>

<a href = "#" class="btn buy">BUY</a>
</div>


<div class="col-md-3  product-grid">
<div class="image">
<a href="#">
<center>
<img src="SSS/6.jpg" class="img-responsive" style="height:154px;">
</center>

<div class="overimage">
<div class="detail">View Details</div>
</div>
</a> 
</div>

<h4 class="text-center" style="font-size:1.5rem;">Apple Watch Series 3 Aluminium</h4>
<h5  style="font-size:1.8rem;padding-left:15px">Rs 15000.00</h5>

<a href = "#" class="btn buy">BUY</a>
</div>



<div class="col-md-3  product-grid">
<div class="image">
<a href="#">
<center>
<img src="SSS/7.jpg" class="img-responsive" style="height:154px;">
</center>

<div class="overimage">
<div class="detail">View Details</div>
</div>
</a> 
</div>

<h4 class="text-center" style="font-size:1.5rem;">Apple Watch Series 3 Aluminium</h4>
<h5  style="font-size:1.8rem;padding-left:15px">Rs 15000.00</h5>

<a href = "#" class="btn buy">BUY</a>
</div>



<div class="col-md-3  product-grid">
<div class="image">
<a href="#">
<center>
<img src="SSS/8.jpg" class="img-responsive" style="height:154px;">
</center>

<div class="overimage">
<div class="detail">View Details</div>
</div>
</a> 
</div>

<h4 class="text-center" style="font-size:1.5rem;">Apple Watch Series 3 Aluminium</h4>
<h5  style="font-size:1.8rem;padding-left:15px">Rs 15000.00</h5>

<a href = "#" class="btn buy">BUY</a>
</div>

-->

 <!--<div class="col-md-12">
<hr>

<div class="text-center">
<ul class="pagination">
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
</ul>
</div>
</div>
-->


</div>

</div>

<!--Product List end-->
</div>

</div>
</div>

<!--Products End-->

<!--filter-->

<?php
include_once("./modules/mobile_filter.php");
?>
<!--filter Ends-->

<!--Footer-->
<?php
include_once("./modules/footer.php");
?>
<!--Footer Ends-->
</body>
</html>



                            