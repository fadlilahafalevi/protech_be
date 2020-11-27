<?php
class M_General extends CI_Model{

	public function getSequence($tbl_name, $lpad, $code) {
		$query=$this->db->query("SELECT concat('$code', CONVERT( LPAD(count(*) + 1, $lpad, 0), varchar(10)) ) as next_code from $tbl_name");
		return $query->row()->next_code;
	}

	function insertData($tblName, $data){
		$this->db->insert($tblName, $data);
		$insertId = $this->db->insert_id();
		return  $insertId;
	}

	function updateData($tblName, $data, $code_name, $code) {
		return $this->db->update($tblName, $data, "$code_name = '$code'");
	}

}