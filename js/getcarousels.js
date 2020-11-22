$(document).ready(function(){
getcarousels();
	function getcarousels()
	{
	   $.ajax({
		   url: "includes/process.php",
		   method : "POST",
		   data : {getcar:1},
		   success : function(data){
			  //alert(data);
			  $("#products_views").html(data);
				}
			})
		}
		
		$("body").delegate(".getAllRelated","click",function(event){
	   event.preventDefault();
	   var c_id=$(this).attr('cid');
	    window.location.href = encodeURI("product_list.php?c_id="+c_id);
		})
		
		$("body").delegate(".img-box","click",function(event){
	 event.preventDefault();
	   var pid = $(this).attr("pid");
	   window.location.href = encodeURI("product_page.php?proid="+pid);
   })
   $("body").delegate(".title","click",function(event){
	 event.preventDefault();
	   var pid = $(this).attr("pid");
	   window.location.href = encodeURI("product_page.php?proid="+pid);
   })
   
   
   
     $("body").delegate("#product_cart","click",function(event){
	   event.preventDefault();
	   //alert(0);
	   var p_id=$(this).attr('pid');
	  // alert(p_id);
	  
	  $.ajax({
		  url : "includes/process.php",
		  method : "POST",
	    data : {addToProduct:1,proId:p_id},
		success : function(data){
			
			if(data=="NOT_LOGIN"){
			alert("Please Login to continue");
				window.location.href="login.php";
			}else{
				alert(data);
			cart_count();
			}
		}
	  })
   })
   
   
   cart_count();
   function cart_count(){
	   
	    $.ajax({
		url :"includes/process.php",
		  method : "POST",
	    data : {cart_count:1},
		success : function(data){
			
			$(".badge").html(data);
			
		}
	})
   }


//For Suscription Part
	$("#suscribe_form").on("submit",function(){
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+([\.a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		var email = $("#suscribe_email");
		var verify_e = false;
	
		if(email.val() == ""){
			alert("Please Enter Email");
			verify_e = false;
		}else if(!e_patt.test(email.val().toLowerCase())){
			alert("Please Enter Valid Email Address..!");
			verify_e = false;
			
		}else{
			verify_e =  true;
		}
		if(verify_e){
			$.ajax({
				url:"includes/process.php",
				method: "POST",
				data: $("#suscribe_form").serialize(),
				success: function(data){
					alert(data);
					email.val("");
				}
				
			})
		}
	})
	
	
		
})