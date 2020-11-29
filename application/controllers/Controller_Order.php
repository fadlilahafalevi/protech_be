<?php
class Controller_Order extends CI_Controller{
	function index(){
        $this->load->model('T_Order');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->T_Order->getAllOrder();
			$this->load->view('admin/order',$data);
		}else if($this->session->userdata('akses')=='2'){
			$data['data']=$this->T_Order->getAllOrder();
			$this->load->view('technician/order',$data);
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
			$data['fix_datetime'] = $this->input->post('fix_datetime');
			$data['fix_datetime'] = $this->input->post('fix_datetime');
			$data['encoded_fix_datetime'] = base64_encode ( $this->input->post('fix_datetime') );
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

	public function confirmOrder($technician_id, $encoded_full_address, $latitude, $longitude, $encoded_fix_datetime, $service, $service_detail_code) {
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
			$data['fix_datetime'] = base64_decode( $encoded_fix_datetime );
			$data['service'] = $this->M_Service->getServiceDetailByCode($service_detail_code);
			$data['fee'] = $this->M_Service->getPriceByServiceDetailCode($service_detail_code);

			$this->load->view('customer/order_confirmation', $data);
		}
	}

	public function inputOrder() {
		if ($this->session->userdata('akses') == '3') {
			$this->load->model("M_Order");
			$this->load->model("M_General");
			$this->load->model("T_Wallet");
			$this->load->model("M_Customer");


			$order_code = $this->input->post('order_code');
			$customer_code = $this->input->post('customer_code');
			$latitude = $this->input->post('latitude');
			$longitude = $this->input->post('longitude');
			$address = $this->input->post('full_address');
			$fix_datetime = $this->input->post('fix_datetime');
			$technician_code = $this->input->post('technician_code');
			$service_type_code = $this->input->post('service_detail_code').'ST01';
			$fee = $this->input->post('fee');
			$order_status_wc = 'WAITING CONFIRMATION';
			$order_status_wp = 'WAITING PAYMENT';
			$order_status = '';
			$is_paid = 0;
			
			$phone = $this->M_Customer->getPhoneByCode($customer_code);
			$balance = $this->T_Wallet->getCurrentBalance($phone);

			//Pengecekan apakah saldo cukup atau tidak
			if ($balance >= $fee) {
				$order_status = $order_status_wc;
				$is_paid = 1;
			} else {
				$order_status = $order_status_wp;
				$is_paid = 0;
			}

			$data = [ 'order_code'  => $order_code,
			'customer_code' => $customer_code,
			'technician_code' => $technician_code,
			'address' => $address,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'fix_datetime' => $fix_datetime,
			'total_amount' => $fee,
			'order_status' => $order_status,
			'created_by' => $customer_code
			];

			$this->M_General->insertData('tbl_order', $data);

			$data_detail = [ 'order_code'  => $order_code,
			'service_type_code' => $service_type_code,
			'price' => $fee,
			'is_paid' => $is_paid,
			'created_by' => $customer_code
			];

			$this->M_General->insertData('tbl_order_detail', $data_detail);
			$order_detail_id = $this->M_Order->getLastIdWithOrderCode($order_code);

			redirect('Controller_Order/getOneByCode/'.$order_code);
		}
	}

	public function getOneByCode($code = '') {
		if ($this->session->userdata('akses')=='2') {

			$this->load->model("M_Order");
			
			if(isset($code)) {
				$data['data'] = $this->M_Order->getOneByCode($code);
				$data['detail'] = $this->M_Order->getDetailByCode($code);
				$this->load->view('technician/order_view', $data);
			}

		} else if ($this->session->userdata('akses')=='3') {

			$this->load->model("M_Order");
			
			if(isset($code)) {
				$data['data'] = $this->M_Order->getOneByCode($code);
				$data['detail'] = $this->M_Order->getDetailByCode($code);
				$total_price = $this->M_Order->getUnpaidOrderCustomer($code);
				$data['total_price'] = number_format($total_price,2,',','.');
				$data['price'] = $total_price;
				$this->load->view('customer/order_view', $data);
			}

		} else {
			redirect('Controller_Login');
		}
	}

	public function getAllByCustomerCode($code = '') {
		if($this->session->userdata('akses')=='3'){

			$this->load->model("M_Order");
			
			if(isset($code)) {
				$data['data'] = $this->M_Order->getAllByCustomerCode($code);
				$this->load->view('customer/order', $data);
			}
		} else {
			redirect('Controller_Login');
		}
	}

	public function getAllByTechnicianCode($code = '') {
		if($this->session->userdata('akses')=='2'){

			$this->load->model("M_Order");
			
			if(isset($code)) {
				$data['data'] = $this->M_Order->getAllByTechnicianCode($code);
				$this->load->view('technician/order', $data);
			}
		} else {
			redirect('Controller_Login');
		}
	}

	public function confirmOrderByTech() {
		if ($this->session->userdata('akses')=='2') {

			$this->load->model("M_Order");
			$order_code = $this->input->post('order_code');
			if (isset($order_code)) {
				$this->M_Order->updateStatus($order_code, 'IN PROGRESS');
				redirect('Controller_Order/getOneByCode/'.$order_code);
			}

		}
	}
}