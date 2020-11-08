<?php
class M_ServiceCategory extends CI_Model{
	function getAllService(){
		$query = $this->db->get('tbl_service_category');
		return $query->result();
	}

	public function getOneById($id) {
		$this->db->select('*');
		$this->db->from('tbl_service_category');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneByCode($service_category_code) {
		$this->db->select('*');
		$this->db->from('tbl_service_category');
		$this->db->where('service_category_code', $service_category_code);
		$query = $this->db->get();
		return $query->row()->id;
	}

	public function getNextSequenceId() {
		$query=$this->db->query("SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='tbl_service_category' and TABLE_SCHEMA = 'db_protech'");
		return $query->row()->auto_value;
		 
	}

	function inputData($service_category_code, $service_category_name){
		$result=$this->db->query("INSERT INTO tbl_service_category(service_category_code, service_category_name, active_status) VALUES ('$service_category_code','$service_category_name', '1')");
		return $result;
	}

	function updateData($service_category_code, $service_name, $active_status) {
		$result=$this->db->query("UPDATE tbl_service_category SET service_category_name='$service_category_name', active_status=$active_status WHERE service_category_code='$service_category_code'");
		return $result;
	}
}