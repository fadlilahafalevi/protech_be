<?php
class Controller_ServiceDetail extends CI_Controller{
	function index(){
        $this->load->model('M_ServiceDetail');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_ServiceDetail->getAllServiceDetail();
			$this->load->view('admin/service_detail',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function updateUserRole($id) {
		$this->load->model("M_ServiceDetail");

		if ($this->session->userdata('akses') == '1') {
			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_ServiceDetail->getUserRoleByID($id);
			}

			$this->load->view('admin/user_role_update', $data);
		}
	}

	public function updateUserCommit() {
		$this->load->model('M_ServiceDetail');

		$id 			= $this->input->post('id');
		$user_level 		= $this->input->post('user_level');

		if (isset($user_password)) {
			$user_password 			= $this->input->post('user_password');

	    	$this->M_ServIceDetail->updateKategori($id, $user_password, $user_level);
    	} else {
	    	$data = array(
	            "id"		=> $id,
	            "user_level"	=> $user_level
	        );

	        $this->M_ServIceDetail->updateUserNoPassword($data);
    	}

		redirect('Controller_Service');
	}

	public function inactivateUser($id) {
		$this->load->model('M_ServiceDetail');

		$this->M_ServIceDetail->inactivateUser($id);

		redirect('Controller_Service');
	}

	public function activateUser($id) {
		$this->load->model('M_ServiceDetail');

		$this->M_ServIceDetail->activateUser($id);

		redirect('Controller_Service');
	}

	public function createUser() {
		$this->load->model("M_ServiceDetail");

		if ($this->session->userdata('akses') == '1') {
			$this->load->view('admin/user_create');
		}
	}

	public function createUserCommit() {
		$this->load->model("M_ServIceDetail");

		if ($this->session->userdata('akses') == '1') {

			$user_name = $this->input->post('user_name');
			$user_password = $this->input->post('user_password');
			$user_level = $this->input->post('user_level');

			$this->M_ServIceDetail->input_data($user_name, $user_password, $user_level);
			$data['data'] = $this->M_ServIceDetail->getAllUser();
			
			$this->load->view('admin/user', $data);
		}
	}
}