<?php  

	class Model_patient extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		#Get Column Name
		public function select_column_name($db)
		{
			$query = $this->db->query("	SELECT COLUMN_NAME
                              			FROM INFORMATION_SCHEMA.COLUMNS
                              			WHERE TABLE_SCHEMA='$db' AND TABLE_NAME='table_patient'");
    		return $query->result();
		}

	  	#Count Patient
		public function record_count() 
		{
		    return $this->db->count_all("table_patient");
		}

		#get data for edit
		public function get_edit($id) 
		{
			$this->db->where('patient_id', $id);
			$query = $this->db->get('table_patient', 1);
			return $query->result_array();
		}

		#get data for order
		public function check($ktp) 
		{
			$this->db->where('patient_noktp',$ktp);
			$query = $getData = $this->db->get('table_patient');
	
			return $query;
		}
		#Show Data Patient By ID
		public function get_patient($ktp)
		{
			$query = $this->db->query("SELECT * FROM table_patient WHERE patient_noktp = '$ktp'");
		    return $query->result();
		}

		#Show All Data Patient
		public function fetch_patient($limit, $start) 
		{
		    $this->db->select('*');
			$this->db->from('table_patient');
			$this->db->order_by("patient_name","asc");
		    $this->db->limit($limit, $start);
		    $query = $this->db->get();

		    if ($query->num_rows() > 0) 
		    {
		      	foreach ($query->result() as $row) 
		      	{
		        	$data[] = $row;
		    	}
		      	return $data;
		    }
		    return false;
		}

		#Show All Data District
		public function fetch_district()
		{
			$query = $this->db->query('SELECT * FROM table_district');

            foreach ($query->result() as $row)
            {
                // echo $row->district_name;
                $data[] = $row;
            }
            return $data;
		}

		#Count Data Search 
		public function record_count_search($key, $column_name) 
		{
		    if ($column_name == "") 
		    {
		      	$this->db->like("patient_name", $key);
		      	$this->db->or_like("patient_email", $key);
		      	$this->db->or_like("patient_status", $key);
				$this->db->or_like("patient_sex", $key);
				$this->db->or_like("patient_phone", $key);
				$this->db->or_like("patient_address", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_patient");
		}

		#Show Data Search
		public function fetch_patient_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
			$this->db->from('table_patient');
			$this->db->order_by("patient_name","asc");
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("patient_name", $key);
		      	$this->db->or_like("patient_email", $key);
		      	$this->db->or_like("patient_status", $key);
				$this->db->or_like("patient_sex", $key);
				$this->db->or_like("patient_phone", $key);
				$this->db->or_like("patient_address", $key);
		      	
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    
		    $this->db->limit($limit, $start);
		    $query = $this->db->get();
		    
		    if ($query->num_rows() > 0) 
		    {
		      	foreach ($query->result() as $row) 
		      	{
		        	$data[] = $row;
		      	}
		      	return $data;
		    }
		    return null;
		}

		#Search Name Image Patient
		public function link_gambar($id)
        {
            
            $this->db->where('patient_id',$id);
            $query = $getData = $this->db->get('table_patient');

            if($getData->num_rows() > 0)
            return $query;
            else
            return null;   
		}

		#Check Email Address 
		public function email_address($email)
        {
            
            $this->db->where('patient_email',$email);
            $query = $getData = $this->db->get('table_patient');

			return $query;
		}
		
		#Show Data Patient By ID
		public function patient_track($id)
		{
			$query = $this->db->query("SELECT * FROM table_patient WHERE patient_id = '$id'");
		    return $query->result();
		}

		#Insert Data
  		public function input($data) 
  		{
   	 		#insert data
    		$this->db->insert('table_patient', $data);
  		}
  
  		#Update Data By ID 
  		public function edit($data) 
  		{
    		#update data
    		$this->db->update('table_patient', $data, array('patient_id' => $data['patient_id']));
  		}
  
  		#Delete Data By ID 
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_patient', array('patient_id' => $id));
		}
		  
		#Export Data
		public function export() 
		{
		    $query = $this->db->query("	SELECT * 
										FROM table_patient 
										ORDER BY patient_name ASC");
		    return $query->result();
	  	}

	}

?>