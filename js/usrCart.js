$(document).ready(function(){
	 deleveryDetails();
	 function deleveryDetails()
	 {
		 $.ajax({
		   url: "includes/process.php",
		   method: "POST",
		   data: {deleveryDetails:1},
		   success: function(data){
			   //alert(data);
			  $("#de").html(data);
		   }
	   })
	 }
	 cart_checkout();
   function cart_checkout(){
	   $.ajax({
		   url: "includes/process.php",
		   method: "POST",
		   data: {cart_checkout:1},
		   success: function(data){
			   //alert(data);
			  $("#cart_checkout").html(data);
		   }
	   })
   }
    $("body").delegate(".qty","keyup",function(){
	   var pid = $(this).attr("pid");
	   //alert(pid);
		
	  var qty = $("#qty-"+pid).val();
	  if(!isNaN(qty))
	  {
	   if(qty>5){
		   alert("You Can't order More than 5");
		  $("#qty-"+pid).val("1");
		  var price = $("#price-"+pid).val();
	   var total = 1 * price;
	   //alert(total);
	   $("#total-"+pid).val(total);
	   }
	   else{
		    var price = $("#price-"+pid).val();
	   var total = qty * price;
	   //alert(total);
	   $("#total-"+pid).val(total);
	   }
	  }else{
		  $("#qty-"+pid).val("1");
		  var price = $("#price-"+pid).val();
	   var total = 1 * price;
	   //alert(total);
	   $("#total-"+pid).val(total);
	  }
	  
	   
   })
   $("body").delegate(".update","click",function(event){
	   event.preventDefault();
	   var pid = $(this).attr("update_id");
	   //alert(pid);
	   var qty = $("#qty-"+pid).val();
	   var price = $("#price-"+pid).val();
	   var total = $("#total-"+pid).val();
	   var updatedsize = $("#select_size-"+pid).val();
	   
	   
	   $.ajax({
		   url:"includes/process.php",
		   method: "POST",
		   data:{updateProduct:1,updateId:pid,qty:qty,price:price,total:total,updatedsize:updatedsize},
		   success:function(data){
			   $("#cart_msg").html(data);
			   cart_checkout();
		   }					
	   })
	   
   })
   
   $("body").delegate(".remove","click",function(event){
	   event.preventDefault();
	   var pid = $(this).attr("remove_id");
	  // alert(pid);
	  $.ajax({
		  url: "includes/process.php",
		  method: "POST",
		  data: {removeFromCart:1,removeId:pid},
		  success: function(data){
			//alert(data);
			$("#cart_msg").html(data);
			cart_checkout();
			cart_count();
			
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
   $("body").delegate("#backtoshop","click",function(event){
	   event.preventDefault();
	   window.location.href = "index.php";
   })
	 $("body").delegate("#placeorder","click",function(event){
		  event.preventDefault();
			var address = $("#usr_address").val();
		  if(address=="")
		  {
			  alert("Please Enter Delivery Address");
			  return 0 ;
		  }
		  
			var ar=[];
			$.each($("input[name='product[]']:checked"), function(){ 
			var t=$(this).val();
			ar.push(t);
		});
		var i=0;
		var qty=[];
		$.each($("input[name='qty[]']"), function(){
			if($(this).attr('pid')==ar[i])
			{
				qty.push($(this).val());
				i=i+1;
			}
		});
	//	alert(ar);
	
	status=true;
 i=0;
		$('.extra').each(function () { 
			if($(this).attr('pid')==ar[i])
			{
				if($(this).html()!="None")
				{if($(this).val()=="0")
					{
						status=false;
					}
					
				}
				
				i=i+1;
			}
});
var pro_nme = [];
i=0;
		$('.pro_nme').each(function () { 
			if($(this).attr('pid')==ar[i])
			{
				pro_nme.push($(this).html());
				
				i=i+1;
			}
});


var extra = [];
	 i=0;
	 if($("#payment").val()!="")
	 {
		 if(status=="true")
{
		$('.extra').each(function () { 
			if($(this).attr('pid')==ar[i])
			{
				if($(this).html()!="None")
					{
						extra.push($(this).val());
						
					}else{
						extra.push("none");
					}
				i=i+1;	
				}
				
				
			});
var payment = $("#payment").val();
		$.ajax({
				url:"includes/process.php",
				method: "POST",
				data: {PlaceOrder:1,products:ar,qty:qty,extra:extra,address:address,payment:payment,pro_nme:pro_nme},
				success: function(data){
					//alert(data);
					if(data=="Success_Order")
					{
						$("#Order").addClass("con");
						$("#Order").html("<h2>Your have Successfully Order</h2><br><a href='#' id='backtoshop'class='btn btn-primary btn-lg'>Go To Shopping Page</a>");
						
					}
				}
				
			})	

}

else{alert("Please Select Sizes");}

	 }else{
		 alert("Please Select Payment Method");
	 }


	 	
	
})

}) 
