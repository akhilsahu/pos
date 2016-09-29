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
$option_html='';
if(count($organizations)>0)
{
	foreach($organizations as $organization)
	{
		if($organization['int_organization_id']==$org_selected)
		{
			$option_html.='<option value="'.$organization['int_organization_id'].'" selected="selected">'.$organization['txt_name'].'</option>';
		}
		else
		{
			$option_html.='<option value="'.$organization['int_organization_id'].'">'.$organization['txt_name'].'</option>';
		}
	}
}
$final_start=isset($start)?$start:date('m/d/Y');
$final_end=isset($end)?$end:date('m/d/Y');
$vehicle_list='<option value="">Select Vehicle</option>';
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
$search=0;
if(($start!='' && $end!='') || $vehicle_id!='')
{
	$search=1;
}
$query_string='start='.$start.'&end='.$end.'&vehicle='.$vehicle_id.'&org_id='.$org_selected.'';
?>
<div class="content-wrapper">
	<div class="loader" style="display: none;">
		<span class="fa fa-cog fa-spin fa-3x fa-fw" aria-hidden="true"></span>the
	</div>
  <div class="row">
    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Transaction List</h3>
                </div><!-- /.box-header -->
				<form method="post" action="" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <div class="col-sm-12">
                        <select id="org_id" name="org_id" class="form-control">
							<option value="">Select Organization</option>
							<?php echo $option_html; ?>
						</select>
                      </div>
					   
                    </div>
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
							<?php echo $vehicle_list; ?>
						  </select>
						</div>
                      </div>
					  <div class="col-sm-3">
                        <button id="search_transaction" class="btn btn-info pull-right" type="submit" style="float:left !important;">Search</button>
						&nbsp;&nbsp;
						<a href="<?php echo site_url(); ?>/fare/print_transaction_admin?<?php echo $query_string;?>" class="btn btn-primary" style="display:inline;float:right;" id="print_btn" target="_blank">Print</a>
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
  $("#print_btn").click(function(){
	if($("#is_search")==0)
	{
		alert("Please search before print");
		return false;
	}
  });
  $("#start").datepicker();
  $("#end").datepicker();
  $("#search_transaction").click(function(){
    if($("#org_id").val()==""){alert("Please select Organization");$("#org_id").focus();return false;}
	if(($("#start").val()=="" || $("#end").val()=="") && $("#vehicle_id").val()=="")
	{
		alert("Please enter proper search criteria");
		return false;
	}
  });
  $("#tg").click(function(){
	$("#start").focus();
  });
  $("#tg1").click(function(){
	$("#end").focus();
  });
  $("#org_id").change(function(){
	if($(this).val()!="")
	{
		$(".loader").show();
		$.ajax({
			type: "POST",
			url: '<?php echo site_url();?>/ws/get_vehicles',
			data: {'org_id':$(this).val()},
			datatype: "json",
			success: function(result) {
				var obj = $.parseJSON(result);
				if (obj.code=="200")
				{
					var option_html='<option value="">Select Vehicle</option>';
					$.each(obj.vehicles, function(i, vehicle) {
						option_html+='<option value="'+vehicle.int_vehicle_id+'">'+vehicle.txt_license_plate+'</option>';
					});
					$("#vehicle_id").html(option_html);
					$(".loader").hide();
				}
			},
			error: function() {
				console.log("Some Error Occured");
			}
		});
	}
  });
});
</script>
<style>
	.loader {
		background-color: rgba(0, 0, 0, 0.6);
		height: 100%;
		left: 0;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: 10000;
	}
	.loader span{
	 color: #fff;
		left: 44%;
		position: fixed;
		top: 50%;
		transform: translate(-50%, -50%);
	}
</style>