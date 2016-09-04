<?php
$user=$this->session->userdata('user');
$location_option='';
foreach($locations as $location)
{
	$location_option.='<option value="'.$location['int_location_id'].'">'.$location['txt_location'].'</option>';
}

?>
<div class="content-wrapper">
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Location</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/fare/save" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Source</label>
                      <div class="col-sm-8">
                        <select id="source" name="source" class="form-control">
							<option value="">Select Source</option>
							<?php echo $location_option;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Destination</label>
                      <div class="col-sm-8">
                        <select id="destination" name="destination" class="form-control">
							<option value="">Select Destination</option>
							<?php echo $location_option;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Fare</label>
                      <div class="col-sm-8">
						<input type="text" id="fare" name="fare" value="" class="form-control">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
                    <button id="save_fare" class="btn btn-info pull-right" type="submit">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
			  </div>
          </div>
      </div>
</div>
<script>
$(document).ready(function(){
  $("#save_fare").click(function(){
    if($("#source").val()==""){alert("Please select source");$("#source").focus();return false;}
	if($("#destination").val()==""){alert("Please select destination");$("#destination").focus();return false;}
	if($("#fare").val()==""){alert("Please enter fare");$("#fare").focus();return false;}
  });
});
</script>