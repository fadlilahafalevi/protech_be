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
		$query1 = $this->db->query("select service_category_code from tbl_order to2 where to2.customer_code = '".$user_code."' and to2.order_status not in ('MENUNGGU KONFIRMASI', 'DIBATALKAN', 'SELESAI')");
		$query1_result = $query1->result();
		$service_category= array();
		foreach($query1_result as $row){
			$service_category[] = $row->service_category_code;
		}
		$service_category_code = implode(",",$service_category);
		$ids = explode(",", $service_category_code);
		
		$this->db->select('*');
		$this->db->from('tbl_service_category');
		$this->db->where('active_status', 1);
		$this->db->where_not_in('service_category_code', $ids);
	    $this->db->order_by('created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}
}