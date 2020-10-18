<?php
class Controller_UserRole extends CI_Controller{
	function index(){
        $this->load->model('M_UserRole');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_UserRole->getAllUserRole();
			$this->load->view('admin/user_role',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function updateUserRole($id) {
		$this->load->model("M_UserRole");

		if ($this->session->userdata('akses') == '1') {
			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_UserRole->getUserRoleByID($id);
			}

			$this->load->view('admin/user_role_update', $data);
		}
	}

	public function updateUserCommit() {
		$this->load->model('M_UserRole');

		$id 			= $this->input->post('id');
		$user_level 		= $this->input->post('user_level');

		if (isset($user_password)) {
			$user_password 			= $this->input->post('user_password');

	    	$this->M_UserRole->updateKategori($id, $user_password, $user_level);
    	} else {
	    	$data = array(
	            "id"		=> $id,
	            "user_level"	=> $user_level
	        );

	        $this->M_UserRole->updateUserNoPassword($data);
    	}

		redirect('Controller_User');
	}

	public function inactivateUser($id) {
		$this->load->model('M_UserRole');

		$this->M_UserRole->inactivateUser($id);

		redirect('Controller_User');
	}

	public function activateUser($id) {
		$this->load->model('M_UserRole');

		$this->M_UserRole->activateUser($id);

		redirect('Controller_User');
	}

	public function createUser() {
		$this->load->model("M_UserRole");

		if ($this->session->userdata('akses') == '1') {
			$this->load->view('admin/user_create');
		}
	}

	public function createUserCommit() {
		$this->load->model("M_UserRole");

		if ($this->session->userdata('akses') == '1') {

			$user_name = $this->input->post('user_name');
			$user_password = $this->input->post('user_password');
			$user_level = $this->input->post('user_level');

			$this->M_UserRole->input_data($user_name, $user_password, $user_level);
			$data['data'] = $this->M_UserRole->getAllUser();
			
			$this->load->view('admin/user', $data);
		}
	}
}