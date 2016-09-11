<?php
class Location extends CI_Controller{

	function Location(){
		parent::__construct();
		$this->load->database();
		$this->load->model('location_model');
		$this->load->model('organization_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		header('Access-Control-Allow-Origin: *');
	}

	function add()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="add_location";

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
		$data['org_id']=$user['int_organization_id'];
		$status=$this->location_model->save($data);

		redirect('location/location_list', 'refresh');

	}

	

	function location_list()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="location_list";

			$data["locations"]=$this->location_model->get_all_locations();
			$this->load->view('page',$data);	

		}

		else

		{

			$this->load->view('login');	

		}	

	}
	
	function location_list_admin()
	{
		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{
			if(isset($data['org_id']))
			{
				$data1["page"]="location_list_admin";
				$data["locations"]=$this->location_model->get_org_locations($data['org_id']);
				$data1["organizations"]=$this->organization_model->get_all_organizations();
				$data1["org_id"]=$data['org_id'];
			}
			else
			{
				$data1["page"]="location_list_admin";
				$data1["locations"]=array();
				$data1["organizations"]=$this->organization_model->get_all_organizations();
				$data1["org_id"]=NULL;
			}

			$data["page"]="location_list_admin";

			$data["locations"]=$this->location_model->get_all_locations();
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

		$this->location_model->delete_location($data['id']);

		redirect('location/location_list', 'refresh');

	}
}
?>