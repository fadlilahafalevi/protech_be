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
        $email   = strip_tags(stripslashes($this->input->post('email',TRUE)));
        $password   = strip_tags(stripslashes($this->input->post('password',TRUE)));

        $cadmin     = $this->Login->cekadmin($email,$password);
        
        if($cadmin->num_rows() > 0){
            $this->session->set_userdata('masuk', true);

            $xcadmin = $cadmin->row_array();
            
            if($xcadmin['role_id'] == '1'){ //superadmin
                $this->session->set_userdata('akses', '1');
                $user_code    = $xcadmin['user_code'];
                $user_name    = $xcadmin['fullname'];
                $this->session->set_userdata('user_code', $user_code);
                $this->session->set_userdata('user_name', $user_name);
            } elseif($xcadmin['role_id'] == '2'){ //admin
                $this->session->set_userdata('akses', '2');
                $user_code    = $xcadmin['user_code'];
                $user_name    = $xcadmin['fullname'];
                $this->session->set_userdata('user_code', $user_code);
                $this->session->set_userdata('user_name', $user_name);
            }
        }
        
        if($this->session->userdata('masuk') == true){
            if($this->session->userdata('akses')=='1'){
                redirect('Controller_Dashboard');
            } 
            else if($this->session->userdata('akses')=='2') {
                redirect('Controller_Dashboard');
            }
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