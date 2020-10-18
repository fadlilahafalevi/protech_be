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

	public function updateUser($user_id) {
		$this->load->model("M_User");

		if ($this->session->userdata('akses') == '1') {
			$data['user_id'] = $user_id;
			if (isset($user_id)) {
				$data['data'] = $this->M_User->getUserByID($user_id);
			}

			$this->load->view('admin/user_update', $data);
		}
	}

	public function updateUserCommit() {
		$this->load->model('M_User');

		$user_id 			= $this->input->post('user_id');
		$user_level 		= $this->input->post('user_level');

		if (isset($user_password)) {
			$user_password 			= $this->input->post('user_password');

	    	$this->M_User->updateKategori($user_id, $user_password, $user_level);
    	} else {
	    	$data = array(
	            "user_id"		=> $user_id,
	            "user_level"	=> $user_level
	        );

	        $this->M_User->updateUserNoPassword($data);
    	}

		redirect('Controller_User');
	}

	public function inactivateUser($user_id) {
		$this->load->model('M_User');

		$this->M_User->inactivateUser($user_id);

		redirect('Controller_User');
	}

	public function activateUser($user_id) {
		$this->load->model('M_User');

		$this->M_User->activateUser($user_id);

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
			$user_password = $this->input->post('user_password');
			$user_level = $this->input->post('user_level');

			$this->M_User->input_data($user_name, $user_password, $user_level);
			$data['data'] = $this->M_User->getAllUser();
			
			$this->load->view('admin/user', $data);
		}
	}
}