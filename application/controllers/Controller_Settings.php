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
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '2') {
			$technician_code = $this->input->post('technician_code');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$fullname = $this->input->post('fullname');
			$phone_old = $this->input->post('phone_old');
			$phone = $this->input->post('phone');
			$full_address = $this->input->post('full_address');
			$identity_number = $this->input->post('identity_number');
			$bank_account_number =	$this->input->post('bank_account_number');
			$latitude =	$this->input->post('latitude');
			$longitude =	$this->input->post('longitude');
			$active_status = 1;

			$data = [ 'email' => $email,
			'fullname' => $fullname,
			'phone' => $phone,
			'full_address' => $full_address,
			'identity_number' => $identity_number,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'active_status' => $active_status,
			'bank_account_number' => $bank_account_number
			];
			
			$data_password = [
			'password' => md5($password)
			];
			
			$data_wallet = [
			'phone' => $phone
			];

			$this->M_General->updateData('tbl_wallet', $data_wallet, 'phone', $phone_old);
			$this->M_General->updateData('tbl_technician', $data, 'technician_code', $technician_code);

			if($password != null){
				$this->M_General->updateData('tbl_technician', $data_password, 'technician_code', $technician_code);
			}

			$this->M_Metadata->updateMeta('tbl_technician', 'technician_code', $technician_code, $this->session->userdata('code'));
			$this->R_AuditLogging->insertLog('TECHNICIAN', 'UPDATE', $this->session->userdata('code'));

            $this->session->set_userdata('fullname', $fullname);
		} else if ($this->session->userdata('akses') == '3') {
			$customer_code = $this->input->post('customer_code');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$fullname = $this->input->post('fullname');
			$phone_old = $this->input->post('phone_old');
			$phone = $this->input->post('phone');
			$full_address = $this->input->post('full_address');
			$latitude =	$this->input->post('latitude');
			$longitude = $this->input->post('longitude');
			$active_status = 1;

			$data = [ 'email' => $email,
			'fullname' => $fullname,
			'phone' => $phone,
			'full_address' => $full_address,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'active_status' => $active_status,
			];
			
			$data_password = [
			'password' => md5($password)
			];
			
			$data_wallet = [
			'phone' => $phone
			];

			$this->M_General->updateData('tbl_wallet', $data_wallet, 'phone', $phone_old);
			$this->M_General->updateData('tbl_customer', $data, 'customer_code', $customer_code);

			if($password != null){
				$this->M_General->updateData('tbl_customer', $data_password, 'customer_code', $customer_code);
			}

			$this->M_Metadata->updateMeta('tbl_technician', 'technician_code', $technician_code, $this->session->userdata('code'));
			$this->R_AuditLogging->insertLog('CUSTOMER', 'UPDATE', $this->session->userdata('code'));

			
            $this->session->set_userdata('fullname', $fullname);
		}
		redirect('Controller_Settings');
	}
}