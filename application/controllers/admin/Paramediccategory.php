<?php 

	class Paramediccategory extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
			$this->load->model('model_paramediccategory');
			$this->load->model('model_profile');
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
				$this->session->unset_userdata('sess_search_paramediccategory');
      			$this->session->unset_userdata('sess_search_paramediccategory2');

      			if ($this->uri->segment(5) != "") 
      			{
			        $limit = $this->uri->segment(5);
			    } 
			    else 
			    {
			        $limit = 10;
			    }
			

				#Config for pagination...
				$config                = array();
				$config["base_url"]    = base_url() . "admin/paramediccategory/index/" . $limit;
				$config["total_rows"]  = $this->model_paramediccategory->record_count();
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
				$page           	= ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
				// $data["district"] 	= $this->model_district->fetch_district();
				$data["paramediccategory"]  	= $this->model_paramediccategory->fetch_paramediccategory($config["per_page"], $page);
				$data["column"] 				= $this->model_paramediccategory->select_column_name($this->db->database);
				$data["links"]  				= $this->pagination->create_links();
				$data['admin']  				= $this->model_profile->getadmin($id_admin);
				$data['company']  				= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/paramediccategory', $data);
			}
		}

		public function result() 
		{
    		if (!($this->session->userdata('id_admin'))) 
    		{
      			$this->load->view("login");
    		} 
    		else 
    		{
      			#Set Key Search to Session...
      			if ($this->input->post('key')) 
      			{
        			$data['cari'] = $this->input->post('key');
        			$this->session->set_userdata('sess_search_paramediccategory', $data['cari']);
        			$this->session->set_userdata('sess_search_paramediccategory2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_paramediccategory');
      			}
      
		      	#set Limit
		      	if ($this->uri->segment(5) != '') 
		      	{
		        	$limit = $this->uri->segment(5);
		      	} 
		      	else 
		      	{
		        	$limit = 10;
		      	}
      
      			#Config for pagination...
      			$config                = array();
      			$config["base_url"]    = base_url() . "admin/paramediccategory/result/" . $limit . "/" . $data['cari'];
      			$config["total_rows"]  = $this->model_paramediccategory->record_count_search($data['cari'], $this->input->post('column_name'));
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
      			$page           				= ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
      			$data["paramediccategory"]   	= $this->model_paramediccategory->fetch_paramediccategory_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["column"] 				= $this->model_paramediccategory->select_column_name($this->db->database);
      			$data["links"]  				= $this->pagination->create_links();
				$data['admin']  				= $this->model_profile->getadmin($id_admin);
				$data['company']  				= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/paramediccategory', $data);
      
    		}
  		}

  		#Insert Data
  		public function input() 
  		{
    		#get data
    		$data['paramediccategory_id']       			= "";
    		$data['paramediccategory_name']     			= $this->input->post('paramediccategory_name');
    		$data['paramediccategory_desc']     			= $this->input->post('paramediccategory_desc');

    		#call function input from model
			$this->model_paramediccategory->input($data);
			$this->session->set_flashdata('notif_success','Kategori Paramedis Telah Di Tambahkan!');
    		#redirect to page
    		redirect('admin/paramediccategory');
  		}

  		#Update Data
  		public function edit() 
  		{
    		#get data
    		$data['paramediccategory_id']       			= $this->input->post('paramediccategory_id');
    		$data['paramediccategory_name']     			= $this->input->post('paramediccategory_name');
    		$data['paramediccategory_desc']     			= $this->input->post('paramediccategory_desc');

    		#call function input from model
			$this->model_paramediccategory->edit($data);
			$this->session->set_flashdata('notif_success','Kategori Paramedis <b>'.$data['paramediccategory_name'].'</b> Berhasil Di Ubah!');
    		#redirect to page
    		redirect('admin/paramediccategory');
  		}

		#Delete Data
 	 	public function delete() 
 	 	{
			$this->model_paramediccategory->delete($this->input->post('paramediccategory_id'));
			$this->session->set_flashdata('notif_success','Kategori Paramedis Berhasil Di Hapus!');			
    		redirect('admin/paramediccategory');
		}
		  
		#Export Data
		public function export()
		{
			$data = $this->model_paramediccategory->export();
    		#load PHPExcel library
    		$this->excel->setActiveSheetIndex(0);
    		#name the worksheet
    		$this->excel->getActiveSheet()->setTitle('Profesi NaKes SN Health Center');
    
    		#STYLING
    		$styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '0000'))));
    
    		#set report header
    		$this->excel->getActiveSheet()->getStyle('A:C')->getFont()->setName('Times New Roman');
    		$this->excel->getActiveSheet()->mergeCells('A1:C1');
    		$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR PROFESI TENAGA KESEHATAN APLIKASI SN HEALTH CENTER');
    		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
    
    
    		//set column name
    		$this->excel->getActiveSheet()->setCellValue('A2', 'No');
    		$this->excel->getActiveSheet()->setCellValue('B2', 'Nama Kategori');
    		$this->excel->getActiveSheet()->setCellValue('C2', 'Deskripsi Kategori');
    
			$this->excel->getActiveSheet()->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
    
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
      			$this->excel->getActiveSheet()->setCellValue('B' . $no, $v->paramediccategory_name);

      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('C' . $no, $v->paramediccategory_desc);

      			$no++;
      			$nomor++;
    		}
    
    		$this->excel->getActiveSheet()->getStyle('A2:C' . ($no - 1))->applyFromArray($styleArray);
    		ob_end_clean();
    		$filename = 'Daftar Profesi NaKes Aplikasi SN Health Center.xls'; //save our workbook as this file name
    		header('Content-Type: application/vnd.ms-excel'); //mime type
    		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
    		header('Cache-Control: max-age=0'); //no cache
    		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    		$objWriter->save('php://output');
   
    		redirect('admin/paramediccategory');
		}
	
	}



 ?>