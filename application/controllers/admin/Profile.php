<?php 

	class Profile extends CI_Controller
	{
		
		function __construct()
		{
            parent::__construct();
            $this->load->model('model_profile');

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
				$id = $this->session->userdata('id_admin');
                $data['admin']  		= $this->model_profile->getadmin($id);
                $data['company']  		= $this->model_profile->getcompany();
            
                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar', $data);
                $this->load->view('admin/profile', $data);
			}
        }

        public function edit_account()
        {
            $id                        = $this->input->post('id_admin');

            $this->form_validation->set_rules('name_admin','Nama','required' , array('required' => '*) Nama Tidak Boleh Kosong'));
            $this->form_validation->set_rules('username_admin','Username','required|alpha_dash', array('required' => '*) Username Tidak Boleh Kosong', 'alpha_dash' => '*) Username Tidak Boleh Menggunakan Spasi'));
            $this->form_validation->set_rules('email_admin','Email','required|valid_email', array('required' => '*) Email Tidak Boleh Kosong', 'valid_email' => '*) Masukkan Alamat Email dengan Benar'));
            $this->form_validation->set_rules('phone_admin','Nomor Handphone','required|numeric|max_length[12]', array('required' => '*) Nomor Handphone Tidak Boleh Kosong', 'numeric' => '*) Periksa kembali Nomor Handphone', 'max_length' => '*) Periksa kembali Nomor Handphone'));
            
            if ($this->form_validation->run() === FALSE)
			{
				$data['admin']  		= $this->model_profile->getadmin($id);
                $data['company']  		= $this->model_profile->getcompany();
            
                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar', $data);
                $this->load->view('admin/profile', $data);
            }
            else
            {
                if($_FILES['userfile']['name']=='')
                {
                    $data['id_admin']                        = $this->input->post('id_admin');
                    $data['name_admin']                      = $this->input->post('name_admin');
                    $data['username_admin']                  = $this->input->post('username_admin');
                    $data['email_admin']                     = $this->input->post('email_admin');
                    $data['phone_admin']                     = $this->input->post('phone_admin');

                    $this->model_profile->edit($data);	
                    
                    $this->session->set_flashdata('notif_success','Data Profil Berhasil Di Ubah !');
                    redirect('admin/profile');
                } 
                else 
                {
                    $filename                               = date('YmdHis');
                    $config['upload_path']                  = './img/admin/';
                    $config['allowed_types']                = "gif|jpg|jpeg|png";
                    $config['overwrite']                    ="true";
                    $config['max_size']                     ="20000000";
                    $config['max_width']                    ="10000";
                    $config['max_height']                   ="10000";
                    $config['file_name']                    = 'account-img-'.$filename;

                    $this->load->library('upload', $config);

                    if(!$this->upload->do_upload())
                    {
                        echo $this->upload->display_errors();
                    }
                    else 
                    {
                        $image = $this->model_profile->link_gambar_admin($id);

                        if($image->num_rows() == 0)
                        {
                            $dat = $this->upload->data();
                            
                            $data['id_admin']                        = $this->input->post('id_admin');
                            $data['name_admin']                      = $this->input->post('name_admin');
                            $data['username_admin']                  = $this->input->post('username_admin');
                            $data['email_admin']                     = $this->input->post('email_admin');
                            $data['phone_admin']                     = $this->input->post('phone_admin');
                            $data['image']                           = $dat['file_name'];

                            $this->model_profile->edit($data);
                        }
                        else
                        {
                            if ($image->num_rows() > 0)
                            {
                                $row = $image->row();			
                                $file_gambar = $row->image;
                                $path_file = './img/admin/';
                                unlink($path_file.$file_gambar);
                            }					
                        
                            $dat = $this->upload->data();
                            
                            $data['id_admin']                        = $this->input->post('id_admin');
                            $data['name_admin']                      = $this->input->post('name_admin');
                            $data['username_admin']                  = $this->input->post('username_admin');
                            $data['email_admin']                     = $this->input->post('email_admin');
                            $data['phone_admin']                     = $this->input->post('phone_admin');
                            $data['image']                           = $dat['file_name'];

                            $this->model_profile->edit($data);	
                        }	
                        
                        $this->session->set_flashdata('notif_success','Data Profil Berhasil Di Ubah !');   
                        redirect('admin/profile');
                        
                    }
                }
            }
        }

        public function change_password()
        {
            $id                        = $this->input->post('id_admin');

            $this->form_validation->set_rules('admin_passwordnew','Password','required|min_length[6]', array('required' => '*) Masukkan Password Baru', 'min_length' => '*) Password Minimal 6 Karakter'));
			$this->form_validation->set_rules('admin_passwordnew_conf','Password Lama','required|matches[admin_passwordnew]', array('required' => '*) Masukkan Konfirmasi Password Baru', 'matches' => '*) Konfirmasi Password Baru Tidak Valid'));

            if ($this->form_validation->run() === FALSE)
			{
				$data['admin']  		= $this->model_profile->getadmin($id);
                $data['company']  		= $this->model_profile->getcompany();
            
                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar', $data);
                $this->load->view('admin/profile', $data);
            }
            else
            {
                $new_password							= md5($this->input->post('admin_passwordnew'));
                $conf_new_password						= md5($this->input->post('admin_passwordnew_conf'));
                
                if($new_password == $conf_new_password)
				{
					$data['id_admin']     							= $this->input->post('id_admin');
					$data['password_admin']     					= $new_password;

                    $this->model_profile->edit($data);
                    
					$this->session->set_flashdata('notif_success','Berhasil, Password Telah Diubah');   
					redirect('admin/profile');
				}
				else
				{
					$this->session->set_flashdata('notif_danger','Gagal, Password Konfirmasi Tidak Valid');   
					redirect('admin/profile');
				}
            }
        }

        public function edit_company()
        {

            $id                        = $this->input->post('company_id');
            
            if($_FILES['userfile']['name']=='')
            {
                $data['company_id']               = $id;
                $data['company_name']             = $this->input->post('company_name');

                $this->model_profile->edit_company($data);	
                // $log['action'] = "Ubah Data Tabel Users dengan id = ".$id;
                // $this->m_log->create($log);	
                
                $this->session->set_flashdata('notif','Data Company Berhasil Di Ubah !');
                redirect('admin/profile');
            } 
            else 
            {
                $filename                               = date('YmdHis');
                $config['upload_path']                  = './img/admin/';
                $config['allowed_types']                = "gif|jpg|jpeg|png";
                $config['overwrite']                    ="true";
                $config['max_size']                     ="20000000";
                $config['max_width']                    ="10000";
                $config['max_height']                   ="10000";
                $config['file_name']                    = 'company-img-'.$filename;

                $this->load->library('upload', $config);

                if(!$this->upload->do_upload())
                {
                    echo $this->upload->display_errors();
                }
                else 
                {
                    $image = $this->model_profile->link_gambar_company($id);

                    if($image->num_rows() == 0)
                    {
                        $dat = $this->upload->data();
                        
                        $data['company_id']               = $this->input->post('company_id');
                        $data['company_name']             = $this->input->post('company_name');

                        $data['company_image']            = $dat['file_name'];

                        $this->model_profile->edit_company($data);
                    }
                    else
                    {
                        if ($image->num_rows() > 0)
                        {
                            $row = $image->row();			
                            $file_gambar = $row->image;
                            $path_file = './img/admin/';
                            unlink($path_file.$file_gambar);
                        }					
                    
                        $dat = $this->upload->data();
                        
                        $data['company_id']               = $this->input->post('company_id');
                        $data['company_name']             = $this->input->post('company_name');

                        $data['company_image']            = $dat['file_name'];

                        $this->model_profile->edit_company($data);	
                    }

                    // $log['action'] = "Ubah Data Tabel Users dengan id = ".$id;
                    // $this->m_log->create($log);	
                    
                    $this->session->set_flashdata('notif4','Data Company Berhasil Di Ubah !');                     
                    redirect('admin/profile');
                    
                }
            }
        }
    }
?>