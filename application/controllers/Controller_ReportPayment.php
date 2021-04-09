<?php
class Controller_ReportPayment extends CI_Controller{
	function index(){
        $this->load->model('M_ReportPayment');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list']=$this->M_ReportPayment->getAllReportPayment();
			$this->load->view('admin/report_payment',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}
}