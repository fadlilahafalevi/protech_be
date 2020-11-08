<?php
class R_AuditLogging extends CI_Model{
	public function insertLog($menu, $action, $email){
		$query=$this->db->query("INSERT INTO tbl_audit_log (menu, `action`, email_user, action_datetime) VALUES('$menu', '$action', '$email', current_timestamp)");
		return $query;
	}
}