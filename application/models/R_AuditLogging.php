<?php
class R_AuditLogging extends CI_Model{
	function getAllAuditLogging(){
		$this->db->select('*');
		$this->db->from('tbl_audit_log');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function insertLog($menu, $action, $email){
		$query=$this->db->query("INSERT INTO tbl_audit_log (menu, action, email_user, action_datetime) VALUES('$menu', '$action', '$email', current_timestamp)");
		return $query;
	}
}