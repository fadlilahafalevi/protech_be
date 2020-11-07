<?php
class M_Technician extends CI_Model{
	function getAllTechnician(){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('role_id', '4');
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneById($id) {
		$this->db->select('user.*, user_role.role_name');
		$this->db->from('tbl_user user');
		$this->db->join('tbl_user_role user_role', 'user.role_id = user_role.id', 'left');
		$this->db->where('user.id', $id);
		$query = $this->db->get();
		return $query->result();
	}
}