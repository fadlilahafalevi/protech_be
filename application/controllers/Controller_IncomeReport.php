<?php
class Controller_IncomeReport extends CI_Controller{
	function index(){
        $this->load->model('R_IncomeReport');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->R_IncomeReport->getAllIncomeReport();
			$this->load->view('admin/income_report',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}
}