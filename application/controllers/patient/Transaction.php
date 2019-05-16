<?php  

	class Transaction extends CI_Controller
	{
		
		function __construct()
		{
			error_reporting(0);
			parent::__construct();
			$this->load->model('model_transaction');
			$this->load->model('model_transactiondetail');
			$this->load->model('model_profile');
			$this->load->model('model_user');
			$this->load->model('model_patient');
			$this->load->library('pagination');

			//if(!($this->session->userdata('patient_id')))
			if(!($this->session->userdata('user_id')))
			{
				redirect('patient');
			}
		}

		public function index()
		{
			//if(!($this->session->userdata('patient_id')))
			if(!($this->session->userdata('user_id')))
			{
				$this->load->view('patient/login');
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
				#Config for pagination...
				$config                = array();
				$config["base_url"]    = base_url() . "patient/transaction/index/" . $limit;
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
				
				//$p_id = $this->session->userdata('patient_id');
				$p_id = $this->session->userdata('user_id');
				
				#Generate Pagination...
				$this->pagination->initialize($config);
				$page           				  = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				//$data["transaction"]        	  = $this->model_transaction->fetch_transaction_perpatient($p_id);
				$data["transaction"]        	  = $this->model_transaction->fetch_transaction_byUser($p_id);
				$data["column"]             	  = $this->model_transaction->select_column_name($this->db->database);
				$data["package"]             	  = $this->model_transaction->fetch_package();
				$data["links"]              	  = $this->pagination->create_links();
				//$data['patient'] 				  			= $this->model_patient->patient_track($p_id);
				$data['company']  				  		= $this->model_profile->getcompany();
				$data['user'] 							= $this->model_user->user_track($p_id);
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar_patient', $data);
				$this->load->view('patient/transaction', $data);
			}
		
		}

		public function input() 
		{
			$data2['transaction_id']					= "trx".date('YmdHis').rand(100000,999999);
			$data2['transaction_code']					= "trxcd".date('YmdHis').rand(100000,999999);
			$pricetotalall = 0;
			$a = count($this->input->post('package_id'));
			for ($i=0; $i < $a; $i++) 
			{ 
				$data['transactiondetail_id']			= "trxdtl".date('YmdHis').rand(100000,999999);
				$data['package_id']         	    	= $this->input->post('package_id')[$i];
				$data['package_amount']					= $this->input->post('qty')[$i];

				$get									= $this->model_transaction->getdata($data['package_id']);

				$data['transaction_id']					= $data2['transaction_id'];
				$data['package_pricetotal']				= $get[0]->package_price * $data['package_amount'];

				$pricetotalall							= $pricetotalall + $data['package_pricetotal'];

				$data['transactiondetail_status']		= "1";
				$data['transactiondetail_rate']			= "";
				$data['transactiondetail_review']		= "";

				$this->model_transaction->input($data);
				
				$package								= $this->model_transaction->getpackage($data['package_id']);
				$count									= $package->num_rows();
				
				for($j=0; $j < $count; $j++)
				{
					$get_packageparamediccategory			= $this->model_transaction->get_packageparamediccategory($data['package_id']);
					$packageparamediccategory				= $get_packageparamediccategory[$j]->paramediccategory_id;
					
					$data3['package_id']					= $data['package_id'];
					$data3['packageteam_id']				= "";
					$data3['paramediccategory_id']			= $packageparamediccategory;
					$data3['paramedic_id']					= "";
					$data3['transactiondetail_id']			= $data['transactiondetail_id'];
					
					$this->model_transaction->input3($data3);
					// print_r($data3);
					
				}
				// print_r($data);
			}
			
			$data2['patient_id'] 						= $this->input->post('patient_id');
			$data2['transaction_arrangementdate'] 		= $this->input->post('transaction_arrangementdate');
			$data2['transaction_total'] 				= $pricetotalall;
			$data2['transaction_date']					= date('Y-m-d H:i:s');
			$data2['transaction_note'] 					= $this->input->post('transaction_note');
			$data2['transaction_status'] 				= "1";
			
			$this->model_transaction->input2($data2);
    		redirect('patient/transaction');
		  }
		  
		public function detail_view()
		{
			$id = $this->input->get('transaction_id');

			$this->data['key'] =  $this->model_transaction->check_transaction($id);
			if(!isset($this->data['key'][0]) || $this->data['key'][0] == "")
			{
				redirect('patient/transaction');
			} 

			$p_id = $this->session->userdata('patient_id');

			$data['transactiondetail'] 				= $this->model_transactiondetail->select_all2('transaction_id', $id);
			$data['transactiondetail2'] 			= $this->model_transactiondetail->select_paramedic('transaction_id', $id);
			$data['transaction']					= $this->model_transactiondetail->select_single($id);
			$data['patient'] 				  		= $this->model_patient->patient_track($p_id);			
			$data['company']  						= $this->model_profile->getcompany();
			
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/sidebar_patient', $data);
			$this->load->view('patient/transactiondetail', $data);
		}

	}

?>