<?php
class Controller_ReportPayment extends CI_Controller{
	function index(){
        $this->load->model('M_ReportPayment');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list']=$this->M_ReportPayment->getAllReportPayment();
			$this->load->view('admin/report_payment',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function printReportPayment() {
		$this->load->library('ReportHeaderLandscape');
        $this->load->model("M_ReportPayment");
        $this->load->helper('download');
        
        // $order_history = $this->M_Order->getAll($from, $to);
        $payment = $this->M_ReportPayment->getAllReportPayment();

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf = $this->reportheaderlandscape->getInstance($from, $to);

        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetFont('Courier', 'B', 16);
        $pdf->Cell(0, 7, 'Data Pembayaran', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Courier', 'B', 8);
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

        $pdf->SetFont('Courier', '', 8);
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