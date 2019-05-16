<?php  

	class Model_slider extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		#Get Nama Kolom
		public function select_column_name($db)
		{
			$query = $this->db->query("	select COLUMN_NAME
                              			from INFORMATION_SCHEMA.COLUMNS
                              			where TABLE_SCHEMA='$db' and TABLE_NAME='table_slider'");
    		return $query->result();
		}


		public function slider_active()
		{
			$query = $this->db->query("	select * from table_slider where slider_status ='1'");
    		return $query->result();
		}

		public function get_edit($id) 
		{
			$this->db->where('slider_id', $id);
			$query = $this->db->get('table_slider', 1);
			return $query->result_array();
		}

		public function link_gambar($id)
        {
            
            $this->db->where('slider_id',$id);
            $query = $getData = $this->db->get('table_slider');

            if($getData->num_rows() > 0)
            return $query;
            else
            return null;  
		}

	  	#Hitung Jumlah user
		public function record_count() 
		{
		    return $this->db->count_all("table_slider");
		}

		#tampilkan data
		public function fetch_slider($limit, $start) 
		{
		    $this->db->select('*');
		    $this->db->from('table_slider');
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
		      	$this->db->like("slider_name", $key);
		      	$this->db->or_like("slider_desc", $key);
		      	$this->db->or_like("slider_image", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_slider");
		}

		#Tampilkan data yang dicari
		public function fetch_slider_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
		    $this->db->from('table_slider');
		    
		    if ($column_name == "") 
		    {
				$this->db->like("slider_name", $key);
		      	$this->db->or_like("slider_desc", $key);
		      	$this->db->or_like("slider_image", $key);
		      	
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
    		$this->db->insert('table_slider', $data);
  		}
  
  		#Edit data sesuai ID terpilih
  		public function edit($data) 
  		{
    		#update data
    		$this->db->update('table_slider', $data, array('slider_id' => $data['slider_id']));
  		}
  
  		#Delete data sesuai ID terpilih
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_slider', array('slider_id' => $id));
  		}

	}




?>