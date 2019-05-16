 <?php  

	class Visitingstage extends CI_Controller
	{
		
		function __construct()
		{
			error_reporting(0);
			parent::__construct();
			$this->load->model('model_transactiondetail');
			$this->load->model('model_transaction');
			$this->load->model('model_profile');
			$this->load->model('model_paramedic');
			$this->load->model('model_package');
			$this->load->library('pagination');
			
			if(!($this->session->userdata('paramedic_id')))
			{
				redirect('paramedic');
			}
		}

		public function index()
		{
			$id 	= $this->session->userdata('paramedic_id');

			if(!($this->session->userdata('paramedic_id')))
			{
				redirect('paramedic');
			}
			else
			{
				$data['paramedic'] 				  = $this->model_paramedic->paramedic_track($id);
				$data['company']  				  = $this->model_profile->getcompany(); 
				$data["transaction"]        	  = $this->model_transaction->visiting_stage($data['paramedic'][0]->paramedic_id);

				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar_paramedic', $data);
				$this->load->view('paramedic/visitingstage', $data);
			}
		}

		public function confirmation_cancel()
		{
			$id											= $this->input->post('transactiondetail_id');
			$data['transactiondetail_statusnote']		= $this->input->post('transactiondetail_statusnote');
			$data['transactiondetail_status']			= "2";

			$package_id									= $this->input->post('package_id');
			$paramediccategory_id						= $this->input->post('paramediccategory_id');
			$data2['paramedic_id']						= $this->input->post('paramedic_id');

			$this->model_transactiondetail->update_conf($data, $id);
			$this->model_transactiondetail->update_conf2($data2, $id, $package_id, $paramediccategory_id);
			$this->session->set_flashdata('notif_success','Transaksi Dengan Nomor <b>'.$id.'</b> Telah Ditolak !');
	
			redirect('paramedic/requestconfirmation');
		}
		
		public function confirmation_request() 
		{
			$id											= $this->input->post('transactiondetail_id');
			$data['transactiondetail_statusnote']		= $this->input->post('transactiondetail_statusnote');
			
			$paramediccategory_id						= $this->input->post('paramediccategory_id');
			$data2['paramedic_id']						= $this->input->post('paramedic_id');
			$data2['packageteam_status']				= "1";

			$this->model_transactiondetail->update_conf2($data2, $id, $paramediccategory_id);
			
			$data['transactiondetail_status']			= "3";
			
			$this->model_transactiondetail->update_conf($data, $id);
			$this->session->set_flashdata('notif_success','Transaksi Dengan Nomor <b>'.$id.'</b> Telah Diterima !');
	
			redirect('paramedic/requestconfirmation');
		}

		public function detail_view()
		{
			$transaction_id = base64_decode($this->input->get('transaction'));
			$id_detail = $this->input->get('transactiondetail_id');

			$this->data['key'] =  $this->model_transaction->check_transaction($transaction_id);
			if(!isset($this->data['key'][0]) || $this->data['key'][0] == "")
			{
				redirect('paramedic/visitingstage');
			} 

			$paramedic_id = $this->session->userdata('paramedic_id');

			$data['paramedic'] 				  		= $this->model_paramedic->paramedic_track($paramedic_id);
			$data["transactiondetail"]        	  	= $this->model_transaction->visiting_stage_history($data['paramedic'][0]->paramedic_id, $transaction_id);
			$data["transaction"]        	  		= $this->model_transaction->visiting_stage_detail($data['paramedic'][0]->paramedic_id, $transaction_id);
			$data['company']  						= $this->model_profile->getcompany();
			
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/topbar', $data);
			$this->load->view('tamplate/sidebar_paramedic', $data);
			$this->load->view('paramedic/transactiondetail', $data);
		}

		public function examination()
		{
			$service_id								= base64_decode($this->input->get('service'));
			$transaction_id							= base64_decode($this->input->get('transaction'));
			$paramedic_id 							= $this->session->userdata('paramedic_id');

			$data['paramedic'] 				  		= $this->model_paramedic->paramedic_track($paramedic_id);
			$data['package']						= $this->model_package->get_package($service_id);
			$data['company']  						= $this->model_profile->getcompany();
			$data["transaction"]        	  		= $this->model_transaction->visiting_stage_detail($data['paramedic'][0]->paramedic_id, $transaction_id);
			$data["transactiondetail"]        	  	= $this->model_transaction->visiting_stage_history2($data['paramedic'][0]->paramedic_id, $transaction_id);

			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/topbar', $data);
			$this->load->view('tamplate/sidebar_paramedic', $data);
			$this->load->view('paramedic/examination', $data);
		}

		public function insert()
		{
			$total													= 0;
			$service_id												= $this->input->post('service_id');
			$paramedic_id											= $this->input->post('paramedic_id');
			$transaction_id											= $this->input->post('transaction_id');
			$transaction_total										= $this->input->post('transaction_total');
			$paramediccategory_id									= $this->input->post('paramediccategory_id');
			$transactiondetail_id									= $this->input->post('transactiondetail_id');
			$transactiondetail_visitdate							= $this->input->post('transactiondetail_visitdate');
			$transactiondetail_locationvisit						= $this->input->post('transactiondetail_locationvisit');

			#transaction Detail
			$data['transactiondetail_id']							= $transactiondetail_id;
			$data['package_id']										= $this->input->post('package_id')[0];
			$data['package_amount']									= 1;
			$package_price											= $this->model_package->get_packageprice($data['package_id']);
			$data['package_pricetotal']								= $package_price[0]->package_price * $data['package_amount'];
			$data['transactiondetail_status']						= 4;

			$this->model_transaction->update2($data);			

			#packageteam
			$data2['transactiondetail_id']							= $transactiondetail_id;
			$data2['package_id']									= $data['package_id'];

			$this->model_transaction->update3($data2);			

			$package												= count($this->input->post('package_id'));

			if($package > 1)
			{
				for ($i=1; $i < $package; $i++) 
				{ 
					#transactiondetail
					$data3['transactiondetail_id']					= "trxdtl".date('YmdHis').rand(100000,999999);
					$data3['transaction_id']						= $transaction_id;
					$data3['package_id']							= $this->input->post('package_id')[$i];
					$data3['package_amount']						= 1;
					$package_price2									= $this->model_package->get_packageprice($data3['package_id']);
					$data3['package_pricetotal']					= $package_price2[0]->package_price * $data3['package_amount'];
					$data3['transactiondetail_status']				= 4;
                    $data3['transactiondetail_rate']			    = "";
					$data3['transactiondetail_review']		    	= "";
					$data3['transactiondetail_locationvisit']		= $transactiondetail_locationvisit; 
					$data3['transactiondetail_visitdate']			= $transactiondetail_visitdate; 
					$total											= $total + $data3['package_pricetotal'];

					$this->model_transaction->input($data3);

					$data4['packageteam_id']				    = "";
                    $data4['service_id']					    = $service_id; 
                    $data4['package_id']					    = $data3['package_id']; 
                    $data4['paramediccategory_id']			    = $paramediccategory_id;
                    $data4['paramedic_id']					    = $paramedic_id; 
                    $data4['transactiondetail_id']			    = $data3['transactiondetail_id'];
					$data4['packageteam_status']			    = 1;
					
					$this->model_transaction->input3($data4);
				}
			}
			
			$data5['transaction_id']								= $transaction_id;
			$data5['transaction_total']								= $data['package_pricetotal'] + $total + $transaction_total;

			$this->model_transaction->update($data5);

			if($this->input->post('examination_status') == 1)
			{
				$data6['transaction_id']						= $transaction_id;
				$data6['transactiondetail_id']			    	= "trxdtl".date('YmdHis').rand(100000,999999);
				$data6['package_id']							= 0;
				$data6['package_amount']						= 0;
				$data6['package_pricetotal']					= 0;
				$data6['transactiondetail_status']		    	= 3;
				$data6['transactiondetail_rate']			    = "";
				$data6['transactiondetail_review']		    	= "";
				$data6['transactiondetail_locationvisit']		= $transactiondetail_locationvisit; 
				$data6['transactiondetail_visitdate']			= $this->input->post('transactiondetail_nextvisitdate'); 

				$this->model_transaction->input($data6);

				$data7['packageteam_id']				    	= "";
				$data7['service_id']					    	= $service_id; 
				$data7['package_id']					    	= 0; 
				$data7['paramediccategory_id']			    	= $paramediccategory_id;
				$data7['paramedic_id']					    	= $paramedic_id; 
				$data7['transactiondetail_id']			    	= $data6['transactiondetail_id'];
				$data7['packageteam_status']			    	= 1;

				$this->model_transaction->input3($data7);
			}
			else
			{
				$data8['transaction_id']						= $transaction_id;
				$data8['transaction_status']					= "2";

				$this->model_transaction->update($data8);
			}
			
			$this->session->set_flashdata('notif_success','Terima Kasih Telah Melayani Dengan Sepenuh Hati');
			redirect('paramedic/visitingstage');
		}

		public function invoice_print()
		{
			$transaction_id 	= base64_decode($this->input->get('transaction'));
			$service_id			= base64_decode($this->input->get('service'));
			$date				= base64_decode($this->input->get('date'));

			$paramedic			= $this->model_paramedic->paramedic_track($this->session->userdata('paramedic_id'));

			include './assets/plugins-new/docxtemplate.class.php';
			include './assets/plugins-new/fungsi_indotgl.php';
		
			// Perawatan Luka
			if($service_id == 19)
			{
				
				$x 				= $this->model_transaction->get_print($transaction_id, $date);
				$y				= $this->model_transaction->get_printDatapatient($transaction_id);
				$url			= './assets/invoice/package_perawatanluka.docx';
				$docx 			= new DOCXTemplate($url);
				$tanggal_visit	= explode(" ",$x[0]->transactiondetail_visitdate);

				
				$tanggal 		= new DateTime($y[0]->patient_datebirth);
				$today 			= new DateTime('today');
				$usia			= $today->diff($tanggal)->y;

				$docx->set('recapmedic.nmr', 'RM-'.date('YmdHis').rand(100000,999999));
				$docx->set('patient.name', $y[0]->patient_name);
				$docx->set('patient.sex', $y[0]->patient_sex);
				$docx->set('patient.datebirth', $usia.' Tahun');
				$docx->set('location.visit', $x[0]->transactiondetail_locationvisit);
				$docx->set('transactiondetail.visitdate', tgl_indo($tanggal_visit[0]));
				$docx->set('paramedic.name', $paramedic[0]->paramedic_name);
				$docx->set('package1', $x[0]->package_name);
				$docx->set('price1', '1');
				$docx->set('subtotal1', $x[0]->package_price);

				if(count($x) > 1)
				{
					$docx->set('package2', $x[1]->package_name);
					$docx->set('price2', '1');
					$docx->set('subtotal2', $x[1]->package_price);
					$docx->set('overall.total', $x[0]->package_price + $x[1]->package_price);
				}
				else
				{
					$docx->set('package2', '-');
					$docx->set('price2', '-');
					$docx->set('subtotal2', '-');
					$docx->set('overall.total', $x[0]->package_price);
				}

				
				
				$docx->saveAs('./assets/invoice/invoice-'.$y[0]->patient_name.'-'.$date.'.docx');
				header("Content-Type:application/msword");
				header("Content-Disposition:attachment;filename=".'invoice-'.$y[0]->patient_name.'-'.$date.".docx");
				readfile('./assets/invoice/invoice-'.$y[0]->patient_name.'-'.$date.'.docx');
				unlink('./assets/invoice/invoice-'.$y[0]->patient_name.'-'.$date.'.docx');
			}
		}
	}

?>