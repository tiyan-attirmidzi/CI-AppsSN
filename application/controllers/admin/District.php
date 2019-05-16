<?php  

	class District extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
			$this->load->model('model_district');
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
				$this->session->unset_userdata('sess_search_district');
      			$this->session->unset_userdata('sess_search_district2');

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
				$config["base_url"]    = base_url() . "admin/district/index/" . $limit;
				$config["total_rows"]  = $this->model_district->record_count();
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
				$page           	= ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				// $data["district"] 	= $this->model_district->fetch_district();
				$data["district"]  	= $this->model_district->fetch_district($config["per_page"], $page);
				$data["column"] 	= $this->model_district->select_column_name($this->db->database);
				$data["links"]  	= $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/district', $data);
		
			}
		}

		public function result() 
		{
    		if (!($this->session->userdata('id_admin'))) 
    		{
      			$this->load->view("login");
    		} 
    		else 
    		{
      			#Set Key Search to Session...
      			if ($this->input->post('key')) 
      			{
        			$data['cari'] = $this->input->post('key');
        			$this->session->set_userdata('sess_search_district', $data['cari']);
        			$this->session->set_userdata('sess_search_district2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_district');
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
      			$config                = array();
      			$config["base_url"]    = base_url() . "admin/district/result/" . $limit . "/" . $data['cari'];
      			$config["total_rows"]  = $this->model_district->record_count_search($data['cari'], $this->input->post('column_name'));
      			$config["per_page"]    = $limit;
      			$config["uri_segment"] = 6;
      
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
      			$data["district"]   					= $this->model_district->fetch_district_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["column"] 						= $this->model_district->select_column_name($this->db->database);
      			$data["links"]  						= $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/district', $data);
      
    		}
  		}

  		#Insert Data
  		public function input() 
  		{
    		#get data
    		$data['district_id']       			= "";
    		$data['district_name']     			= $this->input->post('district_name');
    		$data['district_desc']     			= $this->input->post('district_desc');

    		#call function input from model
			$this->model_district->input($data);
			$this->session->set_flashdata('notif_success','Wilayah Telah Di Tambahkan!');
    		#redirect to page
    		redirect('admin/district');
  		}

  		#Update Data
  		public function edit() 
  		{
    		#get data
    		$data['district_id']       			= $this->input->post('district_id');
    		$data['district_name']     			= $this->input->post('district_name');
    		$data['district_desc']     			= $this->input->post('district_desc');

    		#call function input from model
			$this->model_district->edit($data);
			$this->session->set_flashdata('notif_success','Wilayah <b>'.$data['district_name'].'</b> Berhasil Di Ubah!');
    		#redirect to page
    		redirect('admin/district');
  		}

  		 #Delete Data
 	 	public function delete() 
 	 	{
			$this->model_district->delete($this->input->post('district_id'));
			$this->session->set_flashdata('notif_success','Wilayah Berhasil Di Hapus!');		
    		redirect('admin/district');
  		}
	}



?>