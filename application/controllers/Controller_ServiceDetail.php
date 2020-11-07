<?php
class Controller_ServiceDetail extends CI_Controller{
	function index(){
        $this->load->model('M_ServiceDetail');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_ServiceDetail->getAllServiceDetail();
			$this->load->view('admin/service_detail',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_ServiceDetail");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_ServiceDetail->getOneById($id);
			}

			$this->load->view('admin/service_detail_view', $data);

		}
	}

	public function createServiceDetail($error = '') {
		if($this->session->userdata('akses')=='1'){
			$this->load->model("M_Service");

			$data['list_service'] = $this->M_Service->getAllService();
			$data['error'] = $error;
			$this->load->view('admin/service_detail_create', $data);

		}
	}

	public function updateServiceDetail($id = '', $error = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_ServiceDetail");
			$this->load->model("M_Service");

			$data['id'] = $id;
			if (isset($id)) {
				$listData = $this->M_ServiceDetail->getOneById($id);
				$data['list_service'] = $this->M_Service->getAllService();
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
		$this->load->model("M_ServiceDetail");
	
		if ($this->session->userdata('akses') == '1') {

			$nextSeq = sprintf("%03d", $this->M_ServiceDetail->getNextSequenceId());
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

		}
	}

	public function updateData() {
		$this->load->model("M_ServiceDetail");
	
		if ($this->session->userdata('akses') == '1') {

			$service_code = $this->input->post('service_code');
			$service_name = $this->input->post('service_name');
			$service_desc = $this->input->post('service_desc');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$this->M_ServiceDetail->updateData($service_code, $service_name, $service_desc, $active_status);

			redirect('Controller_Service');
		}
	}
}