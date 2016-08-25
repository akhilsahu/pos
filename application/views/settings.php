<div class="content-wrapper">
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Settings</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/user/settings" enctype="multipart/form-data">
                  <div class="box-body">  
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Site Name<span style="color:#f00;">*</span></label>
                      <div class="col-sm-8">
                        <div class="form-group">
                          <input type="text" id="site_name" name="site_name" value="<?php echo $settings[0]['txt_meta_value']?>" class="form-control">
                        </div><!-- /.form-group -->
                      </div>
                    </div>
					         <div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Site Email<span style="color:#f00;">*</span></label>
                      <div class="col-sm-8">
                        <div class="form-group">
                          <input type="text" id="site_email" name="site_email" value="<?php echo $settings[1]['txt_meta_value']?>" class="form-control">
                        </div><!-- /.form-group -->
                      </div>
                    </div>
					         <div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Site Logo</label>
                      <div class="col-sm-8">
                        <input type="file" id="image1" name="image1" value="" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Logo</label>
                      <div class="col-sm-8">
                        <img src="<?php echo base_url().'uploads/'.$settings[2]['txt_meta_value']?>" alt="<?php echo $settings[2]['txt_meta_value']?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Slider Image 1</label>
                      <div class="col-sm-8">
                        <input type="file" id="slider_image_1" name="slider_image_1" value="" class="form-control">
						<img src="<?php echo base_url().'uploads/'.$settings[3]['txt_meta_value']?>" alt="<?php echo $settings[3]['txt_meta_value']?>" style="width:100px;height:100px;">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Slider Image 2</label>
                      <div class="col-sm-8">
                        <input type="file" id="slider_image_2" name="slider_image_2" value="" class="form-control">
						<img src="<?php echo base_url().'uploads/'.$settings[4]['txt_meta_value']?>" alt="<?php echo $settings[4]['txt_meta_value']?>" style="width:100px;height:100px;">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Slider Image 3</label>
                      <div class="col-sm-8">
                        <input type="file" id="slider_image_3" name="slider_image_3" value="" class="form-control">
						<img src="<?php echo base_url().'uploads/'.$settings[5]['txt_meta_value']?>" alt="<?php echo $settings[5]['txt_meta_value']?>" style="width:100px;height:100px;">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Slider Image 4</label>
                      <div class="col-sm-8">
                        <input type="file" id="slider_image_4" name="slider_image_4" value="" class="form-control">
						<img src="<?php echo base_url().'uploads/'.$settings[6]['txt_meta_value']?>" alt="<?php echo $settings[6]['txt_meta_value']?>" style="width:100px;height:100px;">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Minimum Order Amount</label>
                      <div class="col-sm-8">
						<input type="number" name="minimum_order_amount" id="minimum_order_amount" value="<?php echo $settings[7]['txt_meta_value']; ?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">About Us Image</label>
                      <div class="col-sm-8">
                        <input type="file" id="about_image" name="about_image" value="" class="form-control">
						<img src="<?php echo base_url().'uploads/'.$settings[8]['txt_meta_value']?>" alt="<?php echo $settings[8]['txt_meta_value']?>" style="width:100px;height:100px;">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button id="save_db" class="btn btn-info pull-right" type="submit">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
          </div>
      </div>
</div>
<script>
$(document).ready(function(){
  // $("#save_db").click(function(){
    
  // });
  // $("#db_joining_date").datepicker();
  //$(".select").select2();
});
</script>