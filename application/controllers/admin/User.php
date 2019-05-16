<?php  

	class User extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();

			$this->load->model('model_user');
			$this->load->model('model_profile');
			$this->load->model('model_district');
			$this->load->library('pagination');
			$this->load->library('excel');

			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
		}

		#Index
		public function index()
		{
			$id = $this->session->userdata('id_admin');
			if(!($id))
			{
				redirect('admin');
			}
			else
			{
				$this->session->unset_userdata('sess_search_user');
      			$this->session->unset_userdata('sess_search_user2');

      			if ($this->uri->segment(4) != "") 
      			{
			        $limit = $this->uri->segment(4);
			    } 
			    else 
			    {
					$limit = 10;
			    }
			
				#Config for pagination...
				$config                					= array();
				$config["base_url"]    					= base_url() . "admin/user/index/" . $limit;
				$config["total_rows"]  					= $this->model_user->record_count();
				$config["per_page"]    					= $limit;
				$config["uri_segment"] 					= 5;
			
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
			
				#Check Page in Segement 5...
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
				$page           						= ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				$data["links"]  						= $this->pagination->create_links();
				$data["user"]  							= $this->model_user->fetch_user($config["per_page"], $page);
				$data["column"] 						= $this->model_user->select_column_name($this->db->database);
				$data['admin']  						= $this->model_profile->getadmin($id);
				$data['company']  						= $this->model_profile->getcompany();

				#Generate Template...
				$this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar', $data);
                $this->load->view('admin/user/content', $data);
			}
		}

		#Result (Search)
		public function result() 
		{
			$id = $this->session->userdata('id_admin');
			if(!($id))
			{
				redirect('admin');
			}
    		else 
    		{
      			#Set Key Search to Session...
      			if ($this->input->post('key')) 
      			{
        			$data['cari'] = $this->input->post('key');
        			$this->session->set_userdata('sess_search_user', $data['cari']);
        			$this->session->set_userdata('sess_search_user2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_user');
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
      			$config["base_url"]    					= base_url() . "admin/user/result/" . $limit . "/" . $data['cari'];
      			$config["total_rows"]  					= $this->model_user->record_count_search($data['cari'], $this->input->post('column_name'));
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
      
      			#Generate Pagination...
      			$this->pagination->initialize($config);
      			$page           						= ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["user"]   						= $this->model_user->fetch_user_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["column"] 						= $this->model_user->select_column_name($this->db->database);
      			$data["links"]  						= $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id);
				$data['company']  						= $this->model_profile->getcompany();

				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/user/content', $data);
    		}
		}

  		#Insert Data
  		public function insert() 
  		{
			$this->form_validation->set_rules('user_name','Nama','required' , array('required' => '*) Nama wajib diisi'));
			$this->form_validation->set_rules('user_sex','Jenis Kelamin','required', array('required' => '*) Pilih salah satu'));
			$this->form_validation->set_rules('user_address','Alamat','required', array('required' => '*) Alamat wajib diisi'));
			$this->form_validation->set_rules('user_phone','Nomor Handphone','required|numeric|max_length[12]', array('required' => '*) Nomor Handphone wajib diisi', 'numeric' => '*) Periksa kembali Nomor Handphone', 'max_length' => '*) Periksa kembali Nomor Handphone'));
			$this->form_validation->set_rules('district_id','Wilayah','required', array('required' => '*) Wilayah wajib dipilih'));
			$this->form_validation->set_rules('user_email','Email','required|valid_email', array('required' => '*) Email wajib diisi', 'valid_email' => 'Masukkan Alamat Email dengan Benar'));
			$this->form_validation->set_rules('user_status','Status','required', array('required' => '*) Pilih salah satu'));
			$this->form_validation->set_rules('user_datebirth','Tanggal Lahir','required', array('required' => '*) Tanggal Lahir wajib diisi'));
			$this->form_validation->set_rules('user_password','Password','required|min_length[6]', array('required' => '*) Password wajib diisi', 'min_length' => '*) Password Minimal 6 Karakter'));
			$this->form_validation->set_rules('user_passwordconf','Password Konfirmasi','required|matches[user_password]', array('required' => '*) Password Konfirmasi wajib diisi', 'matches' => '*) Password Konfirmasi tidak valid'));
			
			if ($this->form_validation->run() === FALSE)
			{	
				$id_admin = $this->session->userdata('id_admin');

				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				$data['district']  						= $this->model_district->getdistrict();
				
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/user/insert', $data);
			} 
			else
			{
				$password						= md5($this->input->post('user_password'));
				$conf_password					= md5($this->input->post('user_passwordconf'));

				$email							= $this->model_user->email_address($this->input->post('user_email'));

				if ($email->num_rows() == 0)
				{
					if($password == $conf_password)
					{
						if($_FILES['userfile']['name']=='')
						{
							#get data
							$data['user_id']     						= "";
							$data['user_name']     						= $this->input->post('user_name');
							$data['user_sex']     						= $this->input->post('user_sex');
							$data['user_address'] 						= $this->input->post('user_address');
							$data['user_phone']   						= $this->input->post('user_phone');
							$data['district_id']   						= $this->input->post('district_id');
							$data['user_email']   						= $this->input->post('user_email');
							$data['user_password']   					= $password;
							$data['user_registerdate'] 					= date('Y-m-d H:i:s');
							$data['user_status']   						= $this->input->post('user_status');
							$data['user_datebirth']   					= $this->input->post('user_datebirth');

							$this->model_user->input($data);	
							
							// print_r($data);
							$this->session->set_flashdata('notif_success','Pengguna (User) Berhasil Di Tambahkan !');
							redirect('admin/user');
						} 
						else 
						{
							$filename                               = date('YmdHis');
							$config['upload_path']          		= './img/user/';
							$config['allowed_types']        		= 'gif|jpg|png|jpeg';
							$config['overwrite']                    ="true";
							$config['max_size']                     ="20000000";
							$config['max_width']                    ="10000";
							$config['max_height']                   ="10000";
							$config['file_name']                    = 'user-img-'.$filename;

							$this->load->library('upload', $config);

							if(!$this->upload->do_upload())
							{
								echo $this->upload->display_errors();
							}
							else 
							{
								$dat = $this->upload->data();
									
								$data['user_id']     						= "";
								$data['user_name']     						= $this->input->post('user_name');
								$data['user_sex']     						= $this->input->post('user_sex');
								$data['user_address'] 						= $this->input->post('user_address');
								$data['user_phone']   						= $this->input->post('user_phone');
								$data['district_id']   						= $this->input->post('district_id');
								$data['user_email']   						= $this->input->post('user_email');
								$data['user_password']   					= $password;
								$data['user_registerdate'] 					= date('Y-m-d H:i:s');
								$data['user_status']   						= $this->input->post('user_status');
								$data['user_datebirth']   					= $this->input->post('user_datebirth');
								$data['user_image']                      	= $dat['file_name'];

								$this->model_user->input($data);
								
								$this->session->set_flashdata('notif_success','Pengguna (User) Berhasil Di Tambahkan !');   
								redirect('admin/user');
								
							}
						}
					}
					else
					{
						$this->session->set_flashdata('notif_danger','User Gagal Di Tambahkan, Password Konfirmasi Tidak Valid !');   
						redirect('admin/user/insert');
					}
				}
				else
				{
					$this->session->set_flashdata('notif_danger','Mohon Maaf, Email Sudah Digunakan !');   
					redirect('admin/user/insert');
				}
			}	
		}

		#View Update
		public function update_view()
		{
			$id = base64_decode($this->input->get('user_id'));
			
			$this->data['keys'] =  $this->model_user->get_edit($id);
			if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
			{
				redirect('admin/user');
			} 
			else 
			{
				$id_admin = $this->session->userdata('id_admin');
	
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data["keys"] 							= $this->model_user->get_edit($id);
				$data['company']  						= $this->model_profile->getcompany();
				$data['district']  						= $this->model_district->getdistrict();
				
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/user/update', $data);
			}
		}
		  
		#Update Data
		public function update()
		{
			$this->form_validation->set_rules('user_name','Nama','required' , array('required' => '*) Nama wajib diisi'));
			$this->form_validation->set_rules('user_sex','Jenis Kelamin','required', array('required' => '*) Pilih salah satu'));
			$this->form_validation->set_rules('user_datebirth','Tanggal Lahir','required', array('required' => '*) Tanggal Lahir wajib diisi'));
			$this->form_validation->set_rules('user_phone','Nomor Handphone','required|numeric|exact_length[12]', array('required' => '*) Nomor Handphone wajib diisi', 'numeric' => '*) Periksa kembali Nomor Handphone', 'max_length' => '*) Periksa kembali Nomor Handphone'));
			$this->form_validation->set_rules('district_id','Wilayah','required', array('required' => '*) Wilayah wajib dipilih'));
			$this->form_validation->set_rules('user_address','Alamat','required', array('required' => '*) Alamat wajib diisi'));
			$this->form_validation->set_rules('user_status','Status','required', array('required' => '*) Pilih salah satu'));
			$this->form_validation->set_rules('user_email','Email','required|valid_email', array('required' => '*) Email wajib diisi', 'valid_email' => 'Masukkan Alamat Email dengan Benar'));

			$id = $this->input->post('user_id');

			if ($this->form_validation->run() === FALSE)
			{
				$this->data['keys'] =  $this->model_user->get_edit($this->input->post('user_id'));
				if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
				{
					redirect('admin/user');
				} 
				else 
				{
					$id_admin = $this->session->userdata('id_admin');
	
					$data['admin']  						= $this->model_profile->getadmin($id_admin);
					$data["keys"] 							= $this->model_user->get_edit($this->input->post('user_id'));
					$data['company']  						= $this->model_profile->getcompany();
					$data['district']  						= $this->model_district->getdistrict();
					
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/user/update', $data);
				}
			}
			else
			{
				if($_FILES['userfile']['name']=='')
				{
					#get data
					$data['user_id']     						= $this->input->post('user_id');
					$data['user_name']     						= $this->input->post('user_name');
					$data['user_sex']     						= $this->input->post('user_sex');
					$data['user_address'] 						= $this->input->post('user_address');
					$data['user_phone']   						= $this->input->post('user_phone');
					$data['district_id']   						= $this->input->post('district_id');
					$data['user_email']   						= $this->input->post('user_email');
					$data['user_status']   						= $this->input->post('user_status');
					$data['user_datebirth']   					= $this->input->post('user_datebirth');

					$this->model_user->edit($data);		
					
					$this->session->set_flashdata('notif_success','Data User <b>'.$data['user_name'].'</b> Berhasil Di Ubah!');
					redirect('admin/user');
				} 
				else 
				{
					$filename                               = date('YmdHis');
					$config['upload_path']          		= './img/user/';
					$config['allowed_types']        		= 'gif|jpg|png|jpeg';
					$config['overwrite']                    ="true";
					$config['max_size']                     ="20000000";
					$config['max_width']                    ="10000";
					$config['max_height']                   ="10000";
					$config['file_name']                    = 'user-img-'.$filename;

					$this->load->library('upload', $config);

					if(!$this->upload->do_upload())
					{
						echo $this->upload->display_errors();
					}
					else 
					{
						$image = $this->model_user->link_gambar($id);

						if($image->num_rows() == 0)
						{
							$dat = $this->upload->data();
							
							$data['user_id']     						= $this->input->post('user_id');
							$data['user_name']     						= $this->input->post('user_name');
							$data['user_sex']     						= $this->input->post('user_sex');
							$data['user_address'] 						= $this->input->post('user_address');
							$data['user_phone']   						= $this->input->post('user_phone');
							$data['district_id']   						= $this->input->post('district_id');
							$data['user_email']   						= $this->input->post('user_email');
							$data['user_status']   						= $this->input->post('user_status');
							$data['user_datebirth']   					= $this->input->post('user_datebirth');
							$data['user_image']                      	= $dat['file_name'];

							$this->model_user->edit($data);
						}
						else
						{
							if ($image->num_rows() > 0)
							{
								$row = $image->row();			
								$file_gambar = $row->user_image;
								$path_file = './img/user/';
								unlink($path_file.$file_gambar);
							}					
							
							$dat = $this->upload->data();
							
							$data['user_id']     						= $this->input->post('user_id');
							$data['user_name']     						= $this->input->post('user_name');
							$data['user_sex']     						= $this->input->post('user_sex');
							$data['user_address'] 						= $this->input->post('user_address');
							$data['user_phone']   						= $this->input->post('user_phone');
							$data['district_id']   						= $this->input->post('district_id');
							$data['user_email']   						= $this->input->post('user_email');
							$data['user_status']   						= $this->input->post('user_status');
							$data['user_datebirth']   					= $this->input->post('user_datebirth');
							$data['user_image']                      	= $dat['file_name'];

							$this->model_user->edit($data);	
						}
						
						$this->session->set_flashdata('notif_success','Data User <b>'.$data['user_name'].'</b> Berhasil Di Ubah!'); 
						redirect('admin/user');
						
					}
				}
			}
		}

		#Change Password
		public function change_password()
		{
			$this->form_validation->set_rules('user_passwordnew','Password','required|min_length[6]', array('required' => '*) Masukkan Password Baru', 'min_length' => '*) Password Minimal 6 Karakter'));
			$this->form_validation->set_rules('user_passwordnew_conf','Password Lama','required|matches[user_passwordnew]', array('required' => '*) Masukkan Konfirmasi Password Baru', 'matches' => '*) Konfirmasi Password Baru Tidak Valid'));

			if ($this->form_validation->run() === FALSE)
			{
				$this->data['keys'] =  $this->model_user->get_edit($this->input->post('user_id'));
				if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
				{
					redirect('admin/user');
				} 
				else 
				{
					$id_admin = $this->session->userdata('id_admin');
	
					$data['admin']  						= $this->model_profile->getadmin($id_admin);
					$data["keys"] 							= $this->model_user->get_edit($this->input->post('user_id'));
					$data['company']  						= $this->model_profile->getcompany();
					$data['district']  						= $this->model_district->getdistrict();
					
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/user/update', $data);
				}
			}
			else
			{
				$new_password							= md5($this->input->post('user_passwordnew'));
				$conf_new_password						= md5($this->input->post('user_passwordnew_conf'));

				if($new_password == $conf_new_password)
				{
					$data['user_id']     						= $this->input->post('user_id');
					$data['user_name']     						= $this->input->post('user_name');
					$data['user_password']     					= $new_password;

					$this->model_user->edit($data);
				
					$this->session->set_flashdata('notif_success','Password User Atas Nama <b>'.$data['user_name'].'</b> Berhasil Di Ubah');   
					redirect('admin/user');
				}
				else
				{
					$this->session->set_flashdata('notif_danger','Password User Atas Nama <b>'.$data['user_name'].'</b> Gagal Di Ubah, Password Konfirmasi Tidak Valid!');   
					redirect('admin/user');
				}
				
			}
		} 
  		
		#Delete Data
 	 	public function delete() 
 	 	{
			$image = $this->model_user->link_gambar($this->input->post('user_id'));
			if ($image->num_rows() > 0)
			{
				$row = $image->row();			
				$file_gambar = $row->user_image;
				$path_file = './img/user/';
				unlink($path_file.$file_gambar);
			}	
			$this->model_user->delete($this->input->post('user_id'));
			$this->session->set_flashdata('notif_success','Data User <b>'.$this->input->post('user_name').'</b> Telah Di Hapus!');
    		redirect('admin/user');
  		}

  		#Export Data With Excel
  		public function export() 
  		{
    		$data = $this->model_user->export();
    		#load PHPExcel library
    		$this->excel->setActiveSheetIndex(0);
    		#name the worksheet
    		$this->excel->getActiveSheet()->setTitle('Data User SN Health Care');
    
    		#STYLING
    		$styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '0000'))));
    
    		#set report header
    		$this->excel->getActiveSheet()->getStyle('A:I')->getFont()->setName('Times New Roman');
    		$this->excel->getActiveSheet()->mergeCells('A1:J1');
    		$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR USER APLIKASI SN HEALTH CARE');
    		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
    
    
    		//set column name
    		$this->excel->getActiveSheet()->setCellValue('A2', 'No');
    		$this->excel->getActiveSheet()->setCellValue('B2', 'Nama');
    		$this->excel->getActiveSheet()->setCellValue('C2', 'Jenis Kelamin');
    		$this->excel->getActiveSheet()->setCellValue('D2', 'Tanggal Lahir');
    		$this->excel->getActiveSheet()->setCellValue('E2', 'Email');
    		$this->excel->getActiveSheet()->setCellValue('F2', 'Password');
    		$this->excel->getActiveSheet()->setCellValue('G2', 'Nomor Handphone');
    		$this->excel->getActiveSheet()->setCellValue('H2', 'Wilayah');
    		$this->excel->getActiveSheet()->setCellValue('I2', 'Alamat');
    		$this->excel->getActiveSheet()->setCellValue('J2', 'Tanggal & Waktu Registrasi');
    
			  $this->excel->getActiveSheet()->getStyle('A2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
			  $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
			  $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			  $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			  $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			  $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			  $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
			  $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			  $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
			  $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
			  $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
    
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
      			$this->excel->getActiveSheet()->setCellValue('B' . $no, $v->user_name);

      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('C' . $no, $v->user_sex);

      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('D' . $no, $v->user_datebirth);
				  
      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('E' . $no, $v->user_email);
				  
      			$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('F' . $no, $v->user_password);

      			$this->excel->getActiveSheet()->getStyle('G' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('G' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('G' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('G' . $no, $v->user_phone);
				  
      			$this->excel->getActiveSheet()->getStyle('H' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('H' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('H' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('H' . $no, $v->district_name);
				  
      			$this->excel->getActiveSheet()->getStyle('I' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('I' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('I' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('I' . $no, $v->user_address);
				  
				$this->excel->getActiveSheet()->getStyle('J' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('J' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('J' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('J' . $no, $v->user_registerdate);
				
				$no++;
      			$nomor++;
    		}
    
    		$this->excel->getActiveSheet()->getStyle('A2:J' . ($no - 1))->applyFromArray($styleArray);
    		ob_end_clean();
    		$filename = 'Daftar User Aplikasi SN Health Care.xls'; //save our workbook as this file name
    		header('Content-Type: application/vnd.ms-excel'); //mime type
    		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
    		header('Cache-Control: max-age=0'); //no cache
    		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    		$objWriter->save('php://output');
   
    		redirect('admin/user');
  		}

	}



?>