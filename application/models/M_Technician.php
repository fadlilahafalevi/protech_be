<?php
class M_Technician extends CI_Model{
	function getAllTechnician(){
		$this->db->select('*, up.active_status as up_active_status');
		$this->db->from('tbl_user_profile up');
    	$this->db->join('tbl_user_login ul', 'ul.user_code=up.user_code');
	    $this->db->where('ul.role_id',3);
	    $this->db->order_by('up.created_datetime','desc');    
		$query = $this->db->get();
		return $query->result();
	}

	function getTechnicianDetailByCode($user_code) {
		$this->db->select('*, up.active_status as up_active_status');
		$this->db->from('tbl_user_profile up');
    	$this->db->join('tbl_user_login ul', 'ul.user_code=up.user_code');
	    $this->db->where('ul.role_id',3);
		$this->db->where('up.user_code', $user_code);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getCheckedServiceType($user_code){
		$this->db->select('st.service_type_code, st.service_type_name, if(sr.service_ref_id is null, "false", "true") as checked, sc.service_category_name');
		$this->db->from('tbl_service_type st');
    	$this->db->join('tbl_service_ref sr', "st.service_type_code=sr.service_type_code and sr.user_code='".$user_code."'", 'left');
    	$this->db->join('tbl_service_category sc', 'sc.service_category_code=st.service_category_code', 'left');
		$query = $this->db->get();
		return $query->result();
	}
}