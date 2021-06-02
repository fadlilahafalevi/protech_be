<?php
class Controller_Complain extends CI_Controller{
	function index(){
        $this->load->model('M_Complain');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$data['list']=$this->M_Complain->getAllComplain($from_date, $to_date);
			$data['from_date'] = $from_date;
			$data['to_date'] = $to_date;
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

	function printComplain($from_date = '', $to_date = '') {
		$this->load->library('ReportHeaderLandscape');
        $this->load->model("M_Complain");
        $this->load->helper('download');
        
        // $order_history = $this->M_Order->getAll($from, $to);
        $complain = $this->M_Complain->getAllComplain($from_date, $to_date);

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf = $this->reportheaderlandscape->getInstance($from_date, $to_date);

        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetFont('Courier', 'B', 16);
        $pdf->Cell(0, 7, 'Data Pengaduan', 0, 1, 'C');

		if ($from_date != '' and $to_date != '') {
            setlocale(LC_ALL, 'IND');
            $from_date_new = strftime( "%d %B %Y", DateTime::createFromFormat('Y-m-d', $from_date)->getTimestamp());
            $to_date_new = strftime( "%d %B %Y", DateTime::createFromFormat('Y-m-d', $to_date)->getTimestamp());

            $pdf->SetFont('Courier', '', 8);
            $pdf->Cell(0, 7, $from_date_new.' Sampai '.$to_date_new, 0, 1, 'C');
        }

        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Courier', 'B', 8);
        $pdf->SetX(30);

        $pdf->Cell(5, 7, 'No', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Kode Pengaduan', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Kode Pesanan', 1, 0, 'C');
        $pdf->Cell(70, 7, 'Judul Pengaduan', 1, 0, 'C');
        $pdf->Cell(120, 7, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(25, 7, 'Status', 1, 1, 'C',);

        $pdf->SetWidths(Array(5,40,40,70,120,25));
        $pdf->SetLineHeight(5);

        $pdf->SetFont('Courier', '', 8);
        $no = 1;
        foreach ($complain as $data) {
        	$pdf->SetX(30);

            $pdf->Row(Array(
            	$no,
            	$data->complain_code,
            	$data->order_code,
            	$data->subject,
            	$data->complain_desc,
            	$data->complain_status
            ));
            $no ++;
        }
        
        $filename = 'list_data_pengaduan'.date("Ymdhis").'.pdf';
        
        $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');
        force_download('./assets/downloaded-pdf/'.$filename,NULL);
	}
}