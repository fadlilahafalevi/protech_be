<?php
class M_Admin extends CI_Model{
	function getAllAdmin(){
		$this->db->select('*, up.active_status as up_active_status');
		$this->db->from('tbl_user_profile up');
    	$this->db->join('tbl_user_login ul', 'ul.user_code=up.user_code');
	    $this->db->where('ul.role_id',2);
	    $this->db->order_by('up.created_datetime','desc');    
		$query = $this->db->get();
		return $query->result();
	}

	function getAdminDetailByCode($user_code) {
		$this->db->select('*, up.active_status as up_active_status');
		$this->db->select('DAY(date_of_birth) as d_dob, MONTH(date_of_birth) as m_dob, YEAR(date_of_birth) as y_dob');
		$this->db->from('tbl_user_profile up');
    	$this->db->join('tbl_user_login ul', 'ul.user_code=up.user_code');
	    $this->db->where('ul.role_id',2);
		$this->db->where('up.user_code', $user_code);
		$query = $this->db->get();
		return $query->result();
	}
}