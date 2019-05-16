<?php  

	class Transactiondetail extends CI_Controller
	{
		
		function __construct()
		{
			// error_reporting(0);
			parent::__construct();
			$this->load->model('model_transactiondetail');
			$this->load->model('model_profile');
			$this->load->model('model_paramedic');
			if(!($this->session->userdata('paramedic_id')))
			{
				redirect('paramedic');
			}
		}

		public function confirmation($id)
		{
			$id_paramedic 		= $this->session->userdata('paramedic_id');

			#Generate Template...
			$data['transactiondetail'] 				= $this->model_transactiondetail->select_all('transaction_id', $id);
			$data['transaction']					= $this->model_transactiondetail->select_single($id);
			$data['company']  				  		= $this->model_profile->getcompany();
			$data['paramedic'] 				  		= $this->model_paramedic->paramedic_track($id_paramedic);
			  
	      	#Generate Template...
	      	$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/sidebar_paramedic', $data);
			$this->load->view('paramedic/transactiondetail', $data);
		
		}

		public function cancel($transactiondetail_id)
		{
			#Generate Template...
			$id										= $this->input->post('transaction_id');
			$data['transactiondetail_status']		= "2";
			$data['transactiondetail_statusnote']	= $this->input->post('transactiondetail_statusnote');

			$this->model_transactiondetail->update_cancel($data, $transactiondetail_id);

			redirect('transactiondetail/confirmation/'.$id);

		}

		public function accept($transactiondetail_id)
		{
			$id										= $this->input->post('transaction_id');
			$data['transactiondetail_status']		= "3";
			$data['transactiondetail_statusnote']	= $this->input->post('transactiondetail_statusnote');

			$this->model_transactiondetail->update_accept($data, $transactiondetail_id);

			redirect('transactiondetail/confirmation/'.$id);

		}

		public function success($transactiondetail_id)
		{
			#Generate Template...
			$id										= $this->input->post('transaction_id');
			$data['transactiondetail_status']		= "4";
			$data['transactiondetail_rate']			= $this->input->post('transactiondetail_rate');
			$data['transactiondetail_review']		= $this->input->post('transactiondetail_review');

			$data2['transaction_status']			= "2";

			$this->model_transactiondetail->update($data, $transactiondetail_id);
			$this->model_transactiondetail->update2($data2, $id);

			redirect('transactiondetail/confirmation/'.$id);

		}




	}

?>