<?php
class Login extends CI_Model{
    public function cekadmin($email,$password){
        $hasil=$this->db->query("(select admin_code as code, role_id, email, fullname, phone from tbl_admin where email = '$email' and password=md5('$password') and active_status=1) union (select  customer_code as code, role_id, email, fullname, phone from tbl_customer where email = '$email' and password=md5('$password') and active_status=1) union (select  technician_code as code, role_id, email, fullname, phone from tbl_technician where email = '$email' and password=md5('$password') and active_status=1)");
        return $hasil;
    }  
}
