<?php
class M_Service extends CI_Model{
	public function getAllServiceCategory(){
		$query = $this->db->get('tbl_service_category');
		$return = array();

		foreach ($query->result() as $category) {
			$return[$category->service_category_code] = $category;
			$return[$category->service_category_code]->subs = $this->getAllServiceDetailByCategory($category->service_category_code);
		}
		return $return;
	}

	public function getAllServiceDetail() {
		$this->db->select('*');
		$this->db->from('tbl_service_detail');
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllServiceDetailByCategory($code) {
		$this->db->select('*');
		$this->db->from('tbl_service_detail');
		$this->db->where('service_category_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllServiceTypeByDetail($code) {
		$this->db->select('*');
		$this->db->from('tbl_service_type');
		$this->db->where('service_detail_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getServiceCategoryByCode($code){
		$this->db->select('*');
		$this->db->from('tbl_service_category');
		$this->db->where('service_category_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getServiceDetailByCode($code){
		$this->db->select('d.*, c.service_category_name');
		$this->db->from('tbl_service_detail d');
		$this->db->join('tbl_service_category c', 'c.service_category_code = d.service_category_code', 'left');
		$this->db->where('d.service_detail_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getServiceTypeByCode($code) {
		$this->db->select('*');
		$this->db->from('tbl_service_type');
		$this->db->where('service_type_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getNextSequenceId($tblName) {
		$query = $this->db->query("SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='$tblName' and TABLE_SCHEMA = 'db_protech'");
		return $query->row()->auto_value;
		 
	}

	function inputData($tblName, $data){
		return $this->db->insert($tblName, $data);
	}

	function updateData($tblName, $data, $id) {
		return $this->db->update($tblName, $data, "id = $id");
	}
}