<?php
class Login extends CI_Model{
    public function cekadmin($u,$p){
        $hasil=$this->db->query("select * from tbl_user where username='$u' and password=md5('$p') and active_status=1");
        return $hasil;
    }  
}
