<?php
class Ws extends CI_Controller{

	function Ws(){
		parent::__construct();
		$this->load->database();
		$this->load->model('staff_model');
		$this->load->model('user_model');
		$this->load->model('fare_model');
		$this->load->model('location_model');
		$this->load->model('organization_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		header('Access-Control-Allow-Origin: *');
	}

	function staff_login()
	{
		$data=$this->input->post();
		$response=array();
		if(isset($data['email']) && isset($data['password']))
		{
			$status=$this->staff_model->verify($data);
			if(count($status)>0)
			{
				$response['details']=$status;
				$response['code']="200";
			}
			else
			{
				$response['error']="Invalid Credentials";
				$response['code']="202";
			}
		}
		else
		{
			$response['error']="Invalid Input";
			$response['code']="501";
		}
		echo json_encode($response);
	}
	
	function get_locations()
	{
		$organization_id=$_POST['organization'];
		$locations=$this->location_model->get_org_locations($organization_id);
		$response=array();
		if(count($locations)>0)
		{
			$response['details']=$locations;
			$response['code']="200";
		}
		else
		{
			$response['error']="No Locations";
			$response['code']="202";
		}
		echo json_encode($response);
	}
	
	function get_fare()
	{
		$data=$this->input->post();
		$response=array();
		if(isset($data['source']) && isset($data['destination']) && isset($data['quantity']))
		{
			$total=$this->fare_model->calculate($data);
			if($total!='0')
			{
				$response['fare']=$total;
				$response['code']="200";
			}
			else
			{
				$response['error']="Error Occured";
				$response['code']="202";
			}
		}
		else
		{
			$response['error']="Invalid Input";
			$response['code']="501";
		}
		echo json_encode($response);
	}

	function save_transaction()
	{
		$data=$this->input->post();
		$response=array();
		$ticket=array();
		if(isset($data['secret']) && isset($data['destination']) && isset($data['quantity']) && isset($data['source']))
		{
			$organization_detail=$this->organization_model->get_organization_details($data['organization']);
			$ticket['organization']=$organization_detail[0]['txt_name'];
			$source_detail=$this->location_model->get_location_details($data['source']);
			$ticket['source']=$source_detail[0]['txt_location'];
			$destination_detail=$this->location_model->get_location_details($data['destination']);
			$ticket['destination']=$destination_detail[0]['txt_location'];
			$ticket['fare']=$data['fare'];
			$ticket['quantity']=$data['quantity'];
			$ticket['datetime']=$data['datetime']=date("Y-m-d H:i:s");
			$result=$this->fare_model->save_transaction($data);
			if($result)
			{
				$response['ticket']=$ticket;
				$response['code']="200";
			}
			else
			{
				$response['error']="Error Occured";
				$response['code']="202";
			}
		}
		else
		{
			$response['error']="Invalid Input";
			$response['code']="501";
		}
		echo json_encode($response);
	}
}
?>