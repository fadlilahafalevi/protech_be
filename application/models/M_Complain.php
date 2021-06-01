<?php
class M_Complain extends CI_Model{
	function getAllComplain($from_date = '', $to_date = ''){
		$this->db->select('*');
		$this->db->from('tbl_complain');
		 if ($from_date != '') {
			$this->db->where('DATE(created_datetime) >=', $from_date);
		}
		if ($to_date != '') {
			$this->db->where('DATE(created_datetime) <=', $to_date);
		}
	    $this->db->order_by('created_datetime','asc'); 
		$query = $this->db->get();
		return $query->result();
	}

	function getComplainDetailByCode($complain_code) {
		$this->db->select('*');
		$this->db->from('tbl_complain');
		$this->db->where('complain_code', $complain_code);
		$query = $this->db->get();
		return $query->result();
	}

	function getComplainDetailByUserCode($user_code) {
		$this->db->select('c.*');
		$this->db->from('tbl_complain c');
	    $this->db->join('tbl_order o', 'c.order_code = o.order_code');
		$this->db->where('customer_code', $user_code);
		$query = $this->db->get();
		return $query->result();
	}
}