<?php 

	class Profile extends CI_Controller
	{
		
		function __construct()
		{
            parent::__construct();
            $this->load->model('model_profile');
            $this->load->model('model_paramedic');
            $this->load->model('model_paramediccategory');
            $this->load->model('model_district');

            if(!($this->session->userdata('paramedic_id')))
			{
				redirect('paramedic');
			}
        }
        
        public function index()
        {
            if(!($this->session->userdata('paramedic_id')))
			{
				redirect('paramedic');
			}
			else
			{
				$id = $this->session->userdata('paramedic_id');
				
				$data['district']  						= $this->model_district->getdistrict();
				$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
                $data['paramedic']  					= $this->model_profile->getparamedic($id);
				$data['company']  						= $this->model_profile->getcompany();
				$data['religion']						= array('Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu');
				$data['last_education']					= array('SMA', 'D3', 'D4', 'S1', 'S2', 'S3');
            
                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar_paramedic', $data);
                $this->load->view('paramedic/profile', $data);
			}
        }

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
			$this->form_validation->set_rules('district_id','Wilayah','required', array('required' => '*) Wilayah wajib dipilih'));
			$this->form_validation->set_rules('paramedic_address','Alamat','required', array('required' => '*) Alamat wajib diisi'));

			$id = $this->input->post('paramedic_id');

			if ($this->form_validation->run() === FALSE)
			{
				$id = $this->session->userdata('paramedic_id');
				
				$data['district']  						= $this->model_district->getdistrict();
				$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
                $data['paramedic']  					= $this->model_profile->getparamedic($id);
				$data['company']  						= $this->model_profile->getcompany();
				$data['religion']						= array('Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu');
				$data['last_education']					= array('SMA', 'D3', 'D4', 'S1', 'S2', 'S3');
            
                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar_paramedic', $data);
                $this->load->view('paramedic/profile', $data);
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
					$data['district_id']   							= $this->input->post('district_id');
					$data['paramedic_address'] 						= $this->input->post('paramedic_address');

					$this->model_paramedic->edit($data);		
					
					$this->session->set_flashdata('notif_success','Perubahan Profil Berhasil!');
					redirect('paramedic/profile');
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
							$data['paramedic_status']   					= $this->input->post('paramedic_status');
							$data['district_id']   							= $this->input->post('district_id');
							$data['paramedic_address'] 						= $this->input->post('paramedic_address');
							$data['paramedic_image']                      	= $dat['file_name'];

							$this->model_paramedic->edit($data);	
						}
						
						$this->session->set_flashdata('notif_success','Perubahan Profil Berhasil!');
						redirect('paramedic/profile');
						
					}
				}
			}
		}
		
		public function change_status()
		{
			if(!($this->session->userdata('paramedic_id')))
			{
				redirect('paramedic');
			}
			else
			{
				if($this->input->post('paramedic_online') == 1)
				{
					$data['paramedic_id']										= $this->input->post('paramedic_id');
					$data['paramedic_online']									= $this->input->post('paramedic_online');

					$this->model_paramedic->edit($data);

					$this->session->set_flashdata('notif_success','Status Anda Telah Diubah, Sekarang Anda Dapat Menerima Pesanan!');
				}
				if($this->input->post('paramedic_online') == 0)
				{
					$data['paramedic_id']										= $this->input->post('paramedic_id');
					$data['paramedic_online']									= $this->input->post('paramedic_online');

					$this->model_paramedic->edit($data);

					$this->session->set_flashdata('notif_success','Status Anda Telah Diubah, Sekarang Anda Tidak Dapat Menerima Pesanan!');					
				}
				
				redirect('paramedic/profile');
			}
		}

		public function change_email()
		{
			$this->form_validation->set_rules('paramedic_email','Email','required|valid_email', array('required' => '*) Email wajib diisi', 'valid_email' => 'Masukkan Alamat Email dengan Benar'));

			if ($this->form_validation->run() === FALSE)
			{
				$id = $this->session->userdata('paramedic_id');
				
				$data['district']  						= $this->model_district->getdistrict();
				$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
                $data['paramedic']  					= $this->model_profile->getparamedic($id);
				$data['company']  						= $this->model_profile->getcompany();
				$data['religion']						= array('Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu');
				$data['last_education']					= array('SMA', 'D3', 'D4', 'S1', 'S2', 'S3');
            
                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar_paramedic', $data);
                $this->load->view('paramedic/profile', $data);
			}
			else
			{
				$email							= $this->model_paramedic->email_address($this->input->post('paramedic_email'));

				if ($email->num_rows() == 0)
				{
					$data['paramedic_id']										= $this->input->post('paramedic_id');
					$data['paramedic_email']									= $this->input->post('paramedic_email');

					$this->model_paramedic->edit($data);

					$this->session->set_flashdata('notif_success','Berhasil, Email Anda Telah Diubah!');
					redirect('paramedic/profile');
				}
				else
				{
					$this->session->set_flashdata('notif_success','Gagal, Email Tidak Dapat Diubah Email Telah Digunakan!');
					redirect('paramedic/profile');
				}
			}
		}

		public function change_password()
		{
			$this->form_validation->set_rules('paramedic_passwordnew','Password','required|min_length[6]', array('required' => '*) Masukkan Password Baru', 'min_length' => '*) Password Minimal 6 Karakter'));
			$this->form_validation->set_rules('paramedic_passwordnew_conf','Password Lama','required|matches[paramedic_passwordnew]', array('required' => '*) Masukkan Konfirmasi Password Baru', 'matches' => '*) Konfirmasi Password Baru Tidak Valid'));

			if ($this->form_validation->run() === FALSE)
			{
				
				$id = $this->session->userdata('paramedic_id');
				
				$data['district']  						= $this->model_district->getdistrict();
				$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
                $data['paramedic']  					= $this->model_profile->getparamedic($id);
				$data['company']  						= $this->model_profile->getcompany();
				$data['religion']						= array('Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu');
				$data['last_education']					= array('SMA', 'D3', 'D4', 'S1', 'S2', 'S3');
            
                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar_paramedic', $data);
                $this->load->view('paramedic/profile', $data);
			}
			else
			{
				$new_password							= md5($this->input->post('paramedic_passwordnew'));
				$conf_new_password						= md5($this->input->post('paramedic_passwordnew_conf'));

				if($new_password == $conf_new_password)
				{
					$data['paramedic_id']     							= $this->input->post('paramedic_id');
					$data['paramedic_password']     					= $new_password;

					$this->model_paramedic->edit($data);
				
					$this->session->set_flashdata('notif_success','Berhasil, Password Anda Telah Diubah');   
					redirect('paramedic/profile');
				}
				else
				{
					$this->session->set_flashdata('notif_danger','Gagal, Password Konfirmasi Tidak Valid');   
					redirect('paramedic/profile');
				}
				
			}
		} 
	}	
?>