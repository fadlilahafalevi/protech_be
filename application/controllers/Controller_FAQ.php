<?php
class Controller_FAQ extends CI_Controller{
	function index(){
        $this->load->model('M_FAQ');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_FAQ->getAllFAQ();
			$this->load->view('admin/faq',$data);
		} else if($this->session->userdata('akses')=='2' || $this->session->userdata('akses')=='3'){
			$data['data']=$this->M_FAQ->getAllFAQ();
			$this->load->view('customer/faq',$data);
		} else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($code='') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_FAQ");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_FAQ->getOneById($code);
			}

			$this->load->view('admin/faq_view', $data);

		}
	}

	public function createFAQ() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/faq_create');

		}
	}

	public function updateFAQ($code = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_FAQ");

			$data['code'] = $code;
			if (isset($code)) {
				$listData = $this->M_FAQ->getOneById($code);
				$data['data'] = $listData;
			}

			$this->load->view('admin/faq_edit', $data);

		}
	}

	public function saveData() {
		$this->load->model("M_FAQ");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$faq_code = $this->M_General->getSequence('tbl_faq', 3, 'F');
			$faq_question = $this->input->post('faq_question');
			$faq_answer = $this->input->post('faq_answer');

			$data = [ 'faq_code' => $faq_code,
				'faq_question' => $faq_question,
				'faq_answer' => $faq_answer,
			];

			$this->M_General->insertData('tbl_faq', $data);
			$this->M_Metadata->createMeta('tbl_faq', 'faq_code', $faq_code, $this->session->userdata('code'));
			$this->R_AuditLogging->insertLog('FAQ', 'CREATE', $this->session->userdata('code'));

			redirect('Controller_FAQ');
		}
	}

	public function updateData() {
		$this->load->model("M_FAQ");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
		$this->load->model("M_General");
	
		if ($this->session->userdata('akses') == '1') {

			$faq_code = $this->input->post('faq_code');
			$faq_question = $this->input->post('faq_question');
			$faq_answer = $this->input->post('faq_answer');

			$data = ['faq_question' => $faq_question,
				'faq_answer' => $faq_answer
			];

			$this->M_General->updateData('tbl_faq', $data, 'faq_code', $faq_code);
			$this->M_Metadata->updateMeta('tbl_faq', 'faq_code', $faq_code,  $this->session->userdata('code'));
			$this->R_AuditLogging->insertLog('FAQ', 'UPDATE', $this->session->userdata('code'));
			redirect('Controller_FAQ');
		}
	}
}