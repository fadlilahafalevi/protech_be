<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf181/fpdf.php');

class ReportHeader extends FPDF {
    
    private $order_code;
    
    function Header() {
        // Logo
        //$this->Image('S:/Program Files/xampp/htdocs/protech/assets/images/logo.png', 120, 3, 80);
        $this->Image('E:/xampp/htdocs/protech/assets/images/logo.png', 120, 3, 80);
        // Arial bold 15
        $this->SetFont('Courier', '', 8);
        // Move to the right
        $this->Cell(50, 5, $this->order_code, 0, 1, 'L');
        date_default_timezone_set("Asia/Bangkok");
        $this->Cell(50, 5, 'Date : '.date("Y/m/d h:i:sa"), 0, 0, 'L');
        // Line break
        $this->Ln(20);
        $this->Line(10, 25, 200, 25);
    }
    
    function Footer() {
        //buat garis horizontal
            //$this->Image('S:/Program Files/xampp/htdocs/protech/assets/images/paid.png', 120, 200, 80);
            $this->Image('E:/xampp/htdocs/protech/assets/images/paid.png', 120, 200, 80);
    }

    public function getInstance($order_code = '') {
        $invoice_header = new ReportHeader();
        if ($this->order_code != '') {
            $invoice_header->set_order_code('Order Code : #'.$order_code);
        }
        return $invoice_header;
    }
    
    public function set_order_code($order_code) {
        $this->order_code = $order_code;
    }
}
?>