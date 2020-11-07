<?php
class M_User extends CI_Model{
	function getAllUser(){
		$this->db->select('user.*, user_role.role_name');
		$this->db->from('tbl_user user');
		$this->db->join('tbl_user_role user_role', 'user.role_id = user_role.id', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneById($id) {
		$this->db->select('user.*, user_role.role_name');
		$this->db->from('tbl_user user');
		$this->db->join('tbl_user_role user_role', 'user.role_id = user_role.id', 'left');
		$this->db->where('user.id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneByCode($user_code) {
		$this->db->select('user.id as userId');
		$this->db->from('tbl_user user');
		$this->db->join('tbl_user_role user_role', 'user.role_id = user_role.id', 'left');
		$this->db->where('user.user_code', $user_code);
		$query = $this->db->get();
		return $query->row()->userId;
	}

	public function getNextSequenceId() {
		$query=$this->db->query("SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='tbl_user' and TABLE_SCHEMA = 'db_protech'");
		return $query->row()->auto_value;
		 
	}

	function inputData($userCode, $username, $password, $role_id, $email, $fullname, $phone, $active_status){
		$result=$this->db->query("INSERT INTO tbl_user(user_code, username, password, role_id, email, fullname, phone, active_status) 
			VALUES ('$userCode','$username', md5('$password'), '$role_id', '$email', '$fullname', '$phone', '$active_status')");
		return $result;
	}

	function updateData($user_code, $active_status){
		$result=$this->db->query("UPDATE `tbl_user` SET active_status = $active_status WHERE user_code = '$user_code'");
		return $result;
	}
}