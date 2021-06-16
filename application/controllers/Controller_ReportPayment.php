<?php
class Controller_ReportPayment extends CI_Controller{
	function index(){
        $this->load->model('M_ReportPayment');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
			$data['list']=$this->M_ReportPayment->getAllReportPayment($from_date, $to_date);
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
			$this->load->view('admin/report_payment',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

    public function payment_admin_action($order_code, $action) {
        $this->load->model("M_General");
        if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
            if ($action = 'TERIMA') {
                $data_payment = [
                        'payment_status' => 'LUNAS',
                        'modified_by' => $this->session->userdata('user_name'),
                        'modified_datetime' => date("Y-m-d H:i:s")
                    ];

                $this->M_General->updateData('tbl_payment', $data_payment, 'order_code', $order_code);

                $data = [
                        'order_status' => 'SELESAI',
                        'modified_by' => $this->session->userdata('user_name'),
                        'modified_datetime' => date("Y-m-d H:i:s")
                    ];

                $this->M_General->updateData('tbl_order', $data, 'order_code', $order_code);
            } else if ($action = 'TOLAK') {
                $data = [
                        'payment_status' => 'DITOLAK',
                        'modified_by' => $this->session->userdata('user_name'),
                        'modified_datetime' => date("Y-m-d H:i:s")
                    ];

                $this->M_General->updateData('tbl_payment', $data, 'order_code', $order_code);
            }
            redirect('Controller_ReportPayment');
        }
    }

	function printReportPayment($from_date = '', $to_date = '') {
		$this->load->library('ReportHeaderLandscape');
        $this->load->model("M_ReportPayment");
        $this->load->helper('download');
        
        // $order_history = $this->M_Order->getAll($from, $to);
        $payment = $this->M_ReportPayment->getAllReportPayment($from_date, $to_date);

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf = $this->reportheaderlandscape->getInstance($from_date, $to_date);

        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'Data Pembayaran', 0, 1, 'C');

        if ($from_date != '' and $to_date != '') {
            setlocale(LC_ALL, 'IND');
            $from_date_new = strftime( "%d %B %Y", DateTime::createFromFormat('Y-m-d', $from_date)->getTimestamp());
            $to_date_new = strftime( "%d %B %Y", DateTime::createFromFormat('Y-m-d', $to_date)->getTimestamp());

            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(0, 7, $from_date_new.' Sampai '.$to_date_new, 0, 1, 'C');
        }

        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(18);

        $pdf->Cell(5, 7, 'No', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Kode Pesanan', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Metode Pembayaran', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Tanggal Pembayaran', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Total Pembayaran', 1, 0, 'C');
        $pdf->Cell(70, 7, 'Teknisi', 1, 0, 'C');
        $pdf->Cell(70, 7, 'Pelanggan', 1, 0, 'C',);
        $pdf->Cell(30, 7, 'Status', 1, 1, 'C',);

        $pdf->SetWidths(Array(5,30,40,40,30,70,70,30));
        $pdf->SetLineHeight(5);

        $pdf->SetFont('Arial', '', 8);
        $no = 1;
        foreach ($payment as $data) {
        	$pdf->SetX(18);

        	if (is_null($data->payment_date)) {
        		$status = 'Menunggu Pembayaran';
        	} else {
        		$status = 'Lunas';
        	}
            $pdf->Row(Array(
            	$no,
            	$data->order_code,
            	$data->payment_method,
            	$data->payment_date,
            	$data->total_payment,
            	$data->technician_name,
            	$data->customer_name,
            	$status
            ));
            $no ++;
        }
        
        $filename = 'list_data_pembayaran_'.date("Ymdhis").'.pdf';
        
        $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');
        force_download('./assets/downloaded-pdf/'.$filename,NULL);
	}
}