<?php
class Controller_AuditLog extends CI_Controller{
	function index(){
        $this->load->model('R_AuditLogging');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->R_AuditLogging->getAllAuditLogging();
			$this->load->view('admin/audit_log',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}
}