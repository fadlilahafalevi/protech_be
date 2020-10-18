<?php
class Controller_User extends CI_Controller{
	function index(){
        $this->load->model('M_User');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_User->getAllUser();
			$this->load->view('admin/user',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function updateUser($id) {
		$this->load->model("M_User");

		if ($this->session->userdata('akses') == '1') {
			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_User->getUserByID($id);
			}

			$this->load->view('admin/user_update', $data);
		}
	}

	public function updateUserCommit() {
		$this->load->model('M_User');

		$id 			= $this->input->post('id');
		$role_code 		= $this->input->post('role_code');

		if (isset($password)) {
			$password 			= $this->input->post('password');

	    	$this->M_User->updateKategori($id, $password, $role_code);
    	} else {
	    	$data = array(
	            "id"		=> $id,
	            "role_code"	=> $role_code
	        );

	        $this->M_User->updateUserNoPassword($data);
    	}

		redirect('Controller_User');
	}

	public function inactivateUser($id) {
		$this->load->model('M_User');

		$this->M_User->inactivateUser($id);

		redirect('Controller_User');
	}

	public function activateUser($id) {
		$this->load->model('M_User');

		$this->M_User->activateUser($id);

		redirect('Controller_User');
	}

	public function createUser() {
		$this->load->model("M_User");

		if ($this->session->userdata('akses') == '1') {
			$this->load->view('admin/user_create');
		}
	}

	public function createUserCommit() {
		$this->load->model("M_User");

		if ($this->session->userdata('akses') == '1') {

			$user_name = $this->input->post('user_name');
			$password = $this->input->post('password');
			$role_code = $this->input->post('role_code');

			$this->M_User->input_data($user_name, $password, $role_code);
			$data['data'] = $this->M_User->getAllUser();
			
			$this->load->view('admin/user', $data);
		}
	}
}