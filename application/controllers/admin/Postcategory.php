<?php 

	class Postcategory extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
			$this->load->model('model_postcategory');
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
				$this->session->unset_userdata('sess_search_postcategory');
      			$this->session->unset_userdata('sess_search_postcategory2');

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
				$config["base_url"]    = base_url() . "admin/postcategory/index/" . $limit;
				$config["total_rows"]  = $this->model_postcategory->record_count();
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
				$data["postcategory"]  	        = $this->model_postcategory->fetch_postcategory($config["per_page"], $page);
				$data["column"] 				= $this->model_postcategory->select_column_name($this->db->database);
				$data["links"]  				= $this->pagination->create_links();
				$data['admin']  				= $this->model_profile->getadmin($id_admin);
				$data['company']  				= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/postcategory', $data);
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
        			$this->session->set_userdata('sess_search_postcategory', $data['cari']);
        			$this->session->set_userdata('sess_search_postcategory2', $this->input->post('column_name'));
      			} 
      			else 
      			{
        			$data['cari'] = $this->session->userdata('sess_search_postcategory');
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
      			$config["base_url"]    = base_url() . "admin/postcategory/result/" . $limit . "/" . $data['cari'];
      			$config["total_rows"]  = $this->model_postcategory->record_count_search($data['cari'], $this->input->post('column_name'));
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
      			$data["postcategory"]   	    = $this->model_postcategory->fetch_postcategory_search($config["per_page"], $page, $data['cari'], $this->input->post('column_name'));
      			$data["column"] 				= $this->model_postcategory->select_column_name($this->db->database);
      			$data["links"]  				= $this->pagination->create_links();
				$data['admin']  				= $this->model_profile->getadmin($id_admin);
				$data['company']  				= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar', $data);
				$this->load->view('admin/postcategory', $data);
      
    		}
  		}

  		#Insert Data
  		public function input() 
  		{
    		#get data
    		$data['postcategory_id']       			= "";
    		$data['postcategory_name']     			= $this->input->post('postcategory_name');

    		#call function input from model
    		$this->model_postcategory->input($data);
            $this->session->set_flashdata('notif_postcategory','Kategori <b> '.$data['postcategory_name'].' </b> Berhasil Di Tambah !');
            #redirect to page
    		redirect('admin/postcategory');
  		}

  		#Update Data
  		public function edit() 
  		{
    		#get data
    		$data['postcategory_id']       			= $this->input->post('postcategory_id');
    		$data['postcategory_name']     			= $this->input->post('postcategory_name');

    		#call function input from model
            $this->model_postcategory->edit($data);
            $this->session->set_flashdata('notif_postcategory','Kategori <b> '.$data['postcategory_name'].' </b> Berhasil Di Ubah !');            
    		#redirect to page
    		redirect('admin/postcategory');
  		}

  		 #Delete Data
 	 	public function delete() 
 	 	{
    		$data['postcategory_name']     			= $this->input->post('postcategory_name');
            $this->model_postcategory->delete($this->input->post('postcategory_id'));
            $this->session->set_flashdata('notif_postcategory','Kategori <b> '.$data['postcategory_name'].' </b> Berhasil Di Hapus !');            
    		redirect('admin/postcategory');
        }
          
        #Export Data
  		public function export() 
  		{
    		$data = $this->model_postcategory->export();
    		#load PHPExcel library
    		$this->excel->setActiveSheetIndex(0);
    		#name the worksheet
    		$this->excel->getActiveSheet()->setTitle('Kategori Post SN Health Care');
    
    		#STYLING
    		$styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '0000'))));
    
    		#set report header
    		$this->excel->getActiveSheet()->getStyle('B:C')->getFont()->setName('Times New Roman');
    		$this->excel->getActiveSheet()->mergeCells('B3:C4');
    		$this->excel->getActiveSheet()->setCellValue('B3', 'DAFTAR KATEGORI POST APLIKASI SN HEALTH CARE ');
    		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);       
            $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(12);
            
    
    
    		//set column name
            $this->excel->getActiveSheet()->setCellValue('B5', 'NO');
            $this->excel->getActiveSheet()->setCellValue('C5', 'Nama Kategori');
    		$this->excel->getActiveSheet()->getStyle('B5')->getFont()->setBold(true);
    		$this->excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);            
    
            $this->excel->getActiveSheet()->getStyle('B5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
            
    		$no    = 6;
    		$nomor = 1;
    		foreach ($data as $v) 
    		{
      			
      			$this->excel->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('B' . $no, $nomor);

      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setWrapText(true);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      			$this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      			$this->excel->getActiveSheet()->setCellValue('C' . $no, $v->postcategory_name);
				
				$no++;
      			$nomor++;
    		}
    
    		$this->excel->getActiveSheet()->getStyle('B5:C' . ($no - 1))->applyFromArray($styleArray);
    		ob_end_clean();
    		$filename = 'Kategori Post.xls'; //save our workbook as this file name
    		header('Content-Type: application/vnd.ms-excel'); //mime type
    		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
    		header('Cache-Control: max-age=0'); //no cache
    		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    		$objWriter->save('php://output');
   
    		redirect('admin/postcategory');
  		}
	
	}



 ?>
 