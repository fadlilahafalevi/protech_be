<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Email extends CI_Controller {

    /**
     * Kirim email dengan SMTP Gmail.
     *
     */
    public function send($email_to = '', $subject = '', $flash_message = '') {
      // Konfigurasi email
        $email_sender = 'protechapp.noreply@gmail.com';

        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => $email_sender,  // Email gmail
            'smtp_pass'   => 'Protechapp123!',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from($email_sender, 'protechapp-noreply');

        // Email penerima
        $this->email->to(urldecode($email_to)); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        // $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

        // Subject email
        $this->email->subject(urldecode($subject));

        // Isi email
        $message = $this->session->flashdata('message');
        // echo $message;
        $this->email->message(urldecode($message));

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            // echo 'Sukses! email berhasil dikirim.';
            echo $this->session->set_flashdata('msg', urldecode($flash_message).".");
            redirect('Controller_Login');
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }

    public function send_set_password($email_to = '', $subject = '', $redirect_url = '') {
      // Konfigurasi email
        $email_sender = 'protechapp.noreply@gmail.com';

        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => $email_sender,  // Email gmail
            'smtp_pass'   => 'Protechapp123!',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from($email_sender, 'protechapp-noreply');

        // Email penerima
        $this->email->to(urldecode($email_to)); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        // $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

        // Subject email
        $this->email->subject(urldecode($subject));

        // Isi email
        $message = $this->session->flashdata('message');
        // echo $message;
        $this->email->message(urldecode($message));

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            // echo 'Sukses! email berhasil dikirim.';
            // echo $this->session->set_flashdata('msg', urldecode($flash_message).".");
            redirect(urldecode($redirect_url));
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }

    public function send_email_verification($email_to = '', $token = '') {
        $url = "http://localhost/protechapp/index.php/Controller_Token/email_verification/".$token;
        $url_request = "http://localhost/protechapp/index.php/Controller_Token/request_email_verification/".$token;
        $subject = urlencode("Kode Verifikasi Pendaftaran Akun Protech");
        $message = urlencode("
            Terima kasih telah mendaftar menjadi pelanggan Protech.
            <br><br>
            Tolong konfirmasi bahwa email kamu : ".urldecode($email_to)." adalah email yang kamu gunakan untuk mendaftar akun Protech dengan menekan tombol konfirmasi dibawah.
            <br><br>
            <form action=\"".$url."\">
            <input type=\"submit\" value=\"Verifikasi Email\" />
            </form>
            <br>
            Link diatas berlaku selama 48 jam, klik <a style=\"font-weight:bold\" href=\"".$url_request."\"> disini </a> untuk request verifikasi email yang baru.
            ");
        $this->session->set_flashdata('message', $message);
        $flash_message = urlencode('Pendaftaran sukses! email verifikasi berhasil dikirim');
        redirect("Controller_Email/send/".$email_to."/".$subject."/".$flash_message);
    }

    public function send_email_reset_password($email_to = '', $token = '') {
        $url = "http://localhost/protechapp/index.php/Controller_Token/reset_password/".$token;
        $subject = urlencode("Link Rest Password");
        $message = urlencode("
            Terima kasih telah menjadi pelanggan Protech.
            <br><br>
            Tolong konfirmasi bahwa email kamu yang gunakan : ".urldecode($email_to)." sedang meminta reset password. Klik tombol dibawah untuk reset password.
            <br><br>
            <form action=\"".$url."\">
            <input type=\"submit\" value=\"Reset Password\" />
            </form>
            <br>
            Link diatas berlaku selama 48 jam.
            ");
        $this->session->set_flashdata('message', $message);
        $flash_message = urlencode('Reset password telah dikirim, silahkan cek email');
        redirect("Controller_Email/send/".$email_to."/".$subject."/".$flash_message);
    }

    public function send_email_new_password($email_to = '', $token = '', $redirect_url = '') {
        $url = "http://localhost/protechapp/index.php/Controller_Token/new_password/".$token;
        $subject = urlencode("Link Rest Password");
        $message = urlencode("
            Email yang didaftarkan : ".urldecode($email_to)." belum bisa login, silahkan klik tombol dibawah untuk membuat password baru agar bisa login.
            <br><br>
            <form action=\"".$url."\">
            <input type=\"submit\" value=\"Reset Password\" />
            </form>
            <br>
            Link diatas berlaku selama 48 jam.
            ");
        $this->session->set_flashdata('message', $message);
        $flash_message = urlencode('Link pembuatan password telah dikirim, silahkan cek email');
        redirect("Controller_Email/send_set_password/".$email_to."/".$subject."/".$redirect_url);
    }
}