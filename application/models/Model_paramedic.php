<?php  

	class Model_paramedic extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		#Get Column Name
		public function select_column_name($db)
		{
			$query = $this->db->query("	select COLUMN_NAME
                              			from INFORMATION_SCHEMA.COLUMNS
                              			where TABLE_SCHEMA='$db' and TABLE_NAME='table_paramedic'");
    		return $query->result();
		}

	  	#Count Data Paramedic
		public function record_count() 
		{
		    return $this->db->count_all("table_paramedic");
		}

		#list paramedic status on
		public function list_paramedic($id)
		{
			$query = $this->db->query("SELECT * FROM table_paramedic WHERE paramediccategory_id = '$id' AND paramedic_online = 1 ORDER BY paramedic_name");

            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
		}

		#acak paramedic status on
		public function random_paramedic($id)
		{
			$query = $this->db->query("SELECT * FROM table_paramedic WHERE paramedic_online = 1 AND paramediccategory_id = '$id' ORDER BY RAND() LIMIT 1");

            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
		}

		#Get All Data Paramedic
		public function fetch_paramedic($limit, $start) 
		{
		    $this->db->select('*');
			$this->db->from('table_paramedic , table_paramediccategory');
			$this->db->where('table_paramedic.paramediccategory_id = table_paramediccategory.paramediccategory_id');
			$this->db->order_by("paramedic_name","asc");
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
		      	$this->db->like("paramedic_name", $key);
		      	$this->db->or_like("paramedic_email", $key);
		      	$this->db->or_like("paramedic_status", $key);
				$this->db->or_like("paramedic_sex", $key);
				$this->db->or_like("paramedic_phone", $key);
				$this->db->or_like("paramedic_address", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_paramedic");
		}

		#Swoh Data Search
		public function fetch_paramedic_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
			$this->db->from('table_paramedic');
			$this->db->join('table_paramediccategory', 'table_paramedic.paramediccategory_id = table_paramediccategory.paramediccategory_id','left');
			$this->db->order_by("paramedic_name","asc");
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("paramedic_name", $key);
		      	$this->db->or_like("paramedic_email", $key);
		      	$this->db->or_like("paramedic_status", $key);
		      	$this->db->or_like("paramedic_sex", $key);
		      	$this->db->or_like("paramedic_phone", $key);
		      	$this->db->or_like("paramedic_address", $key);
		      	$this->db->or_like("paramediccategory_name", $key);
		      	
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

		#Search Name Image Paramedic
		public function link_gambar($id)
        {
            $this->db->where('paramedic_id',$id);
            $query = $getData = $this->db->get('table_paramedic');
            if($getData->num_rows() > 0)
            return $query;
            else
            return null;
                
		}

		#Check Email Address 
		public function email_address($email)
        {
            $this->db->where('paramedic_email',$email);
            $query = $getData = $this->db->get('table_paramedic');

			return $query;
		}

		#get data for edit
		public function get_edit($id) 
		{
			$this->db->where('paramedic_id', $id);
			$query = $this->db->get('table_paramedic', 1);
			return $query->result_array();
		}

		#Get Paramedic By ID
		public function paramedic_track($id)
		{
			$query = $this->db->query("SELECT * FROM table_paramedic WHERE paramedic_id = '$id'");
		    return $query->result();
		}

		#Insert Data Data
  		public function input($data) 
  		{
   	 		#insert data
    		$this->db->insert('table_paramedic', $data);
  		}
  
  		#Update Data By ID
  		public function edit($data) 
  		{
    		#update data
    		$this->db->update('table_paramedic', $data, array('paramedic_id' => $data['paramedic_id']));
  		}
  
  		#Delete Data By ID
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_paramedic', array('paramedic_id' => $id));
		}
		  
		#Export Data
		public function export() 
		{
		    $query = $this->db->query("	SELECT * 
										FROM table_paramedic a, table_district b, table_paramediccategory c
										WHERE a.district_id = b.district_id AND a.paramediccategory_id = c.paramediccategory_id
										ORDER BY paramedic_name ASC, paramediccategory_name ASC ");
		    return $query->result();
	  	}

	}



?>