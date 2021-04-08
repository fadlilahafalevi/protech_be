<?php
class M_ServiceType extends CI_Model{
	function getAllServiceType(){
		$this->db->select('st.*, sc.service_category_name');
		$this->db->from('tbl_service_type st');
		$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
		$query = $this->db->get();
		return $query->result();
	}

	function getServiceTypeDetailByCode($service_type_code) {
		$this->db->select('*, sc.service_category_name');
		$this->db->from('tbl_service_type st');
		$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
		$this->db->where('service_type_code', $service_type_code);
		$query = $this->db->get();
		return $query->result();
	}

	function getServiceTypeDetailByCategoryCode($service_category_code) {
		$this->db->select('*, sc.service_category_name');
		$this->db->from('tbl_service_type st');
		$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
		$this->db->where('sc.service_category_code', $service_category_code);
		$query = $this->db->get();
		return $query->result();
	}
}