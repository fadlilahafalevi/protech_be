<?php
class Login extends CI_Model{
    public function cekadmin($email,$password){
        $hasil=$this->db->query("select id, role_id, email,  password=md5(password) as password, fullname from tbl_admin union all select id, role_id, email, password=md5(password) as password, fullname from tbl_customer union all select id, role_id, email, password=md5(password) as password, fullname from tbl_technician where email = '$email' and password=md5('$password') and active_status=1");
        return $hasil;
    }  
}
