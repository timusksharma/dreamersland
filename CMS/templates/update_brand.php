<div id="form_brand" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Brand</h4>
      </div>
      <div class="modal-body">
        <form id="update_brand_form" onsubmit="return false">
  <div class="form-group">
    <label >Brand Name</label>
	<input type = "hidden" name="bid" id="bid" value="" />
    <input type="text" name="update_brand" class="form-control" id="update_brand"  placeholder="Enter Category">
    <small id="brand_error" class="form-text text-muted"></small>
  </div>
 
  <button type="submit" class="btn btn-primary">Update Brand</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>