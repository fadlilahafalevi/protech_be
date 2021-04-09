<?php
class Controller_Settings extends CI_Controller{
	function index(){		
        $this->load->model('M_Technician');
        $this->load->model('M_Customer');
		
		if($this->session->userdata('akses')=='3'){
			$data['data'] = $this->M_Technician->getTechnicianDetailByCode($this->session->userdata('user_code'));
			$this->load->view('technician/settings',$data);
		}else if($this->session->userdata('akses')=='4'){
			$data['data'] = $this->M_Customer->getCustomerDetailByCode($this->session->userdata('user_code'));
			$this->load->view('customer/settings',$data);
	    }

	}

	public function updateProfile() {
        $this->load->model('M_Technician');
        $this->load->model('M_Customer');

		if($this->session->userdata('akses')=='3'){
			$data['data'] = $this->M_Technician->getTechnicianDetailByCode($this->session->userdata('user_code'));
			$this->load->view('technician/settings_edit', $data);
		} else if($this->session->userdata('akses')=='4'){
			$data['data'] = $this->M_Customer->getCustomerDetailByCode($this->session->userdata('user_code'));
			$this->load->view('customer/settings_edit', $data);
		}
	}

	public function updateData() {
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses')=='3' || $this->session->userdata('akses') == '4') {
			$user_code = $this->input->post('user_code');
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
			$last_name = $this->input->post('last_name');
			$gender = $this->input->post('gender');
			$date_of_birth = $this->input->post('date_of_birth');
			$identity_no = $this->input->post('identity_no');
			$phone = $this->input->post('phone');
			$address =	$this->input->post('address');
			$longitude =	$this->input->post('longitude');
			$latitude =	$this->input->post('latitude');

			$data_profile = [ 'user_code' => $user_code,
				'first_name'  => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
				'gender' => $gender,
				'date_of_birth' => $date_of_birth,
				'identity_no' => $identity_no,
				'phone' => $phone,
				'address' => $address,
				'longitude' => $longitude,
				'latitude' => $latitude,
				'active_status' => $active_status
			];

			$this->M_General->updateData('tbl_user_profile', $data_profile, 'user_code', $user_code);
			$this->M_General->updateMeta('tbl_user_profile', 'user_code', $user_code,  $this->session->userdata('user_name'));

			$data_password = [
			'password' => md5($password)
			];

			if($password != null){
				$this->M_General->updateData('tbl_user_login', $data_password, 'user_code', $user_code);
				$this->M_General->updateMeta('tbl_user_login', 'user_code', $user_code,  $this->session->userdata('user_name'));
			}
			
            $this->session->set_userdata('user_name', $user_name);
		}
		redirect('Controller_Settings');
	}
}