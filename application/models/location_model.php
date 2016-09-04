<?php
class Location_model extends CI_Model{
	

	function Location_model(){
		parent::__construct();
	}

	function save($data)
	{
		$sql_product="insert into tab_locations values(DEFAULT,'".$data['name']."','".$data['org_id']."')";
		$query=$this->db->query($sql_product);
		return 1;
	}

	function get_all_locations()
	{
		
		$sql="select * from tab_locations";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	

	function delete_location($id)
	{
		$sql="delete from tab_locations where int_staff_id=".$id."";
		$query=$this->db->query($sql);
		return $query;
	}
	
}

?>