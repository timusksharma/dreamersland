<div id="form_category" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Category</h4>
      </div>
      <div class="modal-body">
          <form id="category_form" onsubmit="return false">
  <div class="form-group">
    <label >Category Name</label>
    <input type="text" name="category_name" class="form-control" id="category_name"  placeholder="Enter Category">
    <small id="cat_error" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label>Parent Category</label>
	<select class="form-control" id="parent_cat" name="parent_cat">
	
	</select>
     
  </div>
  
  <div class="form-group">
  <label class="control-label" >Select Parent Categories:</label>
  <div class="size" id="getparent_cats" name="getparent_cats">
		
  </div>
  </div>
 
  
  <button type="submit" class="btn btn-primary">Add</button>
</form>
<p><br></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>