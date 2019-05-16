<?php 

	class Service extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('model_service');
			$this->load->model('model_profile');
			$this->load->model('model_paramediccategory');
			$this->load->library('pagination');
			$this->load->library('excel');

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
				$this->session->unset_userdata('sess_search_service');
      			$this->session->unset_userdata('sess_search_service2');

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
				$config["base_url"]    = base_url() . "admin/service/index/" . $limit;
				$config["total_rows"]  = $this->model_service->record_count();
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
				$page           				= ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				$data["service"]  				= $this->model_service->fetch_service($config["per_page"], $page);
				$data["column"] 				= $this->model_service->select_column_name($this->db->database);
				$data["links"]  				= $this->pagination->create_links();
				$data['admin']  				= $this->model_profile->getadmin($id_admin);
				$data['company']  				= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/service/content', $data);
			}
		}	

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
        			$this->session->set_userdata('sess_search_service', $data['cari']);
        			$this->session->set_userdata('sess_search_service2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_service');
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
      			$config["base_url"]    = base_url() . "admin/service/result/" . $limit . "/" . $data['cari'];
      			$config["total_rows"]  = $this->model_service->record_count_search($data['cari'], $this->input->post('column_name'));
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
      			$page           						= ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
      			$data["service"]   						= $this->model_service->fetch_service_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["column"] 						= $this->model_service->select_column_name($this->db->database);
      			$data["links"]  						= $this->pagination->create_links();
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/service/content', $data);
      
    		}
		}
		  
		public function insert_view()
		{
			$id_admin = $this->session->userdata('id_admin');
		
			$data['admin']  						= $this->model_profile->getadmin($id_admin);
			$data['company']  						= $this->model_profile->getcompany();
			$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
			
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/topbar', $data);
			$this->load->view('tamplate/sidebar', $data);
			$this->load->view('admin/service/service_insert', $data);
		}

  		#Insert Data
  		public function input() 
  		{
			$this->form_validation->set_rules('service_name','Nama Layanan','required', array('required' => '*) Nama Layanan wajib diisi'));
			$this->form_validation->set_rules('service_desc','Deskripsi Layanan','required', array('required' => '*) Deskripsi wajib diisi'));
			$this->form_validation->set_rules('service_pricerange','Kisaran Harga','required', array('required' => '*) Kisaran Harga wajib diisi'));
			$this->form_validation->set_rules('paramediccategory_id','Penanggung Jawab','required', array('required' => '*) Penanggung Jawab wajib dipilih'));

			if ($this->form_validation->run() === FALSE)
			{	
				$id_admin = $this->session->userdata('id_admin');

				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/service/service_insert', $data);
			} 
			else
			{
				if($_FILES['userfile']['name']=='')
				{
					$data['service_id']       				= "";
					$data['service_name']     				= $this->input->post('service_name');
					$data['service_desc']     				= $this->input->post('service_desc');
					$data['service_pricerange']   			= $this->input->post('service_pricerange');
					$data['service_status']   				= $this->input->post('service_status');
					$data['paramediccategory_id']   		= $this->input->post('paramediccategory_id');
	
					$this->model_service->input($data);
	
					$this->session->set_flashdata('notif_success','Layanan <b>'.$data['service_name'].'</b> Berhasil Di Tambah !');
					redirect('admin/service');
				}
				else
				{
					$filename                               = date('YmdHis');
					$config['upload_path']          		= './img/service/';
					$config['allowed_types']        		= 'gif|jpg|png|jpeg';
					$config['overwrite']                    ="true";
					$config['max_size']                     ="20000000";
					$config['max_width']                    ="10000";
					$config['max_height']                   ="10000";
					$config['file_name']                    = 'service-img-'.$filename;	
	
					$this->load->library('upload', $config);
	
					if(!$this->upload->do_upload())
					{
						echo $this->upload->display_errors();
					}
					else 
					{
						
						$dat = $this->upload->data();
						
						$data['service_id']               		= $this->input->post('service_id');
						$data['service_name']             		= $this->input->post('service_name');
						$data['service_desc']             		= $this->input->post('service_desc');
						$data['service_pricerange']       		= $this->input->post('service_pricerange');
						$data['service_status']   				= $this->input->post('service_status');
						$data['paramediccategory_id']   		= $this->input->post('paramediccategory_id');
						$data['service_image']                  = $dat['file_name'];
	
						$this->model_service->input($data);
						
						$this->session->set_flashdata('notif_success','Layanan <b>'.$data['service_name'].'</b> Berhasil Di Tambah !');
						redirect('admin/service');
			
					}
				}
			}
  		}
		
		public function update_view()
		{
			$id = base64_decode($this->input->get('service_id'));
			
			$this->data['keys'] =  $this->model_service->get_edit($id);
			if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
			{
				redirect('admin/service');
			} 
			else 
			{
				$id_admin = $this->session->userdata('id_admin');

				$data["keys"] 							= $this->model_service->get_edit($id);
				$data['admin']  						= $this->model_profile->getadmin($id_admin);
				$data['company']  						= $this->model_profile->getcompany();
				$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();

				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/service/service_update', $data);
			}
		}
		
  		#Update Data
  		public function edit() 
  		{
			$this->form_validation->set_rules('service_name','Nama Layanan','required', array('required' => '*) Nama Layanan wajib diisi'));
			$this->form_validation->set_rules('service_desc','Deskripsi Layanan','required', array('required' => '*) Deskripsi wajib diisi'));
			$this->form_validation->set_rules('service_pricerange','Kisaran Harga','required', array('required' => '*) Kisaran Harga wajib diisi'));
			$this->form_validation->set_rules('paramediccategory_id','Penanggung Jawab','required', array('required' => '*) Penanggung Jawab wajib dipilih'));
			
			$id = $this->input->post('service_id');
		
			if ($this->form_validation->run() == FALSE)
			{	
				$this->data['keys'] =  $this->model_service->get_edit($this->input->post('service_id'));
				if(!isset($this->data['keys'][0]) || $this->data['keys'][0] == "")
				{
					redirect('admin/service');
				} 
				else 
				{
					$id_admin 	= $this->session->userdata('id_admin');
                    $id_service	= $this->input->post('service_id');

					$data["keys"] 							= $this->model_service->get_edit($id_service);
					$data['admin']  						= $this->model_profile->getadmin($id_admin);
					$data['company']  						= $this->model_profile->getcompany();
					$data['paramediccategory']  			= $this->model_paramediccategory->get_paramediccategory();
					
					#Generate Template...
					$this->load->view('tamplate/header', $data);
					$this->load->view('tamplate/topbar', $data);
					$this->load->view('tamplate/sidebar', $data);
					$this->load->view('admin/service/service_update', $data);
				}
			} 
			else
			{
				if($_FILES['userfile']['name']=='')
				{
					$data['service_id']               = $this->input->post('service_id');
					$data['service_name']             = $this->input->post('service_name');
					$data['service_desc']             = $this->input->post('service_desc');
					$data['service_status']   				= $this->input->post('service_status');
					$data['service_pricerange']       = $this->input->post('service_pricerange');
					$data['paramediccategory_id']     = $this->input->post('paramediccategory_id');


					$this->model_service->edit($data);

					$this->session->set_flashdata('notif_success','Layanan <b>'.$data['service_name'] .'</b> Berhasil Di Ubah !');
					redirect('admin/service');
				}
				else
				{
					$filename                               = date('YmdHis');
					$config['upload_path']          		= './img/service/';
					$config['allowed_types']        		= 'gif|jpg|png|jpeg';
					$config['overwrite']                    ="true";
					$config['max_size']                     ="20000000";
					$config['max_width']                    ="10000";
					$config['max_height']                   ="10000";
					$config['file_name']                    = 'service-img-'.$filename;	

					$this->load->library('upload', $config);

					if(!$this->upload->do_upload())
					{
						echo $this->upload->display_errors();
					}
					else 
					{
						$id_service = $this->input->post('service_id');
						$image = $this->model_service->link_gambar($id_service);

						if($image->num_rows() == 0)
						{
							$dat = $this->upload->data();
							
							$data['service_id']               		= $this->input->post('service_id');
							$data['service_name']             		= $this->input->post('service_name');
							$data['service_desc']             		= $this->input->post('service_desc');
							$data['service_status']   				= $this->input->post('service_status');
							$data['service_pricerange']       		= $this->input->post('service_pricerange');
							$data['paramediccategory_id']   		= $this->input->post('paramediccategory_id');
							$data['service_image']                  = $dat['file_name'];

							$this->model_service->edit($data);
						}
						else
						{
							if ($image->num_rows() > 0)
							{
								$row = $image->row();			
								$file_gambar = $row->service_image;
								$path_file = './img/service/';
								unlink($path_file.$file_gambar);
							}					
						
							$dat = $this->upload->data();
							
							$data['service_id']               		= $this->input->post('service_id');
							$data['service_name']             		= $this->input->post('service_name');
							$data['service_desc']             		= $this->input->post('service_desc');
							$data['service_status']   				= $this->input->post('service_status');
							$data['service_pricerange']       		= $this->input->post('service_pricerange');
							$data['paramediccategory_id']   		= $this->input->post('paramediccategory_id');
							$data['service_image']                  = $dat['file_name'];

							$this->model_service->edit($data);	
							
						}	

						$this->session->set_flashdata('notif_success','Layanan <b>'.$data['service_name'] .'</b> Berhasil Di Ubah !');
						#redirect to page
						redirect('admin/service');

					}
				}
			}
			
  		}

  		 #Delete Data
 	 	public function delete() 
 	 	{
			$image = $this->model_service->link_gambar($this->input->post('service_id'));
			if ($image->num_rows() > 0)
			{
				$row = $image->row();			
				$file_gambar = $row->service_image;
				$path_file = './img/service/';
				unlink($path_file.$file_gambar);
			}	
    		$this->model_service->delete($this->input->post('service_id'));
			$this->session->set_flashdata('notif_editservice1','Kategori<b> '.$this->input->post('service_name').' </b>Telah Di Hapus !');	
    		redirect('admin/service');
		}
		  
		#Export Data
		public function export() 
		{
			$data = $this->model_service->export();
			#load PHPExcel library
			$this->excel->setActiveSheetIndex(0);
			#name the worksheet
			$this->excel->getActiveSheet()->setTitle('Data Layanan SN Health Center');
	
			#STYLING
			$styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '0000'))));
	
			#set report header
			$this->excel->getActiveSheet()->getStyle('A:D')->getFont()->setName('Times New Roman');
			$this->excel->getActiveSheet()->mergeCells('A1:D1');
			$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR LAYANAN APLIKASI SN HEALTH CENTER ');
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
	
	
			//set column name
			$this->excel->getActiveSheet()->setCellValue('A2', 'No');
			$this->excel->getActiveSheet()->setCellValue('B2', 'Nama');
			$this->excel->getActiveSheet()->setCellValue('C2', 'Deskripsi');
		  	$this->excel->getActiveSheet()->setCellValue('D2', 'Kisaran Harga');
  
			$this->excel->getActiveSheet()->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
  
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
				$this->excel->getActiveSheet()->setCellValue('B' . $no, $v->service_name);

				$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setWrapText(true);
				$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('C' . $no, strip_tags($v->service_desc));

				$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setWrapText(true);
				$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->setCellValue('D' . $no, strip_tags($v->service_pricerange));
				
				$no++;
				$nomor++;
		  	}
  
		  $this->excel->getActiveSheet()->getStyle('A2:D' . ($no - 1))->applyFromArray($styleArray);
		  ob_end_clean();
		  $filename = 'Daftar Layanan Aplikasi SN Health Center.xls'; //save our workbook as this file name
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache
		  $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		  $objWriter->save('php://output');
 
		  redirect('service');
		}


	}


?>