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

	public function createTechnician($error = '') {
		if($this->session->userdata('akses')=='1'){

			if (isset($error)) {
				$this->load->view('admin/technician_create', $error);
			} else {
				$this->load->view('admin/technician_create');
			}

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
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$pass_photo = "";
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
			$this->M_Technician->inputData($email, $password, $role_id, $fullname, $phone, $full_address, $latitude, $longitude, $identity_number, $bank_account_number, $active_status, $pass_photo);
			$idData = $this->M_Technician->getOneByEmail($email);
			$this->M_Metadata->createMeta('tbl_technician', $idData, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('TECHNICIAN', 'CREATE', $this->session->userdata('email'));

			redirect('Controller_Technician');
		}
	}

	public function updateData() {
		$this->load->model("M_Technician");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_Service");
	
		if ($this->session->userdata('akses') == '1') {

			$id = $this->input->post('id');
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

			$listDetailService = $this->M_Service->getAllServiceDetail();
			foreach ($listDetailService as $service) {
				$code = $service->service_detail_code;
				$service_detail_code = $this->input->post($code);
				$data = [ 'service_detail_code' => $service_detail_code,
				'user_id'  => $id
				];
				if (isset($service_detail_code)) {
					$this->M_Technician->insertServiceRef($data);
				}
			}

			$this->M_Technician->updateData($id, $email, $fullname, $phone, $full_address, $latitude, $longitude, $identity_number, $bank_account_number, $active_status);
			$this->M_Metadata->updateMeta('tbl_technician', $id, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('TECHNICIAN', 'UPDATE', $this->session->userdata('email'));
			redirect('Controller_Technician');
		}
	}
}