<?php  

	class Model_document extends CI_Model
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
                              			WHERE TABLE_SCHEMA='$db' AND TABLE_NAME='table_document'");
    		return $query->result();
		}

	  	#Count Patient
		public function record_count() 
		{
		    return $this->db->count_all("table_document");
		}

		#Show All Data Patient
		public function fetch_document($limit, $start) 
		{
		    $this->db->select('*');
			$this->db->from('table_document');
			$this->db->order_by("document_name","asc");
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
		      	$this->db->like("document_name", $key);
		      	$this->db->or_like("document_email", $key);
		      	$this->db->or_like("document_status", $key);
				$this->db->or_like("document_sex", $key);
				$this->db->or_like("document_phone", $key);
				$this->db->or_like("document_address", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_document");
		}

		#Show Data Search
		public function fetch_document_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
			$this->db->from('table_document');
			$this->db->order_by("document_name","asc");
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("document_name", $key);
		      	$this->db->or_like("document_email", $key);
		      	$this->db->or_like("document_status", $key);
				$this->db->or_like("document_sex", $key);
				$this->db->or_like("document_phone", $key);
				$this->db->or_like("document_address", $key);
		      	
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
            
            $this->db->where('document_id',$id);
            $query = $getData = $this->db->get('table_document');

            if($getData->num_rows() > 0)
            return $query;
            else
            return null;   
		}

		#Show Data user By ID
		public function document_active()
		{
			$query = $this->db->query("SELECT * FROM table_document WHERE document_status = 1 ORDER BY document_name ASC");
		    return $query->result();
		}

		#get data for edit
		public function get_edit($id) 
		{
			$this->db->where('document_id', $id);
			$query = $this->db->get('table_document', 1);
			return $query->result_array();
		}
		
		#Show Data user By ID
		public function document_track($id)
		{
			$query = $this->db->query("SELECT * FROM table_document WHERE document_id = '$id'");
		    return $query->result();
		}

		#Insert Data
  		public function input($data) 
  		{
   	 		#insert data
    		$this->db->insert('table_document', $data);
  		}
  
  		#Update Data By ID 
  		public function edit($data) 
  		{
    		#update data
    		$this->db->update('table_document', $data, array('document_id' => $data['document_id']));
  		}
  
  		#Delete Data By ID 
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_document', array('document_id' => $id));
		}
		  
		#Export Data
		public function export() 
		{
		    $query = $this->db->query("	SELECT * 
										FROM table_document a, table_district b
										WHERE a.district_id = b.district_id
										ORDER BY document_name ASC");
		    return $query->result();
	  	}

	}

?>