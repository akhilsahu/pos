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
	
	function get_org_vehicle($org_id)
	{
		$sql="select * from tab_vehicle where int_organization_id='".$org_id."'";
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