<?php
class M_Technician extends CI_Model{
	function getAllTechnician(){
		$this->db->select('*, up.active_status as up_active_status');
		$this->db->from('tbl_user_profile up');
    	$this->db->join('tbl_user_login ul', 'ul.user_code=up.user_code');
	    $this->db->where('ul.role_id',3);
	    $this->db->order_by('up.created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}

	function getTechnicianDetailByCode($user_code) {
		$this->db->select('*, up.active_status as up_active_status');
		$this->db->select('DAY(date_of_birth) as d_dob, MONTH(date_of_birth) as m_dob, YEAR(date_of_birth) as y_dob');
		$this->db->from('tbl_user_profile up');
    	$this->db->join('tbl_user_login ul', 'ul.user_code=up.user_code');
	    $this->db->where('ul.role_id',3);
		$this->db->where('up.user_code', $user_code);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getCheckedServiceCategory($user_code){
		$this->db->select('sc.service_category_code, if(sr.service_ref_id is null, "false", "true") as checked, sc.service_category_name');
		$this->db->from('tbl_service_category sc');
    	$this->db->join('tbl_service_ref sr', "sc.service_category_code=sr.service_category_code and sr.user_code='".$user_code."'", 'left');
		$query = $this->db->get();
		return $query->result();
	}
}