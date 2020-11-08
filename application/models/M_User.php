<?php
class M_User extends CI_Model{
	function getAllUser(){
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneById($id) {
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneByEmail($email) {
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query->row()->id;
	}

	public function getNextSequenceId() {
		$query=$this->db->query("SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='tbl_user' and TABLE_SCHEMA = 'db_protech'");
		return $query->row()->auto_value;
		 
	}

	function inputData($email, $password, $role_id, $fullname, $phone, $full_address, $identity_number, $active_status){
		$result=$this->db->query("INSERT INTO tbl_admin(email, password, role_id, fullname, phone, full_address, identity_number, active_status) 
			VALUES ('$email', md5('$password'), '$role_id', '$fullname', '$phone', '$full_address', '$identity_number', $active_status)");
		return $result;
	}

	function updateData($id, $email, $fullname, $phone, $full_address, $identity_number, $active_status){
		$result=$this->db->query("UPDATE `tbl_admin` SET  email='$email', fullname='$fullname', phone='$phone', full_address='$full_address', identity_number='$identity_number', active_status = $active_status WHERE id = '$id'");
		return $result;
	}
}