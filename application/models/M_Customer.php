<?php
class M_Customer extends CI_Model{
	function getAllCustomer(){
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneById($id) {
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function inputData($email, $password, $role_id, $fullname, $phone, $full_address, $active_status){
		$result=$this->db->query("INSERT INTO tbl_customer(email, password, role_id, fullname, phone, full_address, active_status) 
			VALUES ('$email', md5('$password'), '$role_id', '$fullname', '$phone', '$full_address', $active_status)");
		return $result;
	}

	function updateData($id, $email, $fullname, $phone, $full_address, $active_status){
		$result=$this->db->query("UPDATE `tbl_customer` SET  email='$email', fullname='$fullname', phone='$phone', full_address='$full_address', active_status = $active_status WHERE id = '$id'");
		return $result;
	}
}