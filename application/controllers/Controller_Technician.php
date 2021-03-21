<?php
class Controller_Technician extends CI_Controller{
	function index(){
        $this->load->model('M_Technician');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list']=$this->M_Technician->getAllTechnician();
			$this->load->view('admin/technician',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function getOne($code='') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_Technician");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_Technician->getTechnicianDetailByCode($code);
				$data['list_checked_service_type'] = $this->M_Technician->getCheckedServiceType($code);
			}

			$this->load->view('admin/technician_view', $data);

		}
	}

	function createTechnician() {
		$this->load->model("M_ServiceType");
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list_service_type'] = $this->M_ServiceType->getAllServiceType();

			$this->load->view('admin/technician_create', $data);
		}
	}

	function updateTechnician($code = '') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_Technician");

			$data['code'] = $code;
			if (isset($code)) {
				$listData = $this->M_Technician->getTechnicianDetailByCode($code);
				$data['data'] = $listData;
				$data['list_checked_service_type'] = $this->M_Technician->getCheckedServiceType($code);
				
				foreach ($listData as $field) {
					$active_status = $field->active_status;
					if ($active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/technician_edit', $data);

		}
	}

	function saveData() {
		$this->load->model("M_Technician");
		$this->load->model("M_ServiceType");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {

			$user_code = $this->M_General->getSequence('tbl_user_profile', 3, 'T');
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$role_id = '3';
			$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
			$last_name = $this->input->post('last_name');
			$gender = $this->input->post('gender');
			$date_of_birth = $this->input->post('date_of_birth');
			$identity_no = $this->input->post('identity_no');
			$phone = $this->input->post('phone');
			$address =	$this->input->post('address');
			$longitude =	$this->input->post('longitude');
			$latitude =	$this->input->post('latitude');
			$account_number_ovo =	$this->input->post('account_number_ovo');
			$account_number_gopay =	$this->input->post('account_number_gopay');
			$active_status = '1';
			$now = date("Y-m-d H:i:s");

			$data_profile = [ 'user_code' => $user_code,
				'first_name'  => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
				'gender' => $gender,
				'date_of_birth' => $date_of_birth,
				'identity_no' => $identity_no,
				'phone' => $phone,
				'address' => $address,
				'longitude' => $longitude,
				'latitude' => $latitude,
				'active_status' => $active_status,
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_user_profile', $data_profile);

			$data_login = [ 'user_code' => $user_code,
				'role_id' => $role_id,
				'email' => $email,
				'password'  => $password,
				'active_status' => $active_status,
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_user_login', $data_login);

			$listServiceType = $this->M_ServiceType->getAllServiceType();
			foreach ($listServiceType as $service_type) {
				$code = $service_type->service_type_code;
				$service_type_code = $this->input->post($code);
				$data_ref = [ 'service_type_code' => $service_type_code,
				'user_code'  => $user_code
				];
				if (isset($service_type_code)) {
					$this->M_General->insertData('tbl_service_ref', $data_ref);
				}
			}

			redirect('Controller_Technician');
		}
	}

	function updateData() {
		$this->load->model("M_Technician");
		$this->load->model("M_ServiceType");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
		    
			$payment_account_id = $this->input->post('payment_account_id');
			$user_code = $this->input->post('user_code');
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$role_id = '4';
			$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
			$last_name = $this->input->post('last_name');
			$gender = $this->input->post('gender');
			$date_of_birth = $this->input->post('date_of_birth');
			$identity_no = $this->input->post('identity_no');
			$phone = $this->input->post('phone');
			$address =	$this->input->post('address');
			$longitude =	$this->input->post('longitude');
			$latitude =	$this->input->post('latitude');
			$active_status = 0;

			if (isset($_POST['active_status'])) {
				$active_status = 1;
			}

			$data_profile = [ 'user_code' => $user_code,
				'first_name'  => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
				'gender' => $gender,
				'date_of_birth' => $date_of_birth,
				'identity_no' => $identity_no,
				'phone' => $phone,
				'address' => $address,
				'longitude' => $longitude,
				'latitude' => $latitude,
				'active_status' => $active_status
			];

			$this->M_General->updateData('tbl_user_profile', $data_profile, 'user_code', $user_code);
			$this->M_General->updateMeta('tbl_user_profile', 'user_code', $user_code,  $this->session->userdata('user_name'));

			$this->M_General->deleteData('tbl_service_ref', "user_code = '" . $user_code . "'");
			$listServiceType = $this->M_ServiceType->getAllServiceType();
			foreach ($listServiceType as $service_type) {
				$code = $service_type->service_type_code;
				$service_type_code = $this->input->post($code);
				$data_ref = [ 'service_type_code' => $service_type_code,
				'user_code'  => $user_code
				];
				if (isset($service_type_code)) {
					$this->M_General->insertData('tbl_service_ref', $data_ref);
				}
			}
			redirect('Controller_Technician');
		}
	}
}