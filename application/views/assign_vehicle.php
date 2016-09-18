<?php
$complete_structure='';
$mem_option_html='';
$vassign_option_html='';
$vsearch_option_html='';
$v_selected=isset($search_vehicle)?$search_vehicle:'';
if(count($search_data)>0)
{
	foreach($search_data as $result)
	{
		$complete_structure.='<tr role="row" class="odd">
								<td>'.$result['txt_name'].'</td>
								<td>'.$result['dt_assign'].'</td>
								<td>
									<a class="unassign_confirm" href="'.site_url().'/vehicle/unassign?id='.$result['int_assignment_id'].'">Unassign</a>
								</td>
							</tr>';
	}
}
if(count($members)>0)
{
	foreach($members as $member)
	{
		$mem_option_html.='<option value="'.$member['int_staff_id'].'">'.$member['txt_name'].'</option>';
	}
}
if(count($vehicles_assign)>0)
{
	foreach($vehicles_assign as $v_assign)
	{
		$vassign_option_html.='<option value="'.$v_assign['int_vehicle_id'].'">'.$v_assign['txt_license_plate'].'</option>';
	}
}
if(count($vehicles_search)>0)
{
	foreach($vehicles_search as $v_search)
	{
		if($v_search['int_vehicle_id']==$v_selected)
		{
			$vsearch_option_html.='<option value="'.$v_search['int_vehicle_id'].'" selected="selected">'.$v_search['txt_license_plate'].'</option>';
		}
		else
		{
			$vsearch_option_html.='<option value="'.$v_search['int_vehicle_id'].'">'.$v_search['txt_license_plate'].'</option>';
		}
		
	}
}
?>
<div class="content-wrapper">
  <div class="row">
    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Assign Vehicle</h3>
                </div><!-- /.box-header -->
				<form method="post" action="" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <div class="col-sm-4">
						<input type="hidden" id="operation" name="operation" value="assign">
                        <select id="vehicle_assign" name="vehicle_assign" class="form-control">
							<option value="">Select Vehicle</option>
							<?php echo $vassign_option_html; ?>
						</select>
                      </div>
					  <div class="col-sm-4">
                        <select id="staff_assign" name="staff_assign" class="form-control">
							<option value="">Select Staff Member</option>
							<?php echo $mem_option_html; ?>
						</select>
                      </div>
					  <div class="col-sm-4">
                        <button id="assign_vehicle" class="btn btn-info pull-right" type="submit">Assign</button>
                      </div>
                    </div>
				  </div>
                </form>
				<form method="post" action="" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <div class="col-sm-4">
                        <h3 class="box-title">Search</h3>
                      </div>
					  <div class="col-sm-4">
						<input type="hidden" id="operation" name="operation" value="search">
                        <select id="search_vehicle" name="search_vehicle" class="form-control">
							<option value="">Select Vehicle</option>
							<?php echo $vsearch_option_html; ?>
						</select>
                      </div>
					  <div class="col-sm-4">
                        <button id="search" class="btn btn-info pull-right" type="submit">Search</button>
                      </div>
                    </div>
				  </div>
                </form>
                <div class="box-body">
                  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered table-hover dataTable" id="example2" role="grid" aria-describedby="example2_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Year</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Model</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Actions</th>
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
  $(".unassign_confirm").click(function(){
    if(confirm("Are you sure you wish to unassign this member?"))
    {
      return true;
    }
    else
    {
      return false;
    }
  });
  $("#assign_vehicle").click(function(){
    if($("#vehicle_assign").val()==""){alert("Please select Vehicle");$("#vehicle_assign").focus();return false;}
	if($("#staff_assign").val()==""){alert("Please select Staff Member");$("#staff_assign").focus();return false;}
  });
  $("#search").click(function(){
    if($("#search_vehicle").val()==""){alert("Please select Vehicle");$("#search_vehicle").focus();return false;}
  });
});
</script>