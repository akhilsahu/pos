<?php
$complete_structure='';

foreach($staff as $member)
{
  $role=$member['int_role']=='1'?'Helper':'Driver';
  $complete_structure.='<tr role="row" class="odd">
                        <td>'.$member['txt_name'].'</td>
                        <td>'.$member['txt_email'].'</td>
						<td>'.$role.'</td>
                        <td>
                            <a class="del_confirm" href="'.site_url().'/staff/delete?id='.$member['int_staff_id'].'">Delete</a>
                        </td>
                      </tr>';
}
?>
<div class="content-wrapper">
  <div class="row">
    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Staff List</h3>
                </div><!-- /.box-header -->
				<form method="post" action="<?php echo site_url();?>/staff/search_staff" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Organization</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Name" id="name" name="name" value="" class="form-control">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
                    <button id="save_staff" class="btn btn-info pull-right" type="submit">Save</button>
                  </div><!-- /.box-footer -->
                </form>
                <div class="box-body">
                  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered table-hover dataTable" id="example2" role="grid" aria-describedby="example2_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">E-Mail</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Role</th>
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
});
</script>