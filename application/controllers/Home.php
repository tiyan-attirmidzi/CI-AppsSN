<?php  

	class Home extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('model_paramedic');
			$this->load->model('model_service');
			$this->load->model('model_post');
			$this->load->model('model_profile');
			$this->load->model('model_district');
			$this->load->model('model_paramediccategory');
		}

		public function index()
		{
			$data["service"]				= $this->model_service->get_service();
			$data["district"] 				= $this->model_district->getdistrict();
			$data["post"] 					= $this->model_post->fetch_postblog();
			$data["paramediccategory"]  	= $this->model_paramediccategory->get_paramediccategory();

			$this->load->view('home', $data);
		}

		public function blog(){
			$data["service"]				= $this->model_service->get_service();
			$data["district"] 				= $this->model_district->getdistrict();
      		$data["paramediccategory"]  	= $this->model_paramediccategory->get_paramediccategory();
			$data['company']  				= $this->model_profile->getcompany();
			$data['blog'] = $this->model_post->get_blog($this->uri->segment(3));
			$this->load->view('blog', $data); 
		}

		public function service(){
			$data["service"]				= $this->model_service->get_service();
			$data["district"] 				= $this->model_district->getdistrict();
     		$data["paramediccategory"]  	= $this->model_paramediccategory->get_paramediccategory();
			$data['company']  				= $this->model_profile->getcompany();
			$data['layanan'] = $this->model_service->get_service_detail($this->uri->segment(3));
			$this->load->view('layanan', $data); 
		}

	}


?>