<?php
class Controller_ServiceType extends CI_Controller{
	function index(){
        $this->load->model('M_ServiceType');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list']=$this->M_ServiceType->getAllServiceType();
			$this->load->view('admin/service_type',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function getOne($code = '') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_ServiceType");
			$this->load->model("M_ServiceCategory");

			$data['code'] = $code;
			if (isset($code)) {
				$data['data'] = $this->M_ServiceType->getServiceTypeDetailByCode($code);
				$data['list_service_category'] = $this->M_ServiceCategory->getAllServiceCategory();
			}

			$this->load->view('admin/service_type_view', $data);

		}
	}

	public function createServiceType() {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$this->load->model("M_General");
			$this->load->model("M_ServiceCategory");

			$data['service_type_code'] = $this->M_General->getSequence('tbl_service_type', 3, 'J');
			$data['list_service_category'] = $this->M_ServiceCategory->getAllServiceCategory();
			$this->load->view('admin/service_type_create', $data);

		}
	}

	public function updateServiceType($code = '') {
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){

			$this->load->model("M_ServiceType");
			$this->load->model("M_ServiceCategory");

			$data['code'] = $code;
			if (isset($code)) {
				$listData = $this->M_ServiceType->getServiceTypeDetailByCode($code);
				$data['list_service_category'] = $this->M_ServiceCategory->getAllServiceCategory();
				$data['data'] = $listData;
				
				foreach ($listData as $field) {
					$active_status = $field->active_status;
					if ($active_status == 1) {
						$data['checked'] = "checked";
					}
				}
			}

			$this->load->view('admin/service_type_edit', $data);

		}
	}

	public function saveData() {
		$this->load->model("M_General");
		$this->load->model("M_ServiceType");
	
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {

			$service_type_code 	=	$this->input->post('service_type_code');
			$service_type_name 	=	$this->input->post('service_type_name');
			$service_type_desc 	=	$this->input->post('service_type_desc');
			$service_category_code 	=	$this->input->post('service_category_code');
			$price 	=	$this->input->post('price');
			$unit 	=	$this->input->post('unit');
			$type 	=	$this->input->post('type');
			$active_status = '1';
			$now = date("Y-m-d H:i:s");
			
			$data_service_type = [ 'service_type_code' => $service_type_code,
				'service_type_name'  => $service_type_name,
				'service_type_desc' => $service_type_desc,
				'service_category_code' => $service_category_code,
				'price' => $price,
				'unit' => $unit,
				'type' => $type,
				'active_status' => $active_status,
				'created_by' => $this->session->userdata('user_name'),
				'created_datetime' => $now
			];

			$this->M_General->insertData('tbl_service_type', $data_service_type);

			redirect('Controller_ServiceType');
		}
	}

	public function updateData() {
		$this->load->model("M_General");
		$this->load->model("M_ServiceType");
	
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {

			$service_type_code = $this->input->post('service_type_code');
			$service_type_name 	=	$this->input->post('service_type_name');
			$service_type_desc 	=	$this->input->post('service_type_desc');
			$service_category_code 	=	$this->input->post('service_category_code');
			$price 	=	$this->input->post('price');
			$unit 	=	$this->input->post('unit');
			$type 	=	$this->input->post('type');
			$active_status = 0;

			if (isset($_POST['active_status'])) {
				$active_status = 1;
			}

			$data_service_type = [ 'service_type_code' => $service_type_code,
				'service_type_name'  => $service_type_name,
				'service_type_desc'  => $service_type_desc,
				'service_category_code'  => $service_category_code,
				'price'  => $price,
				'unit'  => $unit,
				'type'  => $type,
				'active_status' => $active_status
			];

			$this->M_General->updateData('tbl_service_type', $data_service_type, 'service_type_code', $service_type_code);
			$this->M_General->updateMeta('tbl_service_type', 'service_type_code', $service_type_code,  $this->session->userdata('user_name'));

			redirect('Controller_ServiceType');
		}
	}

	function printServiceType() {
		$this->load->library('ReportHeaderLandscape');
        $this->load->model("M_ServiceType");
        $this->load->helper('download');
        
        // $order_history = $this->M_Order->getAll($from, $to);
        $service_type = $this->M_ServiceType->getAllServiceType();

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf = $this->reportheaderlandscape->getInstance($from, $to);

        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'Data Jenis Layanan', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(30);

        $pdf->Cell(5, 7, 'No', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Kode Jenis Layanan', 1, 0, 'C');
        $pdf->Cell(70, 7, 'Nama Jenis Layanan', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Kategori Layanan', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Harga', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Tipe', 1, 0, 'C');
        $pdf->Cell(25, 7, 'Status', 1, 1, 'C',);

        $pdf->SetWidths(Array(5,40,70,50,50,50,25));
        $pdf->SetLineHeight(5);

        $pdf->SetFont('Arial', '', 8);
        $no = 1;
        foreach ($service_type as $data) {
        	$pdf->SetX(30);

        	if ($data->service_type_status == 1) {
        		$status = 'Aktif';
        	} else {
        		$status = 'Tidak Aktif';
        	}

            $pdf->Row(Array(
            	$no,
            	$data->service_type_code,
            	$data->service_type_name,
            	$data->service_category_name,
            	'Rp '.number_format($data->price,2,',','.'),
            	$data->type,
            	$status
            ));
            $no ++;
        }
        
        $filename = 'list_data_jenis_layanan'.date("Ymdhis").'.pdf';
        
        $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');
        force_download('./assets/downloaded-pdf/'.$filename,NULL);
	}
}