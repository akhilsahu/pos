<?php
class Record extends CI_Controller{

	function record(){
		parent::__construct();
		$this->load->database();
		$this->load->model('bkeepers_model');
		$this->load->model('record_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	function add()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="add_record";
			
			$data["bkeepers"]=$this->bkeepers_model->get_all_bkeepers();

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

		$status=$this->record_model->save($data);

		redirect('record/record_list', 'refresh');

	}

	

	function record_list()

	{

		$user=$this->session->userdata('user');

		if(isset($user['int_user_id']) && $user['int_user_id']!='')

		{

			$data["page"]="record_list";

			$data["records"]=$this->record_model->get_all_records();

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

		$this->record_model->delete_record($data['id']);

		redirect('record/record_list', 'refresh');

	}
}
?>