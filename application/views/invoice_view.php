<?php

$client_name=$product['txt_fname']." ".$product['txt_lname'];
$product_string='';
$total_amount=0;
foreach($product['product_info'] as $indv_product)
{
	$product_string.='<tr>
		<td width="40%">'.$indv_product['txt_product_name'].'</td>
		<td width="20%">'.$indv_product['int_quantity'].'</td>
		<td width="20%">'.$indv_product['dbl_product_cost'].'</td> 
		<td width="20%">'.($indv_product['int_quantity']*$indv_product['dbl_product_cost']).'</td></tr>';
		$total_amount+=$indv_product['int_quantity']*$indv_product['dbl_product_cost'];
}
$final_amount=$total_amount;
if($product['txt_coupon_code']!='')
{
	if($product['coupon_details']['int_discount_type']=='1')
	{
		$discount_amount=$product['int_discount_value'];
	}
	else if($product['coupon_details']['int_discount_type']=='2')
	{
		$discount_amount=(($product['coupon_details']['int_discount_value']*$final_amount)/100);
	}
	else
	{
		$discount_amount=0;
	}
	$coupon_string='<tr>
			<td  width="60%">&nbsp;&nbsp;</td>
			<td width="30%" align="right">Coupon('.$product['txt_coupon_code'].'):</td><td>-'.$discount_amount.'</td>
		</tr>';
}
else
{
	$coupon_string='';
}
$final_amount=$final_amount-$discount_amount;
$tax_string='';
$taxable_amount=$final_amount;
if(count($taxes)>0)
{
	foreach($taxes as $tax)
	{
		$tax_amount=($taxable_amount*$tax['db_rate'])/100;
		$tax_string.='<tr>
			<td  width="60%">&nbsp;&nbsp;</td>
			<td width="30%" align="right">'.$tax['txt_tax_name'].':</td><td>+'.$tax_amount.'</td>
		</tr>';
		$final_amount=$final_amount+$tax_amount;
	}
}
?>
<center>
<div style="width: 70%; border: 1px solid rgb(153, 153, 153); padding: 19px; margin-top: 30px;background:white;">
<table align="center" width="100%">
		<tr>
			<td><b>Client Name:</b><?php echo $client_name;?></td>
			<td><b>INVOICE No.</b><?php echo "INV".str_pad($product['int_order_id'],5,"0",STR_PAD_LEFT)?></td>
			<td rowspan="2"><img src="<?php echo base_url().'uploads/'.$site_config[2]['txt_meta_value']?>"><br /></td>
		</tr>
		<tr>	
			<td><b>Mobile:</b><?php echo $product['txt_cell_no'];?></td>
			<td><b>Date:</b><?php echo date("Y-m-d",strtotime($product['ts_submitted'])) ?></td>
		</tr>
</table>
<hr />
<table align="center"width="100%">
		<tr>
			<td width="40%"><b>PRODUCT NAME</b></td>
			<td width="20%"><b>QTY.</b></td>
			<td width="20%"><b>PRICE</b></td>
			<td width="20%"><b>TOTAL</b></td>
	</tr>
</table>
<hr />
<table class="form-table" id="customFields" align="center" width="100%">
	<?php echo $product_string; ?>
</table>
<hr />
<table align="center" width="100%">	
		<tr>
			<td width="60%">&nbsp;&nbsp;</td>
			<td width="20%" align="right">Total:</td><td><?php echo $total_amount; ?></td>
		</tr>
		<?php echo $coupon_string; ?>
		<?php echo $tax_string; ?>
		
		<tr>
			<td  width="60%">&nbsp;</td>
			<td width="30%" align="right">Amount:</td><td><?php echo $final_amount; ?></td>
		</tr>
</table>
</div>
</center>
<script>
window.print();
</script>
