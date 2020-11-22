<div id="m_filters" class="overlay_filter container-fluid">

  <span class="closebtn" onclick="closeFilter()" title="Close Overlay">×</span>
  
 <h4 style="font-size:24px">Filters</h4>
 
  <div class="row" >
  <div class="col-xs-12" >
  <hr>
  
<a href="#m_p" style="font-size:16px;" data-toggle="collapse" style="text-decoration:none;">Price   <span class="glyphicon glyphicon-plus" style="float:right"></span></a>
<div class="collapse in" id="m_p" style="padding-top:20px;">

      <div id = "m_slider"style="margin-left:10px;margin-right:10px"></div>
	  <p class="text-center">
         <input type = "text" id = "m_price" 
            style = "border:0; width:60%;height:25px;color:#b9cd6d; font-weight:bold;">
      </p>

</div>
  
  </div>
  
  <div class="col-xs-12">
  <hr>
<a href="#m_size" style="font-size:16px;" data-toggle="collapse" style="text-decoration:none;">Size   <span class="glyphicon glyphicon-plus" style="float:right;"></span></a>

<div class="collapse in size"id="m_size">

<form class="form-group form-horizontal"style="font-size:14px; padding-left:20px;">
    <div class="checkbox" >
      <label><input type="checkbox" value="">XL</label>
	  
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="">XXXL</label>
	  
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="" >M</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >S</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >32</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >31</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >30</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >28</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >27</label>
	  
    </div>
  </form>

</div>

    
  </div>
  
  <div class="col-xs-12">
  <hr>
  <a href="#m_brand" style="font-size:16px;" data-toggle="collapse" style="text-decoration:none;">Brand   <span class="glyphicon glyphicon-plus" style="float:right"></span></a>

<div class="collapse  size"id="m_brand">

<form style="font-size:14px; padding-left:20px;">
    <div class="checkbox" >
      <label><input type="checkbox" value="">SSS</label>
	  
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="">Zara</label>
	  
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="" >Addidas</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Puma</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Only</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Vans</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Reebok</label>
	  
    </div>
  </form>

</div>
  
  </div>
  
  
  <div class="col-xs-12">
  <hr>
  <a href="#m_category" style="font-size:16px;" data-toggle="collapse" style="text-decoration:none;">Categories   <span class="glyphicon glyphicon-plus" style="float:right"></span></a>

<div class="collapse size"id="m_category">

<form style="font-size:14px; padding-left:20px;">
    <div class="checkbox" >
      <label><input type="checkbox" value="">SSS</label>
	  
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="">Zara</label>
	  
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="" >Addidas</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Puma</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Only</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Vans</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Reebok</label>
	  
    </div>
  </form>

</div>

  
  </div>
  
  <div class="col-xs-12">
  <hr>
  <a href="#m_color" style="font-size:16px;" data-toggle="collapse" style="text-decoration:none;">Color   <span class="glyphicon glyphicon-plus" style="float:right"></span></a>

<div class="nav collapse size"id="m_color">

<form style="font-size:14px; padding-left:20px;">
    
    <div class="checkbox"  >
      <label><input type="checkbox" value=""> <span style=" background-color:blue;">&nbsp &nbsp &nbsp </span> &nbsp Blue </label>
	  
    </div>
	<div class="checkbox"  >
      <label><input type="checkbox" value=""> <span style=" background-color:red;">&nbsp &nbsp &nbsp </span> &nbsp Red </label>
	  
    </div>
	<div class="checkbox"  >
      <label><input type="checkbox" value=""> <span style=" background-color:green;">&nbsp &nbsp &nbsp </span> &nbsp Green </label>
	  
    </div>
	<div class="checkbox"  >
      <label><input type="checkbox" value=""> <span style=" background-color:black;">&nbsp &nbsp &nbsp </span> &nbsp Black </label>
	  
    </div>
	<div class="checkbox"  >
      <label><input type="checkbox" value=""> <span style=" background-color:orange;">&nbsp &nbsp &nbsp </span> &nbsp Orange </label>
	  
    </div>
	<div class="checkbox"  >
      <label><input type="checkbox" value=""> <span style=" background-color:yellow;">&nbsp &nbsp &nbsp </span> &nbsp Yellow </label>
	  
    </div>
  </form>

</div>

  </div>
  
  <div class="col-xs-12" style="padding-bottom:20px">
  <hr>
  <center><a href="#"  id="mobile_fil_apply"class="btn btn-primary btn-md ">Apply</a></center>
  </div>
  
</div>
</div>

<script>

function closeFilter() {
  document.getElementById("m_filters").style.display = "none";
  document.body.style.overflow = 'auto';

}
</script>