<div id="form_feature" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Feature</h4>
      </div>
      <div class="modal-body">
        <form id="update_feature_form" onsubmit="return false">
  
  <div class="form-group">
    <label >Feature Name</label>
	<input type = "hidden" name="fid" id="fid" value="" />
    <input type="text" name="update_feature" class="form-control" id="update_feature"  placeholder="Enter Feature">
    <small id="feat_error" class="form-text text-muted"></small>
  </div>

  <div class="form-group">
  <label class="control-label" for="sel1">Select Categories:</label>
  <div class="size" id="parent_cats" name="parent_cats">
  </div>
  <small id="c_error" class="form-text text-muted"></small>
</div>

  <button type="submit" class="btn btn-primary">Update Feature</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>