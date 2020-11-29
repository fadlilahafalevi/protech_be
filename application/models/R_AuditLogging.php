<?php
class R_AuditLogging extends CI_Model{
	function getAllAuditLogging(){
		$this->db->select('*');
		$this->db->from('tbl_audit_log');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function insertLog($menu, $action, $user_code){
		$query=$this->db->query("INSERT INTO tbl_audit_log (menu, action, user_code, action_datetime) VALUES('$menu', '$action', '$user_code', current_timestamp)");
		return $query;
	}
}