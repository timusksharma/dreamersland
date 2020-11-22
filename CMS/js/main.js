$(document).ready(function(){
	//var DOMAIN = ".";	
	
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
				//$("#getchild_cats").html(data);

				//$("#select_cat").html(choose+data);
			}
		})
	}
	
	
	
	
	/**/
	//Add Feature
	$("#feature_form").on("submit",function(){
		var feature_cat = [];
            $.each($("input[name='feature_cat[]']:checked"), function(){            
                feature_cat.push($(this).val());
            });
			//alert("Categories: " + feature_cat.join(", "));
		
		if($("#feature_name").val()==""){
			$("#feature_name").addClass("bordr_r");
			$("#feat_error").html("<span class='text-danger'>Please Enter Feature Name</span>");
		}else if(feature_cat.length === 0){
			$("#c_error").html("<span class='text-danger'>Please Select Categories</span>");
		}else{
			$.ajax({
				url:"includes/process.php",
				method: "POST",
				data: $("#feature_form").serialize(),
				success: function(data){
					//alert(data);
					if(data=="FEATURE_ADDED"){
						$("#feature_name").removeClass("bordr_r");
						$("#feat_error").html("<span class='text-success'>New Feature Added Successfully</span>");
						$("#feature_name").val("");
						$("#parent_cats input:checkbox").prop("checked", false);
					}else{
					alert(data);	
					}
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
	//Add Category
	$("#category_form").on("submit",function(){
		if($("#category_name").val()==""){
			$("#category_name").addClass("bordr_r");
			$("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
		}else{
			$.ajax({
				url:"includes/process.php",
				method: "POST",
				data: $("#category_form").serialize(),
				success: function(data){
					if(data=="CATEGORY_ADDED"){
						$("#category_name").removeClass("bordr_r");
						$("#cat_error").html("<span class='text-success'>New Category Added Successfully</span>");
						$("#category_name").val("");
						fetch_category();
					}else{
					alert(data);	
					}
				}
			})
		}
	})
	
	
	
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
	
	//Add Brand
	$("#brand_form").on("submit",function(){
		if($("#brand_name").val()==""){
			$("#brand_name").addClass("border-danger");
			$("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
		}else{
			$.ajax({
				url: "includes/process.php/",
				method: "POST",
				data: $("#brand_form").serialize(),
				success: function(data){
			if(data == "BRAND_ADDED"){
				$("#brand_name").removeClass("border-danger");
			$("#brand_error").html("<span class='text-success'>New Brand Added Successfully..!</span>");
				$("#brand_name").val("");
				fetch_brand();
			}else{
				alert(data);
			}
				
				}
			})
		}
	})
	
	//Size
	
	$("body").delegate("#add_size","click",function(){
	//  alert("hello");
	
			$.ajax({
			
				url: "includes/process.php/",
				method: "POST",
				data: {Select_Sizes:1},
				success: function(data){
					
				document.getElementById("p_sizes").style.display = "block";
                document.body.style.overflow = 'hidden';
				$('#All_Sizes').html(data);
				}
				})
		});
		
	  

	
	//Select Size
  $("body").delegate("#Select_size","click",function(){
	  var ar=[];
		var sid=[];
		$.each($("input[name='si_name[]']:checked"), function(){ 
			var t=$(this).val();
			ar.push(t);
			sid.push($(this).attr("sid"));
			//alert($(this).val());
		
		});
		//alert(ar);
		//alert(sid);
		$.each($("input[name='size_name[]']:checked"), function(){
			for(var i=0;i<ar.length;i++){
				if(ar[i]==$(this).val())
				{
					ar.splice(i,1); 
					sid.splice(i,1);
				}
			}
		})
		alert(ar);
		$.ajax({
				url:"includes/process.php/",
				method: "POST",
				data: {remaining:ar,sid:sid},//$(".send_data").serialize(),
				success: function(data){
					alert(data);
					$("#Selected_Sizes").append(data);
					document.getElementById("p_sizes").style.display = "none";
					document.body.style.overflow = 'auto';
					
				}
			})
	})
	
	//Delete Size
	$("body").delegate(".s_del","click",function(){
		var did = $(this).attr("sid");
		$(this).remove();
		$('input[sid="'+did+'"]').remove();
		$('div[sid="'+did+'"]').remove();

		
		//alert();
	})
	
	
	
	//Add Size
	$("#size_form").on("submit",function(){
		if($("#size_name").val()==""){
			$("#size_name").addClass("border-danger");
			$("#size_error").html("<span class='text-danger'>Please Enter size Name</span>");
		}else{
			$.ajax({
				url: "includes/process.php/",
				method: "POST",
				data: $("#size_form").serialize(),
				success: function(data){
			if(data == "SIZE_ADDED"){
				$("#size_name").removeClass("border-danger");
			$("#size_error").html("<span class='text-success'>New Size Added Successfully..!</span>");
				$("#size_name").val("");
				fetch_size();
			}else{
				alert(data);
			}
				
				}
			})
		}
	})

	
	
	
	//add product
	$("#product_form").on("submit",function(){
		$.ajax({
				url: "includes/process.php/",
				method: "POST",
				data: new FormData(this),//$("#product_form").serialize(),
				contentType:false,
				processData:false,
				success: function(data){
			if(data == "NEW_PRODUCT_ADDED"){
				$("#product_name").val("");
				$("#product_qty").val("");
				$("#select_cat").val("");
				$("#select_brand").val("");
				$("#product_price").val("");
				$('#image_file').val("");
				
				
				alert("New Product Added Successfully..!");
			}else{
				console.log(data);
				alert(data);
				//$('#image_preview').html(data);
				
			}
				
				}
			})
	})
	//Cancel
	$(document).on('click','#remove_button',function(){
		if(confirm("Are You Sure You want to remove this image?"))
		{
			var path = $('#remove_button').data("path");
			alert(path);
			/*$.ajax({
				url:"includes/process.php/",
				method:"POST",
				data:{path:path},
				success:function(data){
					if(data!='')
					{
						$('#image_preview').html('');
					}
				}
			})*/
		}
		else{
			return false;
		}
	})
	
	//Product_category change select_cat
	
	$("#select_cat").change(function(){
    //alert("The text has been changed.");
    $("#Selected_Features").html("");
	alert("Please Select Features related to this Category");

	
  });
  
  $("body").delegate("#add_feature","click",function(){
	//  alert("hello");
	//
	var status=false;
        var cat = $('#select_cat').val();
		if(cat=="")
		{
			alert("Please Select Category");
		}else{
			status = true;
		cat = $('#select_cat option[value="'+cat+'"]').html();
		}
		
		
		if(status==true){
			$.ajax({
			
				url: "includes/process.php/",
				method: "POST",
				data: {Select_Features:1,cat:cat},
				success: function(data){
				//alert(data);
	
				if(data == "NO_DATA"){
				alert("There is No feature Related To That Category");
			}
			else{
				document.getElementById("p_features").style.display = "block";
                document.body.style.overflow = 'hidden';
				$('#All_Features').html(data);
				}
				}
			})
		}
		
	  
  });
  
  //Select Feature
  $("body").delegate("#Select_feat","click",function(){
	  var ar=[];
		var fid=[];
		$.each($("input[name='s_name[]']:checked"), function(){ 
			var t=$(this).val();
			ar.push(t);
			fid.push($(this).attr("fid"));
			//alert($(this).val());
		
		});
		//alert(fid);
		$.each($("input[name='feature_name[]']:checked"), function(){
			for(var i=0;i<ar.length;i++){
				if(ar[i]==$(this).val())
				{
					ar.splice(i,1); 
					fid.splice(i,1);
				}
			}
		});
		//alert(ar);
		$.ajax({
				url:"includes/process.php/",
				method: "POST",
				data: {remain:ar,fid:fid},//$(".send_data").serialize(),
				success: function(data){
					alert(data);
					$("#Selected_Features").append(data);
					document.getElementById("p_features").style.display = "none";
					document.body.style.overflow = 'auto';
					
				}
			})
	})
	
	//Delete Feature
	$("body").delegate(".f_del","click",function(){
		var did = $(this).attr("fid");
		$(this).remove();
		$('input[fid="'+did+'"]').remove();
		$('div[fid="'+did+'"]').remove();

		
		//alert();
	})
	  
  })
  
  
	
