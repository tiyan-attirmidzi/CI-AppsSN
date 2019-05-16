<?php  

	class Patient extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();

			$this->load->model('model_patient');
			$this->load->model('model_profile');
			$this->load->model('model_district');
			$this->load->library('pagination');
			$this->load->library('excel');

			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
		}

		#List Patinet
		public function list_patient()
		{
			
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
				$this->session->unset_userdata('sess_search_patient');
      			$this->session->unset_userdata('sess_search_patient2');

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
				$config["base_url"]    					= base_url() . "admin/patient/index/" . $limit;
				$config["total_rows"]  					= $this->model_patient->record_count();
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
				$page           							= ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				$data["links"]  							= $this->pagination->create_links();
				$data["patient"]  						= $this->model_patient->fetch_patient($config["per_page"], $page);
				$data["column"] 							= $this->model_patient->select_column_name($this->db->database);
				$data['admin']  							= $this->model_profile->getadmin($id);
				$data['company']  						= $this->model_profile->getcompany();

				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/patient/content', $data);
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
      			$config["total_rows"]  					= $this->model_patient->record_count_search($data['cari'], $this->input->post('column_name'));
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
						$data["patient"]   						= $this->model_patient->fetch_patient_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["column"] 						= $this->model_patient->select_column_name($this->db->database);
      			$data["links"]  						= $this->pagination->create_links();
						$data['admin']  						= $this->model_profile->getadmin($id);
						$data['company']  						= $this->model_profile->getcompany();

						#Generate Template...
						$this->load->view('tamplate/header', $data);
						$this->load->view('tamplate/topbar', $data);
						$this->load->view('tamplate/sidebar', $data);
						$this->load->view('admin/patient/content', $data);
    		}
		}

  		#Insert Data
  		public function insert() 
  		{
				$this->form_validation->set_rules('patient_noktp','No KTP','required|exact_length[16]|numeric' , array('required' => '*) Nomor KTP wajib diisi', 'exact_length' => '*) Periksa Kembali Nomor KTP', 'numeric' => '*) Periksa Kembali Nomor KTP'));
				$this->form_validation->set_rules('patient_name','Nama','required' , array('required' => '*) Nama wajib diisi'));
				$this->form_validation->set_rules('patient_sex','Jenis Kelamin','required', array('required' => '*) Pilih salah satu'));
				$this->form_validation->set_rules('patient_datebirth','Tanggal Lahir','required', array('required' => '*) Tanggal Lahir wajib diisi'));
				$this->form_validation->set_rules('patient_religion','Agama','required' , array('required' => '*) Pilih Agama'));
				$this->form_validation->set_rules('patient_job','Pekerjaan','required' , array('required' => '*) Pekerjaan wajib diisi'));
				$this->form_validation->set_rules('patient_address','Alamat','required', array('required' => '*) Alamat wajib diisi'));
				$this->form_validation->set_rules('patient_phone','Nomor Handphone','required|numeric|max_length[12]', array('required' => '*) Nomor Handphone wajib diisi', 'numeric' => '*) Periksa kembali Nomor Handphone', 'max_length' => '*) Periksa kembali Nomor Handphone'));
				
				if ($this->form_validation->run() === FALSE)
				{	
					$id_admin = $this->session->userdata('id_admin');

					$data['admin']  							= $this->model_profile->getadmin($id_admin);
					$data['company']  						= $this->model_profile->getcompany();
					
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/patient/insert', $data);
				} 
				else
				{

					$patient_ktp            = $this->model_patient->check($this->input->post('patient_noktp'));

					if ($patient_ktp->num_rows() == 0)
					{
								#get data
								$data['patient_id']     								= "";
								$data['patient_noregis']     						= "reg-patient-".date('YmdHis').rand(100000,999999);
								$data['patient_noktp']     							= $this->input->post('patient_noktp');
								$data['patient_name']     							= $this->input->post('patient_name');
								$data['patient_sex']     								= $this->input->post('patient_sex');
								$data['patient_datebirth']   						= $this->input->post('patient_datebirth');
								$data['patient_religion']   						= $this->input->post('patient_religion');
								$data['patient_job']   									= $this->input->post('patient_job');
								$data['patient_address'] 								= $this->input->post('patient_address');
								$data['patient_phone']   								= $this->input->post('patient_phone');

								$this->model_patient->input($data);	
								
								// print_r($data);
								$this->session->set_flashdata('notif_success','Pasien Baru Berhasil Di Tambahkan !');
								redirect('admin/patient');
					}
					else
					{
						$this->session->set_flashdata('notif_danger','Mohon Maaf, Data KTP Telah Digunakan !');   
						redirect('admin/patient/insert');
					}
				}	
			}

		#View Update
		public function update_view()
		{
			$id = base64_decode($this->input->get('patient'));
			
			$this->data['keys'] =  $this->model_patient->get_edit($id);
			if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
			{
				redirect('admin/patient');
			} 
			else 
			{
				$id_admin = $this->session->userdata('id_admin');
	
				$data['admin']  							= $this->model_profile->getadmin($id_admin);
				$data["keys"] 								= $this->model_patient->get_edit($id);
				$data['religion']							= array('Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu');
				$data['company']  						= $this->model_profile->getcompany();
				
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/patient/update', $data);
			}
		}
		  
		#Update Data
		public function update()
		{
			$this->form_validation->set_rules('patient_noktp','No KTP','required|exact_length[16]|numeric' , array('required' => '*) Nomor KTP wajib diisi', 'exact_length' => '*) Periksa Kembali Nomor KTP', 'numeric' => '*) Periksa Kembali Nomor KTP'));
			$this->form_validation->set_rules('patient_name','Nama','required' , array('required' => '*) Nama wajib diisi'));
			$this->form_validation->set_rules('patient_sex','Jenis Kelamin','required', array('required' => '*) Pilih salah satu'));
			$this->form_validation->set_rules('patient_datebirth','Tanggal Lahir','required', array('required' => '*) Tanggal Lahir wajib diisi'));
			$this->form_validation->set_rules('patient_religion','Agama','required' , array('required' => '*) Pilih Agama'));
			$this->form_validation->set_rules('patient_job','Pekerjaan','required' , array('required' => '*) Pekerjaan wajib diisi'));
			$this->form_validation->set_rules('patient_address','Alamat','required', array('required' => '*) Alamat wajib diisi'));
			$this->form_validation->set_rules('patient_phone','Nomor Handphone','required|numeric|max_length[12]', array('required' => '*) Nomor Handphone wajib diisi', 'numeric' => '*) Periksa kembali Nomor Handphone', 'max_length' => '*) Periksa kembali Nomor Handphone'));

			$id = $this->input->post('patient_id');

			if ($this->form_validation->run() === FALSE)
			{
				$this->data['keys'] =  $this->model_patient->get_edit($this->input->post('patient_id'));
				if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
				{
					redirect('admin/patient');
				} 
				else 
				{
					$id_admin = $this->session->userdata('id_admin');
	
					$data['admin']  							= $this->model_profile->getadmin($id_admin);
					$data["keys"] 								= $this->model_patient->get_edit($id);
					$data['religion']							= array('Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu');
					$data['company']  						= $this->model_profile->getcompany();
					
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/patient/update', $data);
				}
			}
			else
			{
				$data['patient_id']     								= $this->input->post('patient_id');
				$data['patient_noregis']     						= $this->input->post('patient_noregis');;
				$data['patient_noktp']     							= $this->input->post('patient_noktp');
				$data['patient_name']     							= $this->input->post('patient_name');
				$data['patient_sex']     								= $this->input->post('patient_sex');
				$data['patient_datebirth']   						= $this->input->post('patient_datebirth');
				$data['patient_religion']   						= $this->input->post('patient_religion');
				$data['patient_job']   									= $this->input->post('patient_job');
				$data['patient_address'] 								= $this->input->post('patient_address');
				$data['patient_phone']   								= $this->input->post('patient_phone');

				$this->model_patient->edit($data);		
				
				$this->session->set_flashdata('notif_success','Data Pasient <b>'.$data['patient_name'].'</b> Berhasil Di Ubah!');
				redirect('admin/patient');
			
			}
		}

	
		#Delete Data
 	 	public function delete() 
 	 	{
			$this->model_patient->delete($this->input->post('patient_id'));
			$this->session->set_flashdata('notif_success','Pasien <b>'.$this->input->post('patient_name').'</b> Telah Di Hapus!');
			redirect('admin/patient');
		}

  		#Export Data With Excel
  		public function export() 
  		{
    		$data = $this->model_patient->export();
    		#load PHPExcel library
    		$this->excel->setActiveSheetIndex(0);
    		#name the worksheet
    		$this->excel->getActiveSheet()->setTitle('Data Pasien SN Health Center');
    
    		#STYLING
    		$styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '0000'))));
    
    		#set report header
    		$this->excel->getActiveSheet()->getStyle('A:K')->getFont()->setName('Times New Roman');
    		$this->excel->getActiveSheet()->mergeCells('A1:K1');
    		$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR PASIEN APLIKASI SN HEALTH CENTER');
    		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
    
    
    		//set column name
    		$this->excel->getActiveSheet()->setCellValue('A2', 'No');
    		$this->excel->getActiveSheet()->setCellValue('B2', 'Nomor Registrasi');
    		$this->excel->getActiveSheet()->setCellValue('C2', 'Nomor KTP');
    		$this->excel->getActiveSheet()->setCellValue('D2', 'Nama');
    		$this->excel->getActiveSheet()->setCellValue('E2', 'Jenis Kelamin');
    		$this->excel->getActiveSheet()->setCellValue('F2', 'Tanggal Lahir');
    		$this->excel->getActiveSheet()->setCellValue('G2', 'Agama');
    		$this->excel->getActiveSheet()->setCellValue('H2', 'Pekerjaan');
    		$this->excel->getActiveSheet()->setCellValue('I2', 'Nomor HP');
    		$this->excel->getActiveSheet()->setCellValue('J2', 'Alamat');
    		$this->excel->getActiveSheet()->setCellValue('K2', 'Tanggal & Waktu Registrasi');
    
			  $this->excel->getActiveSheet()->getStyle('A2:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
			  $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
			  $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			  $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			  $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
			  $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			  $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			  $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			  $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			  $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
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
      			$this->excel->getActiveSheet()->setCellValue('B' . $no, $v->patient_noregis);

      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('C' . $no, strval($v->patient_noktp));

      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('D' . $no, $v->patient_name);
				  
      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('E' . $no, $v->patient_sex);
				  
      			$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('F' . $no, $v->patient_datebirth);

      			$this->excel->getActiveSheet()->getStyle('G' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('G' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('G' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('G' . $no, $v->patient_religion);
				  
      			$this->excel->getActiveSheet()->getStyle('H' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('H' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('H' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('H' . $no, $v->patient_job);
				  
      			$this->excel->getActiveSheet()->getStyle('I' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('I' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('I' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('I' . $no, $v->patient_phone);
				  
				$this->excel->getActiveSheet()->getStyle('J' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('J' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('J' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$this->excel->getActiveSheet()->setCellValue('J' . $no, $v->patient_address);
						
				$this->excel->getActiveSheet()->getStyle('K' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('K' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('K' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('K' . $no, $v->patient_registerdate);
				
				$no++;
      			$nomor++;
    		}
    
    		$this->excel->getActiveSheet()->getStyle('A2:K' . ($no - 1))->applyFromArray($styleArray);
    		ob_end_clean();
    		$filename = 'Daftar Pasien Aplikasi SN Health Center.xls'; //save our workbook as this file name
    		header('Content-Type: application/vnd.ms-excel'); //mime type
    		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
    		header('Cache-Control: max-age=0'); //no cache
    		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    		$objWriter->save('php://output');
   
    		redirect('admin/patient');
  		}

	}



?>