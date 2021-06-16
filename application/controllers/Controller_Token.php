<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Token extends CI_Controller {

    public function email_verification($token = '') {
        $this->load->model("M_Token");
        $this->load->model("M_General");

        $token_data = $this->M_Token->getTokenData($token);
        
        $now_datetime = date("Y-m-d H:i:s");
        $token_user_code = $token_data[0]->token_user_code;
        $expired_datetime = $token_data[0]->expired_datetime;
        $token = $token_data[0]->token;
        $email = $token_data[0]->email;
        $used = $token_data[0]->used;
        $token_id = $token_data[0]->token_id;
        //jika token sudah expired
        if ($now_datetime > $expired_datetime || $used == 1) {
            $data['expired_message'] = 'Link sudah expired, silahkan klik <a href="http://localhost/protechapp/index.php/Controller_Token/request_email_verification/'.$token.'">disini</a> untuk request verifikasi email yang baru.';
        } else {
            $data_verification = [ 
                'is_verified' => 1,
                'active_status' => 1
             ];
            $this->M_General->updateData('tbl_user_login', $data_verification, 'user_code', $token_user_code);

            $data_profile = [
                'active_status' => 1
             ];
            $this->M_General->updateData('tbl_user_profile', $data_profile, 'user_code', $token_user_code);

            $data_token = [ 'used' => 1 ];
            $this->M_General->updateData('tbl_token', $data_token, 'token_id', $token_id);
        }

        $data['token_data'] = $token_data;

        $this->load->view('verification_success',$data);
    }

    public function reset_password($token = '') {
        $data['token'] = $token;

        $this->load->view('reset_password',$data);
    }

    public function reset_password_submit($token = '') {
        $this->load->model("M_Token");
        $this->load->model("M_General");

        $token_data = $this->M_Token->getTokenData($token);
        
        $now_datetime = date("Y-m-d H:i:s");
        $token_user_code = $token_data[0]->token_user_code;
        $expired_datetime = $token_data[0]->expired_datetime;
        $token = $token_data[0]->token;
        $email = $token_data[0]->email;
        $used = $token_data[0]->used;
        $token_id = $token_data[0]->token_id;
        //jika token sudah expired
        if ($now_datetime > $expired_datetime) {
            $data['expired_message'] = 'Link sudah kadaluarsa silahkan request reset password kembali.';
        } else {
            if ($used == 1) {
                $data['used_token_message'] = 'Link ini sudah pernah digunakan sebagai reset password.';
            } else {
                $password_baru = $this->input->post('password_baru');
                $konfirmasi_password = $this->input->post('konfirmasi_password');

                if ($password_baru != $konfirmasi_password) {
                    echo $this->session->set_flashdata('msg','Kombinasi password tidak sesuai.');
                    redirect ('Controller_Token/reset_password/'.$token);
                } else {
                    $password = md5($password_baru);
                    $date_now = date("Y-m-d H:i:s");

                    $data_login = [ 'password' => $password,
                    'modified_datetime' => $date_now,
                    'modified_by' => 'RESET PASSWORD'
                    ];
                    $this->M_General->updateData('tbl_user_login', $data_login, 'user_code', $token_user_code);

                    $data_token = [ 'used' => 1 ];
                    $this->M_General->updateData('tbl_token', $data_token, 'token_id', $token_id);
                }
            }
        }

        // $data['token_data'] = $token_data;
        echo $this->session->set_flashdata('msg','Reset password sukses, silahkan login.');
        // $flash_message = urlencode('Reset password sukes, silahkan login.');
        redirect('Controller_Login');
        // $this->load->view('verification_success',$data);
    }

    public function new_password($token = '') {
        $data['token'] = $token;

        $this->load->view('new_password',$data);
    }

    public function new_password_submit($token = '') {
        $this->load->model("M_Token");
        $this->load->model("M_General");

        $token_data = $this->M_Token->getTokenData($token);
        
        $now_datetime = date("Y-m-d H:i:s");
        $token_user_code = $token_data[0]->token_user_code;
        $expired_datetime = $token_data[0]->expired_datetime;
        $token = $token_data[0]->token;
        $email = $token_data[0]->email;
        $used = $token_data[0]->used;
        $token_id = $token_data[0]->token_id;
        //jika token sudah expired
        if ($now_datetime > $expired_datetime) {
            $data['expired_message'] = 'Link sudah kadaluarsa silahkan hubungi admin.';
        } else {
            if ($used == 1) {
                $data['used_token_message'] = 'Link ini sudah pernah digunakan sebagai pembuatan password baru.';
            } else {
                $password_baru = $this->input->post('password_baru');
                $konfirmasi_password = $this->input->post('konfirmasi_password');

                if ($password_baru != $konfirmasi_password) {
                    echo $this->session->set_flashdata('msg','Kombinasi password tidak sesuai.');
                    redirect ('Controller_Token/new_password/'.$token);
                } else {
                    $password = md5($password_baru);
                    $date_now = date("Y-m-d H:i:s");

                    $data_login = [ 'password' => $password,
                    'is_verified' => 1,
                    'active_status' => 1,
                    'modified_datetime' => $date_now,
                    'modified_by' => 'NEW PASSWORD'
                    ];
                    $this->M_General->updateData('tbl_user_login', $data_login, 'user_code', $token_user_code);

                    $data_token = [ 'used' => 1 ];
                    $this->M_General->updateData('tbl_token', $data_token, 'token_id', $token_id);
                }
            }
        }

        // $data['token_data'] = $token_data;
        echo $this->session->set_flashdata('msg','Pembuatan password sukes, silahkan login.');
        // $flash_message = urlencode('Reset password sukes, silahkan login.');
        redirect('Controller_Login');
        // $this->load->view('verification_success',$data);
    }

    public function request_email_verification($token = '') {
        $this->load->model("M_Token");
        $this->load->model("M_General");

        $token_data = $this->M_Token->getTokenData($token);

        if ($token_data[0]->used == 0) {
            $now_datetime = date("Y-m-d H:i:s");
            $token_user_code = $token_data[0]->token_user_code;
            $expired_datetime = $token_data[0]->expired_date;
            $token = $token_date[0]->token;
            $email = $token_data[0]->email;
            //jika sudah expired, akan dibuat token baru, jika belum akan menggunakan token yang lama dan date expired akan di extend.
            if ($now_datetime > $expired_datetime) {
                $token = $this->M_Token->generateRandomToken();
            }
            $expired_datetime_new = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +2 minutes"));

            $data_token = [ 'user_code' => $token_user_code,
                'token' => $token,
                'usage' => 'EMAIL VERIFICATION',
                'expired_datetime'  => $expired_datetime_new,
                'used' => 0
            ];

            $this->M_General->insertData('tbl_token', $data_token);

            redirect('Controller_Email/send_email_verification/'.urlencode($email).'/'.$token);
        } else {
            $url=base_url('Controller_Login');
            echo $this->session->set_flashdata('msg','Email sudah diverifikasi.');
            redirect($url);
        }
    }

    public function request_email_verification_login($user_code = '') {
        $this->load->model("M_Token");
        $this->load->model("M_General");

        $token_data = $this->M_Token->getTokenDataByUsercode($user_code);

        $now_datetime = date("Y-m-d H:i:s");
        $token_user_code = $token_data[0]->token_user_code;
        $expired_datetime = $token_data[0]->expired_date;
        $token = $token_date[0]->token;
        $email = $token_data[0]->email;
        //jika sudah expired, akan dibuat token baru, jika belum akan menggunakan token yang lama dan date expired akan di extend.
        if ($now_datetime > $expired_datetime) {
            $token = $this->M_Token->generateRandomToken();
        }
        $expired_datetime_new = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +48 hours"));

        $data_token = [ 'user_code' => $token_user_code,
            'token' => $token,
            'usage' => 'EMAIL VERIFICATION',
            'expired_datetime'  => $expired_datetime_new,
            'used' => 0
        ];

        $this->M_General->insertData('tbl_token', $data_token);

        $this->session->sess_destroy();
        redirect('Controller_Email/send_email_verification/'.urlencode($email).'/'.$token);
    }

    public function request_reset_password($email = '') {
        $this->load->model("M_Token");
        $this->load->model("M_General");
        $this->load->model("Login");

        $email = urldecode($email);
        $user_code = $this->Login->get_user_code_by_email($email);

        $token = $this->M_Token->generateRandomToken();
        $expired_datetime_new = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +48 hours"));

        $data_token = [ 'user_code' => $user_code,
            'token' => $token,
            'usage' => 'RESET PASSWORD',
            'expired_datetime'  => $expired_datetime_new,
            'used' => 0
        ];

        $this->M_General->insertData('tbl_token', $data_token);

        redirect('Controller_Email/send_email_reset_password/'.urlencode($email).'/'.$token);

    }
}