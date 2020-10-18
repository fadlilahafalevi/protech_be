<?php
class Controller_Login extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('Login');
    }

    function index(){
        $this->load->view('login');
    }

    function cekuser(){
        $username   = strip_tags(stripslashes($this->input->post('username',TRUE)));
        $password   = strip_tags(stripslashes($this->input->post('password',TRUE)));

        $cadmin     = $this->Login->cekadmin($username,$password);
        
        if($cadmin->num_rows() > 0){
            $this->session->set_userdata('masuk', true);
            $this->session->set_userdata('user', $username);

            $xcadmin = $cadmin->row_array();
            
            if($xcadmin['role_code'] == 'su'){ //admin
                $this->session->set_userdata('akses', '1');
                $id    = $xcadmin['id'];
                $username  = $xcadmin['username'];
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('nama', $username);
            } elseif($xcadmin['role_code'] == '2'){ //kasir
                $this->session->set_userdata('akses','2');
                $id    = $xcadmin['id'];
                $username  = $xcadmin['username'];
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('nama', $username);
            } 
        }
        
        if($this->session->userdata('masuk') == true){
            if($this->session->userdata('akses')=='1'){
                redirect('Controller_Dashboard');
            } 
            // else {
            //     redirect('Controller_Penjualan');
            // }
        }else{
            redirect('Controller_Login/login_failed');
        }
    }

    function login_failed(){
        $url=base_url('Controller_Login');
        echo $this->session->set_flashdata('msg','Username atau Password Salah / User Inactive');
        redirect($url);
    }

    function logout(){
        $this->session->sess_destroy();
        $url = base_url('Controller_Login');
        redirect($url);
    }
}