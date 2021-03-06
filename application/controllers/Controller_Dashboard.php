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
        $this->load->model('M_Order');
        $this->load->model('T_Wallet');
		if($this->session->userdata('akses')=='1'){

	    	$data['balance'] = $this->T_Wallet->getCurrentBalance("082213223526");
			$data['waiting_confirmation']=$this->T_Order->countWaitingConfirmationStatus();
			$data['in_progress']=$this->T_Order->countInProgressStatus();
			$data['finished']=$this->T_Order->countFinishedStatus();
			$data['canceled']=$this->T_Order->countCanceledStatus();
			$this->load->view('admin/dashboard',$data);

		} else if($this->session->userdata('akses')=='2'){

	    	$data['balance'] = $this->T_Wallet->getCurrentBalance($this->session->userdata('phone'));
			$data['listNeedConfirm']=$this->M_Order->getListNeedConfirmationByTechCode($this->session->userdata('code'));
			$this->load->view('technician/dashboard', $data);

	    } else if($this->session->userdata('akses')=='3'){

	    	$data['balance'] = $this->T_Wallet->getCurrentBalance($this->session->userdata('phone'));
	    	$data['need_confirmation_order'] = $this->M_Order->getListNeedConfirmByCustomer($this->session->userdata('code'));

			$this->load->view('customer/dashboard', $data);

	    } else {
	        echo "Halaman tidak ditemukan";
	    }
	}
}
