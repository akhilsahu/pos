<?php
$user=$this->session->userdata('user');
$option_string='';
$tax=$details[0];
foreach($categories as $category)
{
	if($category["int_category_id"]==$tax['int_category_id'])
	{
		$option_string.='<option value="'.$category["int_category_id"].'" selected="selected">'.$category["txt_category_name"].'</option>';
	}
	else
	{
		$option_string.='<option value="'.$category["int_category_id"].'">'.$category["txt_category_name"].'</option>';
	}
}
?>
<div class="content-wrapper">
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Tax</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/tax/update" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Name</label>
                      <div class="col-sm-8">
						<input type="hidden" id="tax_id" name="tax_id" value="<?php echo $tax['int_tax_id']; ?>">
                        <input type="text" placeholder="Tax Name" id="tax_name" name="tax_name" value="<?php echo $tax['txt_tax_name']; ?>" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Category</label>
                      <div class="col-sm-8">
                        <select id="tax_category" name="tax_category" class="form-control">
							<option value="-1">All Category</option>
							<?php echo $option_string;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Rate</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Tax Rate" id="tax_rate" name="tax_rate" value="<?php echo $tax['db_rate']; ?>" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Active?</label>
                      <div class="col-sm-8">
                        <input type="radio" id="active_yes" name="is_active" value="1" <?php echo $tax['int_status']==1?'checked="checked"':''; ?> style="display:inline;"><label for="active_yes">Yes</label>
						<input type="radio" id="active_yes" name="is_active" value="0" <?php echo $tax['int_status']==0?'checked="checked"':''; ?> style="display:inline;"><label for="active_no">No</label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
				  <div class="box-footer">
                    <button id="save_tax" class="btn btn-info pull-right" type="submit">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
			  </div>
          </div>
      </div>
</div>
<script>
$(document).ready(function(){
  $("#save_tax").click(function(){
    if($("#tax_name").val()==""){alert("Please enter Category Name");$("#tax_name").focus();return false;}
	if($("#tax_category").val()==""){alert("Please select Category");$("#tax_category").focus();return false;}
	if($("#tax_rate").val()==""){alert("Please Enter Tax Rate");$("#tax_rate").focus();return false;}
  });
});
</script>