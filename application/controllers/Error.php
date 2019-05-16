<?php  

	class Home extends CI_Controller
	{
		
		function __construct()
		{
            parent::__construct();
        }

        public function error404()
        {
            $this->load->view('error404');
        }

    }

?>