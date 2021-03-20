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
	
	function getCheckedServiceByTechID($id){
		$query = $this->db->get('tbl_service_category');
		$return = array();

		foreach ($query->result() as $category) {
			$return[$category->service_category_code] = $category;
			$return[$category->service_category_code]->subs = $this->getCheckedServiceDetailByTechID($category->service_category_code, $id);
		}
		return $return;
	}

	function getCheckedServiceDetailByTechID($service_category_code, $id) {
        $query=$this->db->query("select	sc.service_category_name, sr.is_checked, sd.* from tbl_service_detail sd left join tbl_service_category sc on sc.service_category_code = sd.service_category_code left join (select *, 1 as 'is_checked' from tbl_service_ref where technician_code = '$id') sr on sr.service_detail_code = sd.service_detail_code where sd.service_category_code = '$service_category_code'");
        return $query->result();
	}
}