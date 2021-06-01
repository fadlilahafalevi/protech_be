<?php
class Controller_ReportOrder extends CI_Controller{
	function index(){
        $this->load->model('M_ReportOrder');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
			$data['list']=$this->M_ReportOrder->getAllReportOrder($from_date, $to_date);
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
			$this->load->view('admin/report_order',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function printReportOrder($from_date = '', $to_date = '') {
		$this->load->library('ReportHeaderLandscape');
        $this->load->model("M_ReportOrder");
        $this->load->helper('download');
        
        // $order_history = $this->M_Order->getAll($from, $to);
        $order = $this->M_ReportOrder->getAllReportOrder($from_date, $to_date);

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf = $this->reportheaderlandscape->getInstance($from_date, $to_date);

        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetFont('Courier', 'B', 16);
        $pdf->Cell(0, 7, 'Data Pemesanan', 0, 1, 'C');

        if ($from_date != '' and $to_date != '') {
            setlocale(LC_ALL, 'IND');
            $from_date_new = strftime( "%d %B %Y", DateTime::createFromFormat('Y-m-d', $from_date)->getTimestamp());
            $to_date_new = strftime( "%d %B %Y", DateTime::createFromFormat('Y-m-d', $to_date)->getTimestamp());

            $pdf->SetFont('Courier', '', 8);
            $pdf->Cell(0, 7, $from_date_new.' Sampai '.$to_date_new, 0, 1, 'C');
        }

        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Courier', 'B', 8);
        $pdf->SetX(20);

        $pdf->Cell(5, 7, 'No', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Kode Pesanan', 1, 0, 'C');
        $pdf->Cell(70, 7, 'Nama Teknisi', 1, 0, 'C');
        $pdf->Cell(70, 7, 'Nama Pelanggan', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Kategori Layanan', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Waktu Perbaikan', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Status', 1, 1, 'C',);

        $pdf->SetWidths(Array(5,30,70,70,50,50,40));
        $pdf->SetLineHeight(5);

        $pdf->SetFont('Courier', '', 8);
        $no = 1;
        foreach ($order as $data) {
        	$pdf->SetX(20);

            $pdf->Row(Array(
            	$no,
            	$data->order_code,
            	$data->technician_name,
            	$data->customer_name,
            	$data->service_category_name,
            	$data->repair_datetime,
            	$data->order_status
            ));
            $no ++;
        }
        
        $filename = 'list_data_pemesanan_'.date("Ymdhis").'.pdf';
        
        $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');
        force_download('./assets/downloaded-pdf/'.$filename,NULL);
	}
}