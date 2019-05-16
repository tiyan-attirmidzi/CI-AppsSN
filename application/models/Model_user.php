<?php  

	class Model_user extends CI_Model
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
                              			WHERE TABLE_SCHEMA='$db' AND TABLE_NAME='table_user'");
    		return $query->result();
		}

	  	#Count Patient
		public function record_count() 
		{
		    return $this->db->count_all("table_user");
		}

		#Show All Data Patient
		public function fetch_user($limit, $start) 
		{
		    $this->db->select('*');
			$this->db->from('table_user');
			$this->db->order_by("user_name","asc");
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

		#Count Data Search 
		public function record_count_search($key, $column_name) 
		{
		    if ($column_name == "") 
		    {
		      	$this->db->like("user_name", $key);
		      	$this->db->or_like("user_email", $key);
		      	$this->db->or_like("user_status", $key);
				$this->db->or_like("user_sex", $key);
				$this->db->or_like("user_phone", $key);
				$this->db->or_like("user_address", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_user");
		}

		#Show Data Search
		public function fetch_user_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
			$this->db->from('table_user');
			$this->db->order_by("user_name","asc");
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("user_name", $key);
		      	$this->db->or_like("user_email", $key);
		      	$this->db->or_like("user_status", $key);
				$this->db->or_like("user_sex", $key);
				$this->db->or_like("user_phone", $key);
				$this->db->or_like("user_address", $key);
		      	
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

		#Search Name Image user
		public function link_gambar($id)
        {
            
            $this->db->where('user_id',$id);
            $query = $getData = $this->db->get('table_user');

            if($getData->num_rows() > 0)
            return $query;
            else
            return null;   
		}

		#Check Email Address 
		public function email_address($email)
        {
            
            $this->db->where('user_email',$email);
            $query = $getData = $this->db->get('table_user');

			return $query;
		}

		#get data for edit
		public function get_edit($id) 
		{
			$this->db->where('user_id', $id);
			$query = $this->db->get('table_user', 1);
			return $query->result_array();
		}
		
		#Show Data user By ID
		public function user_track($id)
		{
			$query = $this->db->query("SELECT * FROM table_user WHERE user_id = '$id'");
		    return $query->result();
		}

		#Insert Data
  		public function input($data) 
  		{
   	 		#insert data
    		$this->db->insert('table_user', $data);
  		}
  
  		#Update Data By ID 
  		public function edit($data) 
  		{
    		#update data
    		$this->db->update('table_user', $data, array('user_id' => $data['user_id']));
  		}
  
  		#Delete Data By ID 
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_user', array('user_id' => $id));
		}
		  
		#Export Data
		public function export() 
		{
		    $query = $this->db->query("	SELECT * 
										FROM table_user a, table_district b
										WHERE a.district_id = b.district_id
										ORDER BY user_name ASC");
		    return $query->result();
	  	}

	}

?>