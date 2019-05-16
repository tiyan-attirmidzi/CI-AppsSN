<?php  

	class Home extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model("model_login");
			$this->load->model("model_user");
			$this->load->model("model_profile"); 	
			$this->load->model("model_slider"); 	
			$this->load->model("model_post");
		}

		public function index()
		{
			$id = $this->session->userdata('user_id');
			if(!($this->session->userdata('user_id')))
			{
                $data['company']  					= $this->model_profile->getcompany();
				$this->load->view('patient/login', $data);
				// $this->load->view('maintenance');
			}
			else
			{
				$data['user'] 						= $this->model_user->user_track($id);
				$data['company']  					= $this->model_profile->getcompany();
				$data["slider"]  	          		= $this->model_slider->slider_active();
				$data["post"]  	            		= $this->model_post->new_post();

				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar_patient', $data);
				$this->load->view('patient/content', $data);
			}
		}

		public function login()
		{
			if ($_POST) 
			{
				$data['user_email'] 			= $this->input->post('email_user');
				$data['user_password'] 		= md5($this->input->post('pass_user'));

				$result = $this->model_login->login_patient($data);

				if (!empty($result)) 
				{
					if($result->user_status == '1')
					{
						$data = array(
							'user_id' 					=> $result->user_id, 
							'user_name' 				=> $result->user_name, 
							'user_sex'					=> $result->user_sex,
							'user_address'	 			=> $result->user_address,
							'user_phone'	 			=> $result->user_phone,
							'district_id'	 			=> $result->district_id,
							'user_registerdate'	 		=> $result->user_registerdate,
							'user_email'	 			=> $result->user_email,
							'user_password'	 			=> $result->user_password,
							'user_status'	 			=> $result->user_status,
							'user_datebirth'	 		=> $result->user_datebirth,
							'user_image'		 		=> $result->user_image,
							'leveluser_id'		 		=> $result->leveluser_id
						);
	
						$this->session->set_userdata($data);
						redirect('patient/');
					}
					else
					{
						$this->session->set_flashdata('login','<center>Akun Anda Tidak Aktif !</center>');
						redirect('patient/');
					}
				}
				else
				{

					$this->session->set_flashdata('login','<center>Username dan Password Tidak Valid!</center>');	
					redirect('patient/');
									
				}
			}
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect(''.base_url().'patient');
		}
	}


?>