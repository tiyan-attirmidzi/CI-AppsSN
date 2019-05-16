<?php  

	class Model_package extends CI_Model
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
                              			WHERE TABLE_SCHEMA = '$db' AND TABLE_NAME = 'table_package'");
    		return $query->result();
		}

		
		public function get_edit($id) 
		{
			$this->db->where('package_id', $id);
			$query = $this->db->get('table_package', 1);
			return $query->result_array();
		}

		#Export Data
		public function export() 
		{
		    $query = $this->db->query("	SELECT * 
										FROM table_package a, table_service b, table_packageparamediccategory c, table_paramediccategory d
										WHERE a.service_id = b.service_id AND a.package_id = c.package_id AND c.paramediccategory_id = d.paramediccategory_id
										ORDER BY package_name ASC
										");
		    return $query->result();
	  	}

	  	#Hitung Jumlah user
		public function record_count() 
		{
		    return $this->db->count_all("table_package");
		}

		#tampilkan data
		public function fetch_package($limit, $start) 
		{
		    $this->db->select('*');
		    $this->db->from('table_package , table_service');
		    $this->db->where('table_package.service_id = table_service.service_id');
		    $this->db->order_by("package_name","asc");
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

		public function fetch_service()
		{
			$query = $this->db->query('SELECT * FROM table_service');

            foreach ($query->result() as $row)
            {
                // echo $row->district_name;
                $data[] = $row;
            }
            return $data;
		}

		public function package()
		{
			$query = $this->db->query('SELECT * FROM table_package');

            foreach ($query->result() as $row)
            {
                // echo $row->district_name;
                $data[] = $row;
            }
            return $data;
		}

		public function get_package($id)
		{
			$query = $this->db->query("SELECT * FROM table_package WHERE service_id = '$id' ORDER BY package_name ASC");

            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
		}

		public function get_packageprice($id)
		{
			$query = $this->db->query("	SELECT * FROM table_package WHERE package_id = '$id' ");
			return $query->result();
		}

		public function fetch_paramediccategory()
		{
			$query = $this->db->query('SELECT * FROM table_paramediccategory');

            foreach ($query->result() as $row)
            {
                // echo $row->district_name;
                $data[] = $row;
            }
            return $data;
		}

		public function fetch_packageparamediccategory($id)
		{
			$query = $this->db->query("SELECT * FROM table_packageparamediccategory WHERE package_id = '$id' ");

            foreach ($query->result() as $row)
            {
                // echo $row->district_name;
                $data[] = $row;
            }
            return $data;
		}

		#Hitung data yang di cari 
		public function record_count_search($key, $column_name) 
		{
		    if ($column_name == "") 
		    {
		      	$this->db->like("package_name", $key);
		      	$this->db->or_like("package_price", $key);
		      	$this->db->or_like("package_desc", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_package");
		}

		#Tampilkan data yang dicari
		public function fetch_package_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
			$this->db->from('table_package');
			$this->db->join('table_service', 'table_package.service_id = table_service.service_id','left');
			$this->db->order_by("package_name","asc");		
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("package_name", $key);
		      	$this->db->or_like("package_desc", $key);
		      	$this->db->or_like("package_price", $key);
		      	$this->db->or_like("service_name", $key);
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
            
            $this->db->where('package_id',$id);
            $query = $getData = $this->db->get('table_package');

            if($getData->num_rows() > 0)
            return $query;
            else
            return null;   
		}

		#Masukkan data ke DB
  		public function input($data) 
  		{
    		$this->db->insert('table_package', $data);
    	}

    	public function input2($data2)
    	{
    		$this->db->insert('table_packageparamediccategory',$data2);
    	}

  		public function getdata($a,$b,$c,$d)
  		{

    		$query = $this->db->query("SELECT * FROM table_package WHERE package_name = '$a' AND package_desc = '$b' AND service_id = '$c' AND package_price = '$d'");
    		return $query->result();
  		}
	
  			
  
  		#Edit data sesuai ID terpilih
  		public function edit($data) 
  		{
    		#update data
    		$this->db->update('table_package', $data, array('package_id' => $data['package_id']));
  		}

  		public function edit2($data) 
  		{
    		#update data
    		$this->db->insert('table_packageparamediccategory',$data);
		}
		  
		  public function edit3($data) 
  		{
    		#update data
    		$this->db->query("	DELETE FROM table_packageparamediccategory
								WHERE package_id = '$data'");
  		}
  
  		#Delete data sesuai ID terpilih
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_package', array('package_id' => $id));
		}
		  
  		public function delete2($id) 
  		{
    		#delete data
    		$this->db->query("	DELETE FROM table_packageparamediccategory
								WHERE package_id = '$id'");
  		}

	}


?>