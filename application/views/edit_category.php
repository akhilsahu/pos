<?php
$user=$this->session->userdata('user');
$option_string='';
$category=$details[0];
foreach($categories as $category1)
{
	if($category["int_parent_id"]==$category1["int_category_id"])
	{
		$option_string.='<option value="'.$category1["int_category_id"].'" selected>'.$category1["txt_category_name"].'</option>';
	}
	else
	{
		$option_string.='<option value="'.$category1["int_category_id"].'">'.$category1["txt_category_name"].'</option>';
	}
}
?>
<div class="content-wrapper">
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/category/update" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Name</label>
                      <div class="col-sm-8">
						<input type="hidden" id="category_id" name="category_id" value="<?php echo $category["int_category_id"]; ?>">
                        <input type="text" placeholder="Category Name" id="category_name" name="category_name" value="<?php echo $category["txt_category_name"]; ?>" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Parent</label>
                      <div class="col-sm-8">
                        <select id="category_parent" name="category_parent" class="form-control">
							<option value="0">Select Parent</option>
							<?php echo $option_string;?>
						</select>
                      </div>
                    </div>										<div class="form-group">                      <label class="col-sm-4 control-label" for="inputEmail3">Image for Slider</label>                      <div class="col-sm-8">                        <input type="file" id="category_image" name="category_image" value="" class="form-control">						<img src="<?php echo  base_url().'/uploads/category/'.$category['txt_image_url'];?>" style="height:100px;width:100px;">                      </div>                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button id="save_category" class="btn btn-info pull-right" type="submit">Update</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
          </div>
      </div>
</div>
<script>
$(document).ready(function(){
  $("#save_category").click(function(){
    if($("#category_name").val()==""){alert("Please enter Category Name");$("#category_name").focus();return false;}
  });
});
</script>