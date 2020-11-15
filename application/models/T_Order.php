<?php
class T_Order extends CI_Model{
	function countWaitingPaymentStatus(){
		$this->db->select('count(*) as result_count');
		$this->db->from('tbl_order');
		$this->db->where('order_status', 1);
		$query = $this->db->get();
		return $query->row()->result_count;
	}

	function countInProgressStatus(){
		$this->db->select('count(*) as result_count');
		$this->db->from('tbl_order');
		$this->db->where('order_status', 2);
		$query = $this->db->get();
		return $query->row()->result_count;
	}

	function countFinishedStatus(){
		$this->db->select('count(*) as result_count');
		$this->db->from('tbl_order');
		$this->db->where('order_status', 3);
		$query = $this->db->get();
		return $query->row()->result_count;
	}

	function countCanceledStatus(){
		$this->db->select('count(*) as result_count');
		$this->db->from('tbl_order');
		$this->db->where('order_status', 4);
		$query = $this->db->get();
		return $query->row()->result_count;
	}
}
?>