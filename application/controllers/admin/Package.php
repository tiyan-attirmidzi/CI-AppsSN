<?php  

	class Package extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
      		error_reporting(0);
			$this->load->model('model_package');
			$this->load->model('model_paramediccategory');
			$this->load->model('model_profile');
			$this->load->library('pagination');
			$this->load->library('excel');
			$this->load->library('upload');
			  
			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
		}

		#Index
		public function index()
		{
			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
			else
			{
				$this->session->unset_userdata('sess_search_package');
  				$this->session->unset_userdata('sess_search_package2');

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
				$config["base_url"]    = base_url() . "admin/package/index/" . $limit;
				$config["total_rows"]  = $this->model_package->record_count();
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
				$page           						= ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				$data["service"] 						= $this->model_package->fetch_service();
				$data["paramediccategory"] 				= $this->model_package->fetch_paramediccategory();
				$data["package"]            			= $this->model_package->fetch_package($config["per_page"], $page);
				$data["column"]            	 			= $this->model_package->select_column_name($this->db->database);
				$data["links"]             	 			= $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
			
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/package/content', $data);
			}
		}

		#Result (Search)
		public function result() 
		{
			if (!($this->session->userdata('id_admin'))) 
			{
				$this->load->view("admin");
			} 
			else 
			{
				#Set Key Search to Session...
				if ($this->input->post('key')) 
				{
					$data['cari'] = $this->input->post('key');
					$this->session->set_userdata('sess_search_package', $data['cari']);
					$this->session->set_userdata('sess_search_package2', $this->input->post('column_name'));
				} 
				else 
				{
					$data['cari'] = $this->session->userdata('sess_search_package');
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
				$config["base_url"]    = base_url() . "admin/package/result/" . $limit . "/" . $data['cari'];
				$config["total_rows"]  = $this->model_package->record_count_search($data['cari'], $this->input->post('column_name'));
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
				
				$page           			     = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				$data["package"]   			   	 = $this->model_package->fetch_package_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
				$data["paramediccategory"] 		 = $this->model_package->fetch_paramediccategory();  
				$data["column"] 			     = $this->model_package->select_column_name($this->db->database);
				$data["links"]  			     = $this->pagination->create_links();
				$data['admin']  				 = $this->model_profile->getadmin($id_admin);
				$data['company']  				 = $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/package/content', $data);
		
			}
		}

		public function insert_view()
		{
			$id_admin = $this->session->userdata('id_admin');

			$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
			$data["service"] 						= $this->model_package->fetch_service();
			$data['admin']  						= $this->model_profile->getadmin($id_admin);
			$data['company']  						= $this->model_profile->getcompany();
			
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/topbar', $data);
			$this->load->view('tamplate/sidebar', $data);
			$this->load->view('admin/package/package_insert', $data);
		}

		#Insert Data
		public function input() 
		{
			$this->form_validation->set_rules('package_name','Nama','required' , array('required' => '*) Nama Paket wajib diisi'));
			$this->form_validation->set_rules('paramediccategory_id[]','Paramedic','required' , array('required' => '*) Pilih Minimal 1'));
			$this->form_validation->set_rules('package_price','Tarif','required' , array('required' => '*) Tarif wajib diisi'));
			$this->form_validation->set_rules('package_desc','Tarif','required' , array('required' => '*) Deskripsi wajib diisi'));
			$this->form_validation->set_rules('service_id','Layanan','required' , array('required' => '*) Layanan wajib dipilih'));

			if ($this->form_validation->run() === FALSE)
			{	
				$id_admin = $this->session->userdata('id_admin');

				$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
				$data["service"] 						= $this->model_package->fetch_service();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/package/package_insert', $data);
			}
			else
			{
				$nmfile                             = "package-img-" . date('YmdHis');
				$config['upload_path']              = './img/package/';
				$config['allowed_types']            = 'jpg|jpeg|png|gif';
				$config['max_size']                 = '102400';
				$config['file_name']                = $nmfile;

				$this->upload->initialize($config);

				if ($_FILES['package_image']['name']) 
				{
					if ($this->upload->do_upload('package_image')) 
					{
						$img = $this->upload->data();
						#get data
						$data = array(
						'package_image'       => $img['file_name'],
						'package_name'        => $this->input->post('package_name'),
						'package_desc'        => $this->input->post('package_desc'),
						'service_id'          => $this->input->post('service_id'), 
						'package_price'       => str_replace('.', '', $this->input->post('package_price'))
						);
						$this->model_package->input($data);
					}
				}
				else
				{
					$data['package_id']               = "";
					$data['package_name']             = $this->input->post('package_name');
					$data['package_desc']             = $this->input->post('package_desc');
					$data['service_id']               = $this->input->post('service_id');
					$data['package_price']            = str_replace('.', '', $this->input->post('package_price'));

					$this->model_package->input($data);
				}

				$p = $this->model_package->getdata($data['package_name'], $data['package_desc'], $data['service_id'], $data['package_price']);
				$c = count($this->input->post('paramediccategory_id'));
				for ($i=0; $i < $c; $i++) 
				{ 
					$data2['packageparamediccategory_id'] 	= "";
					$data2['package_id'] 					          = $p[0]->package_id;
					$data2['paramediccategory_id'] 			    = $this->input->post('paramediccategory_id')[$i];

					$this->model_package->input2($data2);
						
				}
					$this->session->set_flashdata('notif_success','Paket <b>'.$this->input->post('package_name').'</b> Berhasil Di Tambah !');
					#redirect to page
					redirect('admin/package');
			} 
  		}

		public function update_view()
		{
			$id = base64_decode($this->input->get('package_id'));
			
			$this->data['key'] =  $this->model_package->get_edit($id);
			if(!isset($this->data['key'][0]) || $this->data['key'][0] == "")
			{
				redirect('admin/package');
			} 
			else 
			{
                $id_admin = $this->session->userdata('id_admin');
				
				$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
				$data["service"] 						= $this->model_package->fetch_service();
				$data["key"] 							= $this->model_package->get_edit($id);
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();

				$v = array();
				
				$data["fetch_ppc"]					= $this->model_package->fetch_packageparamediccategory($id);
				array_push($v, $data["fetch_ppc"]);
				
				$data['q'] = $v;
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/package/package_update', $data);
			}
		}

  		#Update Data
  		public function edit() 
  		{
			$this->form_validation->set_rules('package_name','Nama','required' , array('required' => '*) Nama Paket wajib diisi'));
			$this->form_validation->set_rules('paramediccategory_id[]','Paramedic','required' , array('required' => '*) Pilih Minimal 1'));
			$this->form_validation->set_rules('package_price','Tarif','required' , array('required' => '*) Tarif wajib diisi'));
			$this->form_validation->set_rules('package_desc','Tarif','required' , array('required' => '*) Deskripsi wajib diisi'));
			$this->form_validation->set_rules('service_id','Layanan','required' , array('required' => '*) Layanan wajib dipilih'));

			$id_package			= $this->input->post('package_id');

			if ($this->form_validation->run() === FALSE)
			{
				$this->data['key'] =  $this->model_package->get_edit($id_package);
				if(!isset($this->data['key'][0]) || $this->data['key'][0] == "")
				{
					redirect('admin/package');
				} 
				else 
				{
					$id_admin = $this->session->userdata('id_admin');
	
					$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
					$data["service"] 						= $this->model_package->fetch_service();
					$data['admin']  						= $this->model_profile->getadmin($id_admin);
					$data["key"] 							= $this->model_user->get_edit($id_package);
					$data['company']  						= $this->model_profile->getcompany();

					$v = array();
				
					$data["fetch_ppc"]					= $this->model_package->fetch_packageparamediccategory($id);
					array_push($v, $data["fetch_ppc"]);
					
					$data['q'] = $v;
					
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/user/package_update', $data);
				}
			}
			else
			{
				$this->model_package->edit3($id_package);

				$nmfile                             = "package-img-" . date('YmdHis');
				$config['upload_path']              = './img/package/';
				$config['allowed_types']            = 'jpg|jpeg|png|gif';
				$config['max_size']                 = '102400';
				$config['file_name']                = $nmfile;

				$this->upload->initialize($config);

				if ($_FILES['package_image']['name']) 
				{
					if ($this->upload->do_upload('package_image')) 
					{
						$file_gambar = $this->input->post('package_image');
						$path_file = './img/package/';
						unlink($path_file.$file_gambar);
						
						$img = $this->upload->data();
						#get data
						$data = array(
						'package_image'       => $img['file_name'],
						'package_id'          => $this->input->post('package_id'),
						'package_name'        => $this->input->post('package_name'),
						'package_desc'        => $this->input->post('package_desc'),
						'service_id'          => $this->input->post('service_id'), 
						'package_price'       => str_replace('.', '', $this->input->post('package_price'))
						);
						$this->model_package->edit($data);
					}
				}
				else
				{
					$data['package_id']               = $this->input->post('package_id');
					$data['package_name']             = $this->input->post('package_name');
					$data['package_desc']             = $this->input->post('package_desc');
					$data['service_id']               = $this->input->post('service_id');
					$data['package_price']            = str_replace('.', '', $this->input->post('package_price'));

					$this->model_package->edit($data);
				}

				$p = $this->model_package->getdata($data['package_name'], $data['package_desc'], $data['service_id'], $data['package_price']);
				$c = count($this->input->post('paramediccategory_id'));
				for ($i=0; $i < $c; $i++) 
				{ 
					$data2['packageparamediccategory_id']   = "";
					$data2['package_id']                    = $p[0]->package_id;
					$data2['paramediccategory_id']          = $this->input->post('paramediccategory_id')[$i];

					$this->model_package->edit2($data2);    
				}
					$this->session->set_flashdata('notif_success','Paket <b>'.$this->input->post('package_name').'</b> Berhasil Di Ubah !');
					#redirect to page
					redirect('admin/package');
			}
  		}

  		 #Delete Data
 	 	public function delete() 
 	 	{		
			$file_gambar = $this->input->post('package_image');
			$path_file = './img/package/';
			unlink($path_file.$file_gambar);

    		$this->model_package->delete($this->input->post('package_id'));
			$this->model_package->delete2($this->input->post('package_id'));
			
			$this->session->set_flashdata('notif_success','Paket <b>'.$this->input->post('package_name').'</b> Berhasil Di Hapus !');
    		redirect('admin/package');
		}
		
		public function export()
		{
			$data = $this->model_package->export();
    		#load PHPExcel library
    		$this->excel->setActiveSheetIndex(0);
    		#name the worksheet
    		$this->excel->getActiveSheet()->setTitle('Data Paket SN Health Center');
    
    		#STYLING
    		$styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '0000'))));
    
    		#set report header
    		$this->excel->getActiveSheet()->getStyle('A:K')->getFont()->setName('Times New Roman');
    		$this->excel->getActiveSheet()->mergeCells('A1:F1');
    		$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR PAKET APLIKASI SN HEALTH CENTER');
    		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
    
    
    		//set column name
    		$this->excel->getActiveSheet()->setCellValue('A2', 'No');
    		$this->excel->getActiveSheet()->setCellValue('B2', 'Nama');
    		$this->excel->getActiveSheet()->setCellValue('C2', 'Layanan');
    		$this->excel->getActiveSheet()->setCellValue('D2', 'Deskripsi');
    		$this->excel->getActiveSheet()->setCellValue('E2', 'Tarif (Rp.)');
    		$this->excel->getActiveSheet()->setCellValue('F2', 'Paramedic Yang Dibutuhkan');
    
			$this->excel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
    
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
      			$this->excel->getActiveSheet()->setCellValue('B' . $no, $v->package_name);

      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('C' . $no, $v->service_name);

      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('D' . $no, strip_tags($v->package_desc));

      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		  
				$this->excel->getActiveSheet()->setCellValue('E' . $no,'Rp. '.number_format($v->package_price));
				
				$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('F' . $no, $v->paramediccategory_name);

      			$no++;
      			$nomor++;
    		}
    
    		$this->excel->getActiveSheet()->getStyle('A2:F' . ($no - 1))->applyFromArray($styleArray);
    		ob_end_clean();
    		$filename = 'Daftar Paket Aplikasi SN Health Center.xls'; //save our workbook as this file name
    		header('Content-Type: application/vnd.ms-excel'); //mime type
    		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
    		header('Cache-Control: max-age=0'); //no cache
    		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    		$objWriter->save('php://output');
   
    		redirect('admin/package');
		}

	}


?>