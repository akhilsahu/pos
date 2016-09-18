<?php
class Vehicle extends CI_Controller{

	function Vehicle(){
		parent::__construct();
		$this->load->database();
		$this->load->model('vehicle_model');
		$this->load->model('organization_model');
		$this->load->model('staff_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		header('Access-Control-Allow-Origin: *');
		
	}

	function add()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="add_vehicle";

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
		$status=$this->vehicle_model->save($data);

		redirect('vehicle/vehicle_list', 'refresh');

	}

	

	function vehicle_list()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="vehicle_list";

			$data["vehicles"]=$this->vehicle_model->get_org_vehicle($user['int_organization_id']);
			$this->load->view('page',$data);	

		}

		else

		{

			$this->load->view('login');	

		}	

	}
	
	function vehicle_list_admin()

	{

		$user=$this->session->userdata('user');
		$data=$this->input->post();
		if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			if(isset($data['org_id']))
			{
				$data1["page"]="vehicle_list_admin";
				$data1["vehicles"]=$this->vehicle_model->get_org_vehicle($data['org_id']);
				$data1["organizations"]=$this->organization_model->get_all_organizations();
				$data1["org_id"]=$data['org_id'];
			}
			else
			{
				$data1["page"]="vehicle_list_admin";
				$data1["vehicles"]=array();
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
	
	function assignment()
	{
		$user=$this->session->userdata('user');
		$data=$this->input->post();
		/*if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			if(isset($data['operation']))
			{
				if($data['operation']=='assign')
				{
					$data['user_id']=$user['int_user_id'];
					$result=$this->vehicle_model->assign_vehicle($data);
					$data1["search_vehicle"]='';
					$data1['search_data']=array();
				}
				else
				{
					$data1['search_data']=$this->vehicle_model->get_vehicle_member($data);
					$data1["search_vehicle"]=$data['search_vehicle'];
				}
			}
			else
			{
				$data1["search_vehicle"]='';
				$data1['search_data']=array();
			}
			$data1["vehicles_assign"]=$this->vehicle_model->get_unassigned_vehicle($user['int_organization_id']);
			$data1["vehicles_search"]=$this->vehicle_model->get_org_vehicle($user['int_organization_id']);
			$data1["members"]=$this->staff_model->get_unassigned_staff($user['int_organization_id']);
			$data1["page"]="assign_vehicle";
			
			$this->load->view('page',$data1);
		}
		else
	`	{
			$this->load->view('login');	
		}*/
	}

	function delete()

	{

		$data=$this->input->get();

		$this->vehicle_model->delete_vehicle($data['id']);

		redirect('vehicle/vehicle_list', 'refresh');

	}
	
	function edit()

	{
		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{
			$data1=$this->input->get();

			$data["page"]="edit_vehicle";

			$data["details"]=$this->vehicle_model->get_vehicle_details($data1['id']);
			
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
		$status=$this->vehicle_model->update_vehicle($data);

		redirect('vehicle/vehicle_list', 'refresh');

	}
}
?>