<?php
$user=$this->session->userdata('user');
$fare=$details[0];
$source_option='';
$destination_option='';
foreach($locations as $location)
{
	if($location['int_location_id']==$fare['int_source'])
	{
		$source_option.='<option value="'.$location['int_location_id'].'" selected="selected">'.$location['txt_location'].'</option>';
	}
	else
	{
		$source_option.='<option value="'.$location['int_location_id'].'">'.$location['txt_location'].'</option>';
	}
	if($location['int_location_id']==$fare['int_destination'])
	{
		$destination_option.='<option value="'.$location['int_location_id'].'" selected="selected">'.$location['txt_location'].'</option>';
	}
	else
	{
		$destination_option.='<option value="'.$location['int_location_id'].'">'.$location['txt_location'].'</option>';
	}
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
                <form method="post" action="<?php echo site_url();?>/fare/update" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Source</label>
                      <div class="col-sm-8">
						<input type="hidden" id="fare_id" name="fare_id" value="<?php echo $fare['int_fare_id']; ?>">
                        <select id="source" name="source" class="form-control" disabled="disabled">
							<option value="">Select Source</option>
							<?php echo $source_option;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Destination</label>
                      <div class="col-sm-8">
                        <select id="destination" name="destination" class="form-control" disabled="disabled">
							<option value="">Select Destination</option>
							<?php echo $destination_option;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Fare</label>
                      <div class="col-sm-8">
						<input type="text" id="fare" name="fare" value="<?php echo $fare['float_fare']; ?>" class="form-control">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
                    <button id="save_staff" class="btn btn-info pull-right" type="submit">Save</button>
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
	if($("#fare").val()==""){alert("Please enter fare");$("#fare").focus();return false;}
  });
});
</script>