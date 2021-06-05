<?php
class M_Dashboard extends CI_Model{
	function getServiceByTechnician(){
		$this->db->select('tsc.service_category_name as service_name, count(tsr.user_code) as count');
		$this->db->from('tbl_service_ref tsr');
    	$this->db->join('tbl_service_category tsc', 'tsc.service_category_code = tsr.service_category_code', 'left');
	    $this->db->group_by('tsr.service_category_code');
	    $this->db->order_by('tsc.service_category_code','asc');    
		$query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result();
	}

	function getOrderByMonth(){
		$this->db->select('monthname(created_datetime) as bulan, count(*) as count');
		$this->db->from('tbl_order');
	    $this->db->where('year(created_datetime) = year(now())');
	    $this->db->group_by('month(created_datetime)');
	    $this->db->order_by('month(created_datetime)','asc');    
		$query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result();
	}

	function getOrderByStatus(){
		$this->db->select('order_status as status, count(*) as count');
		$this->db->from('tbl_order');
	    $this->db->group_by('order_status');
	    $this->db->order_by('order_status','asc');    
		$query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result();
	}

	function getOrderByStatusByTechnician($code = ''){
		$this->db->select('order_status as status, count(*) as count');
		$this->db->from('tbl_order');
		$this->db->where('technician_code', $code);
	    $this->db->group_by('order_status');
	    $this->db->order_by('order_status','asc');    
		$query = $this->db->get();
		echo $this->db->last_query();
		return $query->result();
	}
}