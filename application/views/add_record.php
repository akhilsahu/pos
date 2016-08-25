<?php
$user=$this->session->userdata('user');
$option_string='';
foreach($bkeepers as $bkeeper)
{
	$option_string.='<option value="'.$bkeeper["int_bookkeeper_id"].'">'.$bkeeper["txt_name"].'</option>';
}
?>
<div class="content-wrapper">
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Record</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/record/save" enctype="multipart/form-data">
				  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Sport</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Sport Name" id="sport" name="sport" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Competition</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Competition" id="competition" name="competition" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Date</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Date" id="comp_date" name="comp_date" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Time</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Time" id="comp_time" name="comp_time" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Team 1</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Team 1" id="team1" name="team1" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Team 2</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Team 2" id="team2" name="team2" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Bet Type</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Bet Type" id="bet_type" name="bet_type" value="" class="form-control">
                      </div>
                    </div>					
                  </div><!-- /.box-body -->
				  <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Bet 1 Stake</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Bet 1 Stake" id="bet1_stake" name="bet1_stake" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Bet 1 Book Keeper</label>
                      <div class="col-sm-8">
                        <select id="bet1_bkeeper" name="bet1_bkeeper" class="form-control">
							<option value="0">Select Book Keeper</option>
							<?php echo $option_string;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Bet 1 URL</label>
                      <div class="col-sm-8">
                       <input type="text" placeholder="Bet 1 URL" id="bet1_url" name="bet1_url" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Bet 2 Stake</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Bet 2 Stake" id="bet2_stake" name="bet2_stake" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Bet 2 Book Keeper</label>
                      <div class="col-sm-8">
                        <select id="bet2_bkeeper" name="bet2_bkeeper" class="form-control">
							<option value="0">Select Book Keeper</option>
							<?php echo $option_string;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Bet 2 URL</label>
                      <div class="col-sm-8">
                       <input type="text" placeholder="Bet 2 URL" id="bet2_url" name="bet2_url" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Bet 3 Stake</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Bet 3 Stake" id="bet3_stake" name="bet3_stake" value="" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Bet 3 Book Keeper</label>
                      <div class="col-sm-8">
                        <select id="bet3_bkeeper" name="bet3_bkeeper" class="form-control">
							<option value="0">Select Book Keeper</option>
							<?php echo $option_string;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Bet 3 URL</label>
                      <div class="col-sm-8">
                       <input type="text" placeholder="Bet 3 URL" id="bet3_url" name="bet3_url" value="" class="form-control">
                      </div>
                    </div>
				  </div>
                  <div class="box-footer">
                    <button id="save_record" class="btn btn-info pull-right" type="submit">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
          </div>
      </div>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>plugins/timepicker/bootstrap-timepicker.css">
<script src="<?php echo base_url();?>plugins/timepicker/bootstrap-timepicker.js"></script>
<script>
$(document).ready(function(){
	$("#comp_date").datepicker();
  $("#save_record").click(function(){
    if($("#sport").val()==""){alert("Please enter Sports");$("#sport").focus();return false;}
	if($("#Competition").val()==""){alert("Please enter Competition");$("#Competition").focus();return false;}
	if($("#comp_date").val()==""){alert("Please enter Date");$("#comp_date").focus();return false;}
	if($("#comp_time").val()==""){alert("Please enter time");$("#comp_time").focus();return false;}
	if($("#team1").val()==""){alert("Please enter team 1 name");$("#team1").focus();return false;}
	if($("#team2").val()==""){alert("Please enter team 2 name");$("#team2").focus();return false;}
	if($("#bet_type").val()==""){alert("Please enter bet type");$("#bet_type").focus();return false;}
  });
});
</script>