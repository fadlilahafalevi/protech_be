<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
	}
	
	function index(){
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/dashboard');

		} else if($this->session->userdata('akses')=='2'){

			$this->load->view('admin/dashboard');

	    }  else if ($this->session->userdata('akses')=='4') {

	    	$this->load->view('customer/dashboard');
	    	
	    } else {
	        echo "Halaman tidak ditemukan";
	    }
	}
}
