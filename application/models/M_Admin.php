<?php
class M_Admin extends CI_Model{
	function getAllAdmin(){
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
		$query=$this->db->query("SELECT concat('A', CONVERT( LPAD((last_code+1), 2, 0), varchar(10)) ) as next_code from tbl_user_role where role_name = 'Admin'");
		return $query->row()->next_code;
		 
	}

	function inputData($email, $password, $role_id, $fullname, $phone, $full_address, $identity_number, $active_status, $admin_code){
		$result=$this->db->query("INSERT INTO tbl_admin(email, password, role_id, fullname, phone, full_address, identity_number, active_status, admin_code) 
			VALUES ('$email', md5('$password'), '$role_id', '$fullname', '$phone', '$full_address', '$identity_number', $active_status, '$admin_code')");
		return $result;
	}

	function updateData($id, $email, $fullname, $phone, $full_address, $identity_number, $active_status){
		$result=$this->db->query("UPDATE `tbl_admin` SET  email='$email', fullname='$fullname', phone='$phone', full_address='$full_address', identity_number='$identity_number', active_status = $active_status WHERE id = '$id'");
		return $result;
	}
}