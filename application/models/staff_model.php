<?php
class Staff_model extends CI_Model{
	

	function staff_model(){
		parent::__construct();
	}

	function save($data)
	{
		$sql_product="insert into tab_staff values(DEFAULT,'".$data['name']."','".$data['email']."','".$data['password']."','".$data['org_id']."','".$data['role']."','".date("Y-m-d")."')";
		$query=$this->db->query($sql_product);
		return 1;
	}

	function get_all_organizations()
	{
		
		$sql="select * from tab_organizations";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	

	function delete_organization($id)
	{
		$sql="delete from tab_organizations where int_organization_id=".$id."";
		$query=$this->db->query($sql);
		return $query;
	}
	
	function get_organization_details($id)
	{
		$sql="select * from tab_organizations where int_organization_id=".$id."";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function update_org($data)
	{
		$sql_product="update tab_organizations set txt_name='".$data['org_name']."', txt_contact='".$data['contact']."', txt_address='".$data['address']."', int_zip='".$data['zipcode']."' where int_organization_id='".$data['organization_id']."'";
		$query=$this->db->query($sql_product);
		return 1;
	}
	
}

?>