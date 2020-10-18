<?php
class M_UserRole extends CI_Model{
	function getAllUserRole(){
		$query = $this->db->get('user_role');
		return $query->result();
	}

	public function getUserRoleByID($id) {
		$this->db->select('*');
		$this->db->from('user_role');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function updateUserNoPassword($val){
        $this->load->model('M_Kategori');

		$data_to_update = array(
            "role_code"			=> $val['role_code']
        );

		$this->db->where('id', $val["id"]);
        return $this->db->update('user_role', $data_to_update);
	}

	public function updateUser($id, $password, $role_code){
		$result=$this->db->query("UPDATE user_role SET password=md5('$password'), role_code='$role_code' WHERE id='$id'");
		return $result;
	}

	public function activateUser($id){
		$result=$this->db->query("UPDATE user_role SET active_status=1 WHERE id='$id'");
		return $result;
	}

	public function inactivateUser($id){
		$result=$this->db->query("UPDATE user_role SET active_status=0 WHERE id='$id'");
		return $result;
	}

	function input_data($user_name, $password, $role_code){
		$result=$this->db->query("INSERT INTO user(user_name, password, role_code, active_status) VALUES ('$user_name', md5('$password'), '$role_code', '0')");
		return $result;
	}
	// function update_pengguna_nopass($kode,$nama,$username,$level){
	// 	$hsl=$this->db->query("UPDATE user SET user_nama='$nama',user_username='$username',role_code='$level' WHERE id='$kode'");
	// 	return $hsl;
	// }
	// function update_status($kode){
	// 	$hsl=$this->db->query("UPDATE user SET active_status='0' WHERE id='$kode'");
	// 	return $hsl;
	// }
}