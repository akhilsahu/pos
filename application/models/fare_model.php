<?php
class Fare_model extends CI_Model{
	

	function fare_model(){
		parent::__construct();
	}

	function save($data)
	{
		$sql_product="insert into tab_fare values(DEFAULT,'".$data['source']."','".$data['destination']."','".$data['fare']."')";
		$query=$this->db->query($sql_product);
		return 1;
	}

	function get_all_fares()
	{
		
		$sql="select a.int_fare_id, a.float_fare as fare,b.txt_location as source,c.txt_location as destination from tab_fare as a join tab_locations as b ON a.int_source=b.int_location_id join tab_locations as c ON a.int_destination=c.int_location_id";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function save_transaction($data)
	{
		$sql_product="insert into tab_transactions values(DEFAULT,'".$data['source']."','".$data['destination']."','".$data['quantity']."','".$data['fare']."','".$data['organization']."','".$data['secret']."','".$data['datetime']."','".$data['vehicle']."')";
		$query=$this->db->query($sql_product);
		return 1;
	}
	
	function import_org_data($data)
	{
		$filepath='uploads/'.$data['filename'];
		$final_array=array();
		if (($handle = fopen($filepath, "r")) !== FALSE) {
			while (($data1 = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$temp_array=array();
				$temp_array['source']=$data1[0];
				$temp_array['destination']=$data1[1];
				$temp_array['fare']=$data1[2];
				$final_array[]=$temp_array;
			}
			fclose($handle);
		}
		$counter=0;
		$id_array=array();
		for($i=0;$i<count($final_array);$i++)
		{
			$temp_id_array=array();
			if($i==0)
			{
				$insert1="insert into tab_locations values(DEFAULT,'".$final_array[$i]['source']."','".$data['org_id']."')";
				$query1=$this->db->query($insert1);
				$source_id=$this->db->insert_id();
				$insert2="insert into tab_locations values(DEFAULT,'".$final_array[$i]['destination']."','".$data['org_id']."')";
				$query2=$this->db->query($insert2);
				$destination_id=$this->db->insert_id();
				$temp_id_array['source']=$source_id;
				$temp_id_array['destination']=$destination_id;
				$temp_id_array['fare']=$final_array[$i]['fare'];
				$sql_fare="insert into tab_fare values(DEFAULT,'".$source_id."','".$destination_id."','".$final_array[$i]['fare']."')";
				$query_fare=$this->db->query($sql_fare);
			}
			else
			{
				$insert2="insert into tab_locations values(DEFAULT,'".$final_array[$i]['destination']."','".$data['org_id']."')";
				$query1=$this->db->query($insert2);
				$destination_id=$this->db->insert_id();
				$sql_fare="insert into tab_fare values(DEFAULT,'".$id_array[0]['source']."','".$destination_id."','".$final_array[$i]['fare']."')";
				$query_fare=$this->db->query($sql_fare);
				for($j=0;$j<$i;$j++)
				{
					$intermediate_cost=$final_array[$i]['fare']-$final_array[$j]['fare'];
					$source_id=$id_array[$j]['destination'];
					$sql_fare="insert into tab_fare values(DEFAULT,'".$source_id."','".$destination_id."','".$intermediate_cost."')";
					$query_fare=$this->db->query($sql_fare);
				}
				$temp_id_array['source']=$id_array[0]['source'];
				$temp_id_array['destination']=$destination_id;
				$temp_id_array['fare']=$final_array[$i]['fare'];
			}
			$id_array[]=$temp_id_array;
		}
		return 1;
	}
	
	function get_transaction_data($data)
	{
		$start_dt=date("Y-m-d",strtotime($data['selected_date']))." 00:00:00";
		$end_dt=date("Y-m-d",strtotime($data['selected_date']))." 23:59:59";
		$sql="select a.int_transaction_id, a.int_quantity, a.fl_cost as fare,b.txt_location as source,c.txt_location as destination,a.dt_issue from tab_transactions as a join tab_locations as b ON a.int_source=b.int_location_id join tab_locations as c ON a.int_destination=c.int_location_id where a.int_vehicle_id='".$data['vehicle']."' and dt_issue>='".$start_dt."' and dt_issue<='".$end_dt."'";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function get_org_transaction($data)
	{
		$start_dt=date("Y-m-d",strtotime($data['start']))." 00:00:00";
		$end_dt=date("Y-m-d",strtotime($data['end']))." 23:59:59";
		$sql="select a.int_transaction_id, a.int_quantity, a.fl_cost as fare,b.txt_location as source,c.txt_location as destination,a.dt_issue,d.txt_license_plate from tab_transactions as a join tab_locations as b ON a.int_source=b.int_location_id join tab_locations as c ON a.int_destination=c.int_location_id left join tab_vehicle as d ON a.int_vehicle_id=d.int_vehicle_id where a.int_organization_id='".$data['org_id']."' and dt_issue>='".$start_dt."' and dt_issue<='".$end_dt."'";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function get_org_fares($org_id)
	{
		
		$sql="select a.int_fare_id, a.float_fare as fare,b.txt_location as source,c.txt_location as destination from tab_fare as a join tab_locations as b ON a.int_source=b.int_location_id join tab_locations as c ON a.int_destination=c.int_location_id where b.int_organization_id='".$org_id."'";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function calculate($data)
	{
		$sql="select * from tab_fare where int_source='".$data['source']."' and int_destination='".$data['destination']."'";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		$fare_amt=$result[0]['float_fare'];
		if($fare_amt!='' || $fare_amt!='0')
		{
			$total=$fare_amt*$data['quantity'];
		}
		else
		{
			$total=0;
		}
		return $total;
	}
	

	function delete_fare($id)
	{
		$sql="delete from tab_fare where int_fare_id=".$id."";
		$query=$this->db->query($sql);
		return $query;
	}
	
	function get_fare_details($id)
	{
		$sql="select * from tab_fare where int_fare_id=".$id."";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function update_fare($data)
	{
		$sql_product="update tab_fare set float_fare='".$data['fare']."' where int_fare_id='".$data['fare_id']."'";
		$query=$this->db->query($sql_product);
		return 1;
	}
	
}

?>