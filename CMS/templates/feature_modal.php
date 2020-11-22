<div id="form_feature" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Feature</h4>
      </div>
      <div class="modal-body">
         <form  id="feature_form" onsubmit="return false">
  <div class="form-group">
    <label class="control-label" >Feature:</label>
    
      <input type="text" class="form-control" name="feature_name" id="feature_name" placeholder="Enter Feature Name">
	  <small id="feat_error" class="form-text text-muted"></small>
    
  </div>
  
  <div class="form-group">
  <label class="control-label" >Select Categories:</label>
  <div class="size" id="parent_cats" name="parent_cats">
 <!-- <div class="checkbox" >
      <label><input type="checkbox" value="">SSS</label>
	  
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="">Zara</label>
	  
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="" >Addidas</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Puma</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Only</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Vans</label>
	  
    </div>
	<div class="checkbox">
      <label><input type="checkbox" value="" >Reebok</label>
	  
    </div>
	-->
  </div>
  <small id="c_error" class="form-text text-muted"></small>
</div>
  
  
      <button type="submit" class="btn btn-primary btn-md" >Add</button>
    
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>