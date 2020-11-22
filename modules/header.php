<nav class="navbar navbar-default navbar-fixed-top flxcon" data-spy="affix" data-offset-top="40"style="min-height:56px">
  <div class="container-fluid">
<div class="row">
  <div class=" navbar-header col-md-offset-1 col-xs-offset-1 col-sm-offset-1 col-lg-offset-1">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">DreamersLand</a>
	  
    </div>
	
	<div class=" collapse navbar-collapse" id="myNavbar">
	<ul class="nav navbar-nav navbar-right " style="color:#78909C;line-height: 20px;
    font-size: 16px; letter-spacing: .1px;
    font-weight: 500; margin: auto;" >
	<li class="dropdown">
	<?php if($login_key){ ?><a href="ss" class="dropdown-toggle" data-toggle="dropdown"><i class='far fa-smile' style='color:#1976D2;font-size:22px;'></i> <?php $name=explode(" ",$_SESSION["name"]); echo "Hi,".$name[0]; ?></a> <ul class='dropdown-menu' id='ss'>
<li><a href ='profile.php?pag=profile' style='text-decoration:none;color:blue;'>My Profile</a></li>
<li class='divider'></li>
<li ><a href ='profile.php?pag=order' style=' text-decoration:none;color:blue;'>Orders</a></li>
<li class='divider'></li>
<li><a href ='logout.php' style='text-decoration:none;color:blue;'>Logout</a></li>
</ul>  <?php }else{ ?><a href="login.php">Login & Signup</a><?php } ?>
</li>
	<!--<li><a href="#"><i class="fa fa-briefcase"></i> Sell on Dreamspark</a></li>-->
	<li><a href="cart.php"><i class="glyphicon glyphicon-shopping-cart" style="color:#1976D2;font-size:20px;"></i><sup><span class="badge"style="color:#fff; background-color:red;"></span></sup> Cart</a></li>
	</ul>
	
	
	<form onsubmit="return false" autocomplete="off" id="search_form" class="navbar-form">
	    <div class="col-md-4 col-xs-12 col-sm-2  col-lg-5   form-group input-group" onclick="openSearch()">
		<input id = "search" type="text" placeholder="Search" class="form-control srch dropdown-toggle"  data-toggle="dropdown">
		
		<!--<div class="input-group-btn" ><button id="s_btn"type="submit" class="btn btn-default">
		<span class="glyphicon glyphicon-search"></span></button>
	     
	    </div>-->
		    <ul class="dropdown-menu col-md-12" id="search_menu">
				
			</ul>
		</div>
	</form>
	</div>
    </div>
  </div>
  
  
</nav>


<div id="myOverlay" class="overlay">
  <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
  <div class="overlay-content">
    <form onsubmit="return false" autocomplete="off" >
      <input type="text"class="dropdown-toggle"  data-toggle="dropdown" placeholder="Search.." id="h_search" name="search">
     <!-- <button type="submit"><i class="fa fa-search"></i></button>-->
	 <p><br><br><br></p>
	 <ul class="dropdown-menu col-xs-12" id="search_menu_mobile">
				
		</ul>
    </form>
  </div>
</div>


<!--menu-->
<nav class="navbar" style="background-color:white;margin-top:56px; padding:0px;min-height: 40px; box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);">

<div class="container">
    
   <ul class="nav navbar-nav p_nav" >
   <li style="padding-left:40px; ">
        <a href="product_list.php?c_id=1" style="color:#666;padding:10px;" >Men</a>
      </li>
	  <li style="padding-left:40px;">
        <a href="product_list.php?c_id=2" style="color:#666;padding:10px;" >Women</a>
      </li>
	  <li style="padding-left:40px; ">
        <a href="product_list.php?c_id=3"  style="color:#666;padding:10px;">Electronics</a>
      </li>
   </ul>
  </div>
</nav>
<!--menu end-->

<script>
 
function openSearch() {
	if($(window).width()<992)
   {
	   $("#search").removeAttr("data-toggle");
	    $("#search").removeClass("dropdown-toggle");
	 document.getElementById("myOverlay").style.display = "block";
   $("#h_search").focus(); 
	   
   
   }else{
	   $("#search").attr("data-toggle","dropdown");
	   $( "#search" ).addClass( "dropdown-toggle" );
   }
  
}

function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
</script>
