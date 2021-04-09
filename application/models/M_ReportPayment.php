<?php
class M_ReportPayment extends CI_Model{
	function getAllReportPayment(){
		$this->db->select("*, concat(coalesce(c.first_name,''), ' ', coalesce(c.middle_name,''), ' ', coalesce(c.last_name,'')) as customer_name, concat(coalesce(t.first_name,''), ' ', coalesce(t.middle_name,''), ' ', coalesce(t.last_name,'')) as technician_name");
		$this->db->from('tbl_payment p');
	    $this->db->join('tbl_order o', 'p.order_code = o.order_code');
	    $this->db->join('tbl_user_profile c', 'c.user_code = o.customer_code');
	    $this->db->join('tbl_user_profile t', 't.user_code = o.technician_code');
	    $this->db->order_by('p.created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}
}