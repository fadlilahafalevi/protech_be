<?php
class M_Review extends CI_Model{
	function getOneByOrderCode($order_code){
		$this->db->select("*");
		$this->db->from('tbl_review');
	    $this->db->where('order_code',$order_code);    
		$query = $this->db->get();
		return $query->result();
	}

	function get_average_rating_by_user_code($user_code) {
		$this->db->select("avg(rate) average_rate");
		$this->db->from('tbl_review tr');
		$this->db->join('tbl_order to2', 'to2.order_code = tr.order_code', 'left');
		$this->db->join('tbl_user_profile tup', 'tup.user_code = to2.technician_code', 'left');
	    $this->db->where('to2.technician_code',$user_code);    
		$query = $this->db->get();
		return $query->result();
	}
}