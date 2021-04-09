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
}