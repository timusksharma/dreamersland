$(document).ready(function(){
	function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){ return pair[1];}
       }
       return(false);
}
	
	//alert(getQueryVariable("proid"));
	
	getpro();
	function getpro()
	{var pid=getQueryVariable("proid");
	if(pid>0){
		//window.location.href="index.php";
		//alert(pid);
	   $.ajax({
		   url: "includes/process.php",
		   method : "POST",
		   data : {getpro:1,pid:pid},
		   success : function(data){
			  //alert(data);
			  $("#pro_con").html(data);
				}
			})
		}else{
		window.location.href="index.php";
	}	
	}
	$("body").delegate("#productCart","click",function(event){
	event.preventDefault();
		   var p_id=$(this).attr('pid');
		   var status=true;
		   var size = $("#select_size").val(); 
		  // alert(size);
		  var qty = $("#select_qty").val() ;
		  if(size=="0")
		  {
			  status = false;
			  alert("please Select Size");
		  }
		  if(status==true)
		  {
$.ajax({
		  url : "includes/process.php",
		  method : "POST",
	    data : {product_page_cart:1,proId:p_id,selected_size:size,selected_qty:qty},
		success : function(data){
			if(data=="NOT_LOGIN"){
			alert("Please Login to continue");
				window.location.href="login.php";
			}else{
				//alert(data);
				window.location.href="cart.php";
			//$("#product_msg").html(data);
			
			}
		}
	  })
		  }
	})
	
		
		
	})
	