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

	public function getOne($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Admin");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_Admin->getOneById($code);
			}

			$this->load->view('admin/admin_view', $data);

		}
	}

	public function createAdmin() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/admin_create');

		}
	}

	public function updateAdmin($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Admin");

			$data['admin_code'] = $code;
			if (isset($code)) {
				$listData = $this->M_Admin->getOneById($code);
				$data['data'] = $listData;
				
				foreach ($listData as $field) {
					$active_status = $field->active_status;
					if ($active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/admin_edit', $data);

		}
	}

	public function saveData() {
		$this->load->model("M_Admin");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$admin_code = $this->M_General->getSequence('tbl_admin', 2, 'A');
			$email = $this->input->post('email');
			$password = 'password';
		    $role_id = '1';
			$fullname = $this->input->post('fullname');
			$phone = $this->input->post('phone');
			$full_address =	$this->input->post('full_address');
			$identity_number =	$this->input->post('identity_number');
			$active_status = '1';

			$data = [ 'admin_code' => $admin_code,
				'email' => $email,
				'password'  => $password,
				'role_id' => $role_id,
				'fullname' => $fullname,
				'phone' => $phone,
				'full_address' => $full_address,
				'identity_number' => $identity_number,
				'active_status' => $active_status
			];

			$this->M_General->insertData('tbl_admin', $data);
			$this->M_Metadata->createMeta('tbl_admin', 'admin_code', $admin_code, $fullname);
			$this->R_AuditLogging->insertLog('ADMIN', 'CREATE', $this->session->userdata('code'));

			redirect('Controller_Admin');
		}
	}

	public function updateData() {
		$this->load->model("M_Admin");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$admin_code = $this->input->post('admin_code');
			$email = $this->input->post('email');
			$fullname = $this->input->post('fullname');
			$phone = $this->input->post('phone');
			$full_address = $this->input->post('full_address');
			$identity_number = $this->input->post('identity_number');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$data = ['email' => $email,
				'fullname' => $fullname,
				'phone' => $phone,
				'full_address' => $full_address,
				'identity_number' => $identity_number,
				'active_status' => $active_status
			];

			$this->M_General->updateData('tbl_admin', $data, 'admin_code', $admin_code);
			$this->M_Metadata->updateMeta('tbl_admin', 'admin_code', $admin_code,  $this->session->userdata('code'));
			$this->R_AuditLogging->insertLog('ADMIN', 'UPDATE', $this->session->userdata('code'));
			redirect('Controller_Admin');
		}
	}
}