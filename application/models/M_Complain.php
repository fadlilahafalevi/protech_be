<?php
class M_Complain extends CI_Model{
	function getAllComplain(){
		$this->db->select('*');
		$this->db->from('tbl_complain');
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
}