<?php
class Login extends CI_Model{
    public function cekadmin($u,$p){
        $hasil=$this->db->query("select * from tbl_user where user_name='$u' and user_password=md5('$p') and user_status=1");
        return $hasil;
    }  
}
