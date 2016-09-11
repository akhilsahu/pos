<?php
$complete_structure='';
$org_selected=isset($org_id)?$org_id:'';
if(count($fares)>0)
{
	foreach($fares as $fare)
	{
	  $complete_structure.='<tr role="row" class="odd">
							<td>'.$fare['source'].'</td>
							<td>'.$fare['destination'].'</td>
							<td>'.$fare['fare'].'</td>
							<td><a href="'.site_url().'/fare/edit?id='.$fare['int_fare_id'].'">Edit</a>
								&nbsp;&nbsp;&nbsp;
								<a class="del_confirm" href="'.site_url().'/fare/delete?id='.$fare['int_fare_id'].'">Delete</a>
							</td>
						  </tr>';
	}
}
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
?>
<div class="content-wrapper">
  <div class="row">
    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Fare List</h3>
                </div><!-- /.box-header -->
				<form method="post" action="" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-2 control-label" for="inputEmail3">Organization</label>
                      <div class="col-sm-6">
                        <select id="org_id" name="org_id" class="form-control">
							<option value="">Select Organization</option>
							<?php echo $option_html; ?>
						</select>
                      </div>
					  <div class="col-sm-4">
                        <button id="search_fare" class="btn btn-info pull-right" type="submit">Search</button>
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
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Fare</th>
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
  $("#search_fare").click(function(){
    if($("#org_id").val()==""){alert("Please select Organization");$("#org_id").focus();return false;}
  });
});
</script>