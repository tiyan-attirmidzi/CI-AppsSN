<?php  

	class Transactiondetail extends CI_Controller
	{
		
		function __construct()
		{
			// error_reporting(0);
			parent::__construct();
			$this->load->model('model_transactiondetail');
			$this->load->model('model_profile');
			$this->load->model('model_patient');

			if(!($this->session->userdata('patient_id')))
			{
				redirect('patient');
			}
		}

		public function feedback_accept()
		{
			$transaction_id								= $this->input->post('transaction_id');
			$transactiondetail_id						= $this->input->post('transactiondetail_id');

			$data['transactiondetail_status']			= "4";
			$data['transactiondetail_rate']				= $this->input->post('transactiondetail_rate');
			$data['transactiondetail_review']			= $this->input->post('transactiondetail_review');
			$data['transactiondetail_whilestatus']		= "1";

			$this->model_transactiondetail->update_feed($data, $transactiondetail_id);
			
			$detail_status								= $this->model_transactiondetail->check_detailstatus($this->input->post('transaction_id'));
			$abc										= 0;
			$efg										= count($detail_status);
			foreach ($detail_status as $key) 
			{
				if($key->transactiondetail_whilestatus == 1)
				{
					$abc = $abc + 1;
				} 
			}

			if($efg == $abc)
			{
				$data2['transaction_status']			= "2";
			}

			$this->model_transactiondetail->update_feed2($data2, $transaction_id);

			redirect('patient/transaction/detail_view?transaction_id='.$transaction_id);

		}




	}

?>