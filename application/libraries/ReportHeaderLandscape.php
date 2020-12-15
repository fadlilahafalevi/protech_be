<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf181/fpdf.php');

class ReportHeaderLandscape extends FPDF {
    
    private $from;
    private $to;

    function __construct($orientation='L', $unit='mm', $size='A4')
    {
        parent::__construct($orientation,$unit,$size);
    }
    
    function Header() {
            // Logo
        $this->Image('S:/Program Files/xampp/htdocs/protech/assets/images/logo.png', 200, 3, 80);
        // Arial bold 15
        $this->SetFont('Courier', '', 8);
        // Move to the right
        date_default_timezone_set("Asia/Bangkok");
        $this->Cell(50, 5, 'Date : ' . date("Y/m/d h:i:sa"), 0, 1, 'L');
        $this->Cell(50, 5, 'From : ' . $this->from . ' To : ' . $this->to, 0, 0, 'L');
        // Line break
        $this->Ln(20);
        $this->Line(10, 25, 285, 25);
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