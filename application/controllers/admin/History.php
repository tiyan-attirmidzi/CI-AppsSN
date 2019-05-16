<?php  

	class History extends CI_Controller
	{
		
		function __construct()
		{
			error_reporting(0);
			parent::__construct();
			$this->load->model('model_transaction');
			$this->load->model('model_transactiondetail');
			$this->load->model('model_profile');
			$this->load->library('pagination');

			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
		}

		public function index()
		{
			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
			else
			{
				$this->session->unset_userdata('sess_search_transaction');
      			$this->session->unset_userdata('sess_search_transaction2');

      			if ($this->uri->segment(4) != "") 
      			{
			        $limit = $this->uri->segment(4);
			    } 
			    else 
			    {
			        $limit = 10;
			    }
			}
			#Config for pagination...
	      	$config                = array();
	      	$config["base_url"]    = base_url() . "admin/history/index/" . $limit;
	      	$config["total_rows"]  = $this->model_transaction->record_count();
	      	$config["per_page"]    = $limit;
	      	$config["uri_segment"] = 5;
	      
	      	#Config css for pagination...
	      	$config['full_tag_open']   = '<ul class="pagination">';
	      	$config['full_tag_close']  = '</ul>';
	      	$config['first_link']      = "First";
	      	$config['last_link']       = "Last";
	      	$config['first_tag_open']  = '<li>';
	      	$config['first_tag_close'] = '</li>';
	      	$config['prev_link']       = '&laquo';
	      	$config['prev_tag_open']   = '<li class="prev">';
	      	$config['prev_tag_close']  = '</li>';
	      	$config['next_link']       = '&raquo';
	      	$config['next_tag_open']   = '<li>';
	      	$config['next_tag_close']  = '</li>';
	      	$config['last_tag_open']   = '<li>';
	      	$config['last_tag_close']  = '</li>';
	      	$config['cur_tag_open']    = '<li class="active"><a href="#">';
	      	$config['cur_tag_close']   = '</a></li>';
	      	$config['num_tag_open']    = '<li>';
	      	$config['num_tag_close']   = '</li>';
	      
	      	#Check Page in Segement 3...
	      	if ($this->uri->segment(5) == "") 
	      	{
	      	  	$data['number'] = 0;
	      	} 
	      	else 
	      	{
	        	$data['number'] = $this->uri->segment(5);
			}
			  
          	$id_admin = $this->session->userdata('id_admin');
	      	
	      	#Generate Pagination...
	      	$this->pagination->initialize($config);
	      	$page           				  		= ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
          	$data["transaction"]        	  		= $this->model_transaction->fetch_transactionhistory($config["per_page"], $page);
          	$data["column"]             	  		= $this->model_transaction->select_column_name($this->db->database);
          	$data["links"]              	  		= $this->pagination->create_links();
			$data['admin']  						= $this->model_profile->getadmin($id_admin);
			$data['company']  						= $this->model_profile->getcompany();
				
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/topbar', $data);
			$this->load->view('tamplate/sidebar', $data);
			$this->load->view('admin/transactionhistory', $data);
		
		}

		public function result() 
		{
    		if (!($this->session->userdata('id_admin'))) 
    		{
      			redirect('admin');
    		} 
    		else 
    		{
      			#Set Key Search to Session...
      			if ($this->input->post('key')) 
      			{
        			$data['cari'] = $this->input->post('key');
        			$this->session->set_userdata('sess_search_transaction', $data['cari']);
        			$this->session->set_userdata('sess_search_transaction2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_transaction');
      			}
      
		      	#set Limit
		      	if ($this->uri->segment(4) != '') 
		      	{
		        	$limit = $this->uri->segment(4);
		      	} 
		      	else 
		      	{
		        	$limit = 10;
		      	}
      
      			#Config for pagination...
      			$config                					= array();
      			$config["base_url"]    					= base_url() . "admin/history/result/" . $limit . "/" . $data['cari'];
      			$config["total_rows"]  					= $this->model_transaction->record_count_search($data['cari'], $this->input->post('column_name'));
      			$config["per_page"]    					= $limit;
      			$config["uri_segment"] 					= 6;
      
      			#Config css for pagination...
      			$config['full_tag_open']   				= '<ul class="pagination">';
      			$config['full_tag_close']  				= '</ul>';
      			$config['first_link']      				= "First";
      			$config['last_link']       				= "Last";
      			$config['first_tag_open']  				= '<li>';
      			$config['first_tag_close'] 				= '</li>';
      			$config['prev_link']       				= '&laquo';
      			$config['prev_tag_open']   				= '<li class="prev">';
      			$config['prev_tag_close']  				= '</li>';
      			$config['next_link']       				= '&raquo';
      			$config['next_tag_open']   				= '<li>';
      			$config['next_tag_close']  				= '</li>';
      			$config['last_tag_open']   				= '<li>';
      			$config['last_tag_close']  				= '</li>';
      			$config['cur_tag_open']    				= '<li class="active"><a href="#">';
      			$config['cur_tag_close']   				= '</a></li>';
      			$config['num_tag_open']    				= '<li>';
      			$config['num_tag_close']   				= '</li>';
      
      			#Check Page in Segement 3...
      			if ($this->uri->segment(6) == "") 
      			{
        			$data['number'] = 0;
      			} 
      			else 
      			{
        			$data['number'] = $this->uri->segment(6);
				}
				  
				$id_admin = $this->session->userdata('id_admin');
      
      			#Generate Pagination...
      			$this->pagination->initialize($config);
      			$page           						= ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["transaction"]   					= $this->model_transaction->fetch_transactionhistory_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
				$data["column"] 						= $this->model_transaction->select_column_name($this->db->database);
				$data["package"]             	  		= $this->model_transaction->fetch_package();				
				$data["patient"] 						= $this->model_transaction->fetch_patient($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["links"]  						= $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				  
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/transactionhistory', $data);
    		}
		}
		  
		public function detail_view()
		{
			$id = base64_decode($this->input->get('transaction'));
			$id_detail = base64_decode($this->input->get('transactiondetail'));

			$this->data['key'] =  $this->model_transaction->check_transaction($id);
			if(!isset($this->data['key'][0]) || $this->data['key'][0] == "")
			{
				redirect('admin/history');
			} 
			else
			{
				$id_admin = $this->session->userdata('id_admin');

				$data['transaction']					= $this->model_transactiondetail->select_single($id);
				$data['paramedic'] 				  		= $this->model_paramedic->paramedic_track($paramedic_id);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar_paramedic', $data);
				$this->load->view('paramedic/transactiondetail', $data);
			}

			$id = $this->input->get('transaction_id');

			$this->data['key'] =  $this->model_transaction->check_transaction($id);
			if(!isset($this->data['key'][0]) || $this->data['key'][0] == "")
			{
				redirect('admin/history');
			} 
			$id_admin = $this->session->userdata('id_admin');

			$data['transactiondetail'] 				= $this->model_transactiondetail->select_all2('transaction_id', $id);
			$data['transactiondetail2'] 			= $this->model_transactiondetail->select_paramedic('transaction_id', $id);
			$data['transaction']					= $this->model_transactiondetail->select_single($id);
			$data['admin']  						= $this->model_profile->getadmin($id_admin);
			$data['company']  						= $this->model_profile->getcompany();
			
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/sidebar', $data);
			$this->load->view('admin/transactiondetail', $data);
		}

	}

?>