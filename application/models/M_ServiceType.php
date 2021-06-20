<?php
class M_ServiceType extends CI_Model{
	function getAllServiceType(){
		$this->db->select('st.*, sc.service_category_name, st.active_status as service_type_status');
		$this->db->from('tbl_service_type st');
		$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
	    $this->db->order_by('st.created_datetime','asc');    
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

	function isInstalasiExists($service_category_code) {
		$this->db->where('type','INSTALASI');
		$this->db->where('price >','0');
		$this->db->where('service_category_code',$service_category_code);
		return $this->db->count_all_results('tbl_service_type');
	}

	function getInstalasiService($service_category_code) {
		$this->db->select('*, sc.service_category_name');
		$this->db->from('tbl_service_type st');
		$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
		$this->db->where('sc.service_category_code', $service_category_code);
		$this->db->where('st.type', 'INSTALASI');
		$query = $this->db->get();
		return $query->result();
	}

	function getServiceTypeDetailByCategoryCodeAndType($service_category_code, $type) {
		$this->db->select('*, sc.service_category_name');
		$this->db->from('tbl_service_type st');
		$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code', 'left');
		$this->db->where('sc.service_category_code', $service_category_code);
		$this->db->where('type', $type);
		$query = $this->db->get();
		return $query->result();
	}

	function getServiceTypeDetailByCodeAndType($service_type_code, $type) {
		$this->db->select('*, sc.service_category_name');
		$this->db->from('tbl_service_type st');
		$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
		$this->db->where('st.service_category_code', $service_type_code);
		$this->db->where('`type`', $type);
		$query = $this->db->get();
		return $query->result();
	}
}