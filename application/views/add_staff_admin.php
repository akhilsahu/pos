<?php
$user=$this->session->userdata('user');
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
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Staff</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/staff/save_admin" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Organization</label>
                      <div class="col-sm-8">
                        <select id="org_id" name="org_id" class="form-control">
							<option value="">Select Organization</option>
							<?php echo $option_html; ?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Name</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Name" id="name" name="name" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Email</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Email Address" id="email" name="email" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Password</label>
                      <div class="col-sm-8">
						<input type="password" id="password" name="password" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Role</label>
                      <div class="col-sm-8">
                        <select id="role" name="role" class="form-control">
							<option value="">Select Role</option>
							<option value="1">Helper</option>
							<option value="2">Driver</option>
						</select>
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
  $("#save_staff").click(function(){
    if($("#org_id").val()==""){alert("Please select organization");$("#org_id").focus();return false;}
	if($("#name").val()==""){alert("Please enter Name");$("#name").focus();return false;}
	if($("#email").val()==""){alert("Please enter Email");$("#email").focus();return false;}
	if($("#password").val()==""){alert("Please enter password");$("#password").focus();return false;}
	if($("#role").val()==""){alert("Please select role");$("#role").focus();return false;}
  });
});
</script>