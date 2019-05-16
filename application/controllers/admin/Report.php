<?php  

	class Report extends CI_Controller
	{
		
		function __construct()
		{
			error_reporting(0);
			parent::__construct();
			$this->load->model('model_transaction');
			$this->load->model('model_transactiondetail');
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
			  
          	$id_admin = $this->session->userdata('id_admin');
	      	
			$data['admin']  						= $this->model_profile->getadmin($id_admin);
			$data['company']  						= $this->model_profile->getcompany();
				
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/sidebar', $data);
			$this->load->view('admin/report', $data);
		
		}

		public function input() 
		{
			$data2['transaction_id']					= "trx".date('YmdHis').rand(100000,999999);
			$data2['transaction_code']					= "trxcd".date('YmdHis').rand(100000,999999);
			$pricetotalall = 0;
			$a = count($this->input->post('package_id'));
			for ($i=0; $i < $a; $i++) 
			{ 
				$data['transactiondetail_id']			= "trxdtl".date('YmdHis').rand(100000,999999);
				$data['package_id']         	    	= $this->input->post('package_id')[$i];
				$data['package_amount']					= $this->input->post('qty')[$i];

				$get									= $this->model_transaction->getdata($data['package_id']);

				
				$data['transaction_id']					= $data2['transaction_id'];
				$data['package_pricetotal']				= $get[0]->package_price * $data['package_amount'];
				
				$pricetotalall							= $pricetotalall + $data['package_pricetotal'];
				
				$data['transactiondetail_status']		= "1";
				$data['transactiondetail_rate']			= "";
				$data['transactiondetail_review']		= "";

				$data3['package_id']					= $this->input->post('package_id')[$i];
				
				$get_packageparamediccategory			= $this->model_transaction->get_packageparamediccategory($data3['package_id']);
				$packageparamediccategory				= $get_packageparamediccategory[0]->paramediccategory_id;
				$get_paramedic 							= $this->model_transaction->get_paramedic($packageparamediccategory);

				$data3['packageteam_id']				= "packteam".date('YmdHis').rand(100000,999999);
				$data3['paramedic_id']					= $get_paramedic[0]->paramedic_id;
				$data3['transactiondetail_id']			= $data['transactiondetail_id'];

				$this->model_transaction->input($data);
				$this->model_transaction->input3($data3);
			}
			
			$data2['patient_id'] 						= $this->input->post('patient_id');
			$data2['transaction_arrangementdate'] 		= $this->input->post('transaction_arrangementdate');
			$data2['transaction_total'] 				= $pricetotalall;
			$data2['transaction_note'] 					= $this->input->post('transaction_note');
			$data2['transaction_status'] 				= "1";
			
			$this->model_transaction->input2($data2);
			
			// $get_districtpatient						= $this->model_transaction->get_districtpatient($data2['patient_id']);
			// $district_patient							= $get_districtpatient[0]->district_id;
			// $get_districtparamedic						= $this->model_transaction->get_districtparamedic($district_patient);
			// $data3['paramedic_id']						= $get_districtparamedic[0]->paramedic_id;

			#redirect to page
    		redirect('admin/orderrequest');
		}
		  
		#Delete Data
		public function delete() 
		{	
			$id = $this->input->post('transaction_id');
			$this->model_transaction->delete($id);
			$this->model_transactiondetail->delete($id);
			redirect('admin/orderrequest');
        }
        
        public function cetak()
        {
            $this->load->library('excel');
            $tgl=$this->input->post('tahun')."-".$this->input->post('bulan')."-".$this->input->post('tanggal');
            $value = $this->model_transaction->print_transaction($tgl);
            $this->excel->setActiveSheetIndex(0);
            // nama file
            $this->excel->getActiveSheet()->setTitle('Laporan Rekap Transaksi');
            
            //STYLING
            $styleArray = array(
              'borders' => array(
                'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN,
                  'color' => array(
                    'argb' => '0000'
                  )
                )
              )
            );
            
            //header
            //set report header
            //$no = 1;
            $this->excel->getActiveSheet()->getStyle('A:F')->getFont()->setName('Times New Roman');
            $this->excel->getActiveSheet()->mergeCells('A1:F1');
            $this->excel->getActiveSheet()->setCellValue('A1', 'LAPORAN REKAP HISTORI PEMESANAN');
            $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
            
            
            //set column name
            $this->excel->getActiveSheet()->setCellValue('A2', 'No');
            $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->setCellValue('B2', 'Kode Trx');
            $this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->setCellValue('C2', 'Nama Pasien');
            $this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->setCellValue('D2', 'Waktu Perjanjian');
            $this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->setCellValue('E2', 'status');
            $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->setCellValue('F2', 'Total');
            $this->excel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);
            
            $this->excel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
            //$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
            $no    = 3;
            $nomor = 1;
            //$total = 0;
            foreach ($value as $v) {
                if($v->transaction_status==1)
                {
                    $status= "Proses";
                }
                elseif($v->transaction_status==2)
                {
                    $status= "Berhasil";
                }
              
              $this->excel->getActiveSheet()->getStyle('A' . $no)->getAlignment()->setWrapText(true);
              $this->excel->getActiveSheet()->getStyle('A' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('A' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->setCellValue('A' . $no, $nomor);
              $this->excel->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setWrapText(true);
              $this->excel->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->setCellValue('B' . $no, $v->transaction_code);
              $this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setWrapText(true);
              $this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->setCellValue('C' . $no, $v->patient_name);
              $this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setWrapText(true);
              $this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->excel->getActiveSheet()->getStyle('D' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->setCellValue('D' . $no, $v->transaction_date);
              $this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setWrapText(true);
              $this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('E' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->setCellValue('E' . $no, $status);
              $this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setWrapText(true);
              $this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->excel->getActiveSheet()->getStyle('F' . $no)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->setCellValue('F' . $no, "Rp. ".number_format(($v->transaction_total),0,',','.'));
              
              
              $no++;
              $nomor++;
            }
            

            $this->excel->getActiveSheet()->getStyle('A2:F' . ($no-1))->applyFromArray($styleArray);
            
            ob_end_clean();
            $filename = 'Laporan Pemesanan Paramedic SN Alkobar.xls'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            
            //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
            //if you want to save it as .XLSX Excel 2007 format
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            
            $objWriter->save('php://output');
        }

	}

?>