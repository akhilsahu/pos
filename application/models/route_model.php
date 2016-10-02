<?php
class Route_model extends CI_Model{
	

	function route_model(){
		parent::__construct();
	}

	function save($data)
	{
		$sql_route="insert into tab_routes values(DEFAULT,'".$data['name']."','".$data['org_id']."')";
		$query=$this->db->query($sql_route);
		echo $last_id=$this->db->insert_id();
		echo $data['stopage_count'];
		for($i=1;$i<=$data['stopage_count'];$i++)
		{
			if($data['stopage_'.$i.'']!='')
			{
			echo	$sql_stopage="insert into tab_route_locations(DEFAULT,'".$last_id."','".$data['stopage_'.$i.'']."')";
				$query=$this->db->query($sql_stopage);
			}
		}
		exit;
		return 1;
	}

	function get_all_routes()
	{
		
		$sql="select * from tab_routes";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		$final_array=array();
		foreach($result as $record)
		{
			$record_id=$record['int_route_id'];
			$sql_assign="select array_to_string(array(select b.txt_location from tab_route_locations as a Left join tab_locations as b ON a.int_location_id=b.int_location_id where int_route_id=".$record_id."),',') as stopages";
			$query_assign=$this->db->query($sql_assign);
			$result_assign=$query_assign->result_array();
			$record['stopages']=$result_assign[0]['stopages'];
			$final_array[]=$record;
		}
		return $final_array;
	}
	
	function get_org_routes($org_id)
	{
		$sql="select * from tab_routes where int_organization_id='".$org_id."'";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		$final_array=array();
		foreach($result as $record)
		{
			$record_id=$record['int_route_id'];
			$sql_assign="select array_to_string(array(select b.txt_location from tab_route_locations as a Left join tab_locations as b ON a.int_location_id=b.int_location_id where int_route_id=".$record_id."),',') as stopages";
			$query_assign=$this->db->query($sql_assign);
			$result_assign=$query_assign->result_array();
			$record['stopages']=$result_assign[0]['stopages'];
			$final_array[]=$record;
		}
		return $final_array;
	}
	
	function delete_route($id)
	{
		$sql="delete from tab_routes where int_route_id=".$id."";
		$query=$this->db->query($sql);
		$sql="delete from tab_route_locations where int_route_id=".$id."";
		$query=$this->db->query($sql);
	}
	
}

?>