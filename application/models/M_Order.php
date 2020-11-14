<?php
class M_Order extends CI_Model{
	function searchTechnician($latitude, $longitude, $service_code){
		$result=$this->db->query("SELECT * , (6371 * 2 * ASIN(SQRT( POWER(SIN(( $latitude - t.latitude) *  pi()/180 / 2), 2) +COS( $latitude * pi()/180) * COS(t.latitude * pi()/180) * POWER(SIN(( $longitude - t.longitude) * pi()/180 / 2), 2) ))) as distance FROM  tbl_technician t LEFT JOIN tbl_service_ref sr on sr.user_id = t.id WHERE sr.service_detail_code = '$service_code'  HAVING distance <= 10 ORDER BY distance");
		return $result->result();
	}

	public function getOneById($id) {
		$this->db->select('sd.*, s.service_name');
		$this->db->from('tbl_service_detail sd');
		$this->db->join('tbl_service s', 's.service_code = sd.service_code', 'left');
		$this->db->where('sd.id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getNextSequenceId() {
		$query=$this->db->query("SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='tbl_service_detail' and TABLE_SCHEMA = 'db_protech'");
		return $query->row()->auto_value;
		 
	}

	function inputData($serviceDetailCode, $service_code, $tbl_service_detail_name, $price, $img_icon){
		$result=$this->db->query("INSERT INTO tbl_service_detail (service_code, service_detail_code, price, img_icon, service_detail_name,active_status) VALUES('$service_code', '$serviceDetailCode', '$price', '$img_icon', '$tbl_service_detail_name', 1);");
		return $result;
	}

	function updateData($serviceDetailCode, $service_code, $tbl_service_detail_name, $price, $img_icon) {
		$result=$this->db->query("UPDATE tbl_service_detail SET service_code='$serviceCode', service_detail_name=NULL, price=NULL, img_icon=NULL, created_by=NULL, created_datetime=NULL, modified_by=NULL, modified_datetime=current_timestamp(), active_status=NULL
			WHERE service_detail_code='$serviceDetailCode';");
		return $result;
	}
}