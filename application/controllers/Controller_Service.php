<?php
class Controller_ServiceCategory extends CI_Controller{
	function index(){
        $this->load->model('M_ServiceCategory');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_ServiceCategory->getAllService();
			$this->load->view('admin/service',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_ServiceCategory");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_ServiceCategory->getOneById($id);
			}

			$this->load->view('admin/service_category_view', $data);

		}
	}

	public function createService() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/service_category_create');

		}
	}

	public function updateService($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_ServiceCategory");

			$data['id'] = $id;
			if (isset($id)) {
				$listData = $this->M_ServiceCategory->getOneById($id);
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
		$this->load->model("M_ServiceCategory");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$nextSeq = sprintf("%02d", $this->M_ServiceCategory->getNextSequenceId());
			$service_category_code = "S".$nextSeq;

			$service_category_name 	=	$this->input->post('service_category_name');
			$service_category_desc	=	$this->input->post('service_category_desc');

			$this->M_ServiceCategory->inputData($service_category_code, $service_category_name);
			$idData = $this->M_Admin->getOneByCode($service_category_code);
			$this->M_Metadata->createMeta('tbl_service_category', $idData, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('Service Category', 'CREATE', $this->session->userdata('email'));

			redirect('Controller_Service');
		}
	}

	public function updateData() {
		$this->load->model("M_ServiceCategory");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$service_category_code = $this->input->post('service_category_code');
			$service_category_name = $this->input->post('service_category_name');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$this->M_ServiceCategory->updateData($service_category_code, $service_category_name, $active_status);
			$id = $this->M_Admin->getOneByCode($service_category_code);
			$this->M_Metadata->updateMeta('tbl_service_category', $id, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('Service Category', 'UPDATE', $this->session->userdata('email'));

			redirect('Controller_Service');
		}
	}
}