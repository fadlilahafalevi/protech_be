<?php
class M_User extends CI_Model{
	function getAllUser(){
		$query = $this->db->get('tbl_user');
		return $query->result();
	}

	public function getUserByID($user_id) {
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function updateUserNoPassword($val){
        $this->load->model('M_Kategori');

		$data_to_update = array(
            "user_level"			=> $val['user_level']
        );

		$this->db->where('user_id', $val["user_id"]);
        return $this->db->update('tbl_user', $data_to_update);
	}

	public function updateUser($user_id, $user_password, $user_level){
		$result=$this->db->query("UPDATE tbl_user SET user_password=md5('$user_password'), user_level='$user_level' WHERE user_id='$user_id'");
		return $result;
	}

	public function activateUser($user_id){
		$result=$this->db->query("UPDATE tbl_user SET user_status=1 WHERE user_id='$user_id'");
		return $result;
	}

	public function inactivateUser($user_id){
		$result=$this->db->query("UPDATE tbl_user SET user_status=0 WHERE user_id='$user_id'");
		return $result;
	}

	function input_data($user_name, $user_password, $user_level){
		$result=$this->db->query("INSERT INTO tbl_user(user_name, user_password, user_level, user_status) VALUES ('$user_name', md5('$user_password'), '$user_level', '0')");
		return $result;
	}
	// function update_pengguna_nopass($kode,$nama,$username,$level){
	// 	$hsl=$this->db->query("UPDATE tbl_user SET user_nama='$nama',user_username='$username',user_level='$level' WHERE user_id='$kode'");
	// 	return $hsl;
	// }
	// function update_status($kode){
	// 	$hsl=$this->db->query("UPDATE tbl_user SET user_status='0' WHERE user_id='$kode'");
	// 	return $hsl;
	// }
}