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
                      <label class="col-sm-4 control-label" for="inputEmail3">Contact</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Contact" id="contact" name="contact" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Address</label>
                      <div class="col-sm-8">
						<textarea id="address" name="address"  value="" class="form-control">
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
                    <button id="save_bkeeper" class="btn btn-info pull-right" type="submit">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
			  </div>
          </div>
      </div>
</div>
<script>
$(document).ready(function(){
  $("#save_bkeeper").click(function(){
    if($("#bkeeper_name").val()==""){alert("Please enter Book keeper Name");$("#bkeeper_name").focus();return false;}
	if($("#bkeeper_logo").val()==""){alert("Please select logo image");$("#bkeeper_logo").focus();return false;}
  });
});
</script>