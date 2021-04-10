<?php
class M_Review extends CI_Model{
	function getOneByOrderCode($order_code){
		$this->db->select("*");
		$this->db->from('tbl_review');
	    $this->db->where('order_code',$order_code);    
		$query = $this->db->get();
		return $query->result();
	}
}