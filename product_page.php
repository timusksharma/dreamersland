<?php
include_once("./includes/login_status.php");
if(!isset($_REQUEST["proid"]) )
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
<title>DreamersLand</title>

<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

<link href="https://fonts.googleapis.com/css?family=Oswald:300,400|Roboto:300,400,700" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="stylesheet" href="bootstrap/css/bootstrap3.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap3.min.js"></script>



  
<link rel="stylesheet" href="css/header.css">

<script src="js/cart.js"></script>
<script src="js/getpro.js"></script>
<script src="js/header.js"></script>
  
<link rel="stylesheet" href="css/loader.css">

<script type="text/javascript">
	$(document).ready(function(){
		// Highlight bottom nav links
		var clickEvent = false;
		$("#m_Carousel").on("click", ".nav a", function(){
			clickEvent = true;
			$(this).parent().siblings().removeClass("active");
			$(this).parent().addClass("active");		
		}).on("slid.bs.carousel", function(e){
			if(!clickEvent){
				itemIndex = $(e.relatedTarget).index();
				targetNavItem = $(".nav li[data-slide-to='" + itemIndex + "']");
				$(".nav li").not(targetNavItem).removeClass("active");
				targetNavItem.addClass("active");
			}
			clickEvent = false;
		});
	});
</script>
<link rel="stylesheet" href="css/product_page.css">


</head>
<body>


<!--Header Starts-->
<div class="loder_back"><div class="loder"></div></div>

<?php
include_once("./modules/header.php");
?>
<!--Header Ends-->
<?php
include_once("./modules/product.php");
?>

<!--Footer-->
<?php
include_once("./modules/footer.php");
?>
<!--Footer Ends-->
</body>
</html>



                            