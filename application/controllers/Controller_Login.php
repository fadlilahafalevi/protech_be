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
            
            if($xcadmin['role_id'] == '1'){ //admin
                $this->session->set_userdata('akses', '1');
                $id    = $xcadmin['id'];
                $fullname  = $xcadmin['fullname'];
                $emailUser  = $xcadmin['email'];
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('fullname', $fullname);
                $this->session->set_userdata('email', $emailUser);
            } elseif($xcadmin['role_id'] == '2'){ //teknisi
                $this->session->set_userdata('akses','2');
                $id    = $xcadmin['id'];
                $fullname  = $xcadmin['fullname'];
                $emailUser  = $xcadmin['email'];
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('fullname', $fullname);
                $this->session->set_userdata('email', $emailUser);
            } elseif($xcadmin['role_id'] == '3'){ //customer
                $this->session->set_userdata('akses','3');
                $id    = $xcadmin['id'];
                $fullname  = $xcadmin['fullname'];
                $emailUser  = $xcadmin['email'];
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('fullname', $fullname);
                $this->session->set_userdata('email', $emailUser);
            }
        }
        
        if($this->session->userdata('masuk') == true){
            if($this->session->userdata('akses')=='1'){
                redirect('Controller_Dashboard');
            } 
            else if($this->session->userdata('akses')=='2') {
                redirect('Controller_Dashboard');
            }
            else if($this->session->userdata('akses')=='3') {
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