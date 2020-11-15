<?php
class Controller_Order extends CI_Controller{
	function index(){
        $this->load->model('T_Order');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->T_Order->getAllOrder();
			$this->load->view('admin/order',$data);
		}else if($this->session->userdata('akses')=='2'){
			$data['data']=$this->T_Order->getAllOrder();
			$this->load->view('customer/order',$data);
	    }else if($this->session->userdata('akses')=='3'){
			$data['data']=$this->T_Order->getAllOrder();
			$this->load->view('customer/order',$data);
	    }else {
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($id='') {
		if($this->session->userdata('akses')=='1'){
			$this->load->model("T_Order");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->T_Order->getOneById($id);
			}

			$this->load->view('admin/order_view', $data);
		} else if($this->session->userdata('akses')=='2'){
			$this->load->model("T_Order");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->T_Order->getOneById($id);
			}

			$this->load->view('customer/order_view', $data);
		} else if($this->session->userdata('akses')=='3'){
			$this->load->model("T_Order");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->T_Order->getOneById($id);
			}

			$this->load->view('customer/order_view', $data);
		}
	}

	public function createOrder($serviceDetailCode = '') {
		if($this->session->userdata('akses')=='3'){

			$this->load->model("M_Service");
			
			if(isset($serviceDetailCode)) {
				$data['data'] = $this->M_Service->getServiceDetailByCode($serviceDetailCode);
				$this->load->view('customer/order_create_location', $data);
			}

		} else {
			redirect('Controller_Login');
		}
	}

	public function searchTechnician() {
		if ($this->session->userdata('akses') == '3') {
			$this->load->model("M_Order");
			$latitude =	$this->input->post('latitude');
			$longitude = $this->input->post('longitude');
			$service_detail_code = $this->input->post('service_detail_code');
			$data['order_ordertime'] = $this->input->post('order_ordertime');
			$data['fix_ordertime'] = $this->input->post('fix_ordertime');
			$data['service_detail_code'] = $this->input->post('service_detail_code');
			$data['service'] = $this->input->post('service');
			$data['full_address'] = $this->input->post('full_address');
			$data['longitude'] = $this->input->post('longitude');
			$data['latitude'] = $this->input->post('latitude');
			$data['data'] = $this->M_Order->searchTechnician($latitude, $longitude, $service_detail_code);
			$this->load->view('customer/order_result_technician', $data);
		}
	}

	public function confirmOrder($technician_id, $full_address, $latitude, $longitude, $order_ordertime, $fix_ordertime, $service, $service_detail_code) {
		if ($this->session->userdata('akses') == '3') {
			$this->load->model("M_Order");
			$this->load->model("M_Customer");

			$data['order_id'] = $this->M_Order->getOrderId();
			$data['customer'] = $this->M_Customer->getOneByEmail($this->session->userdata('email'));
			$data['full_address'] = $full_address;
			$data['longitude'] = $longitude;
			$data['latitude'] = $latitude;
			$data['order_ordertime'] = $order_ordertime;
			$data['fix_ordertime'] = $fix_ordertime;
			$data['service'] = $service;
			$data['service_detail_code'] = $service_detail_code;
			$data['fee'] = '10000';

			do {
				$unique_number = rand(3, 3);
				$isExist = $this->M_Order->checkUniqueNumber($unique_number);
			} while ($isExist > 0);
			$data['unique_number'] = $unique_number;
			$this->load->view('customer/order_confirmation', $data);
		}
	}

	public function saveData() {
		$this->load->model("T_Order");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '3') {

			$email = $this->input->post('email');
			$password = 'password';
		    $role_id = '2';
			$fullname = $this->input->post('fullname');
			$phone = $this->input->post('phone');
			$full_address =	$this->input->post('full_address');
			$identity_number =	$this->input->post('identity_number');
			$bank_account_number = $this->input->post('bank_account_number');
			$latitude =	$this->input->post('latitude');
			$longitude = $this->input->post('longitude');
			$active_status = '1';
			$this->T_Order->inputData($email, $password, $role_id, $fullname, $phone, $full_address, $latitude, $longitude, $identity_number, $bank_account_number, $active_status);
			$idData = $this->T_Order->getOneByEmail($email);
			$this->M_Metadata->createMeta('tbl_order', $idData, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('ORDER', 'CREATE', $this->session->userdata('email'));

			redirect('Controller_Order');
		}
	}
}