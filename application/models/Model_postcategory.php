<?php 

	class Model_postcategory extends CI_Model
	{
		
		function __construct()
		{
			parent:: __construct();
		}

		#Get Nama Kolom
		public function select_column_name($db)
		{
			$query = $this->db->query("	SELECT COLUMN_NAME
                              			FROM INFORMATION_SCHEMA.COLUMNS
                              			WHERE TABLE_SCHEMA='$db' AND TABLE_NAME='table_postcategory'");
    		return $query->result();
		}

		#Export Data
		public function export() 
		{
		    $query = $this->db->query("SELECT * FROM table_postcategory ORDER BY postcategory_name ASC");
		    return $query->result();
	  	}

	  	#Hitung Jumlah postcategory
		public function record_count() 
		{
		    return $this->db->count_all("table_postcategory");
		}

		#Tampilkan data
		public function fetch_postcategory($limit, $start) 
		{
		    $this->db->select('*');
            $this->db->from('table_postcategory');
			$this->db->order_by("postcategory_name","asc");            
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

		#Hitung data yang di cari 
		public function record_count_search($key, $column_name) 
		{
		    if ($column_name == "") 
		    {
		      	$this->db->like("postcategory_name", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_postcategory");
		}

		#Tampilkan data yang dicari
		public function fetch_postcategory_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
		    $this->db->from('table_postcategory');
			$this->db->order_by("postcategory_name","asc");            
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("postcategory_name", $key);
		      	
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

		#Masukkan data ke DB
  		public function input($data) 
  		{
   	 		#insert data
    		$this->db->insert('table_postcategory', $data);
  		}
  
  		#Edit data sesuai ID terpilih
  		public function edit($data) 
  		{
    		#update data
    		$this->db->update('table_postcategory', $data, array('postcategory_id' => $data['postcategory_id']));
  		}
  
  		#Delete data sesuai ID terpilih
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_postcategory', array('postcategory_id' => $id));
  		}

	}



 ?>