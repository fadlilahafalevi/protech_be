<?php
class M_Metadata extends CI_Model{
	public function createMeta($tbl_name, $code_name, $code_data, $username){
		$query=$this->db->query("UPDATE $tbl_name set created_by = '$username', created_datetime = current_timestamp() where '$code_name' = '$code_data'");
		return $query;
	}

	public function updateMeta($tbl_name, $code_name, $code_data, $username){
		$query=$this->db->query("UPDATE $tbl_name set modified_by = '$username', modified_datetime = current_timestamp() where '$code_name' = '$code_data'");
		return $query;
	}
}