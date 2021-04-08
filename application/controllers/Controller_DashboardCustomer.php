<?php
class Controller_DashboardCustomer extends CI_Controller{
	function index(){
        $this->load->model('M_ServiceCategory');
		if ($this->session->userdata('akses') == '4') {
			$data['listCategory']=$this->M_ServiceCategory->getAllServiceCategory();
			// print_r($data);
			$this->load->view('customer/dashboard',$data);
		} else{
	        echo "Halaman tidak ditemukan";
	    }
	}
}