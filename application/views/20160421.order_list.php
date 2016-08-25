<?php
$complete_structure='';

$status=array('1'=>'Pending','2'=>'Acknowledged','3'=>'Confirmed','4'=>'Shipped','5'=>'Recieved');

foreach($orderlist as $order)
{
  $product_details='';
  $total_price=0;
  foreach ($order['product_list'] as $val) {
      $product_details.='<b>Name</b> : '.$val['txt_product_name'].'  <b>Oty</b>: '.$val['int_quantity'].' <b>Price</b>:'.$val['dbl_product_cost'].'<br>'; 
      $total_price+=$val['int_quantity']*$val['dbl_product_cost'];
  }
  $option_html='';
  for ($i=1;$i<6;$i++) {
    if($order['int_status']<=$i){
      $option_html.='<option value="'.$i.'">'.$status[$i].'</option>';
    }
  }

  $complete_structure.='<tr role="row" class="odd">
                        <td>ORD'.str_pad($order['int_order_id'],5,"0",STR_PAD_LEFT).'</td>
                        <td><b>Name</b>:'.$order['txt_fname'].' '.$order['txt_lname'].'<br><b>Phone</b>:'.$order['txt_cell_no'].'<br><b>Email</b>:'.$order['txt_email'].'<br><b>Address</b>:'.$order['txt_addressline1'].' '.$order['txt_addressline2'].'</td>
						            <td>'.$product_details.'</td>
                        <td>'.$total_price.'</td>
                        <td>
                            <select onchange=changeStatus('.$order['int_order_id'].',$(this).val(),"ORD'.str_pad($order['int_order_id'],5,"0",STR_PAD_LEFT).'") class="form-control" id="status_'.$order['int_order_id'].'">'.$option_html.'</select>
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

function changeStatus(order_id,status,order_no){
  $.ajax({
    url:"<?php echo site_url().'/orders/changeStatus'?>",
    data:{order_id:order_id,status:status},
    method:"POST",
    datatype:"json",
    success:function(response){
        if(response=="success")
          alert("Status updated for OrderNo."+order_no);
    }
  });
}
</script>