<?php
class M_Order extends CI_Model{
	public function searchTechnician($latitude, $longitude, $service_code){
		$result=$this->db->query("SELECT * , (6371 * 2 * ASIN(SQRT( POWER(SIN(( $latitude - t.latitude) *  pi()/180 / 2), 2) +COS( $latitude * pi()/180) * COS(t.latitude * pi()/180) * POWER(SIN(( $longitude - t.longitude) * pi()/180 / 2), 2) ))) as distance, t.technician_code as tech_id FROM  tbl_technician t LEFT JOIN tbl_service_ref sr on sr.technician_code = t.technician_code WHERE sr.service_detail_code = '$service_code'  HAVING distance <= 10 ORDER BY distance");
		return $result->result();
	}

	public function getAllByCustomerCode($code) {
		$this->db->select('o.*, c.fullname as customer_name, t.fullname as technician_name');
		$this->db->from('tbl_order o');
		$this->db->join('tbl_customer c', 'c.customer_code = o.customer_code', 'left');
		$this->db->join('tbl_technician t', 't.technician_code = o.technician_code', 'left');
		$this->db->where('o.customer_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllByTechnicianCode($code) {
		$this->db->select('o.*, c.fullname as customer_name, t.fullname as technician_name');
		$this->db->from('tbl_order o');
		$this->db->join('tbl_customer c', 'c.customer_code = o.customer_code', 'left');
		$this->db->join('tbl_technician t', 't.technician_code = o.technician_code', 'left');
		$this->db->where('o.technician_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneByCode($code) {
		$this->db->select('o.*, c.fullname as customer_name, t.fullname as technician_name');
		$this->db->from('tbl_order o');
		$this->db->join('tbl_customer c', 'c.customer_code = o.customer_code', 'left');
		$this->db->join('tbl_technician t', 't.technician_code = o.technician_code', 'left');
		$this->db->where('o.order_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getDetailByCode($code) {
		$this->db->select('od.*, concat(sc.service_category_name, \' - \', sd.service_detail_name, \' - \', st.service_type_name) as service');
		$this->db->from('tbl_order_detail od');
		$this->db->join('tbl_service_type st', 'st.service_type_code = od.service_type_code', 'left');
		$this->db->join('tbl_service_detail sd', 'sd.service_detail_code = st.service_detail_code', 'left');
		$this->db->join('tbl_service_category sc', 'sc.service_category_code = sd.service_category_code', 'left');
		$this->db->where('od.order_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOrderId() {
		$query=$this->db->query("SELECT concat(date_format(CURDATE(), '%Y%m%d'),'-',(SELECT LPAD((SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='tbl_order' and TABLE_SCHEMA = 'db_protech'), 4, '0'))) as auto_value");
		return $query->row()->auto_value;
		 
	}

	public function checkUniqueNumber($unique_number) {
		$query=$this->db->query("SELECT count(*) as unique_number from tbl_payment_unique_code where unique_number = '$unique_number'");
		return $query->row()->unique_number;
	}

	public function getLastIdWithOrderCode($code) {
		$query=$this->db->query("SELECT MAX(id) as lastId from tbl_order_detail where order_code = '$code'");
		return $query->row()->lastId;
	}

	public function inputData($tbl_name, $data) {
		return $this->db->insert($table_name, $data);
	}

	public function updateData($serviceDetailCode, $service_code, $tbl_service_detail_name, $price, $img_icon) {
		$result=$this->db->query("UPDATE tbl_service_detail SET service_code='$serviceCode', service_detail_name=NULL, price=NULL, img_icon=NULL, created_by=NULL, created_datetime=NULL, modified_by=NULL, modified_datetime=current_timestamp(), active_status=NULL
			WHERE service_detail_code='$serviceDetailCode';");
		return $result;
	}
}