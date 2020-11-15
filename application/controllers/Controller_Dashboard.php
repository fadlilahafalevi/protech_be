<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
        //$this->load->model('M_Grafik');
	}
	
	function index(){
        $this->load->model('T_Order');
		if($this->session->userdata('akses')=='1'){
			$data['waiting_payment']=$this->T_Order->countWaitingPaymentStatus();
			$data['in_progress']=$this->T_Order->countInProgressStatus();
			$data['finished']=$this->T_Order->countFinishedStatus();
			$data['canceled']=$this->T_Order->countCanceledStatus();
			$this->load->view('admin/dashboard',$data);
		} else if($this->session->userdata('akses')=='2'){
			$this->load->view('admin/dashboard');
	    } else if($this->session->userdata('akses')=='3'){
			$this->load->view('admin/dashboard');
	    } else {
	        echo "Halaman tidak ditemukan";
	    }
	}
}
