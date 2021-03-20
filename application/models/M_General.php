<?php
class M_General extends CI_Model{

	public function getSequence($tbl_name, $lpad, $code) {
		$query=$this->db->query("SELECT concat('$code', CONVERT( LPAD(count(*) + 1, $lpad, 0), varchar(10)) ) as next_code from $tbl_name");
		return $query->row()->next_code;
	}
	
	public function getSequenceOrder($tbl_name, $lpad) {
	    $query=$this->db->query("SELECT concat(date_format(CURDATE(), '%Y%m%d'),'-', CONVERT( LPAD(count(*) + 1, $lpad, 0), varchar(10)) ) as next_code from $tbl_name");
	    return $query->row()->next_code;
	}

	function insertData($tblName, $data){
		$this->db->insert($tblName, $data);
		$insertId = $this->db->insert_id();
		return  $insertId;
	}

	function updateData($tblName, $data, $code_name, $code) {
		$query = $this->db->update($tblName, $data, "$code_name = '$code'");
		// print_r($this->db->last_query());
		return $query;
	}
	
	function deleteData($tblName, $where) {
	    return $this->db->query("DELETE FROM $tblName where $where");
	}

}