<?php  

	class Model_profile extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
        }

        // Admin

        public function getadmin($id)
        {
            $query = $this->db->query("SELECT * FROM table_admin WHERE id_admin = '$id'");
		    return $query->result();
        }

        public function link_gambar_admin($id)
        {
            
            $this->db->where('id_admin',$id);
            $query = $getData = $this->db->get('table_admin');

            if($getData->num_rows() > 0)
            return $query;
            else
            return null;
                
        }

        public function edit($data) 
        {
            $this->db->update('table_admin', $data, array('id_admin'=>$data['id_admin']));
        }

        // Company

        public function getcompany()
        {
            $query = $this->db->query("SELECT * FROM table_company");
		    return $query->result();
        }

        public function edit_company($data) 
        {
            $this->db->update('table_company', $data, array('company_id'=>$data['company_id']));
        }

        public function link_gambar_company($id)
        {
            
            $this->db->where('company_id',$id);
            $query = $getData = $this->db->get('table_company');

            if($getData->num_rows() > 0)
            return $query;
            else
            return null;  
        }

        // patient
        public function getpatient($id)
        {
            $query = $this->db->query("SELECT * FROM table_patient WHERE patient_id = '$id'");
		    return $query->result();
        }

        public function edit_patient($data) 
        {
            $this->db->update('table_patient', $data, array('patient_id'=>$data['patient_id']));
        }

        public function link_gambar_patient($id)
        {
            
            $this->db->where('patient_id',$id);
            $query = $getData = $this->db->get('table_patient');

            if($getData->num_rows() > 0)
            return $query;
            else
            return null;       
        }

        // paramedic
        public function getparamedic($id)
        {
            $query = $this->db->query("SELECT * FROM table_paramedic WHERE paramedic_id = '$id'");
		    return $query->result();
        }
    }
?>