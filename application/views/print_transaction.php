<?php
$complete_structure='';
$org_selected=isset($org_id)?$org_id:'';
if(count($transactions)>0)
{
	foreach($transactions as $transaction)
	{
	  $complete_structure.='<tr role="row" class="odd">
							<td>'.$transaction['source'].'</td>
							<td>'.$transaction['destination'].'</td>
							<td>'.$transaction['int_quantity'].'</td>
							<td>'.$transaction['fare'].'</td>
							<td>'.$transaction['txt_license_plate'].'</td>
							<td>'.$transaction['dt_issue'].'</td>
						  </tr>';
	}
}
?>
<div class="content-wrapper">
	<div class="row">
		<table cellspacing="0" cellpadding="0" border="1" style="width:100%;">
			<?php echo $complete_structure; ?>
		</table>
	</div>
</div>
<script>
window.print();
</script>

