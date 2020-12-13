<?php
class T_Order extends CI_Model{
	function countWaitingConfirmationStatus(){
		$this->db->select('count(*) as result_count');
		$this->db->from('tbl_order');
		$this->db->where('order_status', 'WAITING CONFIRMATION');
		$query = $this->db->get();
		return $query->row()->result_count;
	}

	function countInProgressStatus(){
		$this->db->select('count(*) as result_count');
		$this->db->from('tbl_order');
		$this->db->where('order_status', 'IN PROGRESS');
		$query = $this->db->get();
		return $query->row()->result_count;
	}

	function countFinishedStatus(){
		$this->db->select('count(*) as result_count');
		$this->db->from('tbl_order');
		$this->db->where('order_status', 'FINISHED');
		$query = $this->db->get();
		return $query->row()->result_count;
	}

	function countCanceledStatus(){
		$this->db->select('count(*) as result_count');
		$this->db->from('tbl_order');
		$this->db->where('order_status', 'CANCELED');
		$query = $this->db->get();
		return $query->row()->result_count;
	}
}
?>