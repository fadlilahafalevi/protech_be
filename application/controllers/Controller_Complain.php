<?php
class Controller_Complain extends CI_Controller{
	function index(){
        $this->load->model('M_Complain');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list']=$this->M_Complain->getAllComplain();
			$this->load->view('admin/complain',$data);
		}else if($this->session->userdata('akses')=='4'){
			$data['list']=$this->M_Complain->getComplainDetailByUserCode($this->session->userdata('user_code'));
			$this->load->view('customer/complain',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function getOne($code='') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_Complain");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_Complain->getComplainDetailByCode($code);
			}

			$this->load->view('admin/complain_view', $data);

		}
	}

	function createComplain() {
		if($this->session->userdata('akses') == '4'){
			$this->load->model("M_General");
			
			$data['complain_code'] = $this->M_General->getSequence('tbl_complain', 3, 'P');
			$this->load->view('admin/complain_create', $data);
		}
	}

	function updateComplain($code = '') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_Complain");

			$data['complain_code'] = $code;
			if (isset($code)) {
				$listData = $this->M_Complain->getComplainDetailByCode($code);
				$data['data'] = $listData;
			}

			$this->load->view('admin/complain_edit', $data);

		}
	}

	function saveData() {
		$this->load->model("M_Complain");
		$this->load->model("M_General");

		if ($this->session->userdata('akses') == '4') {

			$complain_code = $this->input->post('complain_code');
			$order_code = $this->input->post('order_code');
			$subject = $this->input->post('subject');
			$complain_desc = $this->input->post('complain_desc');
			$response = $this->input->post('response');
			$complain_status = "MENUNGGU";
			$now = date("Y-m-d H:i:s");

			$data_complain = [ 'complain_code' => $complain_code,
				'order_code'  => $order_code,
				'subject' => $subject,
				'complain_desc' => $complain_desc,
				'response' => $response,
				'complain_status' => $complain_status,
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_complain', $data_complain);

			redirect('Controller_Complain');
		}
	}

	function updateData() {
		$this->load->model("M_Complain");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {

			$complain_code = $this->M_General->getSequence('tbl_complain', 3, 'C');
			$order_code = $this->input->post('order_code');
			$subject = $this->input->post('subject');
			$complain_desc = $this->input->post('complain_desc');
			$response = $this->input->post('response');
			$complain_status = $this->input->post('complain_status');

			$data_complain = [ 'complain_code' => $complain_code,
				'order_code'  => $order_code,
				'subject' => $subject,
				'complain_desc' => $complain_desc,
				'response' => $response,
				'complain_status' => $complain_status
			];

			$this->M_General->updateData('tbl_complain', $data_complain, 'complain_code', $complain_code);
			$this->M_General->updateMeta('tbl_complain', 'complain_code', $complain_code,  $this->session->userdata('user_name'));

			redirect('Controller_Complain');
		}
	}
}