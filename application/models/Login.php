<?php
class Login extends CI_Model{
    public function cekadmin($email,$password){
        $hasil=$this->db->query("select ul.user_code, ul.role_id, email, concat(coalesce(first_name,''), ' ', coalesce(middle_name,''), ' ', coalesce(last_name,'')) as fullname, phone 
			from tbl_user_login ul 
			join tbl_user_profile up on up.user_code = ul.user_code
			join tbl_user_role ur on ur.role_id = ul.role_id
			where email = '$email' and password=md5('$password') and ul.active_status=1");
        return $hasil;
    }  
}
