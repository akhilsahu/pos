<?php
$user=$this->session->userdata('user');
$brand=$details[0];
?>
<div class="content-wrapper">
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Brand</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/brand/update" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Name</label>
                      <div class="col-sm-8">
						<input type="hidden" id="brand_id" name="brand_id" value="<?php echo $brand["int_brand_id"]; ?>">
                        <input type="text" placeholder="Brand Name" id="brand_name" name="brand_name" value="<?php echo $brand["txt_brand_name"]; ?>" class="form-control">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button id="save_brand" class="btn btn-info pull-right" type="submit">Update</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
          </div>
      </div>
</div>
<script>
$(document).ready(function(){
  $("#save_brand").click(function(){
    if($("#brand_name").val()==""){alert("Please enter Brand Name");$("#brand_name").focus();return false;}
  });
});
</script>