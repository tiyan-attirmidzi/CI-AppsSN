<?php 	 

	class Model_login extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		public function login($data)
		{
			$this->db->where('username_admin', $data['username_admin']);
			$this->db->where('password_admin', $data['password_admin']);
			return $this->db->get('table_admin')->row();
		}

		public function login_patient($data)
		{
			$this->db->where('user_email', $data['user_email']);
			$this->db->where('user_password', $data['user_password']);
			// $this->db->where('patient_status', '1');
			return $this->db->get('table_user')->row();
		}

		public function login_paramedic($data)
		{
			$this->db->where('paramedic_email', $data['paramedic_email']);
			$this->db->where('paramedic_password', $data['paramedic_password']);
			return $this->db->get('table_paramedic')->row();
		}

		public function reset_nakes($email)
        {
            $this->db->where('paramedic_email',$email);
            $query = $getData = $this->db->get('table_paramedic');

			return $query;
		}

		public function reset_user($email)
        {
            $this->db->where('user_email',$email);
            $query = $getData = $this->db->get('table_user');

			return $query;
		}

		public function get_user($email)
		{
			$query = $this->db->query("SELECT * FROM table_user WHERE user_email = '$email'");
		    return $query->result();
		}

		function __destruct()
		{
			$this->db->close();
		}
	}
		


?>