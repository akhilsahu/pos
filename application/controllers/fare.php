<?php
class Fare extends CI_Controller{

	function Fare(){
		parent::__construct();
		$this->load->database();
		$this->load->model('fare_model');
		$this->load->model('location_model');
		$this->load->model('organization_model');
		$this->load->model('vehicle_model');
		$this->load->model('route_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		header('Access-Control-Allow-Origin: *');
	}

	function add()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="add_fare";
			
			$data["locations"]=$this->location_model->get_all_locations();

			$this->load->view('page',$data);	

		}

		else

		{

			$this->load->view('login');	

		}

	}
	
	function import_form()
	{
		$user=$this->session->userdata('user');
		if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			$data["page"]="import_form";
			$this->load->view('page',$data);
		}
		else
		{
			$this->load->view('login');	
		}
	}
	
	function import_form_admin()
	{
		$user=$this->session->userdata('user');
		if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			$data["page"]="import_form_admin";
			$data["organizations"]=$this->organization_model->get_all_organizations();
			$this->load->view('page',$data);
		}
		else
		{
			$this->load->view('login');	
		}
	}
	
	function list_transaction_admin()
	{
		$user=$this->session->userdata('user');
		$data=$this->input->post();
		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{
			if(isset($data['org_id']) && ((isset($data['start']) && isset($data['end'])) || isset($data['vehicle_id'])))
			{
				$data1["page"]="transaction_list_admin";
				$data1["transactions"]=$this->fare_model->get_org_transaction($data);
				$data1["organizations"]=$this->organization_model->get_all_organizations();
				$data1["vehicles"]=$this->vehicle_model->get_org_vehicle($data['org_id']);
				$data1["org_id"]=$data['org_id'];
				$data1["start"]=$data['start'];
				$data1["end"]=$data['end'];
				$data1["vehicle_id"]=$data['vehicle_id'];
			}
			else
			{
				$data1["page"]="transaction_list_admin";
				$data1["transactions"]=array();
				$data1["organizations"]=$this->organization_model->get_all_organizations();
				$data1["vehicles"]=array();
				$data1["org_id"]=NULL;
				$data1["start"]=NULL;
				$data1["end"]=NULL;
				$data1["vehicle_id"]=NULL;
			}

			$this->load->view('page',$data1);	

		}

		else

		{

			$this->load->view('login');	

		}
	}
	
	function print_transaction()
	{
		$user=$this->session->userdata('user');
		$data=$this->input->get();
		$data['org_id']=$user['int_organization_id'];
		$data1["transactions"]=$this->fare_model->get_org_transaction($data);
		$this->load->view('print_transaction',$data1);
	}
	
	function print_transaction_admin()
	{
		$user=$this->session->userdata('user');
		$data=$this->input->get();
		$data1["transactions"]=$this->fare_model->get_org_transaction($data);
		$this->load->view('print_transaction',$data1);
	}
	
	function list_transaction()
	{
		$user=$this->session->userdata('user');
		$data=$this->input->post();
		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{
			if((isset($data['start']) && isset($data['end'])) || isset($data['vehicle_id']) || isset($data['time_period']))
			{
				$data['org_id']=$user['int_organization_id'];
				$data1["page"]="transaction_list";
				$data1["transactions"]=$this->fare_model->get_org_transaction($data);
				$data1["vehicles"]=$this->vehicle_model->get_org_vehicle($user['int_organization_id']);
				$data1["routes"]=$this->route_model->get_org_routes($user['int_organization_id']);
				$data1["start"]=$data['start'];
				$data1["vehicle_id"]=$data['vehicle_id'];
				$data1["end"]=$data['end'];
				$data1["route_id"]=$data['route_id'];
				$data1["time_period"]=$data['time_period'];
			}
			else
			{
				$data1["page"]="transaction_list";
				$data1["vehicles"]=$this->vehicle_model->get_org_vehicle($user['int_organization_id']);
				$data1["routes"]=$this->route_model->get_org_routes($user['int_organization_id']);
				$data1["transactions"]=array();
				$data1["start"]=NULL;
				$data1["end"]=NULL;
				$data1["vehicle_id"]=NULL;
				$data1["time_period"]=NULL;
			}

			$this->load->view('page',$data1);	

		}

		else

		{

			$this->load->view('login');	

		}
	}
	
	
	function save_import_admin()

	{

		$data=$this->input->post();

		$user=$this->session->userdata('user');
		
		if($_FILES['fare_chart']['tmp_name']!='')
		{
			$ext=explode(".",$_FILES["fare_chart"]["name"]);		
			$file_name=date("YmdHis").".".$ext[count($ext)-1];
			move_uploaded_file($_FILES['fare_chart']['tmp_name'],"uploads/".$file_name);
			$data['filename']=$file_name;
		}
		else
		{
			$data['filename']='';
		}
		
		$data['user']=$user['int_user_id'];
		$status=$this->fare_model->import_org_data($data);

		redirect('fare/fare_list_admin', 'refresh');

	}
	
	function save_import()

	{

		$data=$this->input->post();

		$user=$this->session->userdata('user');
		
		if($_FILES['fare_chart']['tmp_name']!='')
		{
			$ext=explode(".",$_FILES["fare_chart"]["name"]);		
			$file_name=date("YmdHis").".".$ext[count($ext)-1];
			move_uploaded_file($_FILES['fare_chart']['tmp_name'],"uploads/".$file_name);
			$data['filename']=$file_name;
		}
		else
		{
			$data['filename']='';
		}
		
		$data['user']=$user['int_user_id'];
		$data['org_id']=$user['int_organization_id'];
		$status=$this->fare_model->import_org_data($data);

		redirect('fare/fare_list', 'refresh');

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

			$data["fares"]=$this->fare_model->get_org_fares($user['int_organization_id']);
			$this->load->view('page',$data);	

		}

		else

		{

			$this->load->view('login');	

		}	

	}
	
	function fare_list_admin()

	{

		$user=$this->session->userdata('user');
		$data=$this->input->post();

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{
			if(isset($data['org_id']))
			{
				$data1["page"]="fare_list_admin";
				$data1["fares"]=$this->fare_model->get_org_fares($data['org_id']);
				$data1["organizations"]=$this->organization_model->get_all_organizations();
				$data1["org_id"]=$data['org_id'];
			}
			else
			{
				$data1["page"]="fare_list_admin";
				$data1["fares"]=array();
				$data1["organizations"]=$this->organization_model->get_all_organizations();
				$data1["org_id"]=NULL;
			}
				
			$this->load->view('page',$data1);	
			
			//$data["page"]="fare_list";

			//$data["fares"]=$this->fare_model->get_all_fares();
			//$this->load->view('page',$data);	

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
			
			$data["locations"]=$this->location_model->get_all_locations();

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