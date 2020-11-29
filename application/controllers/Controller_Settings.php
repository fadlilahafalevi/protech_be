<?php
class Controller_Settings extends CI_Controller{
	function index(){		
        $this->load->model('M_Technician');
        $this->load->model('M_Customer');
		
		if($this->session->userdata('akses')=='2'){
			$data['data'] = $this->M_Technician->getDataTechnicianByEmail($this->session->userdata('email'));
		$this->load->view('technician/settings',$data);
		}else if($this->session->userdata('akses')=='3'){
			$data['data'] = $this->M_Customer->getDataCustomerByEmail($this->session->userdata('email'));
		$this->load->view('customer/settings',$data);
	    }

	}

	public function updateProfile() {
        $this->load->model('M_Technician');
        $this->load->model('M_Customer');

		if($this->session->userdata('akses')=='2'){
			$data['data'] = $this->M_Technician->getDataTechnicianByEmail($this->session->userdata('email'));
		} else if($this->session->userdata('akses')=='3'){
			$data['data'] = $this->M_Customer->getDataCustomerByEmail($this->session->userdata('email'));
		}
		
		$this->load->view('customer/settings_edit', $data);
	}

	public function updateData() {
		$this->load->model("M_Technician");
		$this->load->model("M_Customer");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '2') {
			$id = $this->input->post('id');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$fullname = $this->input->post('fullname');
			$phone = $this->input->post('phone');
			$full_address = $this->input->post('full_address');
			$identity_number = $this->input->post('identity_number');
			$bank_account_number =	$this->input->post('bank_account_number');
			$latitude =	$this->input->post('latitude');
			$longitude =	$this->input->post('longitude');
			$active_status = 1;

			$this->M_Technician->updateData($id, $email, $fullname, $phone, $full_address, $latitude, $longitude, $identity_number, $bank_account_number, $active_status);

			if($password != null){
				$this->M_Technician->updatePassword($id, $password);
			}
			$this->M_Metadata->updateMeta('tbl_technician', $id, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('TECHNICIAN', 'UPDATE', $this->session->userdata('code'));
            
            $this->session->set_userdata('fullname', $fullname);
		} else if ($this->session->userdata('akses') == '3') {
			$id = $this->input->post('id');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$fullname = $this->input->post('fullname');
			$phone = $this->input->post('phone');
			$full_address = $this->input->post('full_address');
			$latitude =	$this->input->post('latitude');
			$longitude = $this->input->post('longitude');
			$active_status = 1;

			$this->M_Customer->updateData($id, $email, $fullname, $phone, $full_address, $latitude, $longitude, $active_status);
			
			if($password != null){
				$this->M_Customer->updatePassword($id, $password);
			}
			$this->M_Metadata->updateMeta('tbl_customer', $id, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('CUSTOMER', 'UPDATE', $this->session->userdata('code'));
			
            $this->session->set_userdata('fullname', $fullname);
		}
		redirect('Controller_Settings');
	}
}