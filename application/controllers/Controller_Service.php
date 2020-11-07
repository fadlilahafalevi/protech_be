<?php
class Controller_Service extends CI_Controller{
	function index(){
        $this->load->model('M_Service');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_Service->getAllService();
			$this->load->view('admin/service',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Service");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_Service->getOneById($id);
			}

			$this->load->view('admin/service_view', $data);

		}
	}

	public function createService() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/service_create');

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

			$this->load->view('admin/service_edit', $data);

		}
	}

	public function saveData() {
		$this->load->model("M_Service");
	
		if ($this->session->userdata('akses') == '1') {

			$nextSeq = sprintf("%02d", $this->M_Service->getNextSequenceId());
			$serviceCode = "S".$nextSeq;

			$service_name 	=	$this->input->post('service_name');
			$service_desc	=	$this->input->post('service_desc');

			$this->M_Service->inputData($serviceCode, $service_name, $service_desc);

			redirect('Controller_Service');
		}
	}

	public function updateData() {
		$this->load->model("M_Service");
	
		if ($this->session->userdata('akses') == '1') {

			$service_code = $this->input->post('service_code');
			$service_name = $this->input->post('service_name');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$this->M_Service->updateData($service_code, $service_name, $active_status);

			redirect('Controller_Service');
		}
	}
}