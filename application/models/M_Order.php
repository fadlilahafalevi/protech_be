<?php
class M_Order extends CI_Model{
	function getAllOrder(){
		$this->db->select('*');
		$this->db->from('tbl_order o');
    	$this->db->join('tbl_order_detail od', 'od.order_code=o.order_code');
	    $this->db->order_by('o.created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}

	function getOrderDetailByCode($order_code) {
		$this->db->select('*');
		$this->db->from('tbl_order o');
    	$this->db->join('tbl_order_detail od', 'od.order_code=o.order_code');
		$this->db->where('o.order_code', $order_code);
		$query = $this->db->get();
		return $query->result();
	}
}