$(document).ready(function(){
	function openFilter() {
	document.getElementById("m_filters").style.display = "block";
	document.body.style.overflow = 'hidden';
	
	}
	
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
	
	//alert(getQueryVariable("c_id"));
	
	//price
   $(function() {
            $( "#slider-3" ).slider({
               range:true,
               min: 0,
               max: 200000,
               values: [0,200000],
               slide: function( event, ui ) {
                  $( "#price" ).val( "Rs" + ui.values[ 0 ] + " - Rs" + ui.values[ 1 ] );
				  //product(1);
               },
			   stop: function( event, ui ) {
				   $( "#from" ).val(ui.values[ 0 ]);
				   $( "#to" ).val(ui.values[ 1 ]);
                 product(1);
               }
            });
            $( "#price" ).val( "Rs" + $( "#slider-3" ).slider( "values", 0 ) +
               " - Rs" + $( "#slider-3" ).slider( "values", 1 ) );
			   $( "#from" ).val($( "#slider-3" ).slider( "values", 0 ));
				   $( "#to" ).val($( "#slider-3" ).slider( "values", 1 ));
         });
	product(1);
	function product(pn){
		var cid=getQueryVariable("c_id");
		var pricef=$( "#from" ).val();
		
		var pricet=$("#to").val();
		var dat_size = $('#form_size').serializeArray();
		var dat_brnd = $('#form_brnd').serializeArray();
		var dat_cate = $('#form_cate').serializeArray();
		$(".loder_back").show();
		if(cid>0){
	   $.ajax({
		   url: "includes/process.php",
		   method : "POST",
		   data : {getProducts:1,pageno:pn,cid:cid,dat_size:dat_size,dat_cate:dat_cate,dat_brnd:dat_brnd,pricef:pricef,pricet:pricet},
		   success : function(data){
			   $(".loder_back").hide();
			  $("#get_productS").html(data);
				//alert(data);
		   }
	   })
		}else{
		window.location.href="index.php";
	}
   }
   
   //filters
   
   //mobile
      $("body").delegate("#mobile_fil_apply","click",function(){	  
	  alert("Hello World");
	  })
   
   
   //pc
   //Brands
   getBrands();
   function getBrands()
   {	//var cid = getQueryVariable("c_id");
	   
		$.ajax({
		   url: "includes/process.php",
		   method : "POST",
		   data : {GetBrands:1},
		   success : function(data){
			//alert(data);
			$('#brands').html(data);
		   }
	   })
		
		
	   
   }
   
   $("body").delegate(".brd","change",function(){	  
	 product(1); 
   })
  //Category
   getCategory();
   function getCategory()
   {	var cid = getQueryVariable("c_id");
   if(cid>0){
	   $.ajax({
		   url: "includes/process.php",
		   method : "POST",
		   data : {getCatgries:1,cid:cid},
		   success : function(data){
			  $("#catgries").html(data);
			//	alert(data);
			}
	   })
		}else{
		window.location.href="index.php";
	}
   }
   
   $("body").delegate(".cate","change",function(){	  
	 product(1);
		//alert("hello");
   })
   
   //Size
   getSizes();
   function getSizes(){
	   var cid = getQueryVariable("c_id");
	   if(cid==1 || cid==2)
	   {
		  $.ajax({
		   url: "includes/process.php",
		   method : "POST",
		   data : {GetSizes:1},
		   success : function(data){
			  $("#size_fil").html(data);
				//alert(data);
			}
	   }) 
	   }
   }
   $("body").delegate(".size_cat","change",function(){	  
	  product(1);
   })
   
   $("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		//alert(pn);
		product(pn);
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
			}else{alert(data);
			//$("#product_msg").html(data);
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
	
	//product
	
   $("body").delegate(".image","click",function(event){
	 event.preventDefault();
	   var pid = $(this).attr("pid");
	   window.location.href = encodeURI("product_page.php?proid="+pid);
   })
   
   
	
	
})