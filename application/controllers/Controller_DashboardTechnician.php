<?php
class Controller_DashboardTechnician extends CI_Controller{
	function index(){
        $this->load->model('M_Order');
		$this->load->model("M_Dashboard");
		$this->load->model("M_Technician");
		$this->load->model("M_Review");
		
		if ($this->session->userdata('akses') == '3') {
			//for notification
			$data['notif_order']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
			$technician_data = $this->M_Technician->getTechnicianDetailByCode($this->session->userdata('user_code'));
			$data['order_waiting_confirmation'] = $this->M_Order->searchOrder($technician_data[0]->latitude, $technician_data[0]->longitude, $this->session->userdata('user_code'));
			
			$data['order_by_status'] = $this->M_Dashboard->getOrderByStatusByTechnician($this->session->userdata('user_code'));
			$data['average_rate'] = $this->M_Review->get_average_rating_by_user_code($this->session->userdata('user_code'));
			// print_r($data);
			$this->load->view('technician/dashboard',$data);
		} else{
	        echo "Halaman tidak ditemukan";
	    }
	}
}