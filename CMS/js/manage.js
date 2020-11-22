$(document).ready(function(){
//var DOMAIN = ".";



//Fetch child Category 
	fetch_child_cat();
	function fetch_child_cat(){
		$.ajax({
			url : "includes/process.php",
			method: "POST",
			data: {getchild_cats:1},
			success: function(data){
				//alert(data);
				//var root = "<option value='0'>Root</option>";
				//var choose = "<option value=''>Choose Category</option>";
				//$("#getparent_cats").html(data);
				$("#getchild_cats").html(data);

				//$("#select_cat").html(choose+data);
			}
		})
	}

//Fetch parent Category 
	fetch_par_cat();
	function fetch_par_cat(){
		$.ajax({
			url : "includes/process.php",
			method: "POST",
			data: {getparent_cats:1},
			success: function(data){
				//alert(data);
				//var root = "<option value='0'>Root</option>";
				//var choose = "<option value=''>Choose Category</option>";
				$("#getparent_cats").html(data);
				//$("#select_cat").html(choose+data);
			}
		})
	}


//Fetch Feature Category 
	fetch_feat_cat();
	function fetch_feat_cat(){
		$.ajax({
			url : "includes/process.php",
			method: "POST",
			data: {getFeature_cat:1},
			success: function(data){
				//alert(data);
				//var root = "<option value='0'>Root</option>";
				//var choose = "<option value=''>Choose Category</option>";
				$("#parent_cats").html(data);
				//$("#select_cat").html(choose+data);
			}
		})
	}


//Manage Feature
	manageFeature(1);
	function manageFeature(pn){
		$.ajax({
				url: "includes/process.php/",
				method: "POST",
		data: {manageFeature:1,pageno:pn},
				success: function(data){
				//	alert(data);
				$("#get_feature").html(data);
				}
			})
	}

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		//alert(pn);
		manageFeature(pn);
	})
	
	
	$("body").delegate(".del_feat","click",function(){
		var did = $(this).attr("did");
		//alert(did);
		if(confirm("Are you sure ? You want to Delete..!")){
			$.ajax({
				url: "includes/process.php/",
				method: "POST",
		data: {deleteFeature:1,id:did},
				success: function(data){
						//$("#get_category").html(data);
						if(data=="DELETED"){
					alert("Feature is deleted");
					manageFeature(1);
					}else{
						alert(data);
					}
				}
			})
		}
	})
	
	
	//Update Feature
	
	$("body").delegate(".edit_feat","click",function(){
		$("#parent_cats input:checkbox").prop("checked", false);
		var eid = $(this).attr("eid");
		//alert(eid);
		$.ajax({
			url: "includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateFeature:1,id:eid},
			success: function(data){
				//alert(data);
				//alert(data["category_name"]);
				console.log(data);
				$("#fid").val(data["id"]);
				$("#update_feature").val(data["feature_name"]);
				//$("#parent_cats").val((data["parent_cats"]).split("**"));
				//console.log((data["parent_cats"]).split("**"));
				var x= (data["parent_cats"]).split("**");
				//console.log(x.length);
			$("#parent_cats input:checkbox").each(function() {
				var value = $(this).val();
				
				for(var i = 0 ; i<x.length;i++)
					if (value == x[i]) {
					//album_text.push(value);
					//alert(x[i]);
					$(this).prop("checked", true);
						}
						})
			}
		})
		
	})
	
	
	
	$("#update_feature_form").on("submit",function(){
		if($("#update_feature").val()==""){
			$("#update_feature").addClass("bordr_r");
			$("feat_error").html("<span class='text-danger'>Please Enter Feature Name</span>");
		}else{
			$.ajax({
				url:"includes/process.php",
				method: "POST",
				data: $("#update_feature_form").serialize(),
				success: function(data){
					alert(data);
				
					window.location.href="";
				}
			})
		}
	})


	
	
	
	

