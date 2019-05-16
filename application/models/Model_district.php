<?php  

	class Model_district extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		#Get Nama Kolom
		public function select_column_name($db)
		{
			$query = $this->db->query("	SELECT COLUMN_NAME
                              			FROM INFORMATION_SCHEMA.COLUMNS
                              			WHERE TABLE_SCHEMA='$db' AND TABLE_NAME='table_district'");
    		return $query->result();
		}

		#Export Data
		public function export() 
		{
		    $query = $this->db->query("SELECT * FROM table_district");
		    return $query->result();
	  	}

	  	#Hitung Jumlah user
		public function record_count() 
		{
		    return $this->db->count_all("table_district");
		}

		#tampilkan data
		public function fetch_district($limit, $start) 
		{
		    $this->db->select('*');
		    $this->db->from('table_district');
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

		public function getdistrict()
		{
			$query = $this->db->query('SELECT * FROM table_district ORDER BY district_name');

            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
		}

		#Hitung data yang di cari 
		public function record_count_search($key, $column_name) 
		{
		    if ($column_name == "") 
		    {
		      	$this->db->like("district_name", $key);
		      	$this->db->or_like("district_desc", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_district");
		}

		#Tampilkan data yang dicari
		public function fetch_district_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
		    $this->db->from('table_district');
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("district_name", $key);
		      	$this->db->or_like("district_desc", $key);
		      	
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
    		$this->db->insert('table_district', $data);
  		}
  
  		#Edit data sesuai ID terpilih
  		public function edit($data) 
  		{
    		#update data
    		$this->db->update('table_district', $data, array('district_id' => $data['district_id']));
  		}
  
  		#Delete data sesuai ID terpilih
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_district', array('district_id' => $id));
  		}

	}




?>