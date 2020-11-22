 
 $(document).ready(function(){
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


//For Login Part
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
   
