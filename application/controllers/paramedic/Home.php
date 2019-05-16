<?php  

	class Home extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model("model_login");
			$this->load->model("model_paramedic");
			$this->load->model("model_profile");
			$this->load->model("model_slider");
			$this->load->model("model_transaction");
			$this->load->model("model_post");
		}

		public function index()
		{
			$id = $this->session->userdata('paramedic_id');

			if(!($this->session->userdata('paramedic_id')))
			{
				$data['company']  					= $this->model_profile->getcompany();
				$this->load->view('paramedic/login', $data);
				// $this->load->view('maintenance');
			}
			else
			{
				$data["transaction"]  	            	= $this->model_transaction->transaction_onprocess($id);
				$data['paramedic'] 						= $this->model_paramedic->paramedic_track($id);
				$data["slider"]  	          			= $this->model_slider->slider_active();
				$data['company']  						= $this->model_profile->getcompany();
				$data["post"]  	            			= $this->model_post->new_post();

				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar_paramedic', $data);
				$this->load->view('paramedic/content', $data);
			}
		}
		public function login()
		{
			if ($_POST) 
			{
				$data['paramedic_email'] 			= $this->input->post('email_user');
				$data['paramedic_password'] 		= md5($this->input->post('pass_user'));
				// $data['password_admin'] = md5($this->input->post('password_admin'));

				$result = $this->model_login->login_paramedic($data);
				if (!empty($result)) 
				{
					if($result->paramedic_status == '1')
					{
						$data = array(
							'paramedic_id' 					=> $result->paramedic_id, 
							'paramedic_name' 				=> $result->paramedic_name, 
							'paramedic_address'	 			=> $result->paramedic_address,
							'paramedic_sex'					=> $result->paramedic_sex,
							'paramedic_datebirth'	 		=> $result->paramedic_datebirth,
							'paramedic_email'	 			=> $result->paramedic_email,
							'paramedic_password'	 		=> $result->paramedic_password,
							'paramedic_phone'	 			=> $result->paramedic_phone,
							'district_id'	 				=> $result->district_id,
							'paramedic_status'	 			=> $result->paramedic_status,
							'paramedic_registerdate'	 	=> $result->paramedic_registerdate,
							'paramedic_image'		 		=> $result->paramedic_image,
							'paramediccategoty_id'	 		=> $result->paramediccategoty_id,
							'leveluser_id'		 			=> $result->leveluser_id
						);
	
						$this->session->set_userdata($data);
						redirect('paramedic/');
					}
					else
					{
						$this->session->set_flashdata('login','<center>Akun Anda Tidak Aktif!</center>');
						redirect('paramedic/');
					}
				}
				else
				{
					$this->session->set_flashdata('login','<center>Username dan Password Tidak Valid!</center>');
					redirect('paramedic/');
				}
			}
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect(''.base_url().'paramedic');
		}
	}


?>