<?php
class Controller_ServiceCategory extends CI_Controller{
	function index(){
        $this->load->model('M_ServiceCategory');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list']=$this->M_ServiceCategory->getAllServiceCategory();
			$this->load->view('admin/service_category',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($code = '') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_ServiceCategory");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_ServiceCategory->getServiceCategoryDetailByCode($code);
			}

			$this->load->view('admin/service_category_view', $data);

		}
	}

	public function createServiceCategory() {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$this->load->model("M_General");
			$data['service_category_code'] = $this->M_General->getSequence('tbl_service_category', 2, 'K');
			
			$this->load->view('admin/service_category_create', $data);
		}
	}

	public function updateServiceCategory($code = '') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_ServiceCategory");

			$data['code'] = $code;
			if (isset($code)) {
				$listData = $this->M_ServiceCategory->getServiceCategoryDetailByCode($code);
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

	public function saveData() {
		$this->load->model("M_General");
		$this->load->model("M_ServiceCategory");
	
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {

			$service_category_code 	=	$this->input->post('service_category_code');
			$service_category_name 	=	$this->input->post('service_category_name');
			$active_status = '1';
			$now = date("Y-m-d H:i:s");

			$data_service_category = [ 'service_category_code' => $service_category_code,
				'service_category_name'  => $service_category_name,
				'active_status' => $active_status,
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_service_category', $data_service_category);

			redirect('Controller_ServiceCategory');
		}
	}

	public function updateData() {
		$this->load->model("M_General");
		$this->load->model("M_ServiceCategory");
	
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {

			$service_category_code = $this->input->post('service_category_code');
			$service_category_name = $this->input->post('service_category_name');
			$active_status = 0;

			if (isset($_POST['active_status'])) {
				$active_status = 1;
			}

			$data_service_category = [ 'service_category_code' => $service_category_code,
				'service_category_name'  => $service_category_name,
				'active_status' => $active_status
			];

			$this->M_General->updateData('tbl_service_category', $data_service_category, 'service_category_code', $service_category_code);
			$this->M_General->updateMeta('tbl_service_category', 'service_category_code', $service_category_code,  $this->session->userdata('user_name'));

			redirect('Controller_ServiceCategory');
		}
	}
}