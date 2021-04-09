<?php
class Controller_ReportOrder extends CI_Controller{
	function index(){
        $this->load->model('M_ReportOrder');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list']=$this->M_ReportOrder->getAllReportOrder();
			$this->load->view('admin/report_order',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}
}