<?php  

	class Home extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model("model_login");
			$this->load->model("model_widget");
			$this->load->model("model_profile");
			$this->load->model("model_service");
			$this->load->model("model_transaction");
		}

		public function index()
		{
			$id = $this->session->userdata('id_admin');
			if(!($this->session->userdata('id_admin')))
			{
                $data['company']  					= $this->model_profile->getcompany();
				$this->load->view('admin/login', $data);
			}
			else
			{
				$data['paramedic'] 					= $this->model_widget->paramedic();
				$data['patient'] 					= $this->model_widget->patient();
				$data['service'] 					= $this->model_widget->service();
				$data['district'] 					= $this->model_widget->district();
				$data['transaction'] 				= $this->model_widget->transaction();
				$data['package'] 					= $this->model_widget->package();
				$data['post'] 						= $this->model_widget->post();
				$data['user'] 						= $this->model_widget->user();
				$data['admin']  					= $this->model_profile->getadmin($id);
                $data['company']  					= $this->model_profile->getcompany();
                $data['rekapservice']  				= $this->model_service->rekapservice();
                $data['history']  					= $this->model_transaction->rekaphistory();

				$this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar', $data);
                $this->load->view('tamplate/content', $data);
			}
		}
		public function login()
		{
			if ($_POST) 
			{
				$data['username_admin'] 			= $this->input->post('username_admin');
				$data['password_admin'] 			= md5($this->input->post('password_admin'));

				$result = $this->model_login->login($data);
				if (!empty($result)) 
				{
					$data = array(
						'id_admin' 			=> $result->id_admin, 
						'username_admin' 	=> $result->username_admin, 
						'password_admin'	=> $result->password_admin,
						'name_admin'	 	=> $result->name_admin
					);

					$this->session->set_userdata($data);
					redirect('admin/');
				}
				else
				{
					$this->session->set_flashdata('login','Username Atau Password Tidak Valid!');
					redirect('admin/');
				}
			}
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect(''.base_url().'admin');
		}
	}


?>