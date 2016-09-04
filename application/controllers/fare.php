<?php
class Fare extends CI_Controller{

	function Fare(){
		parent::__construct();
		$this->load->database();
		$this->load->model('fare_model');
		$this->load->model('location_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		header('Access-Control-Allow-Origin: *');
	}

	function add()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="add_fare";
			
			$data["locations"]=$this->fare_model->get_all_locations();

			$this->load->view('page',$data);	

		}

		else

		{

			$this->load->view('login');	

		}

	}



	function save()

	{

		$data=$this->input->post();

		$user=$this->session->userdata('user');
		
		$data['user']=$user['int_user_id'];
		$status=$this->fare_model->save($data);

		redirect('fare/fare_list', 'refresh');

	}

	

	function fare_list()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="fare_list";

			$data["fares"]=$this->fare_model->get_all_fares();
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

		$this->fare_model->delete_fare($data['id']);

		redirect('fare/fare_list', 'refresh');

	}
	
	function edit()

	{
		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{
			$data1=$this->input->get();

			$data["page"]="edit_fare";
			
			$data["locations"]=$this->fare_model->get_all_locations();

			$data["details"]=$this->fare_model->get_fare_details($data1['id']);
			
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
		$status=$this->fare_model->update_fare($data);

		redirect('fare/fare_list', 'refresh');

	}
}
?>