<?php

class Document extends CI_Controller
	{
		function __construct()
		{
			parent:: __construct();

			$this->load->model('model_document');
			$this->load->model('model_paramedic');
			$this->load->model('model_profile');
			$this->load->model('model_district');
			$this->load->library('pagination');
			$this->load->library('excel');

			if(!($this->session->userdata('paramedic_id')))
			{
				$data['company']  					= $this->model_profile->getcompany();
				$this->load->view('paramedic/login', $data);
				// $this->load->view('maintenance');
			}
        }

        public function index()
		{
            $id = $this->session->userdata('paramedic_id');   

            if(!($this->session->userdata('paramedic_id')))
			{
				$data['company']  					= $this->model_profile->getcompany();
				$this->load->view('paramedic/login', $data);
				// $this->load->view('maintenance');
			}
			else
			{
				$data['paramedic'] 						= $this->model_paramedic->paramedic_track($id);
				$data['company']  						= $this->model_profile->getcompany();
				$data["document"]  	            		= $this->model_document->document_active();

				$this->load->view('tamplate/header', $data);
				$this->load->view('tamplate/topbar', $data);
				$this->load->view('tamplate/sidebar_paramedic', $data);
				$this->load->view('paramedic/document/content', $data);
			}
        }
    }

?>