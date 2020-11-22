<?php
include_once("./includes/login_status.php");
if(!isset($_SESSION["id"])){
header("location:login.php");
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


<link rel="stylesheet" href="css/header.css">
<script src="js/cart.js"></script>
<script src="js/profile.js"></script>
<script src="js/header.js"></script>
</head>
<body>

<!--Header Starts-->

<?php
include_once("./modules/header.php");
?>
<!--Header Ends-->


<div class="container" style="margin-top:10px; ">
<div class="row" >
<div class="col-md-3" >
<ul class="navbar navbar-default nav" style="">
<p style="padding-left:15px;color:#1976D2;font-size:22px;"><b><?php echo"Hi, ".$_SESSION["name"];?></b> <i class='far fa-smile' style='font-size:35px;'></i></p>
<hr>
<li>
<a href="profile.php?pag=order" style="font-size:16px;"  style="text-decoration:none;">My Orders</a>

</li>

<hr>
<li>
<a href="profile.php?pag=profile" style="font-size:16px;"  style="text-decoration:none;">Profile Information</a>

</li>

<hr>
<li>
<a href="profile.php?pag=address" style="font-size:16px;"  style="text-decoration:none;">Manage Addresses</a>

</li>

<hr>
<li>
<a href="logout.php" style="font-size:16px;"  style="text-decoration:none; ">Logout</a>

</li>

</ul>
</div>
<div class="col-md-7" id="profile" style="background:#fff;min-height:50vh;">
</div>

</div>
</div>


<!--Footer-->
<?php
include_once("./modules/footer.php");
?>
<!--Footer Ends-->
</body>
</html>