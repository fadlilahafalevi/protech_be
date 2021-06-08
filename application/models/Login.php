<?php
class Login extends CI_Model{
    public function cekadmin($email,$password){
        $hasil=$this->db->query("select ul.user_code, ul.role_id, email, concat(coalesce(first_name,''), ' ', coalesce(middle_name,''), ' ', coalesce(last_name,'')) as fullname, phone,
        	is_verified, email, ul.active_status
			from tbl_user_login ul 
			join tbl_user_profile up on up.user_code = ul.user_code
			join tbl_user_role ur on ur.role_id = ul.role_id
			where email = '$email' and password=md5('$password')");
        // echo $this->db->last_query();
        return $hasil;
    }

    public function get_verification_data($user_code = '') {
    	$this->db->select('verification_code');
		$this->db->from('tbl_user_login');
	    $this->db->where('user_code', $user_code);    
		$query = $this->db->get();
		return $query->result();
    }

    public function get_existing_email($email = '') {
    	$this->db->select('count(*) as count');
		$this->db->from('tbl_user_login');
	    $this->db->where('email', $email);    
		$query = $this->db->get();
		$count_data = $query->result();
		return $count_data[0]->count;
    }

    public function get_user_code_by_email($email = '') {
    	$this->db->select('user_code');
		$this->db->from('tbl_user_login');
	    $this->db->where('email', $email);    
		$query = $this->db->get();
		$count_data = $query->result();
		return $count_data[0]->user_code;
    }
}
