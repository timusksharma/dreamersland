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
<link rel="stylesheet" href="css/signup.css">
<script src="./js/main.js"></script>
<script src="js/header.js"></script>
</head>
<style>
.bordr_r{
border: 1px solid red !important;	
}
</style>
<body>

<!--Header Starts-->

<?php
include_once("./modules/header.php");
?>
<!--Header Ends-->

<!--Signup-->
<div class="loder_back"><div class="loder"></div></div>
<div class="signup-form">
    <form id="reg_form" onsubmit="return false" autocomplete="off">
		<h2>Sign Up</h2>
		<p>Please fill in this form to create an account!</p>
		<hr>
        <div class="form-group">
        	<input type="text" class="form-control" name="u_name" id="u_name" placeholder="Full Name">
        	<small id="n_error" class="form-text text-muted"></small>
		</div>
        <div class="form-group">
        	<div class="row">
				<div class="col-xs-3"><input type="text" class="form-control" name="cphcode" value="IN +91"  disabled></div>
				<div class="col-xs-9"><input type="text" class="form-control" name="mno" id="mno" placeholder="Mobile Number" ></div>
				
			</div>
			<small id="mn_error" class="form-text text-muted"></small>
        </div>
		
		<div class="form-group">
        	<input type="email" class="form-control" name="email" id="email" placeholder="Email">
        	<small id="e_error" class="form-text text-muted"></small>
		</div>
		
		<div class="form-group">
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" >
				<small id="p_error" class="form-text text-muted"></small>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="confirm_pass" id="confirm_pass" placeholder="Confirm Password">
				<small id="cp_error" class="form-text text-muted"></small>
        </div>        
       
		<div class="form-group">
            <button type="submit" name="usr_reg" class="btn btn-primary btn-lg">Continue</button>
        </div>
    </form>
	<div class="hint-text">Already have an account? <a href="login.php">Login here</a></div>
</div>
<!--Signup Ends-->

<!--Footer-->
<?php
include_once("./modules/footer.php");
?>
<!--Footer Ends-->
</body>
</html>












                            