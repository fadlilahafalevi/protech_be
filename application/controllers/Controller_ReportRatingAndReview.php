<?php
class Controller_ReportRatingAndReview extends CI_Controller{
	function index(){
        $this->load->model('M_ReportRatingAndReview');
        
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){
			$data['list']=$this->M_ReportRatingAndReview->getAllReportRatingAndReview();
			$this->load->view('admin/report_ratingandreview',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function printReportRatingAndReview() {
		$this->load->library('ReportHeaderLandscape');
        $this->load->model("M_ReportRatingAndReview");
        $this->load->helper('download');
        
        // $order_history = $this->M_Order->getAll($from, $to);
        $ratingReview = $this->M_ReportRatingAndReview->getAllReportRatingAndReview();

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf = $this->reportheaderlandscape->getInstance($from, $to);

        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetFont('Courier', 'B', 16);
        $pdf->Cell(0, 7, 'Data Penilaian Dan Ulasan', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Courier', 'B', 8);
        $pdf->SetX(45);

        $pdf->Cell(5, 7, 'No', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Kode Pesanan', 1, 0, 'C');
        $pdf->Cell(70, 7, 'Nama Teknisi', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Kategori Layanan', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Waktu Perbaikan', 1, 0, 'C');
        $pdf->Cell(15, 7, 'Nilai', 1, 0, 'C');
        $pdf->Cell(70, 7, 'Ulasan', 1, 1, 'C',);

        $pdf->SetWidths(Array(5,30,70,40,40,15,70));
        $pdf->SetLineHeight(5);

        $pdf->SetFont('Courier', '', 8);
        $no = 1;
        foreach ($ratingReview as $data) {
        	$pdf->SetX(45);

            $pdf->Row(Array(
            	$no,
            	$data->order_code,
            	$data->technician_name,
            	$data->service_category_name,
            	$data->repair_datetime,
            	$data->rate,
            	$data->review
            ));
            $no ++;
        }
        
        $filename = 'list_data_penilaian_dan_ulasan_'.date("Ymdhis").'.pdf';
        
        $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');
        force_download('./assets/downloaded-pdf/'.$filename,NULL);
	}
}