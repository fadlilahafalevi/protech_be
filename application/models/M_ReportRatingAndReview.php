<?php
class M_ReportRatingAndReview extends CI_Model{
	function getAllReportRatingAndReview(){
		$this->db->select("*");
		$this->db->from('tbl_review r');
	    $this->db->join('tbl_order o', 'r.order_code = o.order_code');
	    $this->db->order_by('o.created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}
}