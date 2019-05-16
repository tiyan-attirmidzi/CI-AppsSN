<?php  

	class Transactiondetail extends CI_Controller
	{
		
		function __construct()
		{
			// error_reporting(0);
			parent::__construct();
			$this->load->model('model_transactiondetail');
			$this->load->model('model_profile');

			if(!($this->session->userdata('id_admin')))
			{
				redirect('admin');
			}
		}

		public function confirmation($id)
		{

			$id_admin = $this->session->userdata('id_admin');

			#Generate Template...
			$data['transactiondetail'] 				= $this->model_transactiondetail->select_all('transaction_id', $id);
			$data['transaction']					= $this->model_transactiondetail->select_single($id);
			$data['admin']  						= $this->model_profile->getadmin($id_admin);	
			$data['company']  						= $this->model_profile->getcompany();
				
			#Generate Template...
			$this->load->view('tamplate/header', $data);
			$this->load->view('tamplate/sidebar', $data);
			$this->load->view('admin/transactiondetail', $data);
		
		}

		public function cancel($transactiondetail_id)
		{
			#Generate Template...
			$id										= $this->input->post('transaction_id');
			$data['transactiondetail_status']		= "2";
			$data['transactiondetail_statusnote']	= $this->input->post('transactiondetail_statusnote');

			$this->model_transactiondetail->update_cancel($data, $transactiondetail_id);

			redirect('admin/transactiondetail/confirmation/'.$id);

		}

		public function accept($transactiondetail_id)
		{
			$id										= $this->input->post('transaction_id');
			$data['transactiondetail_status']		= "3";
			$data['transactiondetail_statusnote']	= $this->input->post('transactiondetail_statusnote');

			$this->model_transactiondetail->update_accept($data, $transactiondetail_id);

			redirect('admin/transactiondetail/confirmation/'.$id);

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

			redirect('admin/transactiondetail/confirmation/'.$id);

		}




	}

?>