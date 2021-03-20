<?php
class Controller_Admin extends CI_Controller{
	function index(){
        $this->load->model('M_Admin');
        
		if($this->session->userdata('akses')=='1'){
			$data['list'] = $this->M_Admin->getAllAdmin();
			
			$this->load->view('admin/admin',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function getOne($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Admin");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_Admin->getAdminDetailByCode($code);
			}

			$this->load->view('admin/admin_view', $data);

		}
	}

	function createAdmin() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/admin_create');

		}
	}

	function updateAdmin($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Admin");

			$data['user_code'] = $code;
			if (isset($code)) {
				$listData = $this->M_Admin->getAdminDetailByCode($code);
				$data['data'] = $listData;
				
				foreach ($listData as $field) {
					$up_active_status = $field->up_active_status;
					if ($up_active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/admin_edit', $data);

		}
	}

	function saveData() {
		$this->load->model("M_Admin");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$user_code = $this->M_General->getSequence('tbl_user_profile', 3, 'A');
			$email = $this->input->post('email');
			$password = md5('password');
		    $role_id = '2';
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

			redirect('Controller_Admin');
		}
	}

	function updateData() {
		$this->load->model("M_Admin");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$user_code = $this->input->post('user_code');
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
			redirect('Controller_Admin');
		}
	}
}