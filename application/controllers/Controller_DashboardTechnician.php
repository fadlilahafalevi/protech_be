<?php
class Controller_DashboardTechnician extends CI_Controller{
	function index(){
        $this->load->model('M_Order');
		if ($this->session->userdata('akses') == '3') {
			$data['count_order_NC']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
			// print_r($data);
			$this->load->view('technician/dashboard',$data);
		} else{
	        echo "Halaman tidak ditemukan";
	    }
	}
}