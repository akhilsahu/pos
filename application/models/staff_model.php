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
		$sql="select a.* from tab_staff as a left join tab_organizations as b ON a.int_organization_id=b.int_organization_id where a.txt_email='".$data['email']."' and a.txt_password='".$password."' and b.is_active=1";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		$details=array();
		if(count($result)>0)
		{
			$id=$result[0]['int_staff_id'];
			$details=$result[0];
			$sql_assign="select a.* from tab_vehicle_assignment as a left join tab_vehicle as b ON a.int_vehicle_id=b.int_vehicle_id where a.int_staff_id=".$id." and b.is_approved=1";
			$query_assign=$this->db->query($sql_assign);
			$result_assign=$query_assign->result_array();
			if(count($result_assign)>0)
			{
				$details['vehicle']=$result_assign[0]['int_vehicle_id'];
				$details['error']="";
			}
			else
			{
				$details['vehicle']=0;
				$details['error']="No vehicle Assigned";
			}
		}
		else
		{
			$details['error']="Invalid Credentials";
		}
		return $details;
	}

	function get_all_staff()
	{
		$sql="select * from tab_staff";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function get_unassigned_staff($org_id)
	{
		$sql="select a.* from tab_staff as a left join tab_vehicle_assignment as b ON a.int_staff_id=b.int_staff_id where a.int_organization_id='".$org_id."'  and b.int_staff_id is null";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	function get_org_staff($org_id)
	{
		$sql="select * from tab_staff where int_organization_id='".$org_id."'";
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