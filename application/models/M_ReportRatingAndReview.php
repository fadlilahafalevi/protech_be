<?php
class M_ReportRatingAndReview extends CI_Model{
	function getAllReportRatingAndReview(){
		$this->db->select("*, concat(coalesce(t.first_name,''), ' ', coalesce(t.middle_name,''), ' ', coalesce(t.last_name,'')) as technician_name");
		$this->db->select("concat(coalesce(c.first_name,''), ' ', coalesce(c.middle_name,''), ' ', coalesce(c.last_name,'')) as customer_name");
		$this->db->from('tbl_review r');
	    $this->db->join('tbl_order o', 'r.order_code = o.order_code', 'left');
	    $this->db->join('tbl_user_profile t', 't.user_code = o.technician_code', 'left');
	    $this->db->join('tbl_user_profile c', 'c.user_code = o.customer_code', 'left');
	    $this->db->join('tbl_service_category sc', 'sc.service_category_code = o.service_category_code', 'left');
	    $this->db->order_by('o.created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}
}