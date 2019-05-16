<?php  

	class Order extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			error_reporting(0);
			$this->load->model('model_service');
            $this->load->model('model_profile');
            $this->load->model('model_district');
            $this->load->model('model_patient');
            $this->load->model('model_paramedic');
            $this->load->model('model_package');
            $this->load->model('model_user');
			$this->load->model('model_transaction');
			if(!($this->session->userdata('user_id')))
			{
				redirect('patient');
			}
		}

		public function index()
		{
			$id = $this->session->userdata('user_id');
			if(!($this->session->userdata('user_id')))
			{
				redirect('patient');
			}
			else
			{
				$data['user'] 							= $this->model_user->user_track($id);
                $data['service']                        = $this->model_service->get_service_order();
                $data['company']  						= $this->model_profile->getcompany();

                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar_patient', $data);
                $this->load->view('patient/order/content', $data);
			}
		}

		public function contract()
        {
            $service_id = base64_decode($this->input->get('service_id'));

            $this->data['keys'] =  $this->model_service->get_edit($service_id);
			if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
			{
				redirect('patient/order');
			} 
			else 
			{
                $user_id = $this->session->userdata('user_id');

                $get_service                            = $this->model_service->get_edit($service_id);
                $data['service']                        = $get_service;
                $data['paramedic']                      = $this->model_paramedic->list_paramedic($get_service[0]['paramediccategory_id']);
				$data['user'] 							= $this->model_user->user_track($user_id);
                $data['company']  						= $this->model_profile->getcompany();
                $data['healthyfood']  					= $this->model_package->get_package($service_id);
    
                #Generate Template...
                $this->load->view('tamplate/header', $data);
                $this->load->view('tamplate/topbar', $data);
                $this->load->view('tamplate/sidebar_patient', $data);
                $this->load->view('patient/order/contract', $data); 
			}           
		}
		
         #Persetujuan
		public function approval()
		{
            if ($this->input->post('service_id') == 9) 
            {
                
                $patient_ktp            = $this->model_patient->check($this->input->post('patient_noktp'));

                if ($patient_ktp->num_rows() == 0)
				{
                    $this->form_validation->set_rules('patient_noktp','Nomor KTP','required|exact_length[16]|numeric' , array('required' => '*) Nomor KTP wajib diisi', 'exact_length' => '*)Periksa kembali Nomor KTP', 'numeric' => '*) Periksa kembali Nomor KTP'));
                    $this->form_validation->set_rules('patient_name','Nama','required' , array('required' => '*) Nama wajib diisi'));
                    $this->form_validation->set_rules('patient_datebirth','Tanggal Lahir','required', array('required' => '*) Tanggal Lahir wajib diisi'));
                    $this->form_validation->set_rules('patient_sex','Jenis Kelamin','required', array('required' => '*) Pilih salah satu'));
			        $this->form_validation->set_rules('patient_religion','Agama','required', array('required' => '*) Agama wajib dipilih'));
			        $this->form_validation->set_rules('patient_job','Pekerjaan','required', array('required' => '*) Pekerjaan wajib diisi'));
                    $this->form_validation->set_rules('patient_phone','Nomor Handphone','required|numeric|max_length[12]', array('required' => '*) Nomor Handphone wajib diisi', 'numeric' => '*) Periksa kembali Nomor Handphone', 'max_length' => '*) Periksa kembali Nomor Handphone'));
                    $this->form_validation->set_rules('patient_address','Alamat','required', array('required' => '*) Alamat wajib diisi'));
                    $this->form_validation->set_rules('transaction_arrangementdate','Tanggal Perjanjian','required', array('required' => '*) Masukkan Tanggal Awal Perawatan'));
                    $this->form_validation->set_rules('transaction_note','Pesan Untuk Pasien','required', array('required' => '*) Masukkan Pesan'));
                    $this->form_validation->set_rules('transactiondetail_locationvisit','Alamat Perawatan','required', array('required' => '*) Masukkan Alamat Perawatan'));

                    $service_id = $this->input->post('service_id');

                    if ($this->form_validation->run() === FALSE)
                    {
                        $this->data['keys'] =  $this->model_service->get_edit($this->input->post('service_id'));
                        if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
                        {
                            redirect('patient/order');
                        } 
                        else 
                        {
                            $id = $this->session->userdata('user_id');

                            $get_service                            = $this->model_service->get_edit($service_id);
                            $data['service']                        = $get_service;
                            $data['paramedic']                      = $this->model_paramedic->list_paramedic($get_service[0]['paramediccategory_id']);
                            $data['user'] 							= $this->model_user->user_track($id);
                            $data['company']  						= $this->model_profile->getcompany();
                
                            #Generate Template...
                            $this->load->view('tamplate/header', $data);
                            $this->load->view('tamplate/topbar', $data);
                            $this->load->view('tamplate/sidebar_patient', $data);
                            $this->load->view('patient/order/contract', $data); 
                        }
                    }
                    else
                    {            
                        $data['patient_id']     						= "";
                        $data['patient_noregis']     					= "reg-patient-".date('YmdHis').rand(100000,999999);
                        $data['patient_noktp']     						= $this->input->post('patient_noktp');
                        $data['patient_registerdate'] 				    = date('Y-m-d H:i:s');
                        $data['patient_name']     						= $this->input->post('patient_name');
                        $data['patient_datebirth']   					= $this->input->post('patient_datebirth');
                        $data['patient_sex']     						= $this->input->post('patient_sex');
                        $data['patient_religion']     					= $this->input->post('patient_religion');
                        $data['patient_job']     					    = $this->input->post('patient_job');
                        $data['patient_phone']   						= $this->input->post('patient_phone');
                        $data['patient_address'] 						= $this->input->post('patient_address');

                        $this->model_patient->input($data);
                    
                        $patient           = $this->model_patient->get_patient($this->input->post('patient_noktp'));
                    
                        $data2['transaction_id']					= "trx".date('YmdHis').rand(100000,999999);
                        $data2['transaction_code']					= "trxcd".date('YmdHis').rand(100000,999999);
                        $data2['patient_id'] 						= $patient[0]->patient_id;
                        $data2['transaction_arrangementdate'] 		= $this->input->post('transaction_arrangementdate');
                        $data2['transaction_date'] 				    = date('Y-m-d H:i:s');
                        $data2['transaction_note'] 					= $this->input->post('transaction_note');
                        $data2['transaction_status'] 				= 1;
                        $data2['user_id']                           = $this->input->post('user_id');
    
                        $data4['transaction_id']					    = $data2['transaction_id'];
                        $data4['transactiondetail_id']			        = "trxdtl".date('YmdHis').rand(100000,999999);
                        $data4['package_id']							= $this->input->post('package_id');
                        $data4['package_amount']						= $this->input->post('package_price');
                        $data4['package_pricetotal']					= $this->input->post('package_price');
                        $data4['transactiondetail_status']		        = 1;
                        $data4['transactiondetail_rate']			    = "";
                        $data4['transactiondetail_review']		        = "";
                        $data4['transactiondetail_locationvisit']	    = $this->input->post('transactiondetail_locationvisit'); 
                        $data4['transactiondetail_visitdate']    	    = $data2['transaction_arrangementdate']; 
    
                        
                        $data3['packageteam_id']				    = "";
                        $data3['service_id']					    = $this->input->post('service_id'); 
                        $data3['package_id']					    = $this->input->post('package_id'); 
                        $data3['paramediccategory_id']			    = $this->input->post('paramediccategory_id');
                        $data3['transactiondetail_id']			    = $data4['transactiondetail_id'];
                        $data3['packageteam_status']			    = 0;
                        if($this->input->post('paramedic_id'))
                        {
                            $data3['paramedic_id']					= $this->input->post('paramedic_id');
                        }
                        else
                        {
                            $paramedic_random                       = $this->model_paramedic->random_paramedic($this->input->post('paramediccategory_id'));
                            $data3['paramedic_id']					= $paramedic_random[0]->paramedic_id; 
                        }
    
                        $this->model_transaction->input2($data2);
                        $this->model_transaction->input($data4);
                        $this->model_transaction->input3($data3);
    
                        
                        $this->session->set_flashdata('notif_success','Pemesanan Telah Berhasil, Silahkan Tunggu Konfirmasi Dari Tenaga Kesehatan');
                        redirect('patient/order');
                    }
                }
                else
                {
                    $this->form_validation->set_rules('transaction_arrangementdate','Tanggal Perjanjian','required', array('required' => '*) Masukkan Tanggal Awal Perawatan'));
                    $this->form_validation->set_rules('transaction_note','Pesan Untuk Pasien','required', array('required' => '*) Masukkan Pesan'));
                    $this->form_validation->set_rules('transactiondetail_locationvisit','Alamat Perawatan','required', array('required' => '*) Masukkan Alamat Perawatan'));

                    $service_id = $this->input->post('service_id');

                    if ($this->form_validation->run() === FALSE)
                    {
                        $this->data['keys'] =  $this->model_service->get_edit($this->input->post('service_id'));
                        if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
                        {
                            redirect('patient/order');
                        } 
                        else 
                        {
                            $id = $this->session->userdata('user_id');

                            $get_service                            = $this->model_service->get_edit($service_id);
                            $data['service']                        = $get_service;
                            $data['paramedic']                      = $this->model_paramedic->list_paramedic($get_service[0]['paramediccategory_id']);
                            $data['user'] 							= $this->model_user->user_track($id);
                            $data['company']  						= $this->model_profile->getcompany();
                
                            #Generate Template...
                            $this->load->view('tamplate/header', $data);
                            $this->load->view('tamplate/topbar', $data);
                            $this->load->view('tamplate/sidebar_patient', $data);
                            $this->load->view('patient/order/contract', $data); 
                        }
                    }
                    else
                    {
                        $patient                                    = $this->model_patient->get_patient($this->input->post('patient_noktp'));

                        $data2['transaction_id']					= "trx".date('YmdHis').rand(100000,999999);
                        $data2['transaction_code']					= "trxcd".date('YmdHis').rand(100000,999999);
                        $data2['patient_id'] 						= $patient[0]->patient_id;
                        $data2['transaction_arrangementdate'] 		= $this->input->post('transaction_arrangementdate');
                        $data2['transaction_date'] 				    = date('Y-m-d H:i:s');
                        $data2['transaction_note'] 					= $this->input->post('transaction_note');
                        $data2['transaction_status'] 				= 1;
                        $data2['user_id']                           = $this->input->post('user_id');

                        $data['transaction_id']					    = $data2['transaction_id'];
                        $data['transactiondetail_id']			    = "trxdtl".date('YmdHis').rand(100000,999999);
                        $data['package_id']							= $this->input->post('package_id');
                        $data['package_amount']						= $this->input->post('package_price');
                        $data['package_pricetotal']					= $this->input->post('package_price');
                        $data['transactiondetail_status']		    = 1;
                        $data['transactiondetail_rate']			    = "";
                        $data['transactiondetail_review']		    = "";
                        $data['transactiondetail_locationvisit']	= $this->input->post('transactiondetail_locationvisit'); 
                        $data['transactiondetail_visitdate']    	= $data2['transaction_arrangementdate']; 

                        
                        $data3['packageteam_id']				    = "";
                        $data3['service_id']					    = $this->input->post('service_id'); 
                        $data3['package_id']					    = $this->input->post('package_id'); 
                        $data3['paramediccategory_id']			    = $this->input->post('paramediccategory_id');
                        $data3['transactiondetail_id']			    = $data['transactiondetail_id'];
                        $data3['packageteam_status']			    = 0;
                        if($this->input->post('paramedic_id'))
                        {
                            $data3['paramedic_id']					= $this->input->post('paramedic_id');
                        }
                        else
                        {
                            $paramedic_random                       = $this->model_paramedic->random_paramedic($this->input->post('paramediccategory_id'));
                            $data3['paramedic_id']					= $paramedic_random[0]->paramedic_id; 
                        }

                        $this->model_transaction->input2($data2);
                        $this->model_transaction->input($data);
                        $this->model_transaction->input3($data3);

                        
                        $this->session->set_flashdata('notif_success','Pemesanan Telah Berhasil, Silahkan Tunggu Konfirmasi Dari Tenaga Kesehatan');
                        redirect('patient/order');
                    }
                }
            }

            if ($this->input->post('service_id') == 19) 
            {
                
                $patient_ktp            = $this->model_patient->check($this->input->post('patient_noktp'));

                if ($patient_ktp->num_rows() == 0)
				{
                    $this->form_validation->set_rules('patient_noktp','Nomor KTP','required|exact_length[16]|numeric' , array('required' => '*) Nomor KTP wajib diisi', 'exact_length' => '*)Periksa kembali Nomor KTP', 'numeric' => '*) Periksa kembali Nomor KTP'));
                    $this->form_validation->set_rules('patient_name','Nama','required' , array('required' => '*) Nama wajib diisi'));
                    $this->form_validation->set_rules('patient_datebirth','Tanggal Lahir','required', array('required' => '*) Tanggal Lahir wajib diisi'));
                    $this->form_validation->set_rules('patient_sex','Jenis Kelamin','required', array('required' => '*) Pilih salah satu'));
			        $this->form_validation->set_rules('patient_religion','Agama','required', array('required' => '*) Agama wajib dipilih'));
			        $this->form_validation->set_rules('patient_job','Pekerjaan','required', array('required' => '*) Pekerjaan wajib diisi'));
                    $this->form_validation->set_rules('patient_phone','Nomor Handphone','required|numeric|max_length[12]', array('required' => '*) Nomor Handphone wajib diisi', 'numeric' => '*) Periksa kembali Nomor Handphone', 'max_length' => '*) Periksa kembali Nomor Handphone'));
                    $this->form_validation->set_rules('patient_address','Alamat','required', array('required' => '*) Alamat wajib diisi'));
                    $this->form_validation->set_rules('transaction_arrangementdate','Tanggal Perjanjian','required', array('required' => '*) Masukkan Tanggal Awal Perawatan'));
                    $this->form_validation->set_rules('transaction_note','Pesan Untuk Pasien','required', array('required' => '*) Masukkan Pesan'));
                    $this->form_validation->set_rules('transactiondetail_locationvisit','Alamat Perawatan','required', array('required' => '*) Masukkan Alamat Perawatan'));

                    $service_id = $this->input->post('service_id');

                    if ($this->form_validation->run() === FALSE)
                    {
                        $this->data['keys'] =  $this->model_service->get_edit($this->input->post('service_id'));
                        if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
                        {
                            redirect('patient/order');
                        } 
                        else 
                        {
                            $id = $this->session->userdata('user_id');

                            $get_service                            = $this->model_service->get_edit($service_id);
                            $data['service']                        = $get_service;
                            $data['paramedic']                      = $this->model_paramedic->list_paramedic($get_service[0]['paramediccategory_id']);
                            $data['user'] 							= $this->model_user->user_track($id);
                            $data['company']  						= $this->model_profile->getcompany();
                
                            #Generate Template...
                            $this->load->view('tamplate/header', $data);
                            $this->load->view('tamplate/topbar', $data);
                            $this->load->view('tamplate/sidebar_patient', $data);
                            $this->load->view('patient/order/contract', $data); 
                        }
                    }
                    else
                    {            
                        $data['patient_id']     						= "";
                        $data['patient_noregis']     					= "reg-patient-".date('YmdHis').rand(100000,999999);
                        $data['patient_noktp']     						= $this->input->post('patient_noktp');
                        $data['patient_registerdate'] 				    = date('Y-m-d H:i:s');
                        $data['patient_name']     						= $this->input->post('patient_name');
                        $data['patient_datebirth']   					= $this->input->post('patient_datebirth');
                        $data['patient_sex']     						= $this->input->post('patient_sex');
                        $data['patient_religion']     					= $this->input->post('patient_religion');
                        $data['patient_job']     					    = $this->input->post('patient_job');
                        $data['patient_phone']   						= $this->input->post('patient_phone');
                        $data['patient_address'] 						= $this->input->post('patient_address');

                        $this->model_patient->input($data);
                    
                        $patient           = $this->model_patient->get_patient($this->input->post('patient_noktp'));
                    
                        $data2['transaction_id']					= "trx".date('YmdHis').rand(100000,999999);
                        $data2['transaction_code']					= "trxcd".date('YmdHis').rand(100000,999999);
                        $data2['patient_id'] 						= $patient[0]->patient_id;
                        $data2['transaction_arrangementdate'] 		= $this->input->post('transaction_arrangementdate');
                        $data2['transaction_date'] 				    = date('Y-m-d H:i:s');
                        $data2['transaction_note'] 					= $this->input->post('transaction_note');
                        $data2['transaction_status'] 				= 1;
                        $data2['user_id']                           = $this->input->post('user_id');
    
                        $data4['transaction_id']					    = $data2['transaction_id'];
                        $data4['transactiondetail_id']			    = "trxdtl".date('YmdHis').rand(100000,999999);
                        $data4['package_id']							= 0;
                        $data4['package_amount']						= 0;
                        $data4['package_pricetotal']					= 0;
                        $data4['transactiondetail_status']		    = 1;
                        $data4['transactiondetail_rate']			    = "";
                        $data4['transactiondetail_review']		    = "";
                        $data4['transactiondetail_locationvisit']	= $this->input->post('transactiondetail_locationvisit'); 
                        $data4['transactiondetail_visitdate']    	= $data2['transaction_arrangementdate']; 
    
                        
                        $data3['packageteam_id']				    = "";
                        $data3['service_id']					    = $this->input->post('service_id'); 
                        $data3['package_id']					    = 0; 
                        $data3['paramediccategory_id']			    = $this->input->post('paramediccategory_id');
                        $data3['transactiondetail_id']			    = $data4['transactiondetail_id'];
                        $data3['packageteam_status']			    = 0;
                        if($this->input->post('paramedic_id'))
                        {
                            $data3['paramedic_id']					= $this->input->post('paramedic_id');
                        }
                        else
                        {
                            $paramedic_random                       = $this->model_paramedic->random_paramedic($this->input->post('paramediccategory_id'));
                            $data3['paramedic_id']					= $paramedic_random[0]->paramedic_id; 
                        }
    
                        $this->model_transaction->input2($data2);
                        $this->model_transaction->input($data4);
                        $this->model_transaction->input3($data3);
    
                        
                        $this->session->set_flashdata('notif_success','Pemesanan Telah Berhasil, Silahkan Tunggu Konfirmasi Dari Tenaga Kesehatan');
                        redirect('patient/order');
                    }
                }
                else
                {
                    $this->form_validation->set_rules('transaction_arrangementdate','Tanggal Perjanjian','required', array('required' => '*) Masukkan Tanggal Awal Perawatan'));
                    $this->form_validation->set_rules('transaction_note','Pesan Untuk Pasien','required', array('required' => '*) Masukkan Pesan'));
                    $this->form_validation->set_rules('transactiondetail_locationvisit','Alamat Perawatan','required', array('required' => '*) Masukkan Alamat Perawatan'));

                    $service_id = $this->input->post('service_id');

                    if ($this->form_validation->run() === FALSE)
                    {
                        $this->data['keys'] =  $this->model_service->get_edit($this->input->post('service_id'));
                        if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
                        {
                            redirect('patient/order');
                        } 
                        else 
                        {
                            $id = $this->session->userdata('user_id');

                            $get_service                            = $this->model_service->get_edit($service_id);
                            $data['service']                        = $get_service;
                            $data['paramedic']                      = $this->model_paramedic->list_paramedic($get_service[0]['paramediccategory_id']);
                            $data['user'] 							= $this->model_user->user_track($id);
                            $data['company']  						= $this->model_profile->getcompany();
                
                            #Generate Template...
                            $this->load->view('tamplate/header', $data);
                            $this->load->view('tamplate/topbar', $data);
                            $this->load->view('tamplate/sidebar_patient', $data);
                            $this->load->view('patient/order/contract', $data); 
                        }
                    }
                    else
                    {
                        $patient                                    = $this->model_patient->get_patient($this->input->post('patient_noktp'));

                        $data2['transaction_id']					= "trx".date('YmdHis').rand(100000,999999);
                        $data2['transaction_code']					= "trxcd".date('YmdHis').rand(100000,999999);
                        $data2['patient_id'] 						= $patient[0]->patient_id;
                        $data2['transaction_arrangementdate'] 		= $this->input->post('transaction_arrangementdate');
                        $data2['transaction_date'] 				    = date('Y-m-d H:i:s');
                        $data2['transaction_note'] 					= $this->input->post('transaction_note');
                        $data2['transaction_status'] 				= 1;
                        $data2['user_id']                           = $this->input->post('user_id');

                        $data['transaction_id']					    = $data2['transaction_id'];
                        $data['transactiondetail_id']			    = "trxdtl".date('YmdHis').rand(100000,999999);
                        $data['package_id']							= 0;
                        $data['package_amount']						= 0;
                        $data['package_pricetotal']					= 0;
                        $data['transactiondetail_status']		    = 1;
                        $data['transactiondetail_rate']			    = "";
                        $data['transactiondetail_review']		    = "";
                        $data['transactiondetail_locationvisit']	= $this->input->post('transactiondetail_locationvisit'); 
                        $data['transactiondetail_visitdate']    	= $data2['transaction_arrangementdate']; 

                        
                        $data3['packageteam_id']				    = "";
                        $data3['service_id']					    = $this->input->post('service_id'); 
                        $data3['package_id']					    = 0; 
                        $data3['paramediccategory_id']			    = $this->input->post('paramediccategory_id');
                        $data3['transactiondetail_id']			    = $data['transactiondetail_id'];
                        $data3['packageteam_status']			    = 0;
                        if($this->input->post('paramedic_id'))
                        {
                            $data3['paramedic_id']					= $this->input->post('paramedic_id');
                        }
                        else
                        {
                            $paramedic_random                       = $this->model_paramedic->random_paramedic($this->input->post('paramediccategory_id'));
                            $data3['paramedic_id']					= $paramedic_random[0]->paramedic_id; 
                        }

                        $this->model_transaction->input2($data2);
                        $this->model_transaction->input($data);
                        $this->model_transaction->input3($data3);

                        
                        $this->session->set_flashdata('notif_success','Pemesanan Telah Berhasil, Silahkan Tunggu Konfirmasi Dari Tenaga Kesehatan');
                        redirect('patient/order');
                    }
                }
            }
		}
	}
?>