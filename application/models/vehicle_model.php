<?php
class Vehicle_model extends CI_Model{
	

	function vehicle_model(){
		parent::__construct();
	}

	function save($data)
	{
		$sql_product="insert into tab_vehicle values(DEFAULT,'".$data['model']."','".$data['manufacturer']."','".$data['year']."','".$data['lp']."','".$data['org_id']."')";
		$query=$this->db->query($sql_product);
		return 1;
	}

	function get_all_vehicles()
	{
		
		$sql="select * from tab_vehicle";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function get_unassigned_vehicle($org_id)
	{
		$sql="select a.* from tab_vehicle as a left join tab_vehicle_assignment as b ON a.int_vehicle_id=b.int_vehicle_id where a.int_organization_id='".$org_id."' and b.int_vehicle_id is null";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function get_org_vehicle($org_id)
	{
		$sql="select * from tab_vehicle where int_organization_id='".$org_id."'";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		$final_array=array();
		foreach($result as $record)
		{
			$record_id=$record['int_vehicle_id'];
			$sql_assign="select array_to_string(array(select b.txt_name from tab_vehicle_assignment as a Left join tab_staff as b ON a.int_staff_id=b.int_staff_id where int_vehicle_id=".$record_id."),',') as names";
			$query_assign=$this->db->query($sql_assign);
			$result_assign=$query_assign->result_array();
			$record['members']=$result_assign[0]['names'];
			$final_array[]=$record;
		}
		return $final_array;
	}
	
	function delete_assignment($id)
	{
		$sql="delete from tab_vehicle_assignment where int_assignment_id=".$id."";
		$query=$this->db->query($sql);
		return $query;
	}
	
	function assign_vehicle($data)
	{
		$sql_product="insert into tab_vehicle_assignment values(DEFAULT,'".$data['staff_assign']."','".$data['vehicle_assign']."','".$data['user_id']."','".date('Y-m-d')."')";
		$query=$this->db->query($sql_product);
		return 1;
	}
	
	function get_vehicle_member($data)
	{
		$sql="select a.txt_name,b.dt_assign,b.int_assignment_id from tab_staff as a right join tab_vehicle_assignment as b ON a.int_staff_id=b.int_staff_id where b.int_vehicle_id='".$data['search_vehicle']."'";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	

	function delete_vehicle($id)
	{
		$sql="delete from tab_vehicle where int_organization_id=".$id."";
		$query=$this->db->query($sql);
		return $query;
	}
	
	function get_vehicle_details($id)
	{
		$sql="select * from tab_vehicle where int_vehicle_id=".$id."";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function update_vehicle($data)
	{
		$sql_product="update tab_vehicle set txt_model='".$data['model']."', txt_manufacturer='".$data['manufacturer']."', int_year='".$data['year']."', txt_license_plate='".$data['lp']."' where int_vehicle_id='".$data['vehicle_id']."'";
		$query=$this->db->query($sql_product);
		return 1;
	}
	
}

?>