<?php
class M_ReportOrder extends CI_Model{
	function getAllReportOrder(){
		$this->db->select("*, concat(coalesce(t.first_name,''), ' ', coalesce(t.middle_name,''), ' ', coalesce(t.last_name,'')) as technician_name");
		$this->db->from('tbl_order o');
	    $this->db->join('tbl_user_profile t', 't.user_code = o.technician_code');
	    $this->db->order_by('o.created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}
}