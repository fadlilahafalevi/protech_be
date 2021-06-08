<?php
class Controller_Login extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('Login');
        $this->load->model('M_General');
    }

    function index(){
        if ($this->session->userdata('masuk') == true) {
            $url=base_url();
            redirect($url);
        } else {
            $this->load->view('login');
        }
        
    }

    function cekuser(){
        $email   = strip_tags(stripslashes($this->input->post('email',TRUE)));
        $password   = strip_tags(stripslashes($this->input->post('password',TRUE)));

        $cadmin = $this->Login->cekadmin($email,$password);
        
        if($cadmin->num_rows() > 0){
            $xcadmin = $cadmin->row_array();

            if ($xcadmin['active_status'] == 1) {
                $this->session->set_userdata('masuk', true);
                
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
                } elseif($xcadmin['role_id'] == '3'){ //teknisi
                    $this->session->set_userdata('akses', '3');
                    $user_code    = $xcadmin['user_code'];
                    $user_name    = $xcadmin['fullname'];
                    $this->session->set_userdata('user_code', $user_code);
                    $this->session->set_userdata('user_name', $user_name);
                } elseif($xcadmin['role_id'] == '4'){ //pelanggan
                    $this->session->set_userdata('akses', '4');
                    $user_code    = $xcadmin['user_code'];
                    $user_name    = $xcadmin['fullname'];
                    $this->session->set_userdata('user_code', $user_code);
                    $this->session->set_userdata('user_name', $user_name);
                }
            } else if ($xcadmin['active_status'] == 1) {
                redirect('Controller_Login/user_inactive');
            }
        } else {
            redirect('Controller_Login/login_failed');
        }
        
        if($this->session->userdata('masuk') == true) {

            //update last login
            $data = ['last_login_datetime' => date("Y-m-d H:i:s")];
            $this->M_General->updateData('tbl_user_login', $data, 'user_code', $this->session->userdata('user_code'));

            if($this->session->userdata('akses')=='1'){
                redirect('Controller_Dashboard');
            } 
            else if($this->session->userdata('akses')=='2') {
                redirect('Controller_Dashboard');
            }
            else if($this->session->userdata('akses')=='3') {
                redirect('Controller_DashboardTechnician');
            }
            else if($this->session->userdata('akses')=='4') {
                $is_verified = $xcadmin['is_verified'];
                $active_status = $xcadmin['active_status'];
                if ($is_verified == 0) {
                    redirect('Controller_Login/account_not_verified');
                } else if ($is_verified == 1 && $active_status == 1) {
                    redirect('Controller_DashboardCustomer');
                }
            }
        }
    }

    function login_failed(){
        $url=base_url('Controller_Login');
        echo $this->session->set_flashdata('msg','Email atau Password Salah');
        redirect($url);
    }

    function user_inactive() {
        $url=base_url('Controller_Login');
        echo $this->session->set_flashdata('msg','User tidak aktif');
        redirect($url);
    }

    function account_not_verified(){
        $this->load->view('need_verification.php');
    }

    function logout(){
        $this->session->sess_destroy();
        $url = base_url('Controller_Login');
        redirect($url);
    }

    function forgot_password() {
        $this->load->view('forgot_password.php');
    }

    function forgot_password_submit() {

        $email = $this->input->post('email');

        $count = $this->Login->get_existing_email($email);
        if ($count > 0) {
            redirect('Controller_Token/request_reset_password/'.urlencode($email));
        } else {
            $url=base_url('Controller_Login/forgot_password');
            echo $this->session->set_flashdata('msg','Email tidak ditemukan');
            redirect($url);
        }
    }
}