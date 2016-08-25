<?php
class User extends CI_Controller{

	function User(){
		parent::__construct();
		$this->load->database();
		$this->load->model('user_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	function index()
	{

		$user_id=$this->session->userdata('user');
		if(isset($user_id) && $user_id!='')
		{
			//echo "hello";exit;
			redirect('user/dashboard', 'refresh');
		}
		else
		{
			$this->load->view('login');	
		}
	}

	function login(){

		$response_data=array();
		if($this->input->post()){
			$formdata=$this->input->post();
			$status_array=$this->user_model->verifyUser($formdata);
			if(count($status_array)==1)
			{
				$this->session->set_userdata('user', $status_array[0]);
				redirect('user/dashboard', 'refresh');
			}
			else
			{
				redirect('user/index', 'refresh');			
			}
		}else{
			redirect('user/index', 'refresh');
		}
	}

	function dashboard()
	{
		$user=$this->session->userdata('user');
		if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			$data["page"]="dashboard";
			//$data["course_count"]=$this->course_model->get_count();
			//$data["faculty_count"]=$this->faculty_model->get_count();
			$this->load->view('page',$data);	
		}
		else
		{
			$this->load->view('login');	
		}	
	}

	function profile()
	{
		$user=$this->session->userdata('user');
		if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			$data["page"]="profile";
			$this->load->view('page',$data);	
		}
		else
		{
			$this->load->view('login');	
		}	
	}

	function profile_update()
	{
		$data=$this->input->post();
		
		$data['file_name']='';
		if($_FILES['profile_image']['name']!='')
		{
			if (($_FILES["profile_image"]["type"] == "image/gif") || ($_FILES["profile_image"]["type"] == "image/jpeg")|| ($_FILES["profile_image"]["type"] == "image/jpg")|| ($_FILES["profile_image"]["type"] == "image/pjpeg")|| ($_FILES["profile_image"]["type"] == "image/x-png")|| ($_FILES["profile_image"]["type"] == "image/png")){
				$ext=explode(".",$_FILES["profile_image"]["name"]);		
				$file_name=date("YmdHis").".".$ext[count($ext)-1];
				move_uploaded_file($_FILES['profile_image'][tmp_name],"uploads/".$file_name);
				$data['file_name']=$file_name;
			}
		}
		$status=$this->user_model->update($data);
		$data["page"]="profile";
		redirect('user/dashboard', 'refresh');
	}

