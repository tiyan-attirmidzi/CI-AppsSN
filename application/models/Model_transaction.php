<?php  

	class Model_transaction extends CI_Model
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
                              			WHERE TABLE_SCHEMA='$db' AND TABLE_NAME='table_transaction'");
    		return $query->result();
		}

		#Export Data
		public function export() 
		{
		    $query = $this->db->query("SELECT * FROM table_transaction");
		    return $query->result();
	  	}

	  	# ADMIN Count All Data Transaction History
		public function record_count() 
		{
		    return $this->db->count_all("table_transaction");
		}

		# ADMIN Rekap History
		public function rekaphistory()
		{
			$query = $this->db->query("	SELECT * 
										FROM table_transaction a, table_transactiondetail b, table_packageteam c, table_service d, table_package e, table_patient f, table_user g 
										WHERE a.transaction_id = b.transaction_id AND c.transactiondetail_id = b.transactiondetail_id AND c.service_id = d.service_id AND c.package_id = e.package_id AND a.patient_id = f.patient_id AND a.transaction_status = 2 AND a.user_id = g.user_id
										GROUP BY a.transaction_id
										ORDER BY a.transaction_date DESC
										LIMIT 5
									");
		    return $query->result();
		}

		# ADMIN Count Data Search
		public function record_count_search($key, $column_name) 
		{
		    if ($column_name == "") 
		    {
		      	$this->db->like("transaction_code", $key);
		      	$this->db->or_like("transaction_total", $key);
		      	$this->db->or_like("transaction_note", $key);
		      	$this->db->or_like("transaction_arrangementdate", $key);
		      	$this->db->or_like("transaction_status", $key);
		    } 
		    else 
		    {
		      	$this->db->like($column_name, $key);
		    }
		    return $this->db->count_all_results("table_transaction");
		}

		# ADMIN Show Data Search For Processing Transaction
		public function fetch_transactionprocess_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
			$this->db->from('table_transaction');
			$this->db->join('table_patient', 'table_transaction.patient_id = table_patient.patient_id AND transaction_status = 1','left');
			$this->db->join('table_transactiondetail', 'table_transaction.transaction_id = table_transactiondetail.transaction_id AND transactiondetail_status = 1','left');
			$this->db->join('table_package', 'table_transactiondetail.package_id = table_package.package_id','left');
			$this->db->order_by("transaction_date","asc");
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("transaction_code", $key);
		      	$this->db->or_like("transaction_total", $key);
		      	$this->db->or_like("transaction_note", $key);
		      	$this->db->or_like("transaction_arrangementdate", $key);
		      	$this->db->or_like("transaction_status", $key);
		      	$this->db->or_like("patient_name", $key);
		      	$this->db->or_like("package_name", $key);
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

		# ADMIN Show Data Search For History Transaction
		public function fetch_transactionhistory_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
			$this->db->from('table_transaction');
			$this->db->join('table_patient', 'table_transaction.patient_id = table_patient.patient_id AND transaction_status = 1','left');
			$this->db->order_by("transaction_date","asc");
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("transaction_code", $key);
		      	$this->db->or_like("transaction_total", $key);
		      	$this->db->or_like("transaction_note", $key);
		      	$this->db->or_like("transaction_arrangementdate", $key);
		      	$this->db->or_like("transaction_status", $key);
		      	$this->db->or_like("patient_name", $key);
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

		# Admin Processing Transaction
		public function fetch_transactionprocess($limit, $start) 
		{
			$this->db->select('*');
			$this->db->from('table_packageteam , table_patient, table_transaction, table_transactiondetail, table_service');
		    $this->db->where("table_packageteam.transactiondetail_id = table_transactiondetail.transactiondetail_id AND table_transactiondetail.transaction_id = table_transaction.transaction_id AND table_transaction.patient_id = table_patient.patient_id AND table_transactiondetail.transactiondetail_status = '1' AND table_packageteam.packageteam_status = '0' AND table_packageteam.service_id = table_service.service_id");
			$this->db->group_by('table_packageteam.transactiondetail_id');
			$this->db->order_by('table_transaction.transaction_date','ASC');		
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

		# Admin History Transaction
		public function fetch_transactionhistory($limit, $start) 
		{
			$this->db->select('*');
			$this->db->from('table_transaction , table_patient');
			$this->db->where('table_transaction.patient_id = table_patient.patient_id');
			$this->db->order_by("transaction_date","asc");			
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

		# ADMIN For Order Reject
		public function order_reject() 
		{
			$this->db->select('*');
			$this->db->from('table_packageteam , table_patient, table_transaction, table_transactiondetail, table_package, table_paramedic');
		    $this->db->where("table_packageteam.transactiondetail_id = table_transactiondetail.transactiondetail_id AND table_transactiondetail.transaction_id = table_transaction.transaction_id AND table_transaction.patient_id = table_patient.patient_id AND table_transactiondetail.package_id = table_package.package_id AND table_transactiondetail.transactiondetail_status = '2' AND table_packageteam.paramedic_id = table_paramedic.paramedic_id ");
			$this->db->group_by('table_packageteam.transactiondetail_id');
			$this->db->order_by('table_transaction.transaction_date','ASC');
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

		# ADMIN For Order Accept
		public function order_accept() 
		{
			$this->db->select('*');
			$this->db->from('table_packageteam , table_patient, table_transaction, table_transactiondetail, table_package, table_paramedic');
		    $this->db->where("table_packageteam.transactiondetail_id = table_transactiondetail.transactiondetail_id AND table_transactiondetail.transaction_id = table_transaction.transaction_id AND table_transaction.patient_id = table_patient.patient_id AND table_transactiondetail.package_id = table_package.package_id AND table_transactiondetail.transactiondetail_status = '3' AND table_packageteam.paramedic_id = table_paramedic.paramedic_id ");
			$this->db->group_by('table_packageteam.transactiondetail_id');
			$this->db->order_by('table_transaction.transaction_date','ASC');
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

		# For Transaction Patient 
		#----------------------------------------------------- Start ------------------------------------------------------------#
		/*Tambahan Padong*/
		public function fetch_transaction_byUser($id) 
		{
			$this->db->select('*');
			$this->db->from('table_transaction , table_patient');
			$this->db->where("table_transaction.patient_id = table_patient.patient_id AND table_transaction.user_id = '$id' AND table_transaction.transaction_status = '1'");
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
		

		public function fetch_transaction_perpatient($id) 
		{
			$this->db->select('*');
			$this->db->from('table_transaction , table_patient');
			$this->db->where("table_transaction.patient_id = table_patient.patient_id AND table_transaction.patient_id = '$id' AND table_transaction.transaction_status = '1'");
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

		/*Tambahan*/
		public function fetch_transactionhistorypatient_byUser($limit, $start, $id) 
		{
			$this->db->select('*');
			$this->db->from('table_transaction , table_patient');
			$this->db->where("table_transaction.patient_id = table_patient.patient_id AND table_transaction.user_id = '$id' AND table_transaction.transaction_status = '2' ");
			$this->db->order_by("table_transaction.transaction_date","asc");			
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

		public function fetch_transactionhistorypatient($limit, $start, $id) 
		{
			$this->db->select('*');
			$this->db->from('table_transaction , table_patient');
			$this->db->where("table_transaction.patient_id = table_patient.patient_id AND table_transaction.patient_id = '$id' AND table_transaction.transaction_status = '2' ");
			$this->db->order_by("table_transaction.transaction_date","asc");			
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

		public function getpackage($id)
        {
            $this->db->where('package_id',$id);
            $query = $getData = $this->db->get('table_packageparamediccategory');

            if($getData->num_rows() > 0)
            return $query;
            else
            return null;   
		}

		public function get_packageparamediccategory($id)
		{
			$query = $this->db->query("	SELECT * FROM table_packageparamediccategory WHERE package_id = '$id' ");
			return $query->result();
		}

		public function get_paramedic($id)
		{
			$query = $this->db->query("	SELECT * FROM table_paramedic WHERE paramediccategory_id = '$id' ");
			return $query->result();
		}

		#----------------------------------------------------- End ------------------------------------------------------------#


		// For Paramedic -> Patient Request to Paramedic
		public function order_request($ctgry, $id) 
		{
			$this->db->select('*');
			$this->db->from('table_packageteam , table_patient, table_transaction, table_transactiondetail, table_service');
		    $this->db->where("table_packageteam.paramediccategory_id = '$ctgry' AND table_packageteam.paramedic_id = '$id' AND table_packageteam.transactiondetail_id = table_transactiondetail.transactiondetail_id AND table_transactiondetail.transaction_id = table_transaction.transaction_id AND table_transaction.patient_id = table_patient.patient_id AND table_transactiondetail.transactiondetail_status = '1' AND table_packageteam.packageteam_status = '0' AND table_packageteam.service_id = table_service.service_id");
			$this->db->group_by('table_packageteam.transactiondetail_id');
			$this->db->order_by('table_transaction.transaction_date','ASC');
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

		# -------------------------------------------------------------------- Paramedic --------------------------------------------------------------------#
		public function transaction_onprocess($id)
		{
			$query = $this->db->query("	SELECT * 
										FROM table_transaction a, table_transactiondetail b, table_packageteam c, table_service d, table_package e, table_patient f 
										WHERE a.transaction_id = b.transaction_id AND c.transactiondetail_id = b.transactiondetail_id AND c.service_id = d.service_id AND c.package_id = e.package_id AND a.patient_id = f.patient_id AND c.paramedic_id = '$id' AND a.transaction_status = 1
										GROUP BY a.transaction_id
										ORDER BY a.transaction_date ASC
									");
		    return $query->result();
		}

		public function visiting_stage($id) 
		{
			$this->db->select('*');
			$this->db->from('table_packageteam, table_patient, table_transaction, table_transactiondetail, table_service');
		    $this->db->where("table_packageteam.paramedic_id = '$id' AND table_transactiondetail.transactiondetail_status = 3 AND table_packageteam.transactiondetail_id = table_transactiondetail.transactiondetail_id AND table_transactiondetail.transaction_id = table_transaction.transaction_id AND table_packageteam.service_id = table_service.service_id AND table_transaction.patient_id = table_patient.patient_id");
			$this->db->group_by('table_packageteam.transactiondetail_id');
			$this->db->order_by('table_transaction.transaction_date','ASC');
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

		public function visiting_stage_detail($id, $transaction_id) 
		{
			$this->db->select('*');
			$this->db->from('table_packageteam, table_patient, table_transaction, table_transactiondetail, table_service');
		    $this->db->where("table_packageteam.paramedic_id = '$id' AND table_transactiondetail.transactiondetail_status = 3 AND table_packageteam.transactiondetail_id = table_transactiondetail.transactiondetail_id AND table_transactiondetail.transaction_id = table_transaction.transaction_id AND table_transaction.transaction_id = '$transaction_id' AND table_packageteam.service_id = table_service.service_id AND table_transaction.patient_id = table_patient.patient_id");
			$this->db->group_by('table_packageteam.transactiondetail_id');
			$this->db->order_by('table_transaction.transaction_date','ASC');
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

		public function visiting_stage_history($id, $transaction_id) 
		{
			$this->db->select('*');
			$this->db->from('table_packageteam, table_patient, table_transaction, table_transactiondetail, table_service, table_package');
		    $this->db->where("table_packageteam.paramedic_id = '$id' AND table_transactiondetail.transactiondetail_status = 4 AND table_packageteam.transactiondetail_id = table_transactiondetail.transactiondetail_id AND table_transactiondetail.transaction_id = table_transaction.transaction_id AND table_transaction.transaction_id = '$transaction_id' AND table_packageteam.service_id = table_service.service_id AND table_transactiondetail.package_id = table_package.package_id");
			$this->db->group_by('table_packageteam.transactiondetail_id');
			$this->db->order_by('table_transaction.transaction_date','ASC');
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

		public function visiting_stage_history2($id, $transaction_id) 
		{
			$this->db->select('*');
			$this->db->from('table_packageteam, table_transaction, table_transactiondetail, table_service');
		    $this->db->where("table_transaction.transaction_id = '$transaction_id' AND table_packageteam.paramedic_id = '$id' AND table_transactiondetail.transactiondetail_status = 4 AND table_packageteam.transactiondetail_id = table_transactiondetail.transactiondetail_id AND table_transactiondetail.transaction_id = table_transaction.transaction_id AND table_packageteam.service_id = table_service.service_id");
			$this->db->distinct('transactiondetail_visitdate');
			$this->db->group_by('table_transactiondetail.transactiondetail_visitdate');
			$this->db->order_by('table_transaction.transaction_date','ASC');
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

		public function get_print($transaction_id, $date) 
		{
			$this->db->select("*");
			$this->db->from('table_packageteam, table_patient, table_transaction, table_transactiondetail, table_service, table_package');
			$this->db->where("table_transactiondetail.transactiondetail_status = 4 AND table_packageteam.transactiondetail_id = table_transactiondetail.transactiondetail_id AND table_transactiondetail.transaction_id = table_transaction.transaction_id AND table_transaction.transaction_id = '$transaction_id' AND table_packageteam.service_id = table_service.service_id AND table_transactiondetail.package_id = table_package.package_id AND table_transactiondetail.transactiondetail_visitdate = '$date'");
			$this->db->group_by('table_transactiondetail.transactiondetail_id');
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

		public function get_printDatapatient($transaction_id) 
		{
			$this->db->select('*');
			$this->db->from('table_patient, table_transaction');
			$this->db->where("table_transaction.transaction_id = '$transaction_id' AND table_patient.patient_id = table_transaction.patient_id");
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

		public function fetch_transactionhistoryparamedic($limit, $start, $id) 
		{
			$this->db->select('*');
			$this->db->from('table_packageteam, table_transaction, table_transactiondetail, table_patient, table_package, table_service');
			$this->db->where("table_packageteam.paramedic_id = '$id' AND table_packageteam.transactiondetail_id = table_transactiondetail.transactiondetail_id AND table_packageteam.packageteam_status = '1' AND table_transactiondetail.transaction_id = table_transaction.transaction_id AND table_transaction.patient_id = table_patient.patient_id AND table_transactiondetail.package_id = table_package.package_id AND table_packageteam.service_id = table_service.service_id");
			$this->db->group_by("table_transactiondetail.transaction_id");			
			$this->db->order_by("table_transaction.transaction_date","asc");			
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

		public function fetch_transactionhistorypara_search($limit, $start, $key, $column_name) 
		{
		    $this->db->select('*');
			$this->db->from('table_transaction');
			$this->db->join('table_patient', 'table_transaction.patient_id = table_patient.patient_id AND transaction_status = 2','left');
			$this->db->order_by("transaction_date","asc");
		    
		    if ($column_name == "") 
		    {
		      	$this->db->like("transaction_code", $key);
		      	$this->db->or_like("transaction_total", $key);
		      	$this->db->or_like("transaction_note", $key);
		      	$this->db->or_like("transaction_arrangementdate", $key);
		      	$this->db->or_like("transaction_status", $key);
		      	$this->db->or_like("patient_name", $key);
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

		public function check_transaction($id)
		{
			$this->db->where('transaction_id', $id);
			$query = $this->db->get('table_transaction', 1);
			return $query->result_array();
		}
	
		#Insert Data By ID
  		public function input($data) 
  		{
    		$this->db->insert('table_transactiondetail', $data);
		}
		
		public function input2($data) 
		{
		  	$this->db->insert('table_transaction', $data);
		}

		public function input3($data) 
		{
		  	$this->db->insert('table_packageteam', $data);
	  	}
  
  		#Edit transaction
  		public function update($data) 
  		{
    		#update data
    		$this->db->update('table_transaction', $data, array('transaction_id' => $data['transaction_id']));
		  }
		  
  		#Edit transactiondetail
  		public function update2($data) 
  		{
    		#update data
    		$this->db->update('table_transactiondetail', $data, array('transactiondetail_id' => $data['transactiondetail_id']));
		  }
		  
  		#Edit transactiondetail
  		public function update3($data) 
  		{
    		#update data
    		$this->db->update('table_packageteam', $data, array('transactiondetail_id' => $data['transactiondetail_id']));
  		}
  
  		#Delete data sesuai ID terpilih
  		public function delete($id) 
  		{
    		#delete data
    		$this->db->delete('table_transaction', array('transaction_id' => $id));
		}

		public function delete_trxdtl($id)
		{
			$this->db->query("	DELETE FROM table_transactiondetail WHERE transactiondetail_id = '$id'");
		}

		public function delete_packageteam($id)
		{
			$this->db->query("	DELETE FROM table_packageteam WHERE transactiondetail_id = '$id'");
		}


		public function fetch_package() 
		{
		    $this->db->select('*');
		    $this->db->from('table_package , table_service');
		    $this->db->where('table_package.service_id = table_service.service_id');
		    $this->db->order_by("package_name","asc");
		    //$this->db->limit($limit, $start);
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


	}


?>