<?php  

	class Model_post extends CI_Model
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
                              			WHERE TABLE_SCHEMA='$db' AND TABLE_NAME='table_post'");
    		return $query->result();
		}

		public function new_post()
		{
			$query = $this->db->query("	SELECT * FROM table_post WHERE post_status='1' ORDER BY post_postdate DESC LIMIT 4");
    		return $query->result();
		}

		public function get_edit($id) 
		{
			$this->db->where('post_id', $id);
			$query = $this->db->get('table_post', 1);
			return $query->result_array();
		}

		public function link_gambar($id)
        {
            
            $this->db->where('post_id',$id);
            $query = $getData = $this->db->get('table_post');

            if($getData->num_rows() > 0)
            return $query;
            else
            return null;  
		}

	  	#Hitung Jumlah user
		public function record_count() 
		{
		    return $this->db->count_all("table_post");
		}

		#tampilkan data
		public function fetch_post($limit, $start) 
		{
		    $this->db->select('*');
		    $this->db->from('table_post');
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

        #Tampilkan data post category
        public function fetch_postcategory()
		{
			$query = $this->db->query('SELECT * FROM table_postcategory');

            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
		}

        public function fetch_postblog()
		{
			$query = $this->db->query("SELECT * FROM table_post WHERE post_status = '1'");

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
		      	$this->db->like("post_title", $key);
		      	$this->db->or_like("post_desc", $key);
		      	$this->db->or_like("post_postby", $key);
		      	$this->db->or_like("post_postdate", $key);
		      	$this->db->or_like("post_slug", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_post");
		}

		#Tampilkan data yang dicari
		public function fetch_post_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
		    $this->db->from('table_post');
		    
		    if ($column_name == "") 
		    {
				$this->db->like("post_title", $key);
				$this->db->or_like("post_desc", $key);
				$this->db->or_like("post_postby", $key);
		      	$this->db->or_like("post_postdate", $key);
				$this->db->or_like("post_slug", $key);
		      	
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
    		$this->db->insert('table_post', $data);
  		}
  
  		#Edit data sesuai ID terpilih
  		public function edit($data) 
  		{
    		#update data
    		$this->db->update('table_post', $data, array('post_id' => $data['post_id']));
  		}
  
  		#Delete data sesuai ID terpilih
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_post', array('post_id' => $id));
  		}


  		public function get_blog($id) 
		{
			$this->db->where('post_slug', $id);
			$query = $this->db->get('table_post', 1);
			return $query->result();
		}

	}




?>