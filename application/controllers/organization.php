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

		if($_FILES['bkeeper_logo']['tmp_name']!='')

		{

			$ext=explode(".",$_FILES["bkeeper_logo"]["name"]);		

			$file_name=date("YmdHis").".".$ext[count($ext)-1];

			move_uploaded_file($_FILES['bkeeper_logo']['tmp_name'],"uploads/bkeepers/".$file_name);

			$data['file_name']=$file_name;

		}

		else

		{

			$data['file_name']='';

		}

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
}
?>