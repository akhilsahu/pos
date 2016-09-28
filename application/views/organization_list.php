<?php
$complete_structure='';

foreach($organizations as $organization)
{
	$action=$organization['is_active']=='1'?'Disable':'Enable';
	$change_status=$organization['is_active']=='1'?'0':'1';
  $complete_structure.='<tr role="row" class="odd">
                        <td>'.$organization['txt_name'].'</td>
                        <td>'.$organization['txt_contact'].'</td>
						<td>'.$organization['txt_address'].'</td>
						<td>'.$organization['int_zip'].'</td>
                        <td><a href="'.site_url().'/organization/edit?id='.$organization['int_organization_id'].'">Edit</a>
                            &nbsp;&nbsp;&nbsp;
                            <a class="del_confirm" href="'.site_url().'/organization/delete?id='.$organization['int_organization_id'].'">Delete</a>
							&nbsp;&nbsp;&nbsp;
                            <a class="change_confirm" href="'.site_url().'/organization/change_status?id='.$organization['int_organization_id'].'&status='.$change_status.'">'.$action.'</a>
                        </td>
                      </tr>';
}
?>
<div class="content-wrapper">
  <div class="row">
    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Organization List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered table-hover dataTable" id="example2" role="grid" aria-describedby="example2_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Cell No</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Address</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Zipcode</th>
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
  $(".change_confirm").click(function(){
    if(confirm("Are you sure you wish to change the status?"))
    {
      return true;
    }
    else
    {
      return false;
    }
  });
});
</script>