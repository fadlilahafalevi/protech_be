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
				$data['instalasi_pengecekan'] = $this->M_ServiceCategory->get_instalasi_pengecekan($code);
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
				$data['instalasi_pengecekan'] = $this->M_ServiceCategory->get_instalasi_pengecekan($code);
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
			$nama_instalasi 	=	$this->input->post('nama_instalasi');
			$harga_instalasi 	=	$this->input->post('harga_instalasi');
			$nama_pengecekan 	=	$this->input->post('nama_pengecekan');
			$harga_pengecekan 	=	$this->input->post('harga_pengecekan');

			$active_status = '1';
			$now = date("Y-m-d H:i:s");

			$data_service_category = [ 'service_category_code' => $service_category_code,
				'service_category_name'  => $service_category_name,
				'active_status' => $active_status,
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_service_category', $data_service_category);

			$data_instalasi = [
				'service_type_code' => $this->M_General->getSequence('tbl_service_type', 3, 'J'),
				'service_type_name' => $nama_instalasi,
				'service_type_desc' => $nama_instalasi,
				'service_category_code' => $service_category_code,
				'price' => $harga_instalasi,
				'unit' => 'unit',
				'type' => 'INSTALASI',
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_service_type', $data_instalasi);

			$data_pengecekan = [
				'service_type_code' => $this->M_General->getSequence('tbl_service_type', 3, 'J'),
				'service_type_name' => $nama_pengecekan,
				'service_type_desc' => $nama_pengecekan,
				'service_category_code' => $service_category_code,
				'price' => $harga_pengecekan,
				'unit' => 'unit',
				'type' => 'REPARASI',
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_service_type', $data_pengecekan);

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

			$code_instalasi = $this->input->post('code_instalasi');
			$harga_instalasi = $this->input->post('harga_instalasi');
			$code_pengecekan = $this->input->post('code_pengecekan');
			$harga_pengecekan =	$this->input->post('harga_pengecekan');
			$now = date("Y-m-d H:i:s");

			if (isset($_POST['active_status'])) {
				$active_status = 1;
			}

			$data_service_category = [ 'service_category_code' => $service_category_code,
				'service_category_name'  => $service_category_name,
				'active_status' => $active_status
			];

			$this->M_General->updateData('tbl_service_category', $data_service_category, 'service_category_code', $service_category_code);
			$this->M_General->updateMeta('tbl_service_category', 'service_category_code', $service_category_code,  $this->session->userdata('user_name'));

			if (!($code_instalasi == '')) {
				$data_instalasi = [
					'price' => $harga_instalasi,
					'modified_by' => $this->session->userdata('user_name'),
					'modified_datetime' => $now
				];
				$this->M_General->updateData('tbl_service_type', $data_instalasi, 'service_type_code', $code_instalasi);
			} else {
				$data_instalasi = [
				'service_type_code' => $this->M_General->getSequence('tbl_service_type', 3, 'J'),
				'service_type_name' => 'Instalasi',
				'service_type_desc' => 'Instalasi',
				'service_category_code' => $service_category_code,
				'price' => $harga_instalasi,
				'unit' => 'unit',
				'type' => 'INSTALASI',
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
				];

				$this->M_General->insertData('tbl_service_type', $data_instalasi);
			}

			if (!($code_instalasi == '')) {
				$data_pengecekan = [
					'price' => $harga_pengecekan,
					'modified_by' => $this->session->userdata('user_name'),
					'modified_datetime' => $now
				];
				$this->M_General->updateData('tbl_service_type', $data_pengecekan, 'service_type_code', $code_pengecekan);
			} else {
				$data_pengecekan = [
				'service_type_code' => $this->M_General->getSequence('tbl_service_type', 3, 'J'),
				'service_type_name' => 'Pengecekan',
				'service_type_desc' => 'Pengecekan',
				'service_category_code' => $service_category_code,
				'price' => $harga_pengecekan,
				'unit' => 'unit',
				'type' => 'REPARASI',
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
				];

				$this->M_General->insertData('tbl_service_type', $data_pengecekan);
			}

			redirect('Controller_ServiceCategory');
		}
	}

	function printServiceCategory() {
		$this->load->library('ReportHeaderLandscape');
        $this->load->model("M_ServiceCategory");
        $this->load->helper('download');
        
        // $order_history = $this->M_Order->getAll($from, $to);
        $service_category = $this->M_ServiceCategory->getAllServiceCategory();

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf = $this->reportheaderlandscape->getInstance($from, $to);

        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'Data Kategori Layanan', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 8);
		$pdf->SetX(110);

        $pdf->Cell(10, 7, 'No', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Kode Kategori Layanan', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Nama Kategori Layanan', 1, 0, 'C');
        $pdf->Cell(25, 7, 'Status', 1, 1, 'C',);

        $pdf->SetWidths(Array(10,50,50,25));
        $pdf->SetLineHeight(5);

        $pdf->SetFont('Arial', '', 8);
        $no = 1;
        foreach ($service_category as $data) {
			$pdf->SetX(110);
        	if ($data->active_status == 1) {
        		$status = 'Aktif';
        	} else {
        		$status = 'Tidak Aktif';
        	}

            $pdf->Row(Array(
            	$no,
            	$data->service_category_code,
            	$data->service_category_name,
            	$status
            ));
            $no ++;
        }
        
        $filename = 'list_data_kategori_layanan'.date("Ymdhis").'.pdf';
        
        $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');
        force_download('./assets/downloaded-pdf/'.$filename,NULL);
	}
}