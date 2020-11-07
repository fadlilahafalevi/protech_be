<?php
class M_FAQ extends CI_Model{
	function getAllService(){
		$query = $this->db->get('tbl_faq');
		return $query->result();
	}

	public function getOneById($id) {
		$this->db->select('*');
		$this->db->from('tbl_faq');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getNextSequenceId() {
		$query=$this->db->query("SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='tbl_faq' and TABLE_SCHEMA = 'db_protech'");
		return $query->row()->auto_value;
		 
	}

	function inputData($serviceCode, $service_name, $service_desc){
		$result=$this->db->query("INSERT INTO tbl_service(service_code, service_name, service_desc) VALUES ('$serviceCode','$service_name','$service_desc')");
		return $result;
	}

	function updateData($serviceCode, $service_name, $service_desc, $active_status) {
		$result=$this->db->query("UPDATE tbl_service SET service_name='$service_name', service_desc='$service_desc', active_status=$active_status WHERE service_code='$serviceCode'");
		return $result;
	}
}