//Manage Category
	manageCategory(1);
	function manageCategory(pn){
		$.ajax({
				url: "includes/process.php/",
				method: "POST",
		data: {manageCategory:1,pageno:pn},
				success: function(data){
				//	alert(data);
				$("#get_category").html(data);
				}
			})
	}

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		//alert(pn);
		manageCategory(pn);
	})
	
	$("body").delegate(".del_cat","click",function(){
		var did = $(this).attr("did");
		//alert(did);
		if(confirm("Are you sure ? You want to Delete..!")){
			$.ajax({
				url: "includes/process.php/",
				method: "POST",
		data: {deleteCategory:1,id:did},
				success: function(data){
					if(data=="DEPENDENT_CATEGORY"){
					alert("Sorry! This Category is dependent on other sub Categories");
					}else if(data == "CATEGORY_DELETED"){
						alert("Deleted Successfully..!");
						manageCategory(1);
					}else if(data == "DELETED"){
						alert("Deleted Successfully");
					}else{
						alert(data);
					}	//$("#get_category").html(data);
				}
			})
		}
	})
	
	
	
	
	
	
	
	
	//Fetch Category 
	fetch_category();
	function fetch_category(){
		$.ajax({
			url : "includes/process.php",
			method: "POST",
			data: {getCategory:1},
			success: function(data){
				var root = "<option value='0'>Root</option>";
				var choose = "<option value=''>Choose Category</option>";
				$("#parent_cat").html(root+data);
				$("#select_cat").html(choose+data);
			}
		})
	}
	

	
		//Fetch Brand
	fetch_brand();
	function fetch_brand(){
		$.ajax({
			url : "includes/process.php",
			method: "POST",
			data: {getBrand:1},
			success: function(data){
				
				var choose = "<option value=''>Choose Brand</option>";
				$("#select_brand").html(choose+data);
			}
		})
	}


	
	
	//Update Category
	
	$("body").delegate(".edit_cat","click",function(){
		
		$("#getparent_cats input:checkbox").prop("checked", false);
		$("#getchild_cats input:checkbox").prop("checked", false);
		var eid = $(this).attr("eid");
		//alert(eid);
		$.ajax({
			url: "includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateCategory:1,id:eid},
			success: function(data){
				//alert(data);
				//alert(data["category_name"]);
				console.log(data);
				$("#cid").val(data["cid"]);
				$("#update_category").val(data["cat_name"]);
				$("#parent_cat").val(data["p_cat"]);
				
				var x= (data["total_par"]).split("**");
				//console.log(x.length);
			$("#getparent_cats input:checkbox").each(function() {
				var value = $(this).val();
				
				for(var i = 0 ; i<x.length;i++)
					if (value == x[i]) {
					//album_text.push(value);
					//alert(x[i]);
					$(this).prop("checked", true);
						}
			})

			 x= (data["total_childrns"]).split("**");
				//console.log(x.length);
			$("#getchild_cats input:checkbox").each(function() {
				var value = $(this).val();
				
				for(var i = 0 ; i<x.length;i++)
					if (value == x[i]) {
					//album_text.push(value);
					//alert(x[i]);
					$(this).prop("checked", true);
						}
			})			
			}
		})
		
	})
	
	$("#update_category_form").on("submit",function(){
		if($("#update_category").val()==""){
			$("#update_category").addClass("bordr_r");
			$("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
		}else{
			$.ajax({
				url:"includes/process.php",
				method: "POST",
				data: $("#update_category_form").serialize(),
				success: function(data){
				//	alert(data);
					window.location.href="";
				}
			})
		}
	})
	
	
	//-----------Brand-------------
	//Manage Brand
	manageBrand(1);
	function manageBrand(pn){
		$.ajax({
				url: "includes/process.php/",
				method: "POST",
		data: {manageBrand:1,pageno:pn},
				success: function(data){
				//	alert(data);
				$("#get_brand").html(data);
				}
			})
	}
	
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		//alert(pn);
		manageBrand(pn);
	})
	
	
		$("body").delegate(".del_brand","click",function(){
		var did = $(this).attr("did");
		//alert(did);
		if(confirm("Are you sure ? You want to Delete..!")){
			$.ajax({
				url: "includes/process.php/",
				method: "POST",
		data: {deleteBrand:1,id:did},
				success: function(data){
				if(data=="DELETED"){
					alert("Brand is deleted");
					manageBrand(1);
				}else{
			alert(data);
		}	
				}
			})
		}
	})
	
	//Update Brand
	
	$("body").delegate(".edit_brand","click",function(){
		var eid = $(this).attr("eid");
		//alert(eid);
		$.ajax({
			url: "includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateBrand:1,id:eid},
			success: function(data){
				//alert(data);
				//alert(data["category_name"]);
				console.log(data);
				$("#bid").val(data["bid"]);
				$("#update_brand").val(data["brand_name"]);
				
			}
		})
		
	})
	
	

	$("#update_brand_form").on("submit",function(){
		if($("#update_brand").val()==""){
			$("#update_brand").addClass("bordr_r");
			$("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
		}else{
			$.ajax({
				url:"includes/process.php",
				method: "POST",
				data: $("#update_brand_form").serialize(),
				success: function(data){
					alert(data);
					window.location.href="";
				}
			})
		}
	})
	
	//---------------Product-----------------
	
		//Manage Product
	manageProduct(1);
	function manageProduct(pn){
		$.ajax({
				url: "includes/process.php/",
				method: "POST",
		data: {manageProduct:1,pageno:pn},
				success: function(data){
				//	alert(data);
				$("#get_product").html(data);
				}
			})
	}
	
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		//alert(pn);
		manageProduct(pn);
	})

	
	$("body").delegate(".del_product","click",function(){
		var did = $(this).attr("did");
		//alert(did);
		if(confirm("Are you sure ? You want to Delete..!")){
			$.ajax({
				url: "includes/process.php/",
				method: "POST",
		data: {deleteProduct:1,id:did},
				success: function(data){
				if(data=="DELETED"){
					alert("Product is deleted");
					manageProduct(1);
				}else{
			alert(data);
		}	
				}
			})
		}
	})
	
	
	//Update Product
	
	$("body").delegate(".edit_product","click",function(){
		var eid = $(this).attr("eid");
		//alert(eid);
		$.ajax({
			url: "includes/process.php",
			method: "POST",
			dataType: "json", 
			data: {updateProduct:1,id:eid},
			success: function(data){
				//alert(data);
				//alert(data["category_name"]);
				console.log(data);
				$("#pid").val(data["pid"]);
				$("#update_product").val(data["product_name"]);
				$("#select_cat").val(data["cid"]);
				$("#select_brand").val(data["bid"]);
				$("#product_price").val(data["product_price"]);
				$("#product_qty").val(data["product_stock"]);
				
				
				
				
			}
		})
		
	})
	
	
		
	
		//Update product
	$("#update_product_form").on("submit",function(){
		$.ajax({
				url: "includes/process.php/",
				method: "POST",
				data: $("#update_product_form").serialize(),
				success: function(data){
			if(data=="UPDATED"){
				alert("Product Updated Successfully..!");
				window.location.href="";
			}else{
				alert(data);
			}
				
				}
			})
	})
	

})