<div id="form_product" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Product</h4>
      </div>
      <div class="modal-body form_size">
       <form id="product_form" enctype="multipart/form-data" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Date</label>
              <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d"); ?>" readonly />
            </div>
            <div class="form-group col-md-6">
              <label>Product Name</label>
              <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name" required>
            </div>
          </div>
          <div class="form-group">
            <label>Category</label>
            <select class="form-control" id="select_cat" name="select_cat" required />
              

              
            </select>
          </div>
          <div class="form-group">
            <label>Brand</label>
            <select class="form-control" id="select_brand" name="select_brand" required />
              

              
            </select>
          </div>
		 
          <div class="form-group">
            <label>Product Price</label>
            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Price of Product" required />
          </div>
          <div class="form-group">
            <label>Quantity</label>
            <input type="text" class="form-control" id="product_qty" name="product_qty" placeholder="Enter Quantity" required />
          </div>
		  
			<div class="form-group">
				<label for="comment">Description</label>
				<textarea class="form-control" rows="5" id="pro_desc" name="pro_desc" required></textarea>
			</div>
		  
		  
		  <div class="form-group">
            <label>Features <button type="button" id="add_feature" class="btn btn-primary">Add Features</button></label>
             <div class="size" id="Selected_Features" name="Selected_Features">
		  
		  </div>
          </div>
		  <div class="form-group">
            <label>Sizes <button type="button" id="add_size" class="btn btn-primary">Add Sizes</button></label>
             <div class="size" id="Selected_Sizes" name="Selected_Sizes">
		  
		  </div>
          </div>
		  
		  <div class="form-group">
				<label for="comment">Keywords</label>
				<textarea class="form-control" rows="2" id="pro_keywords" name="pro_keywords" required></textarea>
			</div>
		  
		  
		  
		  <div class="form-group">
		  <label>Select Images</label>
		  <input type="file" class="form-control" name="file" id="image_file" required />
		  </div>
		  
		  <!--<div id="image_preview"></div>-->
		
          <button type="submit" class="btn btn-success">Add Product</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>