<?php
$complete_structure='';
$org_selected=isset($org_id)?$org_id:'';
$total_fare=0;
if(count($transactions)>0)
{
	foreach($transactions as $transaction)
	{
	  $total_fare+=$transaction['fare'];
	  $complete_structure.='<tr role="row" class="odd">
							<td>'.$transaction['source'].'</td>
							<td>'.$transaction['destination'].'</td>
							<td>'.$transaction['int_quantity'].'</td>
							<td>'.$transaction['fare'].'</td>
							<td>'.$transaction['txt_license_plate'].'</td>
							<td>'.$transaction['dt_issue'].'</td>
						  </tr>';
	}
}
$complete_structure='<tr role="row" class="odd">
							<td><b>Total</b></td>
							<td>&nbsp;&nbsp;</td>
							<td>&nbsp;&nbsp;</td>
							<td>'.$total_fare.'</td>
							<td>&nbsp;&nbsp;</td>
							<td>&nbsp;&nbsp;</td>
						  </tr>'.$complete_structure;
$final_start=isset($start)?$start:date('m/d/Y');
$final_end=isset($end)?$end:date('m/d/Y');

if(count($vehicles)>0)
{
	foreach($vehicles as $vehicle)
	{
		if($vehicle['int_vehicle_id']==$vehicle_id)
		{
			$vehicle_list.='<option value="'.$vehicle['int_vehicle_id'].'" selected="selected">'.$vehicle['txt_license_plate'].'</option>';
		}
		else
		{
			$vehicle_list.='<option value="'.$vehicle['int_vehicle_id'].'">'.$vehicle['txt_license_plate'].'</option>';
		}
	}
}

if(count($routes)>0)
{
	foreach($routes as $route)
	{
		if($route['int_route_id']==$route_id)
		{
			$route_list.='<option value="'.$route['int_route_id'].'" selected="selected">'.$route['txt_route_name'].'</option>';
		}
		else
		{
			$route_list.='<option value="'.$route['int_route_id'].'">'.$route['txt_route_name'].'</option>';
		}
	}
}
if(isset($time_period) && $time_period!='')
{
	$op1=($time_period=='l7')?'selected="selected"':'';
	$op2=($time_period=='l30')?'selected="selected"':'';
	$op3=($time_period=='cm')?'selected="selected"':'';
	$op4=($time_period=='cy')?'selected="selected"':'';
}

$search=0;

$query_string='start='.$start.'&end='.$end.'&vehicle='.$vehicle_id.'&time_period='.$time_period.'&route_id='.$route_id.'';
?>
<div class="content-wrapper">
  <div class="row">
    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Transaction List</h3>
                </div><!-- /.box-header -->
				<form method="post" action="" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <div class="col-sm-3">
                        <div class="input-group">
						  <div class="input-group-addon">
							<i class="fa fa-calendar" id="tg"></i>
						  </div>
						  <input type="text" id="start" name="start" value="<?php echo $final_start;?>" class="form-control">
						</div>
                      </div>
					   <div class="col-sm-3">
                        <div class="input-group">
						  <div class="input-group-addon">
							<i class="fa fa-calendar" id="tg1"></i>
						  </div>
						  <input type="text" id="end" name="end" value="<?php echo $final_end;?>" class="form-control">
						</div>
                      </div>
					  <div class="col-sm-3">
                        <div class="input-group">
						  <select id="vehicle_id" name="vehicle_id" class="form-control">
							<option value="">Select Vehicle</option>
							<?php echo $vehicle_list; ?>
						  </select>
						</div>
                      </div>
					  <div class="col-sm-3">
							<select id="time_period" name="time_period" class="form-control">
								<option value="">Select Time Period</option>
								<option value="l7" <?php echo $op1; ?>>Last 7 days</option>
								<option value="l30" <?php echo $op2; ?>>Last 30 days</option>
								<option value="cm" <?php echo $op3; ?>>This Month</option>
								<option value="cy" <?php echo $op4; ?>>This Year</option>
							</select>
						</div>
                      </div>
					   <div class="form-group">
					   
					   </div>
					  <div class="form-group">
                      <div class="col-sm-3">
                        <div class="input-group">
							<select id="route_id" name="route_id" class="form-control">
								<option value="">Select Route</option>
								<?php echo $route_list;?>
							</select>
						</div>
                      </div>
					   <div class="col-sm-3">
							&nbsp;&nbsp;
                      </div>
					  <div class="col-sm-3">
							&nbsp;&nbsp;
                      </div>
					  <div class="col-sm-3">
							<button id="search_transaction" class="btn btn-info pull-right" type="submit" style="float:left !important;">Search</button>
							&nbsp;&nbsp;
							<a href="<?php echo site_url(); ?>/fare/print_transaction?<?php echo $query_string;?>" class="btn btn-primary" style="display:inline;float:right;" id="print_btn" target="_blank">Print</a>
						</div>
                      </div>
                    </div>
				  </div>
                </form>
                <div class="box-body">
                  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered table-hover dataTable" id="example2" role="grid" aria-describedby="example2_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Source</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Destination</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Quantity</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Fare</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">License Plate</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Datetime</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php echo $complete_structure; ?>
                    </tbody>
                  </table></div>
                </div><!-- /.box-body -->
              </div>
  </div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
  $(".del_confirm").click(function(){
    if(confirm("Are you sure you wish to delete this record?"))
    {
      return true;
    }
    else
    {
      return false;
    }
  });
  
  $("#start").datepicker();
  $("#end").datepicker();
  /*$("#search_transaction").click(function(){
	if(($("#start").val()=="" || $("#end").val()=="") && $("#vehicle_id").val()=="" $("#time_period").val()=="")
	{
		alert("Please enter proper search criteria");
		return false;
	}
  });*/
  $("#tg").click(function(){
	$("#start").focus();
  });
  $("#tg1").click(function(){
	$("#end").focus();
  });
});
</script>
