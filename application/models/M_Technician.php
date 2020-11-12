<?php
class M_Technician extends CI_Model{
	function getAllTechnician(){
		$this->db->select('*');
		$this->db->from('tbl_technician');
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneById($id) {
		$this->db->select('*');
		$this->db->from('tbl_technician');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneByEmail($email) {
		$this->db->select('*');
		$this->db->from('tbl_technician');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query->row()->id;
	}

	public function getDataTechnicianByEmail($email) {
		$this->db->select('*');
		$this->db->from('tbl_technician');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query->result();
	}

	function inputData($email, $password, $role_id, $fullname, $phone, $full_address, $latitude, $longitude, $identity_number, $bank_account_number, $active_status){
		$result=$this->db->query("INSERT INTO tbl_technician(email, password, role_id, fullname, phone, full_address, latitude, longitude, identity_number, bank_account_number, active_status) 
			VALUES ('$email', md5('$password'), '$role_id', '$fullname', '$phone', '$full_address', '$latitude', '$longitude', '$identity_number', '$bank_account_number', '$active_status')");
		return $result;
	}

	function updateData($id, $email, $fullname, $phone, $full_address, $latitude, $longitude, $identity_number, $bank_account_number, $active_status){
		$result=$this->db->query("UPDATE `tbl_technician` SET  email='$email', fullname='$fullname', phone='$phone', full_address='$full_address', latitude='$latitude', longitude='$longitude', identity_number='$identity_number', bank_account_number = '$bank_account_number', active_status = '$active_status' WHERE id = '$id'");
		return $result;
	}

	function updatePassword($id, $password){
		$result=$this->db->query("UPDATE `tbl_technician` SET  password=md5('$password')  WHERE id = '$id'");
		return $result;
	}
}