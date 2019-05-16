<?php  

	class Model_widget extends CI_Model
	{
			
		function __construct()
		{
			parent::__construct();
		}

		public function paramedic()
		{
			return $this->db->count_all("table_paramedic");
		}

		public function patient()
		{
			return $this->db->count_all("table_patient");
		}

		public function service()
		{
			return $this->db->count_all("table_service");
		}

		public function district()
		{
			return $this->db->count_all("table_district");
		}

		public function transaction()
		{
			return $this->db->count_all("table_transaction");
		}

		public function package()
		{
			return $this->db->count_all("table_package");
		}

		public function post()
		{
			return $this->db->count_all("table_post");
		}

		public function user()
		{
			return $this->db->count_all("table_user");
		}
	}



?>