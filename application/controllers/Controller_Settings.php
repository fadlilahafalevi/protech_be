<?php
class Controller_Settings extends CI_Controller{
	function index(){		
        $this->load->model('M_Technician');
        $this->load->model('M_Customer');
        $this->load->model('M_Order');
		
		if($this->session->userdata('akses')=='3'){
			//for notification
			$data['notif_order']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
			$technician_data = $this->M_Technician->getTechnicianDetailByCode($this->session->userdata('user_code'));
			$data['order_waiting_confirmation'] = $this->M_Order->searchOrder($technician_data[0]->latitude, $technician_data[0]->longitude, $this->session->userdata('user_code'));

			$data['data_settings'] = $technician_data;
			$this->load->view('customer/settings',$data);
		}else if($this->session->userdata('akses')=='4'){
			$data['data_settings'] = $this->M_Customer->getCustomerDetailByCode($this->session->userdata('user_code'));
			$this->load->view('customer/settings',$data);
	    }

	}

	public function updateProfile() {
        $this->load->model('M_Technician');
        $this->load->model('M_Customer');
        $this->load->model('M_Order');

		if($this->session->userdata('akses')=='3'){
			//for notification
			$data['notif_order']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
			$technician_data = $this->M_Technician->getTechnicianDetailByCode($this->session->userdata('user_code'));
			$data['order_waiting_confirmation'] = $this->M_Order->searchOrder($technician_data[0]->latitude, $technician_data[0]->longitude, $this->session->userdata('user_code'));

			$data['data_settings'] = $technician_data;
			$this->load->view('customer/settings_edit', $data);
		} else if($this->session->userdata('akses')=='4'){
			$data['data_settings'] = $this->M_Customer->getCustomerDetailByCode($this->session->userdata('user_code'));
			$this->load->view('customer/settings_edit', $data);
		}
	}

	public function updateData() {
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses')=='3' || $this->session->userdata('akses') == '4') {
			$user_code = $this->input->post('user_code');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$old_password = $this->input->post('old_password');
			$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
			$last_name = $this->input->post('last_name');
			$gender = $this->input->post('gender');
			$tanggal_lahir = $this->input->post('tanggal_lahir');
			$bulan_lahir = $this->input->post('bulan_lahir');
			$tahun_lahir = $this->input->post('tahun_lahir');
			$date_of_birth = $tahun_lahir.'-'.$bulan_lahir.'-'.$tanggal_lahir;
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
				'latitude' => $latitude
			];

			$this->M_General->updateData('tbl_user_profile', $data_profile, 'user_code', $user_code);
			$this->M_General->updateMeta('tbl_user_profile', 'user_code', $user_code,  $this->session->userdata('user_name'));

			if ($old_password != $password) {
				$data_password = [
				'password' => md5($password)
				];

				if($password != null){
					$this->M_General->updateData('tbl_user_login', $data_password, 'user_code', $user_code);
					$this->M_General->updateMeta('tbl_user_login', 'user_code', $user_code,  $this->session->userdata('user_name'));
				}
			}
			
            $this->session->set_userdata('user_name', $first_name.' '.$middle_name.' '.$last_name);
		}
		redirect('Controller_Settings');
	}
}