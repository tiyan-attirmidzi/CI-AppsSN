<?php  

	class Model_service extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function rekapservice()
		{
			$query = $this->db->query('	SELECT * 
										FROM table_service 
										ORDER BY service_name ASC
									');

            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
		}

		#Get Column Name
		public function select_column_name($db)
		{
			$query = $this->db->query("	SELECT COLUMN_NAME
                              			FROM INFORMATION_SCHEMA.COLUMNS
                              			WHERE TABLE_SCHEMA='$db' and TABLE_NAME='table_service'");
    		return $query->result();
		}

		public function get_service()
		{
			$query = $this->db->query('SELECT * FROM table_service ORDER BY service_name ASC');

            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
		}

		public function get_service_order()
		{
			$query = $this->db->query('SELECT * FROM table_service WHERE service_status = 1 ORDER BY service_name ASC');

            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
		}

		#Get ID For Edit
		public function get_edit($id) 
		{
			$this->db->where('service_id', $id);
			$query = $this->db->get('table_service', 1);
			return $query->result_array();
		}

		#Tampilkan data post category
		public function fetch_servicecategory()
		{
			$query = $this->db->query('SELECT * FROM table_servicecategory');

			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		
	  	#Count All Service
		public function record_count() 
		{
		    return $this->db->count_all("table_service");
		}

		#Get All Data Service
		public function fetch_service($limit, $start) 
		{
		    $this->db->select('*');
		    $this->db->from('table_service');
		    // $this->db->from('table_service , table_paramediccategory');
		    // $this->db->where('table_service.paramediccategory_id = table_paramediccategory.paramediccategory_id');
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

		#search Name Image
		public function link_gambar($id)
        {
            $this->db->where('service_id',$id);
            $query = $getData = $this->db->get('table_service');

            if($getData->num_rows() > 0)
            	return $query;
            else
            	return null;
                
		}

		#Count Data Search
		public function record_count_search($key, $column_name) 
		{
		    if ($column_name == "") 
		    {
		      	$this->db->like("service_name", $key);
		      	$this->db->or_like("service_desc", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_service");
		}

		#Get Data Search
		public function fetch_service_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
		    $this->db->from('table_service');
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("service_name", $key);
		      	$this->db->or_like("service_desc", $key);
		      	
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

		#Insert Data
  		public function input($data) 
  		{
    		$this->db->insert('table_service', $data);
  		}
  
  		#Edit Data By ID
  		public function edit($data) 
  		{
    		$this->db->update('table_service', $data, array('service_id' => $data['service_id']));
  		}
  
  		#Delete Data By ID
  		public function delete($id) 
  		{
    		$this->db->delete('table_service', array('service_id' => $id));
		}
		  
		#Export Data
		public function export() 
		{
		    $query = $this->db->query("	SELECT * 
										FROM table_service 
										ORDER BY service_name ASC");
		    return $query->result();
	  	}

	}



?>