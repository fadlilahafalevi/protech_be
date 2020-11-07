<?php
class M_Service extends CI_Model{
	function getAllService(){
		$query = $this->db->get('tbl_service');
		return $query->result();
	}

	public function getOneById($id) {
		$this->db->select('*');
		$this->db->from('tbl_service');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getNextSequenceId() {
		$query=$this->db->query("SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='tbl_service' and TABLE_SCHEMA = 'db_protech'");
		return $query->row()->auto_value;
		 
	}

	function inputData($serviceCode, $service_name){
		$result=$this->db->query("INSERT INTO tbl_service(service_code, service_name) VALUES ('$serviceCode','$service_name')");
		return $result;
	}

	function updateData($serviceCode, $service_name, $active_status) {
		$result=$this->db->query("UPDATE tbl_service SET service_name='$service_name', active_status=$active_status WHERE service_code='$serviceCode'");
		return $result;
	}
}