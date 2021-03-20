<?php
class Controller_ServiceType extends CI_Controller{
	function index(){
        $this->load->model('M_ServiceType');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list']=$this->M_ServiceType->getAllServiceType();
			$this->load->view('admin/service_type',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($code = '') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_ServiceType");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_ServiceType->getServiceTypeDetailByCode($code);
			}

			$this->load->view('admin/service_type_view', $data);

		}
	}

	public function createServiceType() {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$this->load->model("M_ServiceCategory");

			$data['list_service_category'] = $this->M_ServiceCategory->getAllServiceCategory();
			$this->load->view('admin/service_type_create', $data);

		}
	}

	public function updateServiceType($code = '') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_ServiceType");
			$this->load->model("M_ServiceCategory");

			$data['code'] = $code;
			if (isset($code)) {
				$listData = $this->M_ServiceType->getServiceTypeDetailByCode($code);
				$data['list_service_category'] = $this->M_ServiceCategory->getAllServiceCategory();
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

	public function saveData() {
		$this->load->model("M_ServiceType");
	
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {

			$service_type_code = $this->M_General->getSequence('tbl_service_type', 3, 'T');
			$service_type_name 	=	$this->input->post('service_type_name');
			$service_type_desc 	=	$this->input->post('service_type_desc');
			$service_category_code 	=	$this->input->post('service_category_code');
			$price 	=	$this->input->post('price');
			$unit 	=	$this->input->post('unit');
			$type 	=	$this->input->post('type');
			$active_status = '1';
			$now = date("Y-m-d H:i:s");
			
			$data_service_type = [ 'service_type_code' => $service_type_code,
				'service_type_name'  => $service_type_name,
				'service_type_desc' => $service_type_desc,
				'service_category_code' => $service_category_code,
				'price' => $price,
				'unit' => $unit,
				'type' => $type,
				'active_status' => $active_status,
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_service_type', $data_service_type);

			redirect('Controller_ServiceType');
		}
	}

	public function updateData() {
		$this->load->model("M_ServiceType");
	
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {

			$service_type_code = $this->input->post('service_type_code');
			$service_type_name 	=	$this->input->post('service_type_name');
			$service_type_desc 	=	$this->input->post('service_type_desc');
			$service_category_code 	=	$this->input->post('service_category_code');
			$price 	=	$this->input->post('price');
			$unit 	=	$this->input->post('unit');
			$type 	=	$this->input->post('type');
			$active_status = 0;

			if (isset($_POST['active_status'])) {
				$active_status = 1;
			}

			$data_service_type = [ 'service_type_code' => $service_type_code,
				'service_type_name'  => $service_type_name,
				'service_type_desc'  => $service_type_desc,
				'service_category_code'  => $service_category_code,
				'price'  => $price,
				'unit'  => $unit,
				'type'  => $type,
				'active_status' => $active_status
			];

			$this->M_General->updateData('tbl_service_category', $data_service_type, 'service_type_code', $service_type_code);
			$this->M_General->updateMeta('tbl_service_category', 'service_type_code', $service_type_code,  $this->session->userdata('user_name'));

			redirect('Controller_ServiceType');
		}
	}
}