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

	function getActiveServiceCategory(){
		$this->db->select('*');
		$this->db->from('tbl_service_category');
		$this->db->where('active_status', 1);
	    $this->db->order_by('created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}
}