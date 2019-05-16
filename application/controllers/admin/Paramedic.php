<?php  

	class Paramedic extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
			$this->load->model('model_paramedic');
			$this->load->model('model_profile');
			$this->load->model('model_district');
			$this->load->model('model_paramediccategory');
			$this->load->library('pagination');
			$this->load->library('excel');
			
			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
		}

		#Insert
		public function index()
		{
			$id = $this->session->userdata('id_admin');
			if(!($id))
			{
				redirect('admin');
			}
			else
			{
				$this->session->unset_userdata('sess_search_paramedic');
      			$this->session->unset_userdata('sess_search_paramedic2');

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
				$config["base_url"]    = base_url() . "admin/paramedic/index/" . $limit;
				$config["total_rows"]  = $this->model_paramedic->record_count();
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
				
				#Generate Pagination...
				$this->pagination->initialize($config);
				$page           				= ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				$data["links"]  				= $this->pagination->create_links();
				$data["paramedic"]  			= $this->model_paramedic->fetch_paramedic($config["per_page"], $page);
				$data["column"] 				= $this->model_paramedic->select_column_name($this->db->database);
				$data['admin']  				= $this->model_profile->getadmin($id);
				$data['company']  				= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar', $data);
                $this->load->view('admin/paramedic/content', $data);
			}
		}

		#Result (Search)
		public function result() 
		{
			$id = $this->session->userdata('id_admin');
    		if (!($id)) 
    		{
				redirect('admin');
    		} 
    		else 
    		{
      			#Set Key Search to Session...
      			if ($this->input->post('key')) 
      			{
        			$data['cari'] = $this->input->post('key');
        			$this->session->set_userdata('sess_search_paramedic', $data['cari']);
        			$this->session->set_userdata('sess_search_paramedic2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_paramedic');
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
      			$config                				= array();
      			$config["base_url"]    				= base_url() . "admin/paramedic/result/" . $limit . "/" . $data['cari'];
      			$config["total_rows"]  				= $this->model_paramedic->record_count_search($data['cari'], $this->input->post('column_name'));
      			$config["per_page"]    				= $limit;
      			$config["uri_segment"] 				= 6;
      
      			#Config css for pagination...
      			$config['full_tag_open']   			= '<ul class="pagination">';
      			$config['full_tag_close']  			= '</ul>';
      			$config['first_link']      			= "First";
      			$config['last_link']       			= "Last";
      			$config['first_tag_open']  			= '<li>';
      			$config['first_tag_close'] 			= '</li>';
      			$config['prev_link']       			= '&laquo';
      			$config['prev_tag_open']   			= '<li class="prev">';
      			$config['prev_tag_close']  			= '</li>';
      			$config['next_link']       			= '&raquo';
      			$config['next_tag_open']   			= '<li>';
      			$config['next_tag_close']  			= '</li>';
      			$config['last_tag_open']   			= '<li>';
      			$config['last_tag_close']  			= '</li>';
      			$config['cur_tag_open']    			= '<li class="active"><a href="#">';
      			$config['cur_tag_close']   			= '</a></li>';
      			$config['num_tag_open']    			= '<li>';
      			$config['num_tag_close']   			= '</li>';
      
      			#Check Page in Segement 3...
      			if ($this->uri->segment(6) == "") 
      			{
        			$data['number'] = 0;
      			} 
      			else 
      			{
        			$data['number'] = $this->uri->segment(6);
      			}

      			#Generate Pagination...
      			$this->pagination->initialize($config);
      			$page           				= ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
      			$data["paramedic"]  			= $this->model_paramedic->fetch_paramedic_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
				$data["column"] 				= $this->model_paramedic->select_column_name($this->db->database);
				$data["links"]  				= $this->pagination->create_links();
				$data['admin']  				= $this->model_profile->getadmin($id);
                $data['company']  				= $this->model_profile->getcompany();
			
      			#Generate Template...
      			$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/paramedic/content', $data);
      
    		}
		}
		  
		#Insert Data
  		public function insert() 
  		{
			$this->form_validation->set_rules('paramedic_name','Nama','required' , array('required' => '*) Nama wajib diisi'));
			$this->form_validation->set_rules('paramedic_ktp','Nomor KTP','required|max_length[16]|numeric' , array('required' => '*) Nomor KTP wajib diisi', 'max_length' => '*)Periksan kembali Nomor KTP', 'numeric' => '*) Periksa kembali Nomor KTP'));
			$this->form_validation->set_rules('paramedic_sex','Jenis Kelamin','required', array('required' => '*) Pilih salah satu'));
			$this->form_validation->set_rules('paramedic_address','Alamat','required', array('required' => '*) Alamat wajib diisi'));
			$this->form_validation->set_rules('paramedic_phone','Nomor Handphone','required|numeric|max_length[12]', array('required' => '*) Nomor Handphone wajib diisi', 'numeric' => '*) Periksa kembali Nomor Handphone', 'max_length' => '*) Periksa kembali Nomor Handphone'));
			$this->form_validation->set_rules('paramedic_religion','Agama','required', array('required' => '*) Agama wajib dipilih'));
			$this->form_validation->set_rules('paramedic_lasteducation','Pendidikan Terakhir','required', array('required' => '*) Pendidikan Terakhir wajib dipilih'));
			$this->form_validation->set_rules('paramediccategory_id','Profesi','required', array('required' => '*) Profesi wajib dipilih'));
			$this->form_validation->set_rules('district_id','Wilayah','required', array('required' => '*) Wilayah wajib dipilih'));
			$this->form_validation->set_rules('paramedic_email','Email','required|valid_email', array('required' => '*) Email wajib diisi', 'valid_email' => 'Masukkan Alamat Email dengan Benar'));
			$this->form_validation->set_rules('paramedic_status','Status','required', array('required' => '*) Pilih salah satu'));
			$this->form_validation->set_rules('paramedic_datebirth','Tanggal Lahir','required', array('required' => '*) Tanggal Lahir wajib diisi'));
			$this->form_validation->set_rules('paramedic_password','Password','required|min_length[6]', array('required' => '*) Password wajib diisi', 'min_length' => '*) Password Minimal 6 Karakter'));
			$this->form_validation->set_rules('paramedic_passwordconf','Password Konfirmasi','required|matches[paramedic_password]', array('required' => '*) Password Konfirmasi wajib diisi', 'matches' => '*) Password Konfirmasi tidak valid'));
			
			if ($this->form_validation->run() === FALSE)
			{	
				$id_admin = $this->session->userdata('id_admin');

				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				$data['district']  						= $this->model_district->getdistrict();
				$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
				
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/paramedic/insert', $data);
			} 
			else
			{
				$password						= md5($this->input->post('paramedic_password'));
				$conf_password					= md5($this->input->post('paramedic_passwordconf'));

				$email							= $this->model_paramedic->email_address($this->input->post('paramedic_email'));

				if ($email->num_rows() == 0)
				{

					$filename                               = date('YmdHis');
					$config['upload_path']          		= './img/paramedic/';
					$config['allowed_types']        		= '*';
					$config['overwrite']                    ="true";
					$config['max_size']                     ="20000000";
					$config['max_width']                    ="10000";
					$config['max_height']                   ="10000";
					$config['file_name']                    = $this->input->post('paramedic_name').'-paramedic-'.$filename;

					$this->load->library('upload', $config);

					// <!--------------------------------------------------- Data Kompetensi ----------------------------------------------------------------------->

					if($_FILES['paramedic_btcls']['name'])
					{
						if($this->upload->do_upload('paramedic_btcls'))
						{
							$paramedic_btcls = $this->upload->data();
							$data['paramedic_btcls'] = $paramedic_btcls['file_name'];
						}
					}
					
					if($_FILES['paramedic_wc']['name'])
					{
						if($this->upload->do_upload('paramedic_wc'))
						{
							$paramedic_wc = $this->upload->data();
							$data['paramedic_wc'] = $paramedic_wc['file_name'];
						}
					}

					if($_FILES['paramedic_hn']['name'])
					{
						if($this->upload->do_upload('paramedic_hn'))
						{
							$paramedic_hn = $this->upload->data();
							$data['paramedic_hn'] = $paramedic_hn['file_name'];
						}
					}

					if($_FILES['paramedic_sm']['name'])
					{
						if($this->upload->do_upload('paramedic_sm'))
						{
							$paramedic_sm = $this->upload->data();
							$data['paramedic_sm'] = $paramedic_sm['file_name'];
						}
					}

					if($_FILES['paramedic_dk']['name'])
					{
						if($this->upload->do_upload('paramedic_dk'))
						{
							$paramedic_dk = $this->upload->data();
							$data['paramedic_dk'] = $paramedic_dk['file_name'];
						}
					}

					if($_FILES['paramedic_nc']['name'])
					{
						if($this->upload->do_upload('paramedic_nc'))
						{
							$paramedic_nc = $this->upload->data();
							$data['paramedic_nc'] = $paramedic_nc['file_name'];
						}
					}

					if($_FILES['paramedic_g']['name'])
					{
						if($this->upload->do_upload('paramedic_g'))
						{
							$paramedic_g = $this->upload->data();
							$data['paramedic_g'] = $paramedic_g['file_name'];
						}
					}

					if($_FILES['paramedic_ppgd']['name'])
					{
						if($this->upload->do_upload('paramedic_ppgd'))
						{
							$paramedic_ppgd = $this->upload->data();
							$data['paramedic_ppgd']	= $paramedic_ppgd['file_name'];
						}
					}

					if($_FILES['paramedic_icu']['name'])
					{
						if($this->upload->do_upload('paramedic_icu'))
						{
							$paramedic_icu = $this->upload->data();
							$data['paramedic_icu'] = $paramedic_icu['file_name'];
						}
					}

					if($_FILES['paramedic_nicu']['name'])
					{
						if($this->upload->do_upload('paramedic_nicu'))
						{
							$paramedic_nicu = $this->upload->data();
							$data['paramedic_nicu']	= $paramedic_nicu['file_name'];
						}
					}

					// <!--------------------------------------------------- Pemberkasan ----------------------------------------------------------------------->

					if($_FILES['paramedic_it']['name'])
					{
						if($this->upload->do_upload('paramedic_it'))
						{
							$paramedic_it = $this->upload->data();
							$data['paramedic_it'] = $paramedic_it['file_name'];
						}
					}

					if($_FILES['paramedic_fcktp']['name'])
					{
						if($this->upload->do_upload('paramedic_fcktp'))
						{
							$paramedic_fcktp = $this->upload->data();
							$data['paramedic_fcktp'] = $paramedic_fcktp['file_name'];
						}
					}

					if($_FILES['paramedic_str']['name'])
					{
						if($this->upload->do_upload('paramedic_str'))
						{
							$paramedic_str = $this->upload->data(); 
							$data['paramedic_str'] = $paramedic_str['file_name'];
						}
					}

					if($_FILES['paramedic_skbs']['name'])
					{
						if($this->upload->do_upload('paramedic_skbs'))
						{
							$paramedic_skbs = $this->upload->data();
							$data['paramedic_skbs'] = $paramedic_skbs['file_name'];
						}
					}

					if($_FILES['paramedic_kta']['name'])
					{
						if($this->upload->do_upload('paramedic_kta'))
						{
							$paramedic_kta = $this->upload->data();
							$data['paramedic_kta'] = $paramedic_kta['file_name'];
						}
					}

					if($_FILES['paramedic_rp']['name'])
					{
						if($this->upload->do_upload('paramedic_rp'))
						{
							$paramedic_rp = $this->upload->data();
							$data['paramedic_rp'] = $paramedic_rp['file_name'];
						}
					}

					//<!------------------------------------------------------ Data Dasar ------------------------------------------------------- -->

					if($_FILES['userfile']['name'])
					{
						if($this->upload->do_upload('userfile'))
						{
							$dat = $this->upload->data();
							$data['paramedic_image'] = $dat['file_name'];
						}
					}
					
					$data['paramedic_id']     						= "";
					$data['paramedic_noregis']						= "reg-paramedic-".date('YmdHis').rand(100000,999999);
					$data['paramedic_noktp']						= $this->input->post('paramedic_ktp');
					$data['paramedic_name']     					= $this->input->post('paramedic_name');
					$data['paramedic_sex']     						= $this->input->post('paramedic_sex');
					$data['paramedic_address'] 						= $this->input->post('paramedic_address');
					$data['paramedic_phone']   						= $this->input->post('paramedic_phone');
					$data['district_id']   							= $this->input->post('district_id');
					$data['paramedic_religion']						= $this->input->post('paramedic_religion');
					$data['paramediccategory_id']   				= $this->input->post('paramediccategory_id');
					$data['paramedic_lasteducation']				= $this->input->post('paramedic_lasteducation');
					$data['paramedic_email']   						= $this->input->post('paramedic_email');
					$data['paramedic_password']   					= $password;
					$data['paramedic_registerdate'] 				= date('Y-m-d H:i:s');
					$data['paramedic_status']   					= $this->input->post('paramedic_status');
					$data['paramedic_datebirth']   					= $this->input->post('paramedic_datebirth');

					$this->model_paramedic->input($data);	
					
					// print_r($data);
					$this->session->set_flashdata('notif_success','Tenaga Kesehatan Berhasil Di Tambahkan !');
					redirect('admin/paramedic');
					
				}
				else
				{
					$this->session->set_flashdata('notif_danger','Mohon Maaf, Email Sudah Digunakan !');   
					redirect('admin/paramedic/insert');
				}
			}	
		}

		#View Update
		public function update_view()
		{
			$id = base64_decode($this->input->get('paramedic_id'));
			
			$this->data['keys'] =  $this->model_paramedic->get_edit($id);
			if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
			{
				redirect('admin/paramedic');
			} 
			else 
			{
				$id_admin = $this->session->userdata('id_admin');
	
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data["keys"] 							= $this->model_paramedic->get_edit($id);
				$data['company']  						= $this->model_profile->getcompany();
				$data['district']  						= $this->model_district->getdistrict();
				$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
				$data['religion']						= array('Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu');
				$data['last_education']					= array('SMA', 'D3', 'D4', 'S1', 'S2', 'S3');
				
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/paramedic/update', $data);
			}
		}

		#Update Data
		public function update()
		{
			$this->form_validation->set_rules('paramedic_name','Nama','required' , array('required' => '*) Nama wajib diisi'));
			$this->form_validation->set_rules('paramedic_ktp','Nomor KTP','required|max_length[16]|numeric' , array('required' => '*) Nomor KTP wajib diisi', 'max_length' => '*)Periksan kembali Nomor KTP', 'numeric' => '*) Periksa kembali Nomor KTP'));
			$this->form_validation->set_rules('paramedic_sex','Jenis Kelamin','required', array('required' => '*) Pilih salah satu'));
			$this->form_validation->set_rules('paramedic_datebirth','Tanggal Lahir','required', array('required' => '*) Tanggal Lahir wajib diisi'));
			$this->form_validation->set_rules('paramedic_phone','Nomor Handphone','required|numeric|max_length[12]', array('required' => '*) Nomor Handphone wajib diisi', 'numeric' => '*) Periksa kembali Nomor Handphone', 'max_length' => '*) Periksa kembali Nomor Handphone'));
			$this->form_validation->set_rules('paramedic_religion','Agama','required', array('required' => '*) Agama wajib dipilih'));
			$this->form_validation->set_rules('paramedic_lasteducation','Pendidikan Terakhir','required', array('required' => '*) Pendidikan Terakhir wajib dipilih'));
			$this->form_validation->set_rules('paramediccategory_id','Profesi','required', array('required' => '*) Profesi wajib dipilih'));
			$this->form_validation->set_rules('paramedic_status','Status','required', array('required' => '*) Pilih salah satu'));
			$this->form_validation->set_rules('paramedic_email','Email','required|valid_email', array('required' => '*) Email wajib diisi', 'valid_email' => 'Masukkan Alamat Email dengan Benar'));
			$this->form_validation->set_rules('district_id','Wilayah','required', array('required' => '*) Wilayah wajib dipilih'));
			$this->form_validation->set_rules('paramedic_address','Alamat','required', array('required' => '*) Alamat wajib diisi'));

			$id = $this->input->post('paramedic_id');

			if ($this->form_validation->run() === FALSE)
			{
				$this->data['keys'] =  $this->model_paramedic->get_edit($this->input->post('paramedic_id'));
				if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
				{
					redirect('admin/paramedic');
				} 
				else 
				{
					$id_admin = $this->session->userdata('id_admin');
	
					$data['admin']  						= $this->model_profile->getadmin($id_admin);
					$data["keys"] 							= $this->model_paramedic->get_edit($this->input->post('paramedic_id'));
					$data['company']  						= $this->model_profile->getcompany();
					$data['district']  						= $this->model_district->getdistrict();
					$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
					$data['religion']						= array('Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu');
					$data['last_education']					= array('SMA', 'D3', 'D4', 'S1', 'S2', 'S3');
					
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/paramedic/update', $data);
				}
			}
			else
			{
				if($_FILES['userfile']['name']=='')
				{
					#get data
					$data['paramedic_id']     						= $this->input->post('paramedic_id');
					$data['paramedic_name']     					= $this->input->post('paramedic_name');
					$data['paramedic_noktp']     					= $this->input->post('paramedic_ktp');
					$data['paramedic_sex']     						= $this->input->post('paramedic_sex');
					$data['paramedic_datebirth']   					= $this->input->post('paramedic_datebirth');
					$data['paramedic_phone']   						= $this->input->post('paramedic_phone');
					$data['paramedic_religion']   					= $this->input->post('paramedic_religion');
					$data['paramedic_lasteducation']   				= $this->input->post('paramedic_lasteducation');
					$data['paramediccategory_id']   				= $this->input->post('paramediccategory_id');
					$data['paramedic_status']   					= $this->input->post('paramedic_status');
					$data['paramedic_email']   						= $this->input->post('paramedic_email');
					$data['district_id']   							= $this->input->post('district_id');
					$data['paramedic_address'] 						= $this->input->post('paramedic_address');

					$this->model_paramedic->edit($data);		
					
					$this->session->set_flashdata('notif_success','Data Tenaga Kesehatan <b>'.$data['paramedic_name'].'</b> Berhasil Di Ubah!');
					redirect('admin/paramedic');
				} 
				else 
				{
					$filename                               = date('YmdHis');
					$config['upload_path']          		= './img/paramedic/';
					$config['allowed_types']        		= 'gif|jpg|png|jpeg';
					$config['overwrite']                    ="true";
					$config['max_size']                     ="20000000";
					$config['max_width']                    ="10000";
					$config['max_height']                   ="10000";
					$config['file_name']                    = 'paramedic-img-'.$filename;

					$this->load->library('upload', $config);

					if(!$this->upload->do_upload())
					{
						echo $this->upload->display_errors();
					}
					else 
					{
						$image = $this->model_paramedic->link_gambar($id);

						if($image->num_rows() == 0)
						{
							$dat = $this->upload->data();
							
							#get data
							$data['paramedic_id']     						= $this->input->post('paramedic_id');
							$data['paramedic_name']     					= $this->input->post('paramedic_name');
							$data['paramedic_noktp']     					= $this->input->post('paramedic_ktp');
							$data['paramedic_sex']     						= $this->input->post('paramedic_sex');
							$data['paramedic_datebirth']   					= $this->input->post('paramedic_datebirth');
							$data['paramedic_phone']   						= $this->input->post('paramedic_phone');
							$data['paramedic_religion']   					= $this->input->post('paramedic_religion');
							$data['paramedic_lasteducation']   				= $this->input->post('paramedic_lasteducation');
							$data['paramediccategory_id']   				= $this->input->post('paramediccategory_id');
							$data['paramedic_status']   					= $this->input->post('paramedic_status');
							$data['paramedic_email']   						= $this->input->post('paramedic_email');
							$data['district_id']   							= $this->input->post('district_id');
							$data['paramedic_address'] 						= $this->input->post('paramedic_address');
							$data['paramedic_image']                      	= $dat['file_name'];

							$this->model_paramedic->edit($data);
						}
						else
						{
							if ($image->num_rows() > 0)
							{
								$row = $image->row();			
								$file_gambar = $row->paramedic_image;
								$path_file = './img/paramedic/';
								unlink($path_file.$file_gambar);
							}					
							
							$dat = $this->upload->data();
							
							#get data
							$data['paramedic_id']     						= $this->input->post('paramedic_id');
							$data['paramedic_name']     					= $this->input->post('paramedic_name');
							$data['paramedic_noktp']     					= $this->input->post('paramedic_ktp');
							$data['paramedic_sex']     						= $this->input->post('paramedic_sex');
							$data['paramedic_datebirth']   					= $this->input->post('paramedic_datebirth');
							$data['paramedic_phone']   						= $this->input->post('paramedic_phone');
							$data['paramedic_religion']   					= $this->input->post('paramedic_religion');
							$data['paramedic_lasteducation']   				= $this->input->post('paramedic_lasteducation');
							$data['paramediccategory_id']   				= $this->input->post('paramediccategory_id');
							$data['paramedic_status']   					= $this->input->post('paramedic_status');
							$data['paramedic_email']   						= $this->input->post('paramedic_email');
							$data['district_id']   							= $this->input->post('district_id');
							$data['paramedic_address'] 						= $this->input->post('paramedic_address');
							$data['paramedic_image']                      	= $dat['file_name'];

							$this->model_paramedic->edit($data);	
						}
						
						$this->session->set_flashdata('notif_success','Data Tenaga Kesehatan <b>'.$data['paramedic_name'].'</b> Berhasil Di Ubah!'); 
						redirect('admin/paramedic');
						
					}
				}
			}
		}

		#Change Password
		public function change_password()
		{
			$this->form_validation->set_rules('paramedic_passwordnew','Password','required|min_length[6]', array('required' => '*) Masukkan Password Baru', 'min_length' => '*) Password Minimal 6 Karakter'));
			$this->form_validation->set_rules('paramedic_passwordnew_conf','Password Lama','required|matches[paramedic_passwordnew]', array('required' => '*) Masukkan Konfirmasi Password Baru', 'matches' => '*) Konfirmasi Password Baru Tidak Valid'));

			if ($this->form_validation->run() === FALSE)
			{
				$this->data['keys'] =  $this->model_paramedic->get_edit($this->input->post('paramedic_id'));
				if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
				{
					redirect('admin/paramedic');
				} 
				else 
				{
					$id_admin = $this->session->userdata('id_admin');
	
					$data['admin']  						= $this->model_profile->getadmin($id_admin);
					$data["keys"] 							= $this->model_paramedic->get_edit($this->input->post('paramedic_id'));
					$data['company']  						= $this->model_profile->getcompany();
					$data['district']  						= $this->model_district->getdistrict();
					$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
					$data['religion']						= array('Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu');
					$data['last_education']					= array('SMA', 'D3', 'D4', 'S1', 'S2', 'S3');
					
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/paramedic/update', $data);
				}
			}
			else
			{
				$new_password							= md5($this->input->post('paramedic_passwordnew'));
				$conf_new_password						= md5($this->input->post('paramedic_passwordnew_conf'));

				if($new_password == $conf_new_password)
				{
					$data['paramedic_id']     							= $this->input->post('paramedic_id');
					$data['paramedic_name']     						= $this->input->post('paramedic_name');
					$data['paramedic_password']     					= $new_password;

					$this->model_paramedic->edit($data);
				
					$this->session->set_flashdata('notif_success','Password Tenaga Kesehatan Atas Nama <b>'.$data['paramedic_name'].'</b> Berhasil Di Ubah');   
					redirect('admin/paramedic');
				}
				else
				{
					$this->session->set_flashdata('notif_danger','Password Tenaga Kesehatan Atas Nama <b>'.$data['paramedic_name'].'</b> Gagal Di Ubah, Password Konfirmasi Tidak Valid!');   
					redirect('admin/paramedic');
				}
				
			}
		} 

  		#Delete Data
 	 	public function delete() 
 	 	{
			$image = $this->model_paramedic->link_gambar($this->input->post('paramedic_id'));
			if ($image->num_rows() > 0)
			{
				$row = $image->row();			
				$file_gambar = $row->paramedic_image;
				$path_file = './img/paramedic/';
				unlink($path_file.$file_gambar);
			}	
			$this->model_paramedic->delete($this->input->post('paramedic_id'));
			$this->session->set_flashdata('notif_success','Data Tenaga Kesehatan <b>'.$this->input->post('paramedic_name').'</b> Telah Di Hapus!');			
    		redirect('admin/paramedic');
  		}

  		#Export Data
  		public function export() 
  		{
    		$data = $this->model_paramedic->export();
    		#load PHPExcel library
    		$this->excel->setActiveSheetIndex(0);
    		#name the worksheet
    		$this->excel->getActiveSheet()->setTitle('Data NaKes SN Health Center');
    
    		#STYLING
    		$styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '0000'))));
    
    		#set report header
    		$this->excel->getActiveSheet()->getStyle('A:K')->getFont()->setName('Times New Roman');
    		$this->excel->getActiveSheet()->mergeCells('A1:K1');
    		$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR TENAGA KESEHATAN APLIKASI SN HEALTH CENTER');
    		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
    
    
    		//set column name
    		$this->excel->getActiveSheet()->setCellValue('A2', 'No');
    		$this->excel->getActiveSheet()->setCellValue('B2', 'Nama');
    		$this->excel->getActiveSheet()->setCellValue('C2', 'Jenis Kelamin');
    		$this->excel->getActiveSheet()->setCellValue('D2', 'Tanggal Lahir');
    		$this->excel->getActiveSheet()->setCellValue('E2', 'Profesi');
    		$this->excel->getActiveSheet()->setCellValue('F2', 'Email');
    		$this->excel->getActiveSheet()->setCellValue('G2', 'Password');
    		$this->excel->getActiveSheet()->setCellValue('H2', 'Nomor Handphone');
    		$this->excel->getActiveSheet()->setCellValue('I2', 'Wilayah');
    		$this->excel->getActiveSheet()->setCellValue('J2', 'Alamat');
    		$this->excel->getActiveSheet()->setCellValue('K2', 'Tanggal & Waktu Registrasi');
    
			$this->excel->getActiveSheet()->getStyle('A2:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
    
    		$no    = 3;
    		$nomor = 1;
    		foreach ($data as $v) 
    		{
      			$this->excel->getActiveSheet()->getStyle('A' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('A' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('A' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('A' . $no, $nomor);

      			$this->excel->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('B' . $no, $v->paramedic_name);

      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('C' . $no, $v->paramedic_sex);

      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('D' . $no, $v->paramedic_datebirth);

      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('E' . $no, $v->paramediccategory_name);
				
				$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('F' . $no, $v->paramedic_email);

				$this->excel->getActiveSheet()->getStyle('G' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('G' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('G' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('G' . $no, $v->paramedic_password);
				
				$this->excel->getActiveSheet()->getStyle('H' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('H' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('H' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('H' . $no, $v->paramedic_phone);

				$this->excel->getActiveSheet()->getStyle('I' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('I' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('I' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('I' . $no, $v->district_name);

				$this->excel->getActiveSheet()->getStyle('J' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('J' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('J' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('J' . $no, $v->paramedic_address);

				$this->excel->getActiveSheet()->getStyle('K' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('K' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('K' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('K' . $no, $v->paramedic_registerdate);

      			$no++;
      			$nomor++;
    		}
    
    		$this->excel->getActiveSheet()->getStyle('A2:K' . ($no - 1))->applyFromArray($styleArray);
    		ob_end_clean();
    		$filename = 'Daftar NaKes Aplikasi SN Health Center.xls'; //save our workbook as this file name
    		header('Content-Type: application/vnd.ms-excel'); //mime type
    		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
    		header('Cache-Control: max-age=0'); //no cache
    		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    		$objWriter->save('php://output');
   
    		redirect('admin/paramedic');
  		}

	}


?>