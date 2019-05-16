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
	      	$config["base_url"]    = base_url() . "admin/transaction/index/" . $limit;
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
          	$data["transaction"]        	  		= $this->model_transaction->fetch_transaction($config["per_page"], $page);
          	$data["column"]             	  		= $this->model_transaction->select_column_name($this->db->database);
          	$data["package"]             	  		= $this->model_transaction->fetch_package();
          	$data["patient"]             	  		= $this->model_transaction->fetch_patient();
          	$data["links"]              	  		= $this->pagination->create_links();
			$data['admin']  						= $this->model_profile->getadmin($id_admin);
			$data['company']  						= $this->model_profile->getcompany();
				
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/sidebar', $data);
			$this->load->view('admin/transaction', $data);
		
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
        			$this->session->set_userdata('sess_search_patient', $data['cari']);
        			$this->session->set_userdata('sess_search_patient2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_patient');
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
      			$config["base_url"]    					= base_url() . "admin/patient/result/" . $limit . "/" . $data['cari'];
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
				$data["transaction"]   					= $this->model_transaction->fetch_transaction_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
				$data["column"] 						= $this->model_transaction->select_column_name($this->db->database);
				$data["package"]             	  		= $this->model_transaction->fetch_package();				
				$data["patient"] 						= $this->model_transaction->fetch_patient($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["links"]  						= $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				  
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/transaction', $data);
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

				$data3['package_id']					= $this->input->post('package_id')[$i];
				
				$get_packageparamediccategory			= $this->model_transaction->get_packageparamediccategory($data3['package_id']);
				$packageparamediccategory				= $get_packageparamediccategory[0]->paramediccategory_id;
				$get_paramedic 							= $this->model_transaction->get_paramedic($packageparamediccategory);

				$data3['packageteam_id']				= "packteam".date('YmdHis').rand(100000,999999);
				$data3['paramedic_id']					= $get_paramedic[0]->paramedic_id;
				$data3['transactiondetail_id']			= $data['transactiondetail_id'];

				$this->model_transaction->input($data);
				$this->model_transaction->input3($data3);
			}
			
			$data2['patient_id'] 						= $this->input->post('patient_id');
			$data2['transaction_arrangementdate'] 		= $this->input->post('transaction_arrangementdate');
			$data2['transaction_total'] 				= $pricetotalall;
			$data2['transaction_note'] 					= $this->input->post('transaction_note');
			$data2['transaction_status'] 				= "1";
			
			$this->model_transaction->input2($data2);
			
			// $get_districtpatient						= $this->model_transaction->get_districtpatient($data2['patient_id']);
			// $district_patient							= $get_districtpatient[0]->district_id;
			// $get_districtparamedic						= $this->model_transaction->get_districtparamedic($district_patient);
			// $data3['paramedic_id']						= $get_districtparamedic[0]->paramedic_id;

			#redirect to page
    		redirect('admin/transaction');
		}
		  
		#Delete Data
		public function delete() 
		{	
			$id = $this->input->post('transaction_id');
			$this->model_transaction->delete($id);
			$this->model_transactiondetail->delete($id);
			redirect('admin/transaction');
		}

	}

?>