<?php

include_once("./includes/login_status.php");
if(!isset($_SESSION["id"])){
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DreamersLand</title>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

<link href="https://fonts.googleapis.com/css?family=Oswald:300,400|Roboto:300,400,700" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="bootstrap/css/bootstrap3.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap3.min.js"></script>

<link rel="stylesheet" href="css/header.css">

<script src="js/usrCart.js"></script>
<script src="js/header.js"></script>

</head>
<body>

<!--Header Starts-->

<?php
include_once("./modules/header.php");
?>
<!--Header Ends-->


<p><br/></p>
<p><br/></p>
<p><br/></p>
<div class="container-fluid" id="Order" style="">

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8" id="cart_msg">
<!--Cart Message-->
</div>
<div class="col-md-2"></div>


</div>
<div class="row"> 
<div class="col-md-12">
<div class="panel panel-primary">

<div class="panel-heading">
Cart Checkout
</div>

<div class="panel-body">
<div class="row">
<div class="col-md-12"><ul class='navbar navbar-default nav' style=''>
<li>
<a href='#de' style='font-size:16px;' data-toggle='collapse' style='text-decoration:none;'>Delivery Details   <span class='glyphicon glyphicon-plus' style='float:right'></span></a>
<div class='nav collapse in' id='de'>
<br>
     	  

</div>
</li>
</ul>
<p><br></p>
<p><br></p>
</div>

<div class="col-md-1"><b>Select</b></div>
<div class="col-md-2"><b>Action</b></div>
<div class="col-md-2"><b>Product Image</b></div>
<div class="col-md-2"><b>Product Name</b></div>
<div class='col-md-2'><b>Extra</b></div>
<div class="col-md-1"><b>Quantity</b></div>
<div class="col-md-1"><b>Product Price</b></div>
<div class="col-md-1"><b>Price in Rs</b></div>

</div>
<div id="cart_checkout"></div>

<!--<div class='row'>
<div class='col-md-2'>
<div class='btn-group'>
<a href='#'class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></a>
<a href='#'class='btn btn-primary'><span class='glyphicon glyphicon-ok-sign'></span></a>
</div>
</div>
<div class='col-md-2'><img src='product_images/imges.jpg'></div>
<div class='col-md-2'>Product Name</div>
<div class='col-md-2'><input type='text' class='form-control' value='5000' disabled></div>
<div class='col-md-2'><input type='text' class='form-control' value='1'></div>
<div class='col-md-2'><input type='text' class='form-control' value='5000' disabled></div>

</div>-->
<!--<div class="row">
<div class="col-md-8"></div>
<div class="col-md-2"></div>
<b>Total $500000</b>
</div>-->
</div>

<div class="panel-footer"></div>
</div>

</div>
<div class="col-md-2"></div>
</div>
</div>



<!--Footer-->
<?php
include_once("./modules/footer.php");
?>
<!--Footer Ends-->
</body>
</html>