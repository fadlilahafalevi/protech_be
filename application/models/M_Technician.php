<?php
class M_Technician extends CI_Model{
	function getAllTechnician(){
		$this->db->select('t.*, w.balance');
		$this->db->from('tbl_technician t');
		$this->db->join('tbl_wallet w', 'w.phone = t.phone', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneById($code) {
		$this->db->select('*');
		$this->db->from('tbl_technician');
		$this->db->where('technician_code', $code);
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
	
	public function getCheckedServiceByTechID($id){
		$query = $this->db->get('tbl_service_category');
		$return = array();

		foreach ($query->result() as $category) {
			$return[$category->service_category_code] = $category;
			$return[$category->service_category_code]->subs = $this->getCheckedServiceDetailByTechID($category->service_category_code, $id);
		}
		return $return;
	}

	public function getCheckedServiceDetailByTechID($service_category_code, $id) {
        $query=$this->db->query("select	sc.service_category_name, sr.is_checked, sd.* from tbl_service_detail sd left join tbl_service_category sc on sc.service_category_code = sd.service_category_code left join (select *, 1 as 'is_checked' from tbl_service_ref where technician_code = '$id') sr on sr.service_detail_code = sd.service_detail_code where sd.service_category_code = '$service_category_code'");
        return $query->result();
	}

	function inputData($email, $password, $role_id, $fullname, $phone, $full_address, $latitude, $longitude, $identity_number, $bank_account_number, $active_status){
		$result=$this->db->query("INSERT INTO tbl_technician(email, password, role_id, fullname, phone, full_address, latitude, longitude, identity_number, bank_account_number, active_status) 
			VALUES ('$email', md5('$password'), '$role_id', '$fullname', '$phone', '$full_address', '$latitude', '$longitude', '$identity_number', '$bank_account_number', '$active_status')");
		return $result;
	}

	function insertServiceRef($data) {
		return $this->db->insert('tbl_service_ref', $data);
	}

	function updateData($id, $email, $fullname, $phone, $full_address, $latitude, $longitude, $identity_number, $bank_account_number, $active_status){
		$result=$this->db->query("UPDATE `tbl_technician` SET  email='$email', fullname='$fullname', phone='$phone', full_address='$full_address', latitude='$latitude', longitude='$longitude', identity_number='$identity_number', bank_account_number = '$bank_account_number', active_status = '$active_status' WHERE id = '$id'");
		return $result;
	}

	function updatePassword($id, $password){
		$result=$this->db->query("UPDATE `tbl_technician` SET  password=md5('$password')  WHERE id = '$id'");
		return $result;
	}

	function deleteServiceRef($technician_code){
		$this->db->where('technician_code', $technician_code);
		$this->db->delete('tbl_service_ref');
	}
}