<?php
$complete_structure='';

foreach($records as $record)
{
  $complete_structure.='<tr role="row" class="odd">
                        <td>'.$record['txt_sport'].'</td>						<td>'.$record['txt_competition'].'</td>						<td>'.$record['txt_team1'].'</td>						<td>'.$record['txt_team2'].'</td>						<td>'.$record['dt_date'].' '.$record['ts_time'].'</td>						<td>							<a class="del_confirm" href="'.site_url().'/record/delete?id='.$record['int_record_id'].'">Delete</a>
                        </td>
                      </tr>';
}
?>
<div class="content-wrapper">
  <div class="row">
    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Record List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered table-hover dataTable" id="example2" role="grid" aria-describedby="example2_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Sport</th>						<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Competition</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Team 1</th>						<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Team 2</th>						<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Datetime</th>
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
</script>