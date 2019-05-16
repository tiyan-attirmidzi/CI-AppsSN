<?php 

	class Profile extends CI_Controller
	{
		
		function __construct()
		{
            parent::__construct();
            $this->load->model('model_profile');
            $this->load->model('model_user');
            $this->load->model('model_district');

            if(!($this->session->userdata('user_id')))
			{
				redirect('user');
			}
        }
        
        public function index()
        {
            if(!($this->session->userdata('user_id')))
			{
				redirect('user');
			}
			else
			{
                $id = $this->session->userdata('user_id');
                
				$data['district']  	                    = $this->model_district->getdistrict();
				$data['user'] 							= $this->model_user->user_track($id);                
                $data['company']  		                = $this->model_profile->getcompany();
            
                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar_patient', $data);
                $this->load->view('patient/profile', $data);
			}
        }

        public function update()
        {
			$this->form_validation->set_rules('user_email','Email','required|valid_email', array('required' => '*) Email wajib diisi', 'valid_email' => 'Masukkan Alamat Email dengan Benar'));
			$this->form_validation->set_rules('user_name','Nama','required' , array('required' => '*) Nama wajib diisi'));
			$this->form_validation->set_rules('user_sex','Jenis Kelamin','required', array('required' => '*) Pilih salah satu'));
			$this->form_validation->set_rules('user_datebirth','Tanggal Lahir','required', array('required' => '*) Tanggal Lahir wajib diisi'));
			$this->form_validation->set_rules('user_phone','Nomor Handphone','required|numeric|max_length[12]', array('required' => '*) Nomor Handphone wajib diisi', 'numeric' => '*) Periksa kembali Nomor Handphone', 'max_length' => '*) Periksa kembali Nomor Handphone'));
			$this->form_validation->set_rules('district_id','Wilayah','required', array('required' => '*) Wilayah wajib dipilih'));
			$this->form_validation->set_rules('user_address','Alamat','required', array('required' => '*) Alamat wajib diisi'));

			$id = $this->input->post('user_id');

			if ($this->form_validation->run() === FALSE)
			{
				$id = $this->session->userdata('user_id');
				
                $data['district']  						= $this->model_district->getdistrict();
				$data['user'] 							= $this->model_user->user_track($id);                                
				$data['company']  						= $this->model_profile->getcompany();
            
                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar_patient', $data);
                $this->load->view('patient/profile', $data);
			}
			else
			{
				if($_FILES['userfile']['name']=='')
				{
					#get data
					$data['user_id']     						= $this->input->post('user_id');
					$data['user_name']     					    = $this->input->post('user_name');
					$data['user_noktp']     					= $this->input->post('user_ktp');
					$data['user_sex']     						= $this->input->post('user_sex');
					$data['user_datebirth']   					= $this->input->post('user_datebirth');
					$data['user_phone']   						= $this->input->post('user_phone');
					$data['user_email']   						= $this->input->post('user_email');
					$data['user_address'] 						= $this->input->post('user_address');
					$data['district_id']   						= $this->input->post('district_id');

					$this->model_user->edit($data);		
					
					$this->session->set_flashdata('notif_success','Perubahan Profil Berhasil!');
					redirect('patient/profile');
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
							
							#get data
							$data['user_id']     						= $this->input->post('user_id');
							$data['user_name']     					    = $this->input->post('user_name');
							$data['user_noktp']     					= $this->input->post('user_ktp');
							$data['user_sex']     						= $this->input->post('user_sex');
							$data['user_datebirth']   					= $this->input->post('user_datebirth');
							$data['user_phone']   						= $this->input->post('user_phone');
							$data['user_email']   						= $this->input->post('user_email');
							$data['user_address'] 						= $this->input->post('user_address');
							$data['user_image']                      	= $dat['file_name'];
							$data['district_id']   						= $this->input->post('district_id');

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
							
							#get data
							$data['user_id']     						= $this->input->post('user_id');
							$data['user_name']     					    = $this->input->post('user_name');
							$data['user_noktp']     					= $this->input->post('user_ktp');
							$data['user_sex']     						= $this->input->post('user_sex');
							$data['user_datebirth']   					= $this->input->post('user_datebirth');
							$data['user_phone']   						= $this->input->post('user_phone');
							$data['user_email']   						= $this->input->post('user_email');
							$data['user_address'] 						= $this->input->post('user_address');
							$data['user_image']                      	= $dat['file_name'];
							$data['district_id']   						= $this->input->post('district_id');

							$this->model_user->edit($data);	
						}
						
						$this->session->set_flashdata('notif_success','Perubahan Profil Berhasil!');
						redirect('patient/profile');
						
					}
				}
			}
        }
    }
?>