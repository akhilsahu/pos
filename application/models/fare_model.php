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