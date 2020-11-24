<?php
class Controller_Service extends CI_Controller{
	function index(){
        $this->load->model('M_Service');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_Service->getAllServiceCategory();
			$this->load->view('admin/service',$data);
		} else if($this->session->userdata('akses')=='3'){
			$data['list_service_category']=$this->M_Service->getAllServiceCategory();
			$this->load->view('customer/service_list',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getAllServiceDetailByCategory($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Service");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_Service->getAllServiceDetailByCategory($code);
				$data['category'] = $this->M_Service->getServiceCategoryByCode($code);
			}

			$this->load->view('admin/service_detail', $data);

		}
	}

	public function getAllServiceTypeByDetail($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Service");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_Service->getAllServiceTypeByDetail($code);
				$data['detail'] = $this->M_Service->getServiceDetailByCode($code);
			}

			$this->load->view('admin/service_type', $data);

		}
	}

	public function createServiceCategory() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/service_create');

		}
	}

	public function createServiceDetail($code = '') {
		if($this->session->userdata('akses')=='1'){
			$this->load->model("M_Service");

			if (isset($code)) {
				$data['category'] = $this->M_Service->getServiceCategoryByCode($code);
			}

			$this->load->view('admin/service_detail_create', $data);

		}
	}

	public function createServiceType($code = '') {
		if($this->session->userdata('akses')=='1'){
			$this->load->model("M_Service");

			if (isset($code)) {
				$data['detail'] = $this->M_Service->getServiceDetailByCode($code);
			}

			$this->load->view('admin/service_type_create', $data);

		}
	}

	public function updateServiceCategory($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Service");

			$data['code'] = $code;
			if (isset($code)) {
				$listData = $this->M_Service->getServiceCategoryByCode($code);
				$data['data'] = $listData;
				
				foreach ($listData as $field) {
					$active_status = $field->active_status;
					if ($active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/service_edit', $data);

		}
	}

	public function updateServiceDetail($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Service");

			$data['code'] = $code;
			if (isset($code)) {
				$listData = $this->M_Service->getServiceDetailByCode($code);
				$data['data'] = $listData;
				
				foreach ($listData as $field) {
					$active_status = $field->active_status;
					if ($active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/service_detail_edit', $data);

		}
	}

	public function updateServiceType($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Service");

			$data['code'] = $code;
			if (isset($code)) {
				$listData = $this->M_Service->getServiceTypeByCode($code);
				$data['data'] = $listData;
				
				foreach ($listData as $field) {
					$active_status = $field->active_status;
					if ($active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/service_type_edit', $data);

		}
	}

	public function saveDataCategory() {
		$this->load->model("M_Service");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$service_category_code = $this->M_General->getSequence('tbl_service_category', 2, 'S');

			$service_category_name 	=	$this->input->post('service_category_name');

			$data = [ 'service_category_code' => $service_category_code,
			'service_category_name'  => $service_category_name,
			'active_status' => '1'
			];

			$this->M_Service->inputData('tbl_service_category', $data);
			$this->M_Metadata->createMeta('tbl_service_category', 'service_category_code', $service_category_code,  $this->session->userdata('code'));
			$this->R_AuditLogging->insertLog('Service Category', 'CREATE', $this->session->userdata('code'));

			redirect('Controller_Service');
		}
	}

	public function updateDataCategory() {
		$this->load->model("M_Service");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$service_category_code = $this->input->post('service_category_code');
			$service_category_name = $this->input->post('service_category_name');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$data = [ 'service_category_name'  => $service_category_name,
			'active_status' => $active_status
			];

			$this->M_General->updateData('tbl_service_category', $data, 'service_category_code', $service_category_code);
			$this->M_Metadata->updateMeta('tbl_service_category', 'service_category_code', $service_category_code, $this->session->userdata('email'));
			$this->R_AuditLogging->insertLog('Service Category', 'UPDATE', $this->session->userdata('email'));

			redirect('Controller_Service');
		}
	}

	public function saveDataDetail($service_category_code) {
		$this->load->model("M_Service");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$service_detail_code = $this->M_General->getSequence('tbl_service_detail where service_category_code = \''.$service_category_code.'\'', 2, $service_category_code.'SD');
			// $icon = "";

			$service_detail_name = $this->input->post('service_detail_name');
			
			// $config['upload_path']          = './assets/uploaded-icon/';
			// $config['allowed_types']        = 'jpeg|jpg|png';
			// $config['max_size']             = 3000;
			// $this->load->library('upload', $config);
			// if ( ! $this->upload->do_upload('icon')) {
			// 	$error = array('error' => $this->upload->display_errors());
			// 	$error['category'] = $this->M_Service->getServiceCategoryByCode($service_category_code);
			// 	$this->load->view('admin/service_detail_create', $error);
			// } else {
			// 	$image_data = $this->upload->data();
			// 	$imgdata = file_get_contents($image_data['full_path']);
			// 	$icon=base64_encode($imgdata);
			// }

			$data = [ 'service_category_code' => $service_category_code,
			'service_detail_code' => $service_detail_code,
			'service_detail_name'  => $service_detail_name,
			// 'icon' => $icon,
			'active_status' => '1'
			];

			$this->M_General->insertData('tbl_service_detail', $data);
			$this->M_Metadata->createMeta('tbl_service_detail', 'service_detail_code' , $service_detail_code, $this->session->userdata('code'));
			$this->R_AuditLogging->insertLog('Service Detail', 'CREATE', $this->session->userdata('code'));

			$service_type_code = $this->M_General->getSequence('tbl_service_type where service_detail_code = \''.$service_detail_code.'\'', 2, $service_detail_code.'ST');

			$data_type_default = [ 'service_type_code' => $service_type_code,
			'service_detail_code' => $service_detail_code,
			'service_type_name' => 'Pengecekan',
			'price' => 10000,
			'active_status' => '1'
			];
			
			$this->M_General->insertData('tbl_service_type', $data_type_default);

			redirect('Controller_Service/getAllServiceDetailByCategory/'.$service_category_code);
		}
	}

	public function saveDataType($service_detail_code) {
		$this->load->model("M_Service");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$nextId = $this->M_Service->getNextSequenceId('tbl_service_type');
			$nextSeq = sprintf("%02d", $nextId);
			$service_type_code = "ST".$nextSeq;

			$service_type_name 	=	$this->input->post('service_type_name');
			$price 	=	$this->input->post('price');

			$data = [ 'service_detail_code' => $service_detail_code,
			'service_type_code' => $service_type_code,
			'service_type_name'  => $service_type_name,
			'price'  => $price,
			'active_status' => '1'
			];

			$this->M_Service->inputData('tbl_service_type', $data);
			$this->M_Metadata->createMeta('tbl_service_type', $nextId, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('Service Type', 'CREATE', $this->session->userdata('email'));

			redirect('Controller_Service/getAllServiceTypeByDetail/'.$service_detail_code);
		}
	}

	public function updateDataDetail() {
		$this->load->model("M_Service");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$id = $this->input->post('id');
			$service_detail_name = $this->input->post('service_detail_name');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$data = [ 'service_detail_name'  => $service_detail_name,
			'active_status' => $active_status
			];

			$this->M_Service->updateData('tbl_service_detail', $data, $id);
			$this->M_Metadata->updateMeta('tbl_service_detail', $id, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('Service Detail', 'UPDATE', $this->session->userdata('email'));

			redirect('Controller_Service/getAllServiceDetailByCategory/'.$service_category_code);
		}
	}

	public function updateDataType() {
		$this->load->model("M_Service");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$id = $this->input->post('id');
			$service_detail_code = $this->input->post('service_detail_code');
			$service_type_name = $this->input->post('service_type_name');
			$price = $this->input->post('price');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$data = [ 'service_type_name'  => $service_type_name,
			'price' => $price,
			'active_status' => $active_status
			];

			$this->M_Service->updateData('tbl_service_type', $data, $id);
			$this->M_Metadata->updateMeta('tbl_service_type', $id, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('Service Type', 'UPDATE', $this->session->userdata('email'));

			redirect('Controller_Service/getAllServiceTypeByDetail/'.$service_detail_code);
		}
	}
}