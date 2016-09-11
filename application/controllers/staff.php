<?php
class Staff extends CI_Controller{

	function Staff(){
		parent::__construct();
		$this->load->database();
		$this->load->model('staff_model');
		$this->load->model('organization_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		header('Access-Control-Allow-Origin: *');
	}

	function add()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="add_staff";

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
	
	function staff_list_admin()
	{
		$user=$this->session->userdata('user');
		$data=$this->input->post();

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{
			if(isset($data['org_id']))
			{
				$data1["page"]="staff_list_admin";
				$data1["staff"]=$this->staff_model->get_org_staff($data['org_id']);
				$data1["organizations"]=$this->organization_model->get_all_organizations();
				$data1["org_id"]=$data['org_id'];
			}
			else
			{
				$data1["page"]="staff_list_admin";
				$data1["staff"]=array();
				$data1["organizations"]=$this->organization_model->get_all_organizations();
				$data1["org_id"]=NULL;
			}
				
			$this->load->view('page',$data1);	

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