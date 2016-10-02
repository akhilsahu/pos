<?php
$user=$this->session->userdata('user');
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
?>
<div class="content-wrapper">
	<div class="loader" style="display: none;">
		<span class="fa fa-cog fa-spin fa-3x fa-fw" aria-hidden="true"></span>the
	</div>
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Route</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/route/save_admin" enctype="multipart/form-data">
                    <div class="box-body" id="frm_fields">
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
						<input type="hidden" id="stopage_count" name="stopage_count" value="<?php echo count($locations);?>">
						<input type="text" id="name" name="name" value="" class="form-control">
					  </div>
					</div>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
                    <button id="save_route" class="btn btn-info pull-right" type="submit">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
			  </div>
          </div>
      </div>
</div>
<script>
$(document).ready(function(){
  $("#save_route").click(function(){
	if($("#name").val()==""){alert("Please enter route name");$("#name").focus();return false;}
  });
  $("#org_id").change(function(){
	if($(this).val()!="")
	{
		$(".loader").show();
		$.ajax({
			type: "POST",
			url: '<?php echo site_url();?>/ws/get_locations',
			data: {'organization':$(this).val()},
			datatype: "json",
			success: function(result) {
				var obj = $.parseJSON(result);
				if (obj.code=="200")
				{
					var option_html='';
					$.each(obj.details, function(i, locations) {
						option_html+='<option value="'+locations.int_location_id+'">'+locations.txt_location+'</option>';
					});
					var total_html='';
					for(var i=1;i<=count(obj.details);i++)
					{
						total_html+='<div class="form-group"><label class="col-sm-4 control-label" for="inputEmail3">Stopage '+i+'</label><div class="col-sm-8"><select id="stopage_'+i+'" name="stopage_'+i+'" class="form-control"><option value="">Select Stopage</option>'+option_html+'</option></select></div></div>';
					}
					$("#frm_fields").append(total_html);
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