<?php

$complete_structure='';



foreach($users as $user)

{
	
	$role=$user['int_user_type']=='1'?'Admin':'Organization Admin';

  $complete_structure.='<tr role="row" class="odd">

                        <td>'.$user['txt_name'].'</td>

                        <td>'.$user['txt_username'].'</td>

						<td>'.$user['txt_email'].'</td>
						
						<td>'.$role.'</td>

                        <td><a href="'.site_url().'/user/edit?id='.$user['int_user_id'].'">Edit</a>

                            &nbsp;&nbsp;&nbsp;

                            <a class="del_confirm" href="'.site_url().'/user/delete?id='.$user['int_user_id'].'">Delete</a>

                        </td>

                      </tr>';

}

?>

<div class="content-wrapper">

  <div class="row">

    <div class="box">

                <div class="box-header">

                  <h3 class="box-title">User List</h3>

                </div><!-- /.box-header -->

                <div class="box-body">

                  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered table-hover dataTable" id="example2" role="grid" aria-describedby="example2_info">

                    <thead>

                      <tr role="row">

                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Name</th>

                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Username</th>

						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Email</th>
						
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