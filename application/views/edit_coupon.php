<?php
$user=$this->session->userdata('user');
$option_string='';
$coupon=$details[0];
foreach($categories as $category)
{
	if($coupon['int_category_id']==$category["int_category_id"])
	{
		$option_string.='<option value="'.$category["int_category_id"].'" selected="selected">'.$category["txt_category_name"].'</option>';
	}
	else
	{
		$option_string.='<option value="'.$category["int_category_id"].'">'.$category["txt_category_name"].'</option>';
	}
}
?>
<div class="content-wrapper">
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Coupon</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/coupons/update" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Code</label>
                      <div class="col-sm-8">
						<input type="hidden" id="coupon_id" name="coupon_id" value="<?php echo $coupon["int_coupon_id"]; ?>">
                        <input type="text" placeholder="Coupon Code" id="coupon_code" name="coupon_code" value="<?php echo $coupon["txt_coupon_code"]; ?>" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Category</label>
                      <div class="col-sm-8">
                        <select id="product_category" name="coupon_category" class="form-control">
							<option value="-1">All Category</option>
							<?php echo $option_string;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Discount Type</label>
                      <div class="col-sm-8">
                        <input type="radio" id="discount_type_fixed" name="discount_type" value="1" <?php echo $coupon["int_discount_type"]==1?'checked':''; ?>  style="display:inline;"><label for="discount_type_fixed">Fixed</label>
						<input type="radio" id="discount_type_percentage" name="discount_type" value="2" <?php echo $coupon["int_discount_type"]==2?'checked':''; ?> style="display:inline;"><label for="discount_type_percentage">Percentage</label>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Discount Value</label>
                      <div class="col-sm-8">
                        <input type="number" placeholder="Discount Value" id="discount_value" name="discount_value" value="<?php echo $coupon["int_discount_value"]; ?>" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Expire Date</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Expire Date" id="expire_date" name="expire_date" value="<?php echo date("m/d/Y",strtotime($coupon["dt_expire_date"])); ?>" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Uses Per Person</label>
                      <div class="col-sm-8">
                        <input type="number" placeholder="Uses Per Person" id="coupon_uses" name="coupon_uses" value="<?php echo $coupon["int_uses_per_person"]; ?>" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Minimum Purchase</label>
                      <div class="col-sm-8">
                        <input type="number" placeholder="Minimum Purchase" id="minimum_purchase" value="<?php echo $coupon["int_min_purchase_amt"]; ?>" name="minimum_purchase" value="0" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="box-footer">
                    <button id="save_product" class="btn btn-info pull-right" type="submit">Update</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
			  </div>
          </div>
      </div>
</div>
<script>
$(document).ready(function(){
  $("#save_product").click(function(){
    if($("#coupon_code").val()==""){alert("Please enter Coupon Code");$("#coupon_code").focus();return false;}
	if($("#discount_value").val()==""){alert("Please enter Discount Value");$("#discount_value").focus();return false;}
  });
  $("#expire_date").datepicker();
});
</script>