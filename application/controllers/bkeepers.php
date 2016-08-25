<?php
class Bkeepers extends CI_Controller{

	function Bkeepers(){
		parent::__construct();
		$this->load->database();
		$this->load->model('bkeepers_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		header('Access-Control-Allow-Origin: *');
	}

	function add()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="add_bkeeper";

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

		$status=$this->bkeepers_model->save($data);

		redirect('bkeepers/bkeepers_list', 'refresh');

	}

	

	function bkeepers_list()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="bkeepers_list";

			$data["bkeepers"]=$this->bkeepers_model->get_all_bkeepers();

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

		$this->bkeepers_model->delete_bkeepers($data['id']);

		redirect('bkeepers/bkeepers_list', 'refresh');

	}
}
?>