<?php
class M_ServiceCategory extends CI_Model{
	function getAllServiceCategory(){
		$this->db->select('*');
		$this->db->from('tbl_service_category');
	    $this->db->order_by('created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}

	function getServiceCategoryDetailByCode($service_category_code) {
		$this->db->select('*');
		$this->db->from('tbl_service_category');
		$this->db->where('service_category_code', $service_category_code);
		$query = $this->db->get();
		return $query->result();
	}

	function getActiveServiceCategoryForCustomer($user_code = '') {
		$this->db->select('*');
		$this->db->from('tbl_service_category');
		$this->db->where('active_status', 1);
	    $this->db->order_by('created_datetime','asc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_instalasi_pengecekan($service_category_code) {
		$this->db->select('tst.service_type_code as code_instalasi, tst2.service_type_code as code_pengecekan');
		$this->db->select('tst.service_type_name as instalasi, tst2.service_type_name as pengecekan');
		$this->db->select('tst.price as price_instalasi, tst2.price as price_pengecekan');
		$this->db->from('tbl_service_category tsc');
		$this->db->join('tbl_service_type tst', 'tst.service_category_code  = tsc.service_category_code and tst.`type` = "INSTALASI"', 'left');
		$this->db->join('tbl_service_type tst2', 'tst2.service_category_code = tsc.service_category_code and tst2.`type` = "PERBAIKAN" and tst2.service_type_name = "Pengecekan"', 'left');
		$this->db->where('tsc.service_category_code', $service_category_code);
		$query = $this->db->get();
		return $query->result();
	}
}