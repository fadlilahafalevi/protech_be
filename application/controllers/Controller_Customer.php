<?php
class Controller_Customer extends CI_Controller{
	function index(){
        $this->load->model('M_Customer');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_Customer->getAllCustomer();
			$this->load->view('admin/customer',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($id='') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Customer");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_Customer->getOneById($id);
			}

			$this->load->view('admin/customer_view', $data);

		}
	}

	public function updateCustomer($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Customer");

			$data['id'] = $id;
			if (isset($id)) {
				$listData = $this->M_Customer->getOneById($id);
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

	public function updateData() {
		$this->load->model("M_Customer");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$id = $this->input->post('id');
			$email = $this->input->post('email');
			$fullname = $this->input->post('fullname');
			$phone = $this->input->post('phone');
			$full_address = $this->input->post('full_address');
			$active_status = $this->input->post('active_status');

			if ($active_status != 1) {
				$active_status = 0;
			}

			$this->M_Customer->updateData($id, $email, $fullname, $phone, $full_address, $active_status);
			$this->M_Metadata->updateMeta('tbl_customer', $id, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('ADMIN', 'UPDATE', $this->session->userdata('email'));
			redirect('Controller_Customer');
		}
	}
}