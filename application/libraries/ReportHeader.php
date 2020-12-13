<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf181/fpdf.php');

class ReportHeader extends FPDF {
    
    function Header() {
        // Logo
        $this->Image('S:/Program Files/xampp/htdocs/protech/assets/images/logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Title',1,0,'C');
        // Line break
        $this->Ln(20);
    }
    
    public function getInstance(){
        return new ReportHeader();
    }
}
?>