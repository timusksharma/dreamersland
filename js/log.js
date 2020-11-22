//Login
$(document).ready(function(){

//For Login Part
	$("#log_form").on("submit",function(){
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+([\.a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		var email = $("#log_e");
		var pass = $("#log_p");
		var verify_e = false;
		var verify_p = false;
		var status = false;
		if(email.val() == ""){
			email.addClass("bordr_r");
			$("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
			verify_e = false;
		}else if(!e_patt.test(email.val().toLowerCase())){
			email.addClass("bordr_r");
			$("#e_error").html("<span class='text-danger'>Please Enter Valid Email Address..!</span>");
			verify_e = false;
			
		}else{
			email.removeClass("bordr_r");
			$("#e_error").html("");
			verify_e =  true;
		}
		
		
		if(pass.val() == ""){
			pass.addClass("bordr_r");
			$("#p_error").html("<span class='text-danger'>Please Enter Password</span>");
			verify_p = false;
		}else{
			pass.removeClass("bordr_r");
			$("#p_error").html("");
			verify_p = true;
		}

		if((verify_e == true) && (verify_p == true))
		{
			status = true;
		}else{
			status = false;
		}
		if(status){
			$(".loder_back").show();
			$.ajax({
				url:"includes/action.php",
				method: "POST",
				data: $("#log_form").serialize(),
				success: function(data){
				if(data == "NOT_REGISTERED"){
					$(".loder_back").hide();
						email.addClass("bordr_r");
				$("#e_error").html("<span class='text-danger'>It seems like you have not registered yet..!</span>");
				status = false;
				}else if(data == "PASSWORD_NOT_MATCHED"){
					$(".loder_back").hide();
					pass.addClass("bordr_r");
			$("#p_error").html("<span class='text-danger'>Please Enter Correct Password..!</span>");
			status = false;
				}else{
					$(".loder_back").hide();
					//console.log(data);
					//alert(data);
					window.location.href = "profile.php?pag=profile";
				}
				}
				
			})
		}else{
			
		}
	})
	
})