	function signout()
	{
		$user=$this->session->userdata('user');
		if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			   $this->session->unset_userdata('user');
			   $this->session->sess_destroy();
			   redirect('user/login', 'refresh');
		}
		else
		{
			redirect('user/login', 'refresh');
		}	
	}

	function settings(){
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('site_name', 'Site Name', 'required');
		$this->form_validation->set_rules('site_email', 'Email', 'required');					
		if($this->form_validation->run())
		{	
			$data=array('txt_meta_value'=>$this->input->post('site_name'));
			$this->db->where('txt_meta_key','site_name');
			$this->db->update('tab_settings',$data);

			$data=array('txt_meta_value'=>$this->input->post('site_email'));
			$this->db->where('txt_meta_key','site_email');
			$this->db->update('tab_settings',$data);

			if($_FILES['image1']['tmp_name']!=''){
				$ext=explode(".",$_FILES["image1"]["name"]);		
				$file_name="logo.".$ext[count($ext)-1];

				$data=array('txt_meta_value'=>$file_name);
				$this->db->where('txt_meta_key','site_logo');
				$this->db->update('tab_settings',$data);
				
				move_uploaded_file($_FILES['image1']['tmp_name'],"uploads/".$file_name);
			}
			for($i=1;$i<=4;$i++)
			{
				if($_FILES['slider_image_'.$i.'']['tmp_name']!=''){
					$ext=explode(".",$_FILES["slider_image_".$i.""]["name"]);		
					$file_name="slider_image_".$i.".".$ext[count($ext)-1];

					$data=array('txt_meta_value'=>$file_name);
					$this->db->where('txt_meta_key','slider_image_'.$i.'');
					$this->db->update('tab_settings',$data);
					
					move_uploaded_file($_FILES['slider_image_'.$i.'']['tmp_name'],"uploads/".$file_name);
				}
			}
			
			if($_FILES['about_image']['tmp_name']!=''){
				$ext=explode(".",$_FILES["about_image"]["name"]);		
				$file_name="about_image.".$ext[count($ext)-1];

				$data=array('txt_meta_value'=>$file_name);
				$this->db->where('txt_meta_key','about_image');
				$this->db->update('tab_settings',$data);
				
				move_uploaded_file($_FILES['about_image']['tmp_name'],"uploads/".$file_name);
			}
			
			$data=array('txt_meta_value'=>$this->input->post('minimum_order_amount'));
			$this->db->where('txt_meta_key','minimum_order_amount');
			$this->db->update('tab_settings',$data);
			
			redirect('user/settings', 'refresh');
		}
		else
		{
			$query = $this->db->get('tab_settings');
			$data['settings'] = $query->result_array();
			$data["page"]="settings";
			$this->load->view('page',$data);
		}
	}
	

	function changePassword(){
		
	}
	
	function add()
	{
		$user=$this->session->userdata('user');
		if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			$data["page"]="add_user";
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
		if($_FILES['profile_image']['name']!='')
		{
			if (($_FILES["profile_image"]["type"] == "image/gif") || ($_FILES["profile_image"]["type"] == "image/jpeg")|| ($_FILES["profile_image"]["type"] == "image/jpg")|| ($_FILES["profile_image"]["type"] == "image/pjpeg")|| ($_FILES["profile_image"]["type"] == "image/x-png")|| ($_FILES["profile_image"]["type"] == "image/png")){
				$ext=explode(".",$_FILES["profile_image"]["name"]);		
				$file_name=date("YmdHis").".".$ext[count($ext)-1];
				move_uploaded_file($_FILES['profile_image'][tmp_name],"uploads/".$file_name);
				$data['file_name']=$file_name;
			}
		}
		$data['user']=$user['int_user_id'];
		$status=$this->user_model->save($data);
		redirect('user/user_list', 'refresh');
	}
	
	function user_list()
	{
		$user=$this->session->userdata('user');
		if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			$data["page"]="user_list";
			$data["users"]=$this->user_model->get_all_users($user['int_user_id']);
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
		$this->coupon_model->delete_user($data['id']);
		redirect('user/user_list', 'refresh');
	}



	function edit()

	{
		$data=$this->input->get();
		$user=$this->session->userdata('user');
		if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			$data["page"]="edit_user";
			$data["id"]=$data['id'];
			$data["details"]=$this->user_model->user_detail($data['id']);
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
		if($_FILES['profile_image']['name']!='')
		{
			if (($_FILES["profile_image"]["type"] == "image/gif") || ($_FILES["profile_image"]["type"] == "image/jpeg")|| ($_FILES["profile_image"]["type"] == "image/jpg")|| ($_FILES["profile_image"]["type"] == "image/pjpeg")|| ($_FILES["profile_image"]["type"] == "image/x-png")|| ($_FILES["profile_image"]["type"] == "image/png")){
				$ext=explode(".",$_FILES["profile_image"]["name"]);		
				$file_name=date("YmdHis").".".$ext[count($ext)-1];
				move_uploaded_file($_FILES['profile_image'][tmp_name],"uploads/".$file_name);
				$data['file_name']=$file_name;
			}
		}
		$this->user_model->update_indv($data);
		redirect('user/user_list', 'refresh');
	}
	
	function contact_list()
	{
		$user=$this->session->userdata('user');
		if(isset($user['int_user_id']) && $user['int_user_id']!='')
		{
			$data["page"]="contact_list";
			$data["contacts"]=$this->user_model->get_all_contacts();
			$this->load->view('page',$data);	
		}
		else
		{
			$this->load->view('login');	
		}
	}
}


?>