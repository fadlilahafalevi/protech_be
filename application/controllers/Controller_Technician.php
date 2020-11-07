<?php
class Controller_Technician extends CI_Controller{
	function index(){
        $this->load->model('M_Technician');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_Technician->getAllTechnician();
			$this->load->view('admin/technician',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($id='') {
		if($this->session->userdata('akses')=='1'){

			$this->load->model("M_Technician");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->M_Technician->getOneById($id);
			}

			$this->load->view('admin/technician_view', $data);

		}
	}
}