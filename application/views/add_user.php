<?php
$org_option='';
foreach($organizations as $organization)
{
	$org_option.='<option value="'.$organization['int_organization_id'].'">'.$organization['txt_name'].'</option>';
}
?>
<div class="content-wrapper">

<div class="row">

    <div class="col-md-8">

      <div class="box box-info">

                <div class="box-header with-border">

                  <h3 class="box-title">Add User</h3>

                </div><!-- /.box-header -->

                <!-- form start -->

                <form method="post" action="<?php echo site_url();?>/user/save" enctype="multipart/form-data">

                  <div class="box-body">

                    <div class="form-group">

                      <label class="col-sm-4 control-label" for="inputEmail3">Username</label>

                      <div class="col-sm-8">

                        <input type="text" placeholder="Username" value="" id="username" name="username" class="form-control">

                      </div>

                    </div>

                    <div class="form-group">

                      <label class="col-sm-4 control-label" for="inputEmail3">Name</label>

                      <div class="col-sm-8">

                        <input type="text" placeholder="Name" id="name" name="name" value="" class="form-control">

                      </div>

                    </div>

                    <div class="form-group">

                      <label class="col-sm-4 control-label" for="inputPassword3">Password</label>

                      <div class="col-sm-8">

                        <input type="hidden" id="old_password" name="old_password" value="<?php echo $user['txt_password'] ?>">

                        <input type="password" placeholder="Password" id="password" name="password" value="" class="form-control">

                      </div>

                    </div>

                    <div class="form-group">

                      <label class="col-sm-4 control-label" for="inputPassword3">Confirm Password</label>

                      <div class="col-sm-8">

                        <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" value="" class="form-control">

                      </div>

                    </div>

                    <div class="form-group">

                      <label class="col-sm-4 control-label" for="inputPassword3">Email</label>

                      <div class="col-sm-8">

                          <input type="email" id="email" name="email" value="" class="form-control">                        

                      </div>

                    </div>
					
					<div class="form-group">

                      <label class="col-sm-4 control-label" for="inputPassword3">Cell No</label>

                      <div class="col-sm-8">

                          <input type="text" id="cellno" name="cellno" value="" class="form-control">                        

                      </div>

                    </div>
					
					<div class="form-group">

                      <label class="col-sm-4 control-label" for="inputPassword3">Organization</label>

                      <div class="col-sm-8">
                        
						  <select id="organization" name="organization" class="form-control">
							<option value="0">Select Organization</option>
							<?php echo $org_option; ?>
						  </select>

                      </div>

                    </div>

                  </div><!-- /.box-body -->

                  <div class="box-footer">

                    <button id="save_profile" class="btn btn-info pull-right" type="submit">Add User</button>

                  </div><!-- /.box-footer -->

                </form>

              </div>

          </div>

      </div>

</div>

<script>

$(document).ready(function(){

  $("#save_profile").click(function(){

    if($("#username").val()=="")

    {

      alert("Please enter username");

      $("#username").focus();

      return false;

    }

    if($("#name").val()=="")

    {

      alert("Please enter name");

      $("#name").focus();

      return false;

    }

    if($("#password").val()=="")

    {

      alert("Please enter password");

      $("#password").focus();

      return false;

    }

    if($("#confirm_password").val()=="")

    {

      alert("Please enter confirm password");

      $("#confirm_password").focus();

      return false;

    }

    if($("#confirm_password").val()!=$("#password").val())

    {

      alert("Password do not match");

      $("#confirm_password").focus();

      return false;

    }
	
	if($("#email").val()=="")

    {

      alert("Please enter email");

      $("#email").focus();

      return false;

    }
	
	if($("#cellno").val()=="")

    {

      alert("Please enter cell number");

      $("#cellno").focus();

      return false;

    }
	
	if($("#organization").val()=="0")

    {

      alert("Please select organization");

      $("#organization").focus();

      return false;

    }

    // if($("#email").val()!="" && !isEmail($("#email").val()))

    // {

    //     alert("Please enter proper email address");

    //     $("#email").focus();

    //     return false;

    // }

  });

  // function isEmail(email)

  // {

  //   var regex=/^\w+([\.-]?\w+)*@w+;

  //   return regex.test();

  // }

});

</script>