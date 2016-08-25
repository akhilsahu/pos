<?php
class Record_model extends CI_Model{
	

	function Record_model(){
		parent::__construct();
	}

	function save($data)
	{		$keeper1=$data['bet1_bkeeper']!=''?$data['bet1_bkeeper']:0;		$keeper2=$data['bet2_bkeeper']!=''?$data['bet2_bkeeper']:0;		$keeper3=$data['bet3_bkeeper']!=''?$data['bet3_bkeeper']:0;
		$sql_db="insert into tab_records values(DEFAULT,'".$data['sport']."','".$data['competition']."','".date("Y-m-d",strtotime($data['comp_date']))."','".$data['comp_time']."','".$data['team1']."','".$data['team2']."','".$data['bet_type']."','".$data['bet1_stake']."','".$keeper1."','".$data['bet2_stake']."','".$keeper2."','".$data['bet3_stake']."','".$keeper3."','".$data['bet1_url']."','".$data['bet2_url']."','".$data['bet3_url']."','".date("Y-m-d")."')";
		$query_db=$this->db->query($sql_db);
		return $query_db?1:0;
	}
	
	function get_all_records()
	{
		$sql="select * from tab_records order by int_record_id desc";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}

	function delete_record($id)
	{
		$sql="delete from tab_records where int_record_id=".$id."";
		$query=$this->db->query($sql);
		return $query;
	}
}

?>