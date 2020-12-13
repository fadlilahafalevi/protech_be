<?php
class Controller_Customer extends CI_Controller{
	function index(){
        $this->load->model('M_Customer');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_Customer->getAllCustomer();
			$this->load->view('admin/customer',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($code='') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Customer");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_Customer->getOneById($code);
			}

			$this->load->view('admin/customer_view', $data);

		}
	}

	public function createCustomer() {
		$this->load->view('customer/customer_create');
	}

	public function updateCustomer($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Customer");

			$data['customer_code'] = $code;
			if (isset($code)) {
				$listData = $this->M_Customer->getOneById($code);
				$data['data'] = $listData;
				
				foreach ($listData as $field) {
					$active_status = $field->active_status;
					if ($active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/customer_edit', $data);

		}
	}

	public function saveData() {
		$this->load->model("M_Customer");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_General");
	
		$customer_code = $this->M_General->getSequence('tbl_customer', 3, 'C');
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$role_id = '3';
		$fullname = $this->input->post('fullname');
		$phone = $this->input->post('phone');
		$full_address =	$this->input->post('full_address');
		$latitude =	$this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$active_status = '1';

		$data_wallet = [ 'phone' => $phone,
        'user_code' => $customer_code,
		'balance' => 0,
		'total_debit' => 0,
		'total_credit' => 0,
		];

		$this->M_General->insertData('tbl_wallet', $data_wallet);

		$data = [ 'customer_code' => $customer_code,
			'email' => $email,
			'password'  => $password,
			'role_id' => $role_id,
			'fullname' => $fullname,
			'phone' => $phone,
			'full_address' => $full_address,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'active_status' => $active_status
		];

		$this->M_General->insertData('tbl_customer', $data);

		$this->M_Metadata->createMeta('tbl_customer', 'customer_code', $customer_code, $fullname);
		$this->R_AuditLogging->insertLog('CUSTOMER', 'CREATE', $customer_code);

		redirect('Controller_Login');
	}

	public function updateData() {
		$this->load->model("M_Customer");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$customer_code = $this->input->post('customer_code');
			$email = $this->input->post('email');
			$fullname = $this->input->post('fullname');
			$phone_old = $this->input->post('phone_old');
			$phone = $this->input->post('phone');
			$full_address = $this->input->post('full_address');
			$latitude =	$this->input->post('latitude');
			$longitude = $this->input->post('longitude');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$data = ['email' => $email,
			'fullname' => $fullname,
			'phone' => $phone,
			'full_address' => $full_address,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'active_status' => $active_status
			];

			$data_wallet = [
			'phone' => $phone
			];

			$this->M_General->updateData('tbl_wallet', $data_wallet, 'phone', $phone_old);
			$this->M_General->updateData('tbl_customer', $data, 'customer_code', $customer_code);
			$this->M_Metadata->updateMeta('tbl_customer', 'customer_code', $customer_code,  $this->session->userdata('code'));
			$this->R_AuditLogging->insertLog('CUSTOMER', 'UPDATE', $this->session->userdata('code'));
			redirect('Controller_Customer');
		}
	}

	public function goTopUp($code = '') {
        if ($this->session->userdata('akses') == '3') {

            $this->load->model("M_Customer");

            $data['code'] = $code;
            if (isset($code)) {
                $data['data'] = $this->M_Customer->getOneById($code);
            }
            $this->load->view('customer/topup', $data);
        }
	}
	
	public function goWithdrawal($code = '') {
	    if ($this->session->userdata('akses') == '3') {
	        
	        $this->load->model("M_Customer");
	        $this->load->model("T_Wallet");
	        
	        $data['code'] = $code;
	        if (isset($code)) {
	            $phone = $this->M_Customer->getPhoneByCode($code);
	            $data['data'] = $this->M_Customer->getOneById($code);
	            $data['balance'] = number_format($this->T_Wallet->getCurrentBalance($phone),2,',','.');
	        }
	        $this->load->view('customer/withdrawal', $data);
	    }
	}
}