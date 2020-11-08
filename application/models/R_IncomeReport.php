<?php
class R_IncomeReport extends CI_Model{
	function getAllIncomeReport(){
		$this->db->select('id, order_code, fix_datetime, total_amount');
		$this->db->from('tbl_order');
		$query = $this->db->get();
		return $query->result();
	}
}