<?php
class Controller_Service extends CI_Controller{
	function index(){
        $this->load->model('M_Service');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_Service->getAllServiceCategory();
			$this->load->view('admin/service',$data);
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
			}

			$this->load->view('admin/service_type', $data);

		}
	}

	public function createServiceCategory() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/service_create');

		}
	}

	public function createServiceDetail() {
		if($this->session->userdata('akses')=='1'){
			$this->load->model("M_Service");

			$data['list_service'] = $this->M_Service->getAllServiceCategory();

			$this->load->view('admin/service_detail_create', $data);

		}
	}

	public function createServiceType() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/service_type_create');

		}
	}

	public function updateService($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Service");

			$data['id'] = $id;
			if (isset($id)) {
				$listData = $this->M_Service->getOneById($id);
				$data['data'] = $listData;
				
				foreach ($listData as $field) {
					$active_status = $field->active_status;
					if ($active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/service_category_edit', $data);

		}
	}

	public function saveDataCategory() {
		$this->load->model("M_Service");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$nextId = $this->M_Service->getNextSequenceId('tbl_service_category');
			$nextSeq = sprintf("%02d", $nextId);
			$service_category_code = "S".$nextSeq;

			$service_category_name 	=	$this->input->post('service_category_name');

			$data = [ 'service_category_code' => $service_category_code,
			'service_category_name'  => $service_category_name,
			'active_status' => '1'
			];

			$this->M_Service->inputData('tbl_service_category', $data);
			$this->M_Metadata->createMeta('tbl_service_category', $nextId, $this->session->userdata('fullname'));
			$this->M_AuditLogging->insertLog('Service Category', 'CREATE', $this->session->userdata('email'));

			redirect('Controller_Service');
		}
	}

	public function saveDataDetail() {
		$this->load->model("M_ServiceDetail");
	
		if ($this->session->userdata('akses') == '1') {

			$nextId =  $this->M_ServiceDetail->getNextSequenceId('tbl_service_detail');
			$nextSeq = sprintf("%02d", $nextId);
			$serviceDetailCode = "SD".$nextSeq;
			$icon = "";

			$service_code		 	=	$this->input->post('service_code');
			$service_detail_name 	=	$this->input->post('service_detail_name');
			$price					=	$this->input->post('price');
			
			$config['upload_path']          = './assets/img/icon-uploaded/';
			$config['allowed_types']        = 'jpeg|jpg|png';
			$config['max_size']             = 3000;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('icon')) {
				$error = array('error' => $this->upload->display_errors());
				$this->createServiceDetail($error);
			} else {
				$image_data = $this->upload->data();
				$imgdata 	= file_get_contents($image_data['full_path']);
				$icon 		= base64_encode($imgdata);
				$this->M_ServiceDetail->inputData($serviceDetailCode, $service_code, $service_detail_name, $price, $icon);
				redirect('Controller_ServiceDetail');
			}
			$data = [ 'service_category_code' => $service_category_code,
			'service_category_name'  => $service_category_name,
			'active_status' => '1'
			];

		}
	}

	public function updateData() {
		$this->load->model("M_Service");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$service_category_code = $this->input->post('service_category_code');
			$service_category_name = $this->input->post('service_category_name');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$this->M_Service->updateData($service_category_code, $service_category_name, $active_status);
			$id = $this->M_Admin->getOneByCode($service_category_code);
			$this->M_Metadata->updateMeta('tbl_service_category', $id, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('Service Category', 'UPDATE', $this->session->userdata('email'));

			redirect('Controller_Service');
		}
	}
}