<?php
class Controller_User extends CI_Controller{
	function index(){
        $this->load->model('M_User');
        
		if($this->session->userdata('akses')=='1'){
			$data['list'] = $this->M_User->getAllUser();
			
			$this->load->view('admin/user',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_User");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_User->getOneById($id);
			}

			$this->load->view('admin/user_view', $data);

		}
	}

	public function createUser() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/user_create');

		}
	}

	public function updateUser($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_User");

			$data['id'] = $id;
			if (isset($id)) {
				$listData = $this->M_User->getOneById($id);
				$data['data'] = $listData;
				
				foreach ($listData as $field) {
					$active_status = $field->active_status;
					if ($active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/user_edit', $data);

		}
	}

	public function saveData() {
		$this->load->model("M_User");
		$this->load->model("M_Metadata");
	
		if ($this->session->userdata('akses') == '1') {

			$nextSeq = sprintf("%03d", $this->M_User->getNextSequenceId());
			$userCode = "A".$nextSeq;

			$username 		=	$this->input->post('username');
			$password 		=	'P@ssw0rd';
		    $role_id		=	'2';
			$email			=	$this->input->post('email');
			$fullname		=	$this->input->post('fullname');
			$phone 			=	$this->input->post('phone');
			$active_status 	=	'1';
			$this->M_User->inputData($userCode, $username, $password, $role_id, $email, $fullname, $phone, $active_status);
			$idData = $this->M_User->getOneByCode($userCode);
			$this->M_Metadata->createMeta('tbl_user', $idData, $this->session->userdata('nama'));

			redirect('Controller_User');
		}
	}

	public function updateData() {
		$this->load->model("M_User");
		$this->load->model("M_Metadata");
	
		if ($this->session->userdata('akses') == '1') {

			$user_code = $this->input->post('user_code');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			echo "user code ".$user_code;

			$this->M_User->updateData($user_code, $active_status);
			$idData = $this->M_User->getOneByCode($user_code);
			$this->M_Metadata->updateMeta('tbl_user', $idData, $this->session->userdata('nama'));
			redirect('Controller_User');
		}
	}
}