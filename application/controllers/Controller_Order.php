<?php
class Controller_Order extends CI_Controller{
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
			}

			$this->load->view('admin/technician_view', $data);

		}
	}

	public function createOrder() {
		if($this->session->userdata('akses')=='3'){
			$this->load->view('customer/order_create');
		} else {
			redirect('Controller_Login');
		}
	}

	public function saveData() {
		$this->load->model("M_Technician");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '3') {

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
			$this->M_Technician->inputData($email, $password, $role_id, $fullname, $phone, $full_address, $latitude, $longitude, $identity_number, $bank_account_number, $active_status);
			$idData = $this->M_Technician->getOneByEmail($email);
			$this->M_Metadata->createMeta('tbl_technician', $idData, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('TECHNICIAN', 'CREATE', $this->session->userdata('email'));

			redirect('Controller_Technician');
		}
	}
}