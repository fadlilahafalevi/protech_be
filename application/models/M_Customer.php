<?php
class M_Customer extends CI_Model{
	function getAllCustomer(){
		$this->db->select('c.*, w.balance');
		$this->db->from('tbl_customer c');
		$this->db->join('tbl_wallet w', 'w.phone = c.phone', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneById($code) {
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->where('customer_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getPhoneByCode($code) {
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->where('customer_code', $code);
		$query = $this->db->get();
		return $query->row()->phone;
	}

	public function getOneByEmail($email) {
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query->row()->id;
	}

	public function getDataCustomerByEmail($email) {
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query->result();
	}

	function inputData($email, $password, $role_id, $fullname, $phone, $full_address, $latitude, $longitude, $active_status){
		$result=$this->db->query("INSERT INTO tbl_customer(email, password, role_id, fullname, phone, full_address, latitude, longitude, active_status) 
			VALUES ('$email', md5('$password'), '$role_id', '$fullname', '$phone', '$full_address', '$latitude', '$longitude', '$active_status')");
		return $result;
	}

	function updateData($id, $email, $fullname, $phone, $full_address, $latitude, $longitude, $active_status){
		$result=$this->db->query("UPDATE `tbl_customer` SET  email='$email', fullname='$fullname', phone='$phone', full_address='$full_address', latitude='$latitude', longitude='$longitude', active_status = '$active_status' WHERE id = '$id'");
		return $result;
	}

	function updatePassword($id, $password){
		$result=$this->db->query("UPDATE `tbl_customer` SET  password=md5('$password')  WHERE id = '$id'");
		return $result;
	}
}