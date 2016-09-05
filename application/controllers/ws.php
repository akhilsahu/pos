<?php
class Ws extends CI_Controller{

	function Ws(){
		parent::__construct();
		$this->load->database();
		$this->load->model('staff_model');
		$this->load->model('user_model');
		$this->load->model('fare_model');
		$this->load->model('location_model');
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
				$response['details']=$status[0];
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



	function save()

	{

		$data=$this->input->post();

		$user=$this->session->userdata('user');
		
		$data['user']=$user['int_user_id'];
		$data['org_id']=$user['int_organization_id'];
		$status=$this->staff_model->save($data);

		redirect('staff/staff_list', 'refresh');

	}

	

	function staff_list()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="staff_list";

			$data["staff"]=$this->staff_model->get_all_staff();
			$this->load->view('page',$data);	

		}

		else

		{

			$this->load->view('login');	

		}	

	}



	function delete()

	{

		$data=$this->input->get();

		$this->staff_model->delete_staff($data['id']);

		redirect('staff/staff_list', 'refresh');

	}
	
	function edit()

	{
		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{
			$data1=$this->input->get();

			$data["page"]="edit_staff";

			$data["details"]=$this->staff_model->get_staff_details($data1['id']);
			
			$this->load->view('page',$data);	

		}

		else

		{

			$this->load->view('login');	

		}

	}
	
	function update()

	{

		$data=$this->input->post();

		$user=$this->session->userdata('user');

		$data['user']=$user['int_user_id'];
		$status=$this->staff_model->update_staff($data);

		redirect('staff/staff_list', 'refresh');

	}
}
?>