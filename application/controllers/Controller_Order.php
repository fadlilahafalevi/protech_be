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
			$data['encoded_order_ordertime'] = base64_encode ( $this->input->post('order_ordertime') );
			$data['encoded_fix_ordertime'] = base64_encode ( $this->input->post('fix_ordertime') );
			$data['service_detail_code'] = $this->input->post('service_detail_code');
			$data['service'] = $this->input->post('service');
			$data['full_address'] = $this->input->post('full_address');
			$data['encoded_full_address'] = base64_encode ( $this->input->post('full_address') );
			$data['longitude'] = $this->input->post('longitude');
			$data['latitude'] = $this->input->post('latitude');
			$data['data'] = $this->M_Order->searchTechnician($latitude, $longitude, $service_detail_code);
			$this->load->view('customer/order_result_technician', $data);
		}
	}

	public function confirmOrder($technician_id, $encoded_full_address, $latitude, $longitude, $encoded_order_ordertime, $encoded_fix_ordertime, $service, $service_detail_code) {
		if ($this->session->userdata('akses') == '3') {
			$this->load->model("M_Order");
			$this->load->model("M_Customer");
			$this->load->model("M_Technician");
			$this->load->model("M_Service");

			$data['order_id'] = $this->M_Order->getOrderId();
			$data['email'] = $this->session->userdata('email');
			$data['technician'] = $this->M_Technician->getOneById($technician_id);
			$data['customer'] = $this->M_Customer->getDataCustomerByEmail($this->session->userdata('email'));
			$data['full_address'] = base64_decode ( $encoded_full_address );
			$data['longitude'] = $longitude;
			$data['latitude'] = $latitude;
			$data['technician_id'] = $technician_id;
			$data['order_ordertime'] = base64_decode( $encoded_order_ordertime );
			$data['fix_ordertime'] = base64_decode( $encoded_fix_ordertime );
			$data['service'] = $this->M_Service->getServiceDetailByCode($service_detail_code);
			$data['fee'] = '10000';

			do {
				$unique_number = rand(3, 3);
				$isExist = $this->M_Order->checkUniqueNumber($unique_number);
			} while ($isExist > 0);
			$data['unique_number'] = $unique_number;
			$this->load->view('customer/order_confirmation', $data);
		}
	}

	public function inputOrder() {
		if ($this->session->userdata('akses') == '3') {
			$this->load->model("M_Order");

			$order_code = $this->input->post('order_code');
			$customer_id = $this->input->post('customer_id');
			$latitude = $this->input->post('latitude');
			$longitude = $this->input->post('longitude');
			$address = $this->input->post('full_address');
			$order_ordertime = $this->input->post('order_ordertime');
			$fix_ordertime = $this->input->post('fix_ordertime');
			$technician_id =	$this->input->post('technician_id');
			$service_detail_code =	$this->input->post('service_detail_code');
			$total_amount =	$this->input->post('fee');

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