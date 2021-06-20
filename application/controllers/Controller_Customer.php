<?php
class Controller_Customer extends CI_Controller{
	function index(){
        $this->load->model('M_Customer');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list']=$this->M_Customer->getAllCustomer();
			$this->load->view('admin/customer',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function getOne($code='') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_Customer");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_Customer->getCustomerDetailByCode($code);
			}

			$this->load->view('admin/customer_view', $data);

		}
	}

	function createCustomer() {
		$this->load->view('admin/customer_create');
	}

	function updateCustomer($code = '') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_Customer");

			$data['customer_code'] = $code;
			if (isset($code)) {
				$listData = $this->M_Customer->getCustomerDetailByCode($code);
				$data['data'] = $listData;
				
				foreach ($listData as $field) {
					$active_status = $field->active_status;
					if ($active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/customer_edit', $data);

		}
	}

	function saveData() {
		$this->load->model("M_Customer");
		$this->load->model("M_General");
		$this->load->model("M_Token");

		$is_email_exist = $this->M_General->check_existing_email($this->input->post('email'));

		if ($is_email_exist == false) {
			$user_code = $this->M_General->getSequence('tbl_user_profile', 3, 'C');
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$role_id = '4';
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
			$active_status = '0';
			$now = date("Y-m-d H:i:s");
			$token = $this->M_Token->generateRandomToken();
			$expired_datetime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +2 minutes"));

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
				'active_status' => $active_status,
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_user_profile', $data_profile);

			$data_login = [ 'user_code' => $user_code,
				'role_id' => $role_id,
				'email' => $email,
				'password'  => $password,
				'active_status' => $active_status,
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_user_login', $data_login);

			$data_token = [ 'user_code' => $user_code,
				'token' => $token,
				'usage' => 'EMAIL VERIFICATION',
				'expired_datetime'  => $expired_datetime,
				'used' => 0
			];

			$this->M_General->insertData('tbl_token', $data_token);

			redirect('Controller_Email/send_email_verification/'.urlencode($email).'/'.$token);
		} else if ($is_email_exist == true) {
			$url=base_url('Controller_Customer/createCustomer');
	        echo $this->session->set_flashdata('msg','Email sudah terdaftar di sistem');
	        redirect($url);
		}
	}

	function updateData() {
		$this->load->model("M_Customer");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {

			$payment_account_id = $this->input->post('payment_account_id');
			$user_code = $this->input->post('user_code');
			$email = $this->input->post('email');
			// $password = md5($this->input->post('password'));
			$role_id = '4';
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
			$active_status = 0;

			if (isset($_POST['active_status'])) {
				$active_status = 1;
			}

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
				// 'active_status' => $active_status
			];
			$this->M_General->updateData('tbl_user_profile', $data_profile, 'user_code', $user_code);

			$data_login = [
				'active_status' => $active_status
			];
			$this->M_General->updateData('tbl_user_login', $data_login, 'user_code', $user_code);

			$this->M_General->updateMeta('tbl_user_profile', 'user_code', $user_code,  $this->session->userdata('user_name'));

			redirect('Controller_Customer');
		}
	}

	function printCustomer() {
		$this->load->library('ReportHeaderLandscape');
        $this->load->model("M_Customer");
        $this->load->helper('download');
        
        // $order_history = $this->M_Order->getAll($from, $to);
        $customer = $this->M_Customer->getAllCustomer();

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf = $this->reportheaderlandscape->getInstance($from, $to);

        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'Data Pelanggan', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 8);

        $pdf->Cell(5, 7, 'No', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Nama', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Email', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Jenis Kelamin', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Tanggal Lahir', 1, 0, 'C');
        $pdf->Cell(25, 7, 'Telepon', 1, 0, 'C',);
        $pdf->Cell(125, 7, 'Alamat', 1, 0, 'C',);
        $pdf->Cell(25, 7, 'Status', 1, 1, 'C',);

        $pdf->SetWidths(Array(5,40,50,30,30,25,125,25));
        $pdf->SetLineHeight(5);

        $pdf->SetFont('Arial', '', 8);
        $no = 1;
        foreach ($customer as $data) {
        	if ($data->gender == 'L') {
        		$gender = 'Laki-laki';
        	} else {
        		$gender = 'Perempuan';
        	}

        	if ($data->up_active_status == 1) {
        		$status = 'Aktif';
        	} else {
        		$status = 'Tidak Aktif';
        	}

            /*$pdf->Cell(5, 6, $no, 1, 0);
            $pdf->Cell(30, 6, $data->first_name.' '.$data->middle_name.' '.$data->last_name, 1, 0);
            $pdf->Cell(40, 6, $data->email, 1, 0);
            $pdf->Cell(30, 6, $data->identity_no, 1, 0);
            $pdf->Cell(30, 6, $gender, 1, 0);
            $pdf->Cell(30, 6, $data->date_of_birth, 1, 0);
            $pdf->Cell(25, 6, $data->phone, 1, 0);
            $pdf->MultiCell(120, 6, $data->address,'T,R,L,B', 'L');
            $pdf->Cell(25, 6, $status, 1, 1);*/

            $pdf->Row(Array(
            	$no,
            	$data->first_name.' '.$data->middle_name.' '.$data->last_name,
            	$data->email,
            	$gender,
            	$data->date_of_birth,
            	$data->phone,
            	$data->address,
            	$status
            ));
            $no ++;
        }
        
        $filename = 'list_data_pelanggan'.date("Ymdhis").'.pdf';
        
        $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');
        force_download('./assets/downloaded-pdf/'.$filename,NULL);
	}
}