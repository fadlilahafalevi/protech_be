<?php
class Controller_Technician extends CI_Controller{
	function index(){
        $this->load->model('M_Technician');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_Technician->getAllTechnician();
			$this->load->view('admin/technician',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($id='') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Technician");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_Technician->getOneById($id);
				$data['list_checked_service_detail'] = $this->M_Technician->getCheckedServiceByTechID($id);
			}

			$this->load->view('admin/technician_view', $data);

		}
	}

	public function createTechnician() {
		$this->load->model("M_Service");
		if($this->session->userdata('akses')=='1'){
			$data['list_service_detail'] = $this->M_Service->getAllServiceCategory();

			$this->load->view('admin/technician_create', $data);
		}
	}

	public function updateTechnician($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Technician");
			$this->load->model("M_Service");

			$data['id'] = $id;
			if (isset($id)) {
				$listData = $this->M_Technician->getOneById($id);
				$data['data'] = $listData;
				$data['list_checked_service_detail'] = $this->M_Technician->getCheckedServiceByTechID($id);
				
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

	public function saveData() {
		$this->load->model("M_Technician");
		$this->load->model("M_Service");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$pass_photo = "";
			$ktp_photo = "";
			$config['upload_path']          = './assets/uploaded-image/';
			$config['allowed_types']        = 'jpeg|jpg|png';
			$config['max_size']             = 3000;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('pass_photo')) {
				$error = array('error' => $this->upload->display_errors());
				redirect('/Controller_Technician/createTechnician/'.$error);
			} else {
				$image_data = $this->upload->data();
				$imgdata = file_get_contents($image_data['full_path']);
				$pass_photo=base64_encode($imgdata);
			}

			// if ( ! $this->upload->do_upload('ktp_photo')) {
			// 	$error = array('error' => $this->upload->display_errors());
			// 	redirect('/Controller_Technician/createTechnician/'.$error);
			// } else {
			// 	$image_data = $this->upload->data();
			// 	$imgdata = file_get_contents($image_data['full_path']);
			// 	$ktp_photo=base64_encode($imgdata);
			// }
			
			$technician_code = $this->M_General->getSequence('tbl_technician', 3, 'T');
			$email = $this->input->post('email');
			$password = md5('password');
		    $role_id = '2';
			$fullname = $this->input->post('fullname');
			$phone = $this->input->post('phone');
			$full_address =	$this->input->post('full_address');
			$identity_number =	$this->input->post('identity_number');
			$bank_account_number = $this->input->post('bank_account_number');
			$latitude =	$this->input->post('latitude');
			$longitude = $this->input->post('longitude');
			$active_status = '1';

			$data = [ 'technician_code' => $technician_code,
			'email' => $email,
			'password' => $password,
			'role_id'  => $role_id,
			'fullname' => $fullname,
			'phone' => $phone,
			'full_address' => $full_address,
			'identity_number' => $identity_number,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'active_status' => $active_status,
			'bank_account_number' => $bank_account_number,
			'pass_photo' => $pass_photo,
			'ktp_photo' => $ktp_photo
			];

			$this->M_General->insertData('tbl_technician', $data);

			$listDetailService = $this->M_Service->getAllServiceDetail();
			foreach ($listDetailService as $service) {
				$code = $service->service_detail_code;
				$service_detail_code = $this->input->post($code);
				$data = [ 'service_detail_code' => $service_detail_code,
				'technician_code'  => $technician_code
				];
				if (isset($service_detail_code)) {
					$this->M_Technician->insertServiceRef($data);
				}
			}
			
			$this->M_Metadata->createMeta('tbl_technician', 'technician_code', $technician_code, $this->session->userdata('code'));
			$this->R_AuditLogging->insertLog('TECHNICIAN', 'CREATE', $this->session->userdata('code'));

			redirect('Controller_Technician');
		}
	}

	public function updateData() {
		$this->load->model("M_Technician");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_Service");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$technician_code = $this->input->post('technician_code');
			$email = $this->input->post('email');
			$fullname = $this->input->post('fullname');
			$phone = $this->input->post('phone');
			$full_address = $this->input->post('full_address');
			$identity_number = $this->input->post('identity_number');
			$bank_account_number =	$this->input->post('bank_account_number');
			$latitude =	$this->input->post('latitude');
			$longitude =	$this->input->post('longitude');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}


			$this->M_Technician->deleteServiceRef($technician_code);
			$listDetailService = $this->M_Service->getAllServiceDetail();
			foreach ($listDetailService as $service) {
				$code = $service->service_detail_code;
				$service_detail_code = $this->input->post($code);
				$data = [ 'service_detail_code' => $service_detail_code,
				'technician_code'  => $technician_code
				];
				if (isset($service_detail_code)) {
					$this->M_Technician->insertServiceRef($data);
				}
			}

			$data = [ 'email' => $email,
			'fullname' => $fullname,
			'phone' => $phone,
			'full_address' => $full_address,
			'identity_number' => $identity_number,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'active_status' => $active_status,
			'bank_account_number' => $bank_account_number
			];

			$this->M_General->updateData('tbl_technician', $data, 'technician_code', $technician_code);
			$this->M_Metadata->updateMeta('tbl_technician', 'technician_code', $technician_code, $this->session->userdata('code'));
			$this->R_AuditLogging->insertLog('TECHNICIAN', 'UPDATE', $this->session->userdata('code'));
			redirect('Controller_Technician');
		}
	}
}