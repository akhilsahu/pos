<?php
$complete_structure='';

$status=array('1'=>'Processing','2'=>'Packed','3'=>'Shipped','4'=>'Delivered');

foreach($orderlist as $order)
{
  $product_details='';
  $total_price=0;
  foreach ($order['product_list'] as $val) {
      $product_details.='<b>Name</b> : '.$val['txt_product_name'].'  <b>Oty</b>: '.$val['int_quantity'].' <b>Price</b>:'.$val['dbl_product_cost'].'<br>'; 
      $total_price+=$val['int_quantity']*$val['dbl_product_cost'];
  }
  $option_html='';
  for ($i=1;$i<5;$i++) {
    if($order['int_status']<=$i){
      $option_html.='<option value="'.$i.'">'.$status[$i].'</option>';
    }
  }
  $shipping_string='';
  if(count($order['shipping'])>0)
  {
	$shipping_string='<strong>Shipping Company</strong>:'.$order['shipping'][0]['txt_shipping_company'].'<br/><strong>Tracking Number</strong>:'.$order['shipping'][0]['txt_tracking_number'].'';
  }
  else
  {
	$shipping_string='';
  }
  if($order['is_active']==1)
  {
	$action_string='<select  id="status_change_'.$order['int_order_id'].'" class="form-control status_change" id="status_'.$order['int_order_id'].'">'.$option_html.'</select><br/>
							<input type="hidden" id="order_customer_cell_'.$order['int_order_id'].'" value="'.$order['txt_cell_no'].'">
							<input type="hidden" id="order_customer_email_'.$order['int_order_id'].'" value="'.$order['txt_email'].'">
							<input type="hidden" id="prev_status_'.$order['int_order_id'].'" value="'.$order['int_status'].'">
							<input type="text" name="shipping_company_'.$order['int_order_id'].'" id="shipping_company_'.$order['int_order_id'].'" placeholder="Shipping Company" style="display:none;"><br/>
							<input type="text" name="tracking_number_'.$order['int_order_id'].'" id="tracking_number_'.$order['int_order_id'].'" placeholder="Tracking Number" style="display:none;"><br/>
							<select id="cancel_reason_'.$order['int_order_id'].'" style="display:none;">
								<option value="">Select Reason</option>
								<option value="Test Order">Test Order</option>
								<option value="Invalid Address">Invalid Address</option>
							</select><br/>
							<button type="button" class="update_status" id="update_status_'.$order['int_order_id'].'">Update</button>
							<button type="button" class="cancel_order" id="cancel_order_'.$order['int_order_id'].'">Cancel</button>';
  }
  else
  {
	$action_string='<p>Cancelled - '.$order['txt_cancel_reason'].'</p>';
  }
  $complete_structure.='<tr role="row" class="odd">
                        <td>ORD'.str_pad($order['int_order_id'],5,"0",STR_PAD_LEFT).'</td>
                        <td><b>Name</b>:'.$order['txt_fname'].' '.$order['txt_lname'].'<br><b>Phone</b>:'.$order['txt_cell_no'].'<br><b>Email</b>:'.$order['txt_email'].'<br><b>Address</b>:'.$order['txt_addressline1'].' '.$order['txt_addressline2'].'</td>
						 <td>'.$product_details.'</td>
                        <td>'.$order['int_order_amount'].'</td>
						<td>'.$shipping_string.'</td>
						<td><a target="_blank" href="'.site_url().'/orders/invoice?id='.$order['int_order_id'].'">Invoice</a></td>
                        <td>
                            '.$action_string.'
                        </td>
                      </tr>';
}
?>
<div class="content-wrapper">
  <div class="row">
    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Order List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered table-hover dataTable" id="example2" role="grid" aria-describedby="example2_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Order Id</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Customer Detail</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Product Detail</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Total Price</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Shipping Info</th>
						<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Invoice</th>
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
  $(".status_change").change(function(){
	var status=$(this).val();
	var id_array=this.id.split("_");
	if(status==3)
	{
		$("#shipping_company_"+id_array[2]+"").show();
		$("#tracking_number_"+id_array[2]+"").show();
	}
	else
	{
		$("#shipping_company_"+id_array[2]+"").hide();
		$("#tracking_number_"+id_array[2]+"").hide();
	}
  });
  $(".update_status").click(function(){
	
	 var id_array=this.id.split("_");
	 var status=$("#status_change_"+id_array[2]+"").val();
	 var email=$("#order_customer_email_"+id_array[2]+"").val();
	 var cell=$("#order_customer_cell_"+id_array[2]+"").val();
	 var shipping=$("#shipping_company_"+id_array[2]+"").val();
	 var tracking=$("#tracking_number_"+id_array[2]+"").val();
	 var prev_status=$("#prev_status_"+id_array[2]+"").val();
	 if(prev_status==status)
	 {
		alert("Please change status to update");
		$("#status_change_"+id_array[2]+"").focus();
		return false;
	 }
	 if(status==3)
	 {
		if(shipping==""){alert("Please enter shipping address");$("#shipping_company_"+id_array[2]+"").focus();return false;}
		if(tracking==""){alert("Please enter tracking number");$("#tracking_number_"+id_array[2]+"").focus();return false;}
	 }
	if(confirm("Are you sure you wish to change the status?")){
		 $.ajax({
			url:"<?php echo site_url().'/orders/changeStatus'?>",
			data:{order_id:id_array[2],status:status,email:email,shipping:shipping,tracking:tracking,cell:cell},
			method:"POST",
			datatype:"json",
			success:function(response){
				if(response=="success")
				  alert("Order Status Updated Successfully");
			}
		 });
	}
  });
  $(".cancel_order").click(function(){
	
	 var id_array=this.id.split("_");
	 var reason=$("#cancel_reason_"+id_array[2]+"").val();
	 var email=$("#order_customer_email_"+id_array[2]+"").val();
	 var cell=$("#order_customer_cell_"+id_array[2]+"").val();
	 $("#cancel_reason_"+id_array[2]+"").show();
	 if(reason==""){alert("Please select reason");$("#cancel_reason_"+id_array[2]+"").focus();return false;}
	 if(confirm("Are you sure you wish to cancel this order?")){
		 $.ajax({
			url:"<?php echo site_url().'/orders/cancelOrder'?>",
			data:{order_id:id_array[2],reason:reason,email:email,cell:cell},
			method:"POST",
			datatype:"json",
			success:function(response){
				if(response=="success")
				  alert("Order Succesfully Cancelled");
				   location.reload();
			}
		 });
	}
  });
});

function changeStatus(order_id,status,order_no,email){
  
}
</script>