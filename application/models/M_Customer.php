<?php
class M_Customer extends CI_Model{
	function getAllCustomer(){
		$this->db->select('*, up.active_status as up_active_status');
		$this->db->from('tbl_user_profile up');
    	$this->db->join('tbl_user_login ul', 'ul.user_code=up.user_code');
	    $this->db->where('ul.role_id',4);
	    $this->db->order_by('up.created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}

	function getCustomerDetailByCode($user_code) {
		$this->db->select('*, up.active_status as up_active_status');
		$this->db->from('tbl_user_profile up');
    	$this->db->join('tbl_user_login ul', 'ul.user_code=up.user_code');
	    $this->db->where('ul.role_id',4);
		$this->db->where('up.user_code', $user_code);
		$query = $this->db->get();
		return $query->result();
	}
}