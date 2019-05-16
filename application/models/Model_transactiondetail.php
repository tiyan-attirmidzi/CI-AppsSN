<?php  

	class Model_transactiondetail extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function check_packageteam($id)
        {
            $query= $this->db->query(" 	SELECT packageteam_status
										 FROM table_packageteam
										 WHERE transactiondetail_id = '$id' ");
			return $query->result();	
		}

		public function check_statusnote($id)
        {
            $query= $this->db->query(" 	SELECT transactiondetail_statusnote
										 FROM table_transactiondetail
										 WHERE transactiondetail_id = '$id' ");
			return $query->result();	
		}

		public function check_detailstatus($id)
        {
            $query= $this->db->query(" 	SELECT transactiondetail_whilestatus
										 FROM table_transactiondetail
										 WHERE transaction_id = '$id' ");
			return $query->result();	
		}

		public function select_paramedic($field, $id)
		{
			$query = $this->db->query("	SELECT GROUP_CONCAT(DISTINCT(f.paramedic_name)) AS paramedic_name, d.package_name, a.transactiondetail_rate, a.transactiondetail_review, a.transactiondetail_statusnote
										FROM table_transactiondetail a, table_transaction b, table_patient c, table_package d, table_packageteam e, table_paramedic f
										WHERE a.transaction_id = b.transaction_id AND a.package_id = d.package_id AND b.patient_id = c.patient_id AND b.transaction_id = '$id' AND a.transactiondetail_id = e.transactiondetail_id AND e.paramedic_id = f.paramedic_id
										GROUP BY e.transactiondetail_id
										");
			return $query->result();
		}

		public function select_paramedic2($field, $id, $id_p)
		{
			$query = $this->db->query("	SELECT GROUP_CONCAT(DISTINCT(f.paramedic_name)) AS paramedic_name, d.package_name, a.transactiondetail_rate, a.transactiondetail_review, a.transactiondetail_statusnote
										FROM table_transactiondetail a, table_transaction b, table_patient c, table_package d, table_packageteam e, table_paramedic f
										WHERE a.transaction_id = b.transaction_id AND a.package_id = d.package_id AND b.patient_id = c.patient_id AND b.transaction_id = '$id' AND a.transactiondetail_id = e.transactiondetail_id AND e.paramedic_id = f.paramedic_id AND e.paramedic_id = '$id_p'
										GROUP BY e.transactiondetail_id
										");
			return $query->result();
		}

		#Get Nama Kolom
		public function select_all($field, $id)
		{
			$query = $this->db->query("	SELECT *
										FROM table_transactiondetail a, table_transaction b, table_patient c, table_package d, table_packageteam e, table_paramedic f
										WHERE a.transaction_id = b.transaction_id AND a.package_id = d.package_id AND b.patient_id = c.patient_id AND b.transaction_id = '$id' AND a.transactiondetail_id = e.transactiondetail_id AND e.paramedic_id = f.paramedic_id
										GROUP BY d.package_name
										");
			return $query->result();
		}

		public function select_all2($field, $id)
		{
			$query = $this->db->query("	SELECT *
										FROM table_transactiondetail a, table_transaction b, table_patient c, table_package d
										WHERE a.transaction_id = b.transaction_id AND a.package_id = d.package_id AND b.patient_id = c.patient_id AND b.transaction_id = '$id' 
										GROUP BY d.package_name
										");
			return $query->result();
		}
		
		public function select_all3($field, $id, $id_detail)
		{
			$query = $this->db->query("	SELECT *
										FROM table_transactiondetail a, table_transaction b, table_patient c, table_package d
										WHERE a.transaction_id = b.transaction_id AND a.package_id = d.package_id AND b.patient_id = c.patient_id AND b.transaction_id = '$id' AND a.transactiondetail_id = '$id_detail'");
			return $query->result();
		}
		
		public function select_all4($field, $id, $id_p)
		{
			$query = $this->db->query("	SELECT *
										FROM table_transactiondetail a, table_transaction b, table_patient c, table_package d, table_packageteam e
										WHERE a.transaction_id = b.transaction_id AND a.package_id = d.package_id AND b.patient_id = c.patient_id AND b.transaction_id = '$id' AND e.transactiondetail_id = a.transactiondetail_id AND e.paramedic_id = '$id_p'
										GROUP BY d.package_name
										");
			return $query->result();
		}

		public function select_single($id)
		{
			$query = $this->db->query("	SELECT *
										FROM table_transactiondetail a, table_transaction b, table_patient c, table_packageteam d, table_service e, table_user f
										WHERE a.transaction_id = b.transaction_id AND b.patient_id = c.patient_id AND b.transaction_id = '$id' AND d.transactiondetail_id = a.transactiondetail_id AND d.service_id = e.service_id AND b.user_id = f.user_id");
			return $query->result();
		}

		public function update_feed($data, $id)
		{
			#update data
    		$this->db->update('table_transactiondetail', $data, array('transactiondetail_id' => $id));
		}

		public function update_feed2($data, $id)
		{
			#update data
    		$this->db->update('table_transaction', $data, array('transaction_id' => $id));
		}


		public function update_conf($data, $id)
		{
			#update data
    		$this->db->update('table_transactiondetail', $data, array('transactiondetail_id' => $id));
		}

		public function update_conf2($data, $id, $paramediccategory_id)
		{
			#update data
    		$this->db->update('table_packageteam', $data, array(
				'transactiondetail_id' 		=> $id,
				'paramediccategory_id'		=> $paramediccategory_id
			));
		}


		#Delete data sesuai ID terpilih
		public function delete($id) 
		{
		  #delete data
		  $this->db->delete('table_transactiondetail', array('transaction_id' => $id));
		}

	}

?>