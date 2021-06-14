<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/pdf_mc_table.php');

class ReportHeaderLandscape extends PDF_MC_Table {
    
    private $from;
    private $to;

    function __construct($orientation='L', $unit='mm', $size='legal')
    {
        parent::__construct($orientation,$unit,$size);
    }
    
    function Header() {
        // Logo
        $this->Image(FCPATH.'assets\\images\\logo.png', 135, 3, 80);

        // Arial bold 15
        $this->SetFont('Arial', '', 8);
        // Move to the right
        date_default_timezone_set("Asia/Bangkok");
        // $this->Cell(50, 5, 'Date : ' . date("Y/m/d h:i:sa"), 0, 1, 'L');
        // $this->Cell(50, 5, 'From : ' . $this->from . ' To : ' . $this->to, 0, 0, 'L');
        // Line break
        $this->Ln(20);
        $this->Line(5, 25, 350, 25);
    }


    function Footer() {
        date_default_timezone_set("Asia/Bangkok");
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,1,'C');
        //cetak tanggal
        $this->Cell(280,10,'',0,0,'C');
        $this->Cell(100,10, 'Dicetak tanggal : ' . date("d F Y H:i:s"), 0, 1, 'L');
    }

    public function getInstance($from = '', $to = '') {
        $invoice_header = new ReportHeaderLandscape();
        $invoice_header->setFrom($from);
        $invoice_header->setTo($to);
        return $invoice_header;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

}
?>