<?php  

	class Registration_paramedic extends CI_Controller
	{
		function __construct()
		{
            parent::__construct();
            $this->load->model('model_service');
            $this->load->model('model_paramedic');
            $this->load->model('model_paramediccategory');
            $this->load->model('model_profile');
            $this->load->model('model_district');
        }

        public function index()
        {
            $data["service"]				= $this->model_service->get_service();
			$data["district"] 				= $this->model_district->getdistrict();
            $data["paramediccategory"]  	= $this->model_paramediccategory->get_paramediccategory();
			$data['company']  				= $this->model_profile->getcompany();
			
			$this->load->view('regis_paramedic', $data);
        }

        public function reg_newparamedic()
		{
			$email							= $this->model_paramedic->email_address($this->input->post('exampleInputEmail'));

			if ($email->num_rows() == 0)
			{
				$filename                               = date('YmdHis');
				$config['upload_path']          		= './img/paramedic/';
				$config['allowed_types']        		= '*';
				$config['overwrite']                    ="true";
				$config['max_size']                     ="20000000";
				$config['max_width']                    ="10000";
				$config['max_height']                   ="10000";
				$config['file_name']                    = $this->input->post('paramedic_name').'paramedic-'.$filename;

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
					
				$data['paramedic_id']							= "";
				$data['paramedic_noregis']						= "reg-paramedic-".date('YmdHis').rand(100000,999999);
				$data['paramedic_name']							= $this->input->post('paramedic_name');
				$data['paramedic_noktp']						= $this->input->post('paramedic_ktp');
				$data['paramedic_sex']							= $this->input->post('paramedic_sex');
				$data['paramedic_datebirth']					= $this->input->post('paramedic_datebirth');
				$data['paramedic_religion']						= $this->input->post('paramedic_religion');
				$data['paramedic_lasteducation']				= $this->input->post('paramedic_lasteducation');
				$data['paramediccategory_id']					= $this->input->post('paramediccategory_id');
				$data['paramedic_phone']						= $this->input->post('paramedic_phone');
				$data['district_id']							= $this->input->post('district_id')	;
				$data['paramedic_address']						= $this->input->post('paramedic_address');
				$data['paramedic_region']						= $this->input->post('paramedic_region');

				$data['paramedic_registerdate'] 				= date('Y-m-d H:i:s');
				$data['paramedic_email']						= $this->input->post('exampleInputEmail');
				$data['paramedic_password']						= md5($this->input->post('exampleInputPassword1'));
				$data['paramedic_status']						= "0";

				$this->model_paramedic->input($data);

				$this->session->set_flashdata('notif_regparamedic','Terima Kasih, Anda Telah Berhasil Melakukan Registrasi Silahkan Menunggu Konfirmasi!');   
				redirect('registration_paramedic');     

			}
			else
			{
				$this->session->set_flashdata('notif_regparamedic1','Mohon Maaf, Email Sudah Terdaftar!');   
				redirect('registration_paramedic'); 
			}
		}
    }
?>