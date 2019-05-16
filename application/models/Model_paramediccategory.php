<?php 

	class Model_paramediccategory extends CI_Model
	{
		
		function __construct()
		{
			parent:: __construct();
		}

		#Get Nama Kolom
		public function select_column_name($db)
		{
			$query = $this->db->query("	select COLUMN_NAME
                              			from INFORMATION_SCHEMA.COLUMNS
                              			where TABLE_SCHEMA='$db' and TABLE_NAME='table_paramediccategory'");
    		return $query->result();
		}

		#Export Data
		public function export() 
		{
		    $query = $this->db->query("select * from table_paramediccategory");
		    return $query->result();
	  	}

	  	#Hitung Jumlah user
		public function record_count() 
		{
		    return $this->db->count_all("table_paramediccategory");
		}

		#tampilkan data
		public function fetch_paramediccategory($limit, $start) 
		{
		    $this->db->select('*');
		    $this->db->from('table_paramediccategory');
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

		public function get_paramediccategory()
		{
			$query = $this->db->query('SELECT * FROM table_paramediccategory');

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
		      	$this->db->like("paramediccategory_name", $key);
		      	$this->db->or_like("paramediccategory_desc", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_paramediccategory");
		}

		#Tampilkan data yang dicari
		public function fetch_paramediccategory_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
		    $this->db->from('table_paramediccategory');
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("paramediccategory_name", $key);
		      	$this->db->or_like("paramediccategory_desc", $key);
		      	
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
    		$this->db->insert('table_paramediccategory', $data);
  		}
  
  		#Edit data sesuai ID terpilih
  		public function edit($data) 
  		{
    		#update data
    		$this->db->update('table_paramediccategory', $data, array('paramediccategory_id' => $data['paramediccategory_id']));
  		}
  
  		#Delete data sesuai ID terpilih
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_paramediccategory', array('paramediccategory_id' => $id));
  		}

	}



 ?>