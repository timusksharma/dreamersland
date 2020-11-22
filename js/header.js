$(document).ready(function(){
	$("#search").keyup(function(){
		var search = $(this).val();
		if(search!="")
		{
		$.ajax({
		   url: "includes/process.php",
		   method : "POST",
		   data : {Get_Search:1,search:search},
		   success : function(data){
		//alert(data);
		if(data!="NO_DATA")
		{
			$("#search_menu").html(data);
		}else{
			$("#search_menu").html("<li class='text-center'>No Results Found!!</li>");
		}
				}
			})	
		}else{
			$("#search_menu").html("");
		}
		
		
	})
	$("#h_search").keyup(function(){
		$("#h_search").dropdown("toggle");
		var search = $(this).val();
		if(search!="")
		{
		$.ajax({
		   url: "includes/process.php",
		   method : "POST",
		   data : {Get_Search:1,search:search},
		   success : function(data){
		//alert(data);
		if(data!="NO_DATA")
		{	
			$("#search_menu_mobile").html(data);
		}else{
			$("#search_menu_mobile").html("<li class='text-center'>No Results Found!!</li>");
		}
				}
			})	
		}else{
			$("#search_menu_mobile").html("");
		}
		
	})

})