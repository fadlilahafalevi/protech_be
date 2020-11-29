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

	public function getOne($id='') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_FAQ");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_FAQ->getOneById($id);
			}

			$this->load->view('admin/faq_view', $data);

		}
	}

	public function createFAQ() {
		if($this->session->userdata('akses')=='1'){

			$this->load->view('admin/faq_create');

		}
	}

	public function updateFAQ($id = '') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_FAQ");

			$data['id'] = $id;
			if (isset($id)) {
				$listData = $this->M_FAQ->getOneById($id);
				$data['data'] = $listData;
			}

			$this->load->view('admin/faq_edit', $data);

		}
	}

	public function deleteFAQ($id='') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_FAQ");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_FAQ->getOneById($id);
			}

			$this->load->view('admin/faq_delete', $data);

		}
	}

	public function saveData() {
		$this->load->model("M_FAQ");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$faq_question = $this->input->post('faq_question');
			$faq_answer = $this->input->post('faq_answer');
			$created_by = $this->session->userdata('fullname');
			$this->M_FAQ->inputData($faq_question, $faq_answer, $created_by);
			$idData = $this->M_FAQ->getOneByQuestion($faq_question);
			$this->M_Metadata->createMeta('tbl_faq', $idData, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('FAQ', 'CREATE', $this->session->userdata('code'));

			redirect('Controller_FAQ');
		}
	}

	public function updateData() {
		$this->load->model("M_FAQ");
		$this->load->model("M_Metadata");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$id = $this->input->post('id');
			$faq_question = $this->input->post('faq_question');
			$faq_answer = $this->input->post('faq_answer');
			$modified_by = $this->session->userdata('fullname');

			$this->M_FAQ->updateData($id, $faq_question, $faq_answer, $modified_by);
			$this->M_Metadata->updateMeta('tbl_faq', $id, $this->session->userdata('fullname'));
			$this->R_AuditLogging->insertLog('FAQ', 'UPDATE', $this->session->userdata('code'));
			redirect('Controller_FAQ');
		}
	}

	public function deleteData() {
		$this->load->model("M_FAQ");
		$this->load->model("R_AuditLogging");
	
		if ($this->session->userdata('akses') == '1') {

			$id = $this->input->post('id');

			$this->M_FAQ->deleteData($id);
			$this->R_AuditLogging->insertLog('FAQ', 'DELETE', $this->session->userdata('code'));
			redirect('Controller_FAQ');
		}
	}
}