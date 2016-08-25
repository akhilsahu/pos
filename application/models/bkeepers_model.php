<?php
class Bkeepers_model extends CI_Model{
	

	function bkeepers_model(){
		parent::__construct();
	}

	function save($data)
	{
		$sql_product="insert into tab_book_keepers values(DEFAULT,'".$data['bkeeper_name']."','".$data['file_name']."')";
		$query=$this->db->query($sql_product);
		return 1;
	}

	function get_all_bkeepers(){
		
		$sql="select * from tab_book_keepers";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	

	function delete_bkeepers($id)
	{
		$sql="delete from tab_book_keepers where int_bookkeeper_id=".$id."";
		$query=$this->db->query($sql);
		return $query;
	}
	
}

?>