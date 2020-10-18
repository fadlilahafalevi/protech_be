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
		if($this->session->userdata('akses')=='1'){
			//$data['report']=$this->M_Grafik->statistik_stok();
			//$data['reportPenjualan']=$this->M_Grafik->graf_penjualan();
			//$this->load->view('admin/dashboard',$data);
			$this->load->view('admin/dashboard');
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}
}
