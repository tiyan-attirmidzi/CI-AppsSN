<?php  

	class Registration_patient extends CI_Controller
	{
		function __construct()
		{
            parent::__construct();
            $this->load->model('model_service');
            $this->load->model('model_district');
            $this->load->model('model_user');
            $this->load->model('model_profile');
        }

        public function index()
        {
            $data["service"]				= $this->model_service->get_service();
			$data["district"] 				= $this->model_district->getdistrict();
			$data['company']  				= $this->model_profile->getcompany();
			
			$this->load->view('regis_patient', $data);
        }

        public function reg_newpatient()
		{
            $password						= md5($this->input->post('patient_password'));
			$conf_password					= md5($this->input->post('conf_patient_password'));

			$email							= $this->model_user->email_address($this->input->post('patient_email'));

			if ($email->num_rows() == 0)
			{
				if($password == $conf_password)
				{
					if($_FILES['userfile']['name']=='')
					{
						#get data
						$data['user_id']     						= "";
						$data['user_name']     						= $this->input->post('patient_name');
						$data['user_sex']     						= $this->input->post('patient_sex');
						$data['user_address'] 						= $this->input->post('patient_address');
						$data['user_phone']   						= $this->input->post('patient_phone');
						$data['district_id']   						= $this->input->post('district_id');
						$data['user_email']   						= $this->input->post('patient_email');
						$data['user_password']   					= $password;
						$data['user_registerdate'] 					= date('Y-m-d H:i:s');
						$data['user_status']   						= "0";
						$data['user_datebirth']   					= $this->input->post('patient_datebirth');

                        $this->model_user->input($data);	

                        $this->session->set_flashdata('notif_regpatient','Terima Kasih, Anda Telah Berhasil Melakukan Registrasi Silahkan Menunggu Konfirmasi!');   
                        redirect('registration_patient');                            
                        
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
							$data['user_name']     						= $this->input->post('patient_name');
							$data['user_sex']     						= $this->input->post('patient_sex');
							$data['user_address'] 						= $this->input->post('patient_address');
							$data['user_phone']   						= $this->input->post('patient_phone');
							$data['district_id']   						= $this->input->post('district_id');
							$data['user_email']   						= $this->input->post('patient_email');
							$data['user_password']   					= $password;
							$data['user_registerdate'] 					= date('Y-m-d H:i:s');
							$data['user_status']   						= "0";
							$data['user_datebirth']   					= $this->input->post('patient_datebirth');
							$data['user_image']                      	= $dat['file_name'];

                            $this->model_user->input($data);
                            
                            $this->session->set_flashdata('notif_regpatient','Terima Kasih, Anda Telah Berhasil Melakukan Registrasi Silahkan Menunggu Konfirmasi!');   
                            redirect('registration_patient');                            
							
						}
					}
				}
				else
				{
                    $this->session->set_flashdata('notif_regpatient1','Mohon Maaf, Password Konfirmasi Tidak Valid!');   
                    redirect('registration_patient'); 
				}
			}
			else
			{
                $this->session->set_flashdata('notif_regpatient1','Mohon Maaf, Email Sudah Terdaftar!');   
                redirect('registration_patient'); 
			}	
		}
    }
?>