<?php
class Fare_model extends CI_Model{
	

	function fare_model(){
		parent::__construct();
	}

	function save($data)
	{
		$sql_product="insert into tab_fares values(DEFAULT,'".$data['source']."','".$data['destination']."','".$data['fare']."')";
		$query=$this->db->query($sql_product);
		return 1;
	}

	function get_all_organizations()
	{
		
		$sql="select a.float_fare as fare,b.txt_location as source,c.txt_location as destination from tab_fares as a join tab_locations as b ON a.int_source=b.int_location_id join tab_locations as c ON a.int_destination=b.int_location_id";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	

	function delete_organization($id)
	{
		$sql="delete from tab_fares where int_fare_id=".$id."";
		$query=$this->db->query($sql);
		return $query;
	}
	
	function get_organization_details($id)
	{
		$sql="select * from tab_fares where int_fare_id=".$id."";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function update_org($data)
	{
		$sql_product="update tab_fares set float_fare='".$data['fare']."' where int_fare_id='".$data['fare_id']."'";
		$query=$this->db->query($sql_product);
		return 1;
	}
	
}

?>