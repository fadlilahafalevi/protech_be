<?php
class M_Metadata extends CI_Model{
	public function createMeta($tbl_name, $idData, $username){
		$query=$this->db->query("UPDATE $tbl_name set created_by = '$username', created_datetime = current_timestamp() where id = $idData");
		return $query;
	}

	public function updateMeta($tbl_name, $idData, $username){
		$query=$this->db->query("UPDATE $tbl_name set modified_by = '$username', modified_datetime = current_timestamp() where id = $idData");
		return $query;
	}
}