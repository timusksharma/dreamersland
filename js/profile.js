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

page();
function page(){
var page=getQueryVariable("pag");

if(page!="" && page!=false){
	   $.ajax({
		   url: "includes/process.php",
		   method : "POST",
		   data : {getpage:1,pname:page},
		   success : function(data){
			  //alert(data);
			  
			 $("#profile").html(data);
				}
			})
		}else{
		window.location.href="index.php";
	}
	
}

 $("body").delegate(".can","click",function(event){
	var r = confirm("Do you want to cancel the Order");
	if(r==true)
	{
		var oid = $(this).attr('oid');
		$.ajax({
		   url: "includes/process.php",
		   method : "POST",
		   data : {cancelOrder:1,oid:oid},
		   success : function(data){
			if(data=="cancel")
			{
				window.location.href="";
			}else if(data=="NotCancel"){alert("Please Try Again");}
			  
			// $("#profile").html(data);
				}
			})
	}
 })



})