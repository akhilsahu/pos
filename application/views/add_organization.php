<?php
$user=$this->session->userdata('user');

?>
<div class="content-wrapper">
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Organization</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/organization/save" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Name</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Organization Name" id="org_name" name="org_name" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Contact No</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Contact No" id="contact" name="contact" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Address</label>
                      <div class="col-sm-8">
						<textarea id="address" name="address"  value="" class="form-control"></textarea>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Zip</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Zipcode" id="zipcode" name="zipcode" value="" class="form-control">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
                    <button id="save_organization" class="btn btn-info pull-right" type="submit">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
			  </div>
          </div>
      </div>
</div>
<script>
$(document).ready(function(){
  $("#save_organization").click(function(){
    if($("#org_name").val()==""){alert("Please enter Name");$("#org_name").focus();return false;}
	if($("#contact").val()==""){alert("Please enter contact number");$("#contact").focus();return false;}
	if($("#address").val()==""){alert("Please enter address");$("#address").focus();return false;}
	if($("#zipcode").val()==""){alert("Please enter zipcode");$("#zipcode").focus();return false;}
  });
});
</script>