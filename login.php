<?php
include_once("./includes/login_status.php");

if($login_key){
	header("location:profile.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DreamersLand</title>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="bootstrap/css/bootstrap3.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap3.min.js"></script>

<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/loader.css">
<link rel="stylesheet" href="css/login.css">
<script src="./js/log.js"></script>
<script src="js/header.js"></script>
<style>
.bordr_r{
border: 1px solid red !important;	
}
</style>
</head>
<body>

<!--Header Starts-->
<div class="loder_back"><div class="loder"></div></div>

<?php
include_once("./modules/header.php");
?>
<!--Header Ends-->

<!--Login-->

<div class="login-form">
    <form id="log_form" onsubmit="return false" autocomplete="off">
        <h2 class="text-center">Login</h2>   
        <div class="form-group has-error">
        	<input type="text" class="form-control" name="log_e" id="log_e" placeholder="Username">
			<small id="e_error" class="form-text text-muted"></small>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="log_p" id="log_p" placeholder="Password">
			<small id="p_error" class="form-text text-muted"></small>
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
        </div>
        <!--<p><a href="#">Lost your Password?</a></p>-->
    </form>
    <p class="text-center hint-text ">Don't have an account? <a href="signup.php">Sign up here!</a></p>
</div>

<!--Login Ends-->
<p><br></p>
<!--Footer-->
<?php
include_once("./modules/footer.php");
?>
<!--Footer Ends-->
</body>
</html>












                            