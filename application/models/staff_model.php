<?php
class Staff_model extends CI_Model{
	

	function staff_model(){
		parent::__construct();
	}

	function save($data)
	{
		$password=md5($data['password']);
		$sql_product="insert into tab_staff values(DEFAULT,'".$data['name']."','".$data['email']."','".$password."','".$data['org_id']."','".$data['role']."','".date("Y-m-d")."')";
		$query=$this->db->query($sql_product);
		return 1;
	}
	
	function verify($data)
	{
		$password=md5($data['password']);
		$sql="select * from tab_staff where txt_email='".$data['email']."' and txt_password='".$password."'";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}

	function get_all_staff()
	{
		
		$sql="select * from tab_staff";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	

	function delete_staff($id)
	{
		$sql="delete from tab_staff where int_staff_id=".$id."";
		$query=$this->db->query($sql);
		return $query;
	}
	
}

?>