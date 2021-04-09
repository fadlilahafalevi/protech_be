<?php
class M_General extends CI_Model{

	function getSequence($tbl_name, $lpad, $code) {
		$query=$this->db->query("SELECT concat('$code', CONVERT( LPAD(count(*) + 1, $lpad, 0), varchar(10)) ) as next_code from $tbl_name");
		return $query->row()->next_code;
	}
	
	function getSequenceOrder($tbl_name, $lpad) {
	    $query=$this->db->query("SELECT concat(date_format(CURDATE(), '%Y%m%d'),'', CONVERT( LPAD(count(*) + 1, $lpad, 0), varchar(10)) ) as next_code from $tbl_name");
	    print_r($this->db->last_query());
	    return $query->row()->next_code;
	}

	function insertData($tblName, $data){
		$this->db->insert($tblName, $data);
		$insertId = $this->db->insert_id();
		return  $insertId;
	}

	function updateData($tblName, $data, $code_name, $code) {
		$query = $this->db->update($tblName, $data, "$code_name = '$code'");
		return $query;
	}
	
	function deleteData($tblName, $where) {
	    return $this->db->query("DELETE FROM $tblName where $where");
	}

	function updateMeta($tbl_name, $code_name, $code_data, $username){
		$query=$this->db->query("UPDATE $tbl_name set modified_by = '$username', modified_datetime = current_timestamp() where $code_name = '$code_data'");
		return $query;
	}

}