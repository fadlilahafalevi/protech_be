<?php
class Controller_DashboardCustomer extends CI_Controller{
	function index(){
        $this->load->model('M_ServiceCategory');
		$data['listCategory']=$this->M_ServiceCategory->getAllServiceCategory();
		// print_r($data);
		$this->load->view('customer/dashboard',$data);
	}
}