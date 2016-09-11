<?php
$user=$this->session->userdata('user');
$vehicle=$details[0];
?>
<div class="content-wrapper">
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Vehicle</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/vehicle/update" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Year</label>
                      <div class="col-sm-8">
						<input type="hidden" id="vehicle_id" name="vehicle_id" value="<?php echo $vehicle['int_vehicle_id']; ?>">
                        <input type="number" id="year" name="year" class="form-control" value="<?php echo $vehicle['int_year']; ?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Model</label>
                      <div class="col-sm-8">
                        <input type="text" id="model" name="model" class="form-control" value="<?php echo $vehicle['txt_model']; ?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Manufacturer</label>
                      <div class="col-sm-8">
						<input type="text" id="manufacturer" name="manufacturer" class="form-control" value="<?php echo $vehicle['txt_manufacturer']; ?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">License Plate</label>
                      <div class="col-sm-8">
						<input type="text" id="lp" name="lp" class="form-control" value="<?php echo $vehicle['txt_license_plate']; ?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
                    <button id="update_vehicle" class="btn btn-info pull-right" type="submit">Update</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
			  </div>
          </div>
      </div>
</div>
<script>
$(document).ready(function(){
  $("#update_vehicle").click(function(){
    if($("#year").val()==""){alert("Please enter year");$("#year").focus();return false;}
	if($("#model").val()==""){alert("Please enter model number");$("#model").focus();return false;}
	if($("#manufacturer").val()==""){alert("Please enter manufacturer");$("#manufacturer").focus();return false;}
	if($("#lp").val()==""){alert("Please enter license plate");$("#lp").focus();return false;}
  });
});
</script>