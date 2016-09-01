<?php
class Organization extends CI_Controller{

	function Organization(){
		parent::__construct();
		$this->load->database();
		$this->load->model('organization_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		header('Access-Control-Allow-Origin: *');
	}

	function add()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="add_organization";

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
		$status=$this->organization_model->save($data);

		redirect('organization/organization_list', 'refresh');

	}

	

	function organization_list()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="organization_list";

			$data["organizations"]=$this->organization_model->get_all_organizations();
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

		$this->organization_model->delete_organization($data['id']);

		redirect('organization/organization_list', 'refresh');

	}
	
	function edit()

	{
		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{
			$data=$this->input->get();

			$data1["page"]="edit_organization";

			$data1["details"]=$this->organization_model->get_organization_details($data['id']);
			print_r($data1);exit;
			
			$this->load->view('page',$data1);	

		}

		else

		{

			$this->load->view('login');	

		}

	}
}
?>