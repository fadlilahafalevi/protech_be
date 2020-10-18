<?php
class Controller_Service extends CI_Controller{
	function index(){
        $this->load->model('M_Service');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_Service->getAllService();
			$this->load->view('admin/service',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function updateUserRole($id) {
		$this->load->model("M_ServIce");

		if ($this->session->userdata('akses') == '1') {
			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_ServIce->getUserRoleByID($id);
			}

			$this->load->view('admin/user_role_update', $data);
		}
	}

	public function updateUserCommit() {
		$this->load->model('M_ServIce');

		$id 			= $this->input->post('id');
		$user_level 		= $this->input->post('user_level');

		if (isset($user_password)) {
			$user_password 			= $this->input->post('user_password');

	    	$this->M_ServIce->updateKategori($id, $user_password, $user_level);
    	} else {
	    	$data = array(
	            "id"		=> $id,
	            "user_level"	=> $user_level
	        );

	        $this->M_ServIce->updateUserNoPassword($data);
    	}

		redirect('Controller_Service');
	}

	public function inactivateUser($id) {
		$this->load->model('M_ServIce');

		$this->M_ServIce->inactivateUser($id);

		redirect('Controller_Service');
	}

	public function activateUser($id) {
		$this->load->model('M_ServIce');

		$this->M_ServIce->activateUser($id);

		redirect('Controller_Service');
	}

	public function createUser() {
		$this->load->model("M_ServIce");

		if ($this->session->userdata('akses') == '1') {
			$this->load->view('admin/user_create');
		}
	}

	public function createUserCommit() {
		$this->load->model("M_ServIce");

		if ($this->session->userdata('akses') == '1') {

			$user_name = $this->input->post('user_name');
			$user_password = $this->input->post('user_password');
			$user_level = $this->input->post('user_level');

			$this->M_ServIce->input_data($user_name, $user_password, $user_level);
			$data['data'] = $this->M_ServIce->getAllUser();
			
			$this->load->view('admin/user', $data);
		}
	}
}