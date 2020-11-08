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

	public function getOne($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Admin");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_Admin->getOneById($id);
			}

			$this->load->view('admin/admin_view', $data);

		}
	}

	public function createAdmin() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/admin_create');

		}
	}

	public function updateAdmin($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Admin");

			$data['id'] = $id;
			if (isset($id)) {
				$listData = $this->M_Admin->getOneById($id);
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
		$this->load->model("M_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$email = $this->input->post('email');
			$password = 'password';
		    $role_id = '1';
			$fullname = $this->input->post('fullname');
			$phone = $this->input->post('phone');
			$full_address =	$this->input->post('full_address');
			$identity_number =	$this->input->post('identity_number');
			$active_status = '1';
			$this->M_Admin->inputData($email, $password, $role_id, $fullname, $phone, $full_address, $identity_number, $active_status);
			$idData = $this->M_Admin->getOneByEmail($email);
			$this->M_Metadata->createMeta('tbl_admin', $idData, $this->session->userdata('fullname'));
			$this->M_AuditLogging->insertLog('ADMIN', 'CREATE', $this->session->userdata('email'));

			redirect('Controller_Admin');
		}
	}

	public function updateData() {
		$this->load->model("M_Admin");
		$this->load->model("M_Metadata");
		$this->load->model("M_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$id = $this->input->post('id');
			$email = $this->input->post('email');
			$fullname = $this->input->post('fullname');
			$phone = $this->input->post('phone');
			$full_address = $this->input->post('full_address');
			$identity_number = $this->input->post('identity_number');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$this->M_Admin->updateData($id, $email, $fullname, $phone, $full_address, $identity_number, $active_status);
			$this->M_Metadata->updateMeta('tbl_admin', $id, $this->session->userdata('fullname'));
			$this->M_AuditLogging->insertLog('ADMIN', 'UPDATE', $this->session->userdata('email'));
			redirect('Controller_Admin');
		}
	}
}