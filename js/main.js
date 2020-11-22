$(document).ready(function(){

//verify Input fields
$("#email").focusout(function(){
	var inp = $("#email");
	var error = $("#e_error");
	verify_inp(inp,error);
	
})	
$("#mno").focusout(function(){
	var inp = $("#mno");
	var error = $("#mn_error");
	verify_inp(inp,error);
	
})
$("#u_name").focusout(function(){
	var inp = $("#u_name");
	var error = $("#n_error");
	verify_inp(inp,error);
	
})

$("#pass").focusout(function(){
	var inp = $("#pass");
	var error = $("#p_error");
	verify_inp(inp,error);
	
})	
$("#confirm_pass").focusout(function(){
	var inp = $("#confirm_pass");
	var error = $("#cp_error");
	verify_inp(inp,error);
	
})		

	
function verify_inp(inp,inperr){
	var n_patt = new RegExp(/^[A-Za-z ]+$/);
	var m_patt = new RegExp(/^[0-9]+$/);
	var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+([\.a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		
	if(inp.val() == ""){
			inp.addClass("bordr_r");
			inperr.html("<span class='text-danger'>Please fill this inputfield!!</span>");
		
			
		}else if(inp.attr("name")=="u_name"){
		if(!n_patt.test(inp.val())){
			inp.addClass("bordr_r");
					inperr.html("<span class='text-danger'>Invalid characters you are using in Name. Please use A-Z a-z Only..!</span>");
		}
		else{
					inp.removeClass("bordr_r");
					inperr.html("");
				
		}
		}
		
		else if(inp.attr("name")=="email"){
			
			if(!e_patt.test(inp.val().toLowerCase())){
					inp.addClass("bordr_r");
					inperr.html("<span class='text-danger'>Invalid characters you are using in email. Please Use Xyz@abc.com Type of pattern..!</span>");
			
			}else{
			$.ajax({
			url:"includes/action.php",
			method : "POST",
			data:{check_email:1,email:inp.val()},
			success : function(data){
				if(data==1)
				{
					inp.addClass("bordr_r");
					inperr.html("<span class='text-danger'>Account From This Email is Already Exists. Please use Different Email..!</span>");
				}
			else{
					inp.removeClass("bordr_r");
					inperr.html("");
				}				
				
				
			}
		})
		}
		}
		else if(inp.attr("name")=="mno"){
			if(!m_patt.test(inp.val()) ){
				inp.addClass("bordr_r");
				inperr.html("<span class='text-danger'>Invalid characters you are using in Mobile_no. Please Use 0-9 Digits only..!</span>");
				
			}else if((inp.val()).length>10 || (inp.val()).length<10){
				inp.addClass("bordr_r");
				inperr.html("<span class='text-danger'>Invalid Mobile no. Please use 10 digit of mobile no..!</span>");
			}
				else{
			$.ajax({
			url:"includes/action.php",
			method : "POST",
			data:{check_mob:1,mno:inp.val()},
			success : function(data){
				if(data==1)
				{
					inp.addClass("bordr_r");
					inperr.html("<span class='text-danger'>Account From This Mobile no. is Already Exists. Please use Different Mobile No..!</span>");
				}
			else{
					inp.removeClass("bordr_r");
					inperr.html("");
				}				
				
				
			}
		})
		}
		}
		else{
			inp.removeClass("bordr_r");
			inperr.html("");
		}
		
	}




/**/

	
//Register User
	$("#reg_form").on("submit",function(){
		
		var status = false;
		var verify_e = false;
		var verify_n = false;
		var verify_m = false;
		var verify_p = false;
		var verify_cp = false;
		var verify_mp = false;
		var name = $("#u_name");
		var mobn = $("#mno");
		var email = $("#email");
		var pass1 = $("#pass");
		var pass2 = $("#confirm_pass");
		var n_patt = new RegExp(/^[A-Za-z ]+$/);
		var m_patt = new RegExp(/^[0-9]+$/);
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+([\.a-z0-9_-]+)*(\.[a-z]{2,4})$/);
	
	if(name.val() == "" || (!n_patt.test(name.val())) ){
			name.addClass("bordr_r");
			$("#n_error").html("<span class='text-danger'>Please Enter your name.Use A-Z a-z Letters Only..!<br></span>");
			verify_n = false;
		
	}else{
			name.removeClass("bordr_r");
			$("#n_error").html("");
			verify_n = true;
		}
		
		if((!m_patt.test(mobn.val())) || mobn.val() == ""){
			mobn.addClass("bordr_r");
			$("#mn_error").html("<span class='text-danger'>Please Enter Valid Mobile No.Use 0-9 Digits Only..!</span>");
			verify_m = false;
		}else{
			mobn.removeClass("bordr_r");
			$("#mn_error").html("");
			verify_m = true;
		}
		
		if(!e_patt.test(email.val().toLowerCase()) || email.val() == "" ){
			email.addClass("bordr_r");
			$("#e_error").html("<span class='text-danger'>Please Enter Valid email Address. Use xyz@abc.com type of pattern only..!</span>");
			verify_e = false;
		}else{
			email.removeClass("bordr_r");
			$("#e_error").html("");
			verify_e = true;
		}
		
		
		if(pass1.val() == "" || pass1.val().length <9){
			pass1.addClass("bordr_r");
			$("#p_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			verify_p = false;
		}else{
			pass1.removeClass("bordr_r");
			$("#p_error").html("");
			verify_p = true;
		}
		
		
		if(pass2.val() == "" || pass2.val().length <9){
			pass2.addClass("bordr_r");
			$("#cp_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			verify_cp = false;
		}else{
			pass2.removeClass("bordr_r");
			$("#cp_error").html("");
			verify_cp = true;
		}
		
		if(pass1.val() == pass2.val() && verify_p == true){
			
			verify_mp = true;
		}else{
			pass2.addClass("bordr_r");
			$("#cp_error").html("<span class='text-danger'>Password is not matched.</span>");
			verify_mp = false;
		};
		
		if(verify_e == true && verify_n==true && verify_mp==true && verify_m==true){
			status = true;
		}
		else{
			status = false;
		}
		
//Inserting all records		
		if(status == true){
			$(".loder_back").show();
			$.ajax({
				url:"includes/action.php",
				method: "POST",
				data: $("#reg_form").serialize(),
				success: function(data){
				//alert(data);
				if(data=="Mobile_No_ALREADY_EXISTS")
				{  $(".loder_back").hide();
					mobn.addClass("bordr_r");
					$("#mn_error").html("<span class='text-danger'>Account From This Mobile no. is Already Exists. Please use Different Mobile No..!</span>");
				}
				else if(data == "EMAIL_ALREADY_EXISTS"){
					$(".loder_back").hide();
					email.addClass("bordr_r");
					$("#e_error").html("<span class='text-danger'>Account From This Email is Already Exists. Please use Different Email..!</span>");
				}else if(data == "SOME_ERROR"){
					$(".loder_back").hide();
					alert("Technical Issue Please Try Again Some Time!!");
				}else{
					$(".loder_back").hide();
					window.location.href = encodeURI("/index.php?msg=You are registered Now you can login");
					//alert(data);
				}
				}
				
			})
			
		}else{
			
			
		}
		
		
})

})