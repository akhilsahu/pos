<?php
$user=$this->session->userdata('user');
$option_string='';
$option_string_brand='';
$product=$details[0];
foreach($categories as $category)
{
	if($product['int_category_id']==$category["int_category_id"])
	{
		$option_string.='<option value="'.$category["int_category_id"].'" selected>'.$category["txt_category_name"].'</option>';
	}
	else
	{
		$option_string.='<option value="'.$category["int_category_id"].'">'.$category["txt_category_name"].'</option>';
	}
}
foreach($brands as $brand)
{
	if($product['int_brand_id']==$brand["int_brand_id"])
	{
		$option_string_brand.='<option value="'.$brand["int_brand_id"].'" selected>'.$brand["txt_brand_name"].'</option>';
	}
	else
	{
		$option_string_brand.='<option value="'.$brand["int_brand_id"].'">'.$brand["txt_brand_name"].'</option>';
	}
}
$count=0;
$image_string='';
$images=$details['images'];
foreach($images as $image)
{
	$image_string.='<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Image'.($count+1).'</label>
                      <div class="col-sm-8">
                        <input type="file" id="image'.($count+1).'" name="image'.($count+1).'" value="" class="form-control">
						<img src="'.base_url().'/uploads/products/'.$image['txt_image_url'].'" style="height:100px;width:100px;">
                      </div>
                    </div>';
	$count++;
}
for($i=($count+1);$i<=5;$i++)
{
	$image_string.='<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Image'.$i.'</label>
                      <div class="col-sm-8">
                        <input type="file" id="image'.$i.'" name="image'.$i.'" value="" class="form-control">
                      </div>
                    </div>';
}
$spec_string='';
if(count($details['specs'])>0)
{
	$specs_count=0;
	$specs=$details['specs'];
	foreach($specs as $spec)
	{
		$spec_string.='<tr id="specification_'.($specs_count+1).'">
								<td width="40%"><input type="text" id="specification_key_'.($specs_count+1).'" name="specification_key_'.($specs_count+1).'" value="'.$spec['txt_specification_meta'].'" class="form-control"></td>
								<td width="40%"><input type="text" id="specification_value_'.($specs_count+1).'" name="specification_value_'.($specs_count+1).'" value="'.$spec['txt_specification_value'].'" class="form-control"></td>
								<td width="20%"><input type="button" class="btn btn-info pull-right" onclick="remove_row(this.id)" id="remove_'.($specs_count+1).'" value="Remove"></td>
							</tr>';
		$specs_count++;
	}
	
}
else
{
	$spec_string.='<tr id="specification_1">
								<td width="40%"><input type="text" id="specification_key_1" name="specification_key_1" value="" class="form-control"></td>
								<td width="40%"><input type="text" id="specification_value_1" name="specification_value_1" value="" class="form-control"></td>
								<td width="20%"><input type="button" class="btn btn-info pull-right" onclick="remove_row(this.id)" id="remove_1" value="Remove"></td>
							</tr>';
	$specs_count=1;
}
?>
<div class="content-wrapper">
<div class="row">
    <div class="col-md-8">
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Product</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo site_url();?>/product/update" enctype="multipart/form-data">
                    <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Name</label>
                      <div class="col-sm-8">
						<input type="hidden" name="product_id" id="product_id" value="<?php echo $product['int_product_id']; ?>">
                        <input type="text" placeholder="Product Name" id="product_name" name="product_name" value="<?php echo $product['txt_product_name']; ?>" class="form-control">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Description</label>
                      <div class="col-sm-8">
                        <textarea id="product_description" name="product_description" class="form-control"><?php echo $product['txt_product_description']; ?></textarea>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Category</label>
                      <div class="col-sm-8">
                        <select id="product_category" name="product_category" class="form-control">
							<option value="0">Select Category</option>
							<?php echo $option_string;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Brand</label>
                      <div class="col-sm-8">
                        <select id="product_brand" name="product_brand" class="form-control">
							<option value="0">Select Brand</option>
							<?php echo $option_string_brand;?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label" for="inputEmail3">Cost</label>
                      <div class="col-sm-8">
                        <input type="text" placeholder="Product Cost" id="product_cost" name="product_cost" value="<?php echo $product['dbl_product_cost']; ?>" class="form-control">
                      </div>
                    </div>
					<?php echo $image_string; ?>
                  </div><!-- /.box-body -->
				  
				  <div class="box box-info">
					<table cellspacing="0" cellpadding="0" border="0" width="100%">
						<thead>
							<tr>
								<td width="40%">Feature Specification(Like Color,weight etc)</td>
								<td width="40%">Specification Value</td>
								<td width="20%"><input type="button" class="btn btn-info pull-right" id="add_specification" value="add"><input type="hidden" id="specification_count" name="specification_count" value="<?php echo $specs_count; ?>"></td>
							</tr>
						</thead>
						<tbody id="specification_structure">
							<?php echo $spec_string; ?>
						</tbody>
					</table>
				  </div>
                  <div class="box-footer">
                    <button id="save_product" class="btn btn-info pull-right" type="submit">Save</button>
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
    if($("#product_name").val()==""){alert("Please enter Category Name");$("#product_name").focus();return false;}
	if($("#product_description").val()==""){alert("Please enter Category Name");$("#product_description").focus();return false;}
	if($("#product_category").val()==""){alert("Please Select Category");$("#product_category").focus();return false;}
	if($("#product_brand").val()==""){alert("Please Select Brand");$("#product_brand").focus();return false;}
	if($("#product_cost").val()==""){alert("Please enter Cost");$("#product_cost").focus();return false;}
  });
  
  $("#add_specification").click(function(){
	var specification_count=$("#specification_count").val();
	var new_count=parseInt(specification_count, 10)+1;
	var structure='<tr id="specification_'+new_count+'"><td width="40%"><input type="text" id="specification_key_'+new_count+'" name="specification_key_'+new_count+'" value="" class="form-control"></td><td width="40%"><input type="text" id="specification_value_'+new_count+'" name="specification_value_'+new_count+'" value="" class="form-control"></td><td width="20%"><input type="button" class="btn btn-info pull-right" onclick="remove_row(this.id)" id="remove_'+new_count+'" value="Remove"></td></tr>';
	$("#specification_structure").append(structure);
	$("#specification_count").val(new_count);
  });
});
function remove_row(id)
{
		var id_array=id.split("_");
		var remove_id=id_array[1];
		$("#specification_"+remove_id+"").remove();
}
</script>