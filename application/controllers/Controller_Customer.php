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
}