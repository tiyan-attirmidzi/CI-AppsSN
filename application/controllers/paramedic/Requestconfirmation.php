<?php  

	class Requestconfirmation extends CI_Controller
	{
		
		function __construct()
		{
			error_reporting(0);
			parent::__construct();
			$this->load->model('model_transactiondetail');
			$this->load->model('model_transaction');
			$this->load->model('model_profile');
			$this->load->model('model_paramedic');
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
				$data["transaction"]        	  = $this->model_transaction->order_request($data['paramedic'][0]->paramediccategory_id, $data['paramedic'][0]->paramedic_id);

				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar_paramedic', $data);
				$this->load->view('paramedic/requestconfirmation', $data);
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
			$data['transactiondetail_status']			= 3;
			
			$paramediccategory_id						= $this->input->post('paramediccategory_id');
			$data2['packageteam_status']				= 1;

			$this->model_transactiondetail->update_conf2($data2, $id, $paramediccategory_id);
			
			$this->model_transactiondetail->update_conf($data, $id);
			$this->session->set_flashdata('notif_success','Transaksi Dengan Nomor <b>'.$id.'</b> Telah Diterima !');
	
			redirect('paramedic/requestconfirmation');
		}

		public function detail_view()
		{
			$id = base64_decode($this->input->get('transaction'));
			$id_detail = base64_decode($this->input->get('transactiondetail'));

			$this->data['key'] =  $this->model_transaction->check_transaction($id);
			if(!isset($this->data['key'][0]) || $this->data['key'][0] == "")
			{
				redirect('paramedic/requestconfirmation');
			} 
			else
			{
				$paramedic_id = $this->session->userdata('paramedic_id');

				$data['transaction']					= $this->model_transactiondetail->select_single($id);
				$data['paramedic'] 				  		= $this->model_paramedic->paramedic_track($paramedic_id);
				$data['company']  						= $this->model_profile->getcompany();
				
				#Generate Template...
				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar_paramedic', $data);
				$this->load->view('paramedic/transactiondetail', $data);
			}
		}
	}

?>