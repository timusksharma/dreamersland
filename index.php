<?php
include_once("./includes/login_status.php");
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

<link rel="stylesheet" href="
https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="bootstrap/css/bootstrap3.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap3.min.js"></script>

<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/banner.css">
<link rel="stylesheet" href="css/product_carousel.css">
<link rel="stylesheet" href="css/main_carousel.css">
<script src="js/getcarousels.js"></script>
<script src="js/header.js"></script>
</head>
<body>

<!--Header Starts-->

<?php
include_once("./modules/header.php");
?>
<!--Header Ends-->


<!--Main Carousel-->
<?php
include_once("./modules/main_carousel.php");
?>
<!--Main Carousel Ends-->


<!--product carousel-->
<?php
include_once("./modules/product_carousel.php");
?>
<!--End product carousel-->


<!-- Banner -->
<?php
include_once("./modules/banner.php");
?>

<!--Banner Ends-->

<!--Footer-->
<?php
include_once("./modules/footer.php");
?>
<!--Footer Ends-->
</body>
</html>












                            