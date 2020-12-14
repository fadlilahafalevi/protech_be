<?php
class Controller_Wallet extends CI_Controller{
	function index(){
        $this->load->model('T_Wallet');

        if ($this->session->userdata('akses') == '1') {
            $data['data'] = $this->T_Wallet->getAllNonProcessedTransaction();
            $this->load->view('admin/transaction_confirmation', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
	}
	
	public function downloadTransactionHistory() {
	    if($this->session->userdata('akses')=='1'){
	        $this->load->library('ReportHeader');
	        $this->load->model("M_Order");
	        $this->load->library('pdf');
	        $this->load->helper('download');
	        
	        $transaction_history = $this->T_Wallet->getAllTransaction();
	        
	        $pdf = new FPDF('L', 'mm', 'Letter');
	        $pdf = $this->reportheader->getInstance();
	        
	        $pdf->AddPage();
	        
	        $pdf->SetFont('Arial', 'B', 16);
	        $pdf->Cell(0, 7, 'Order History', 0, 1, 'C');
	        $pdf->Cell(10, 7, '', 0, 1);
	        
	        $pdf->SetFont('Arial', 'B', 10);
	        
	        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
	        $pdf->Cell(30, 6, 'Transaction Datetime', 1, 0, 'C');
	        $pdf->Cell(40, 6, 'Transaction Type', 1, 0, 'C');
	        $pdf->Cell(50, 6, 'From', 1, 0, 'C');
	        $pdf->Cell(50, 6, 'To', 1, 0, 'C');
	        $pdf->Cell(35, 6, 'Amount', 1, 0, 'C');
	        
	        $pdf->SetFont('Arial', '', 10);
	        $no = 1;
	        foreach ($transaction_history as $data) {
	            $pdf->Cell(8, 6, $no, 1, 0);
	            $pdf->Cell(30, 6, $data->order_code, 1, 0);
	            $pdf->Cell(40, 6, $data->created_datetime, 1, 0);
	            $pdf->Cell(50, 6, $data->customer_name, 1, 0);
	            $pdf->Cell(50, 6, $data->technician_name, 1, 0);
	            $pdf->Cell(35, 6, $data->service, 1, 0);
	            $pdf->Cell(30, 6, $data->order_status, 1, 1);
	            $no ++;
	        }
	        
	        $filename = 'transaction_history_report_'.date("Ymdhis").'.pdf';
	        
	        $pdf->Output('S:/Program Files/xampp/htdocs/protech/assets/downloaded-pdf/'.$filename,'F');
	        force_download('./assets/downloaded-pdf/'.$filename,NULL);
	    }
	}
	
	public function transactionHistory() {
        $this->load->model('T_Wallet');
        if ($this->session->userdata('akses') == '1') {
            $data['data'] = $this->T_Wallet->getAllTransaction();
            $this->load->view('admin/transaction_history', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

	public function insertTransaction() {
        if ($this->session->userdata('akses') == '3') {

            $this->load->model("M_General");
            $this->load->model("T_Wallet");
            $this->load->model("M_Customer");

            $phone = $this->input->post('phone');
            $amount = $this->input->post('amount');
            $txn_code = $this->input->post('txn_code');
            $is_processed = $this->input->post('is_processed');
            $order_code = $this->input->post('order_code');
            $bank_name = $this->input->post('bank_name');
            $account_number = $this->input->post('account_number');
            $account_name = $this->input->post('account_name');
            $data_insert = [];
            if (isset($phone)) {
                if ($txn_code == 'TOPU') {
                    $data_insert = [
                        'to_phone' => $phone,
                        'txn_amount' => $amount,
                        'txn_code' => $txn_code,
                        'is_processed' => $is_processed
                    ];
                } else if ($txn_code == 'WDRW') {
                    $data_insert = [
                        'from_phone' => $phone,
                        'txn_amount' => $amount,
                        'txn_code' => $txn_code,
                        'is_processed' => $is_processed,
                        'bank_name' => $bank_name,
                        'account_number' => $account_number,
                        'account_name' => $account_name
                    ];
                }
            }

            if (isset($order_code)) {
                $data_insert['order_code'] = $order_code;
            }

            $insertId = $this->M_General->insertData('tbl_transaction_history', $data_insert);

            $data['insertedData'] = $this->T_Wallet->getTransactionHistoryById($insertId);
            $data['phone'] = $phone;
            if ($txn_code == 'TOPU') {
                $this->load->view('customer/upload_receipt_topup', $data);
            } else if ($txn_code == 'WDRW') {
                $current_debit = $this->T_Wallet->getCurrentDebit($phone);
                $balance = $this->T_Wallet->getCurrentBalance($phone);

                $new_balance = $balance - $amount;
                $total_debit = $current_debit + $amount;

                $data_wallet = [
                    'balance' => $new_balance,
                    'total_debit' => $total_debit
                ];
                $this->M_General->updateData('tbl_wallet', $data_wallet, 'phone', $phone);
                redirect('Controller_Wallet/getTransactionByPhone/' . $phone);
            }
        }
    }

	public function uploadReceipt() {
        if ($this->session->userdata('akses') == '3') {

            $this->load->model("M_General");
            $this->load->model("T_Wallet");

            $receipt = "";

            $config['upload_path'] = './assets/uploaded-receipt/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 3000;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('receipt')) {
                $error = $this->upload->display_errors();
                $this->load->view('customer/upload_receipt_topup', $error);
            } else {
                $image_data = $this->upload->data();
                $imgdata = file_get_contents($image_data['full_path']);
                $receipt = base64_encode($imgdata);
            }

            $phone = $this->input->post('phone');
            $id = $this->input->post('id');

            if (isset($id)) {
                $data = [
                    'receipt' => $receipt,
                    'modified_datetime' => date("Y-m-d h:i:sa", strtotime("now"))
                ];

                $this->M_General->updateData('tbl_transaction_history', $data, 'id', $id);
            }

            redirect('Controller_Wallet/getTransactionByPhone/' . $phone);
        }
    }

	public function confirmation($id = '') {
        if ($this->session->userdata('akses') == '1') {

            $this->load->model("T_Wallet");

            if (isset($id)) {

                $data['data'] = $this->T_Wallet->getTransactionHistoryById($id);
                $this->load->view('admin/transaction_confirmation_view', $data);
            }
        }
    }
	
	public function getTransactionById($id = '') {
        $this->load->model("T_Wallet");

        if (isset($id)) {
            $data['data'] = $this->T_Wallet->getTransactionHistoryById($id);
            if ($this->session->userdata('akses') == '2') {
                $this->load->view('technician/transaction_wallet_view', $data);
            } elseif ($this->session->userdata('akses') == '3') {
                $this->load->view('customer/transaction_wallet_view', $data);
            }
        }
    }

	public function confirmationSubmit() {
        if ($this->session->userdata('akses') == '1') {

            $this->load->model("T_Wallet");
            $this->load->model("M_General");
            $this->load->model("M_Order");

            $id = $this->input->post('id');

            if (isset($id)) {

                $is_approved = $this->input->post('is_approved');
                $txn_code = $this->input->post('txn_code');
                $txn_amount = $this->input->post('txn_amount');
                $phone = $this->input->post('phone');
                $is_processed = '1';
                $order_code = $this->input->post('order_code');
                $data_update = [];

                if ($txn_code == 'TOPU') {
                    $is_approved = $this->input->post('is_approved');
                    if ($is_approved == 1) {
                        $data_update = [
                            'is_approved' => $is_approved,
                            'is_processed' => $is_processed,
                            'modified_datetime' => date("Y-m-d h:i:sa", strtotime("now")),
                            'modified_by' => $this->session->userdata('code')
                        ];
                        $this->M_General->updateData('tbl_transaction_history', $data_update, 'id', $id);

                        $current_balance = $this->T_Wallet->getCurrentBalance($phone);
                        $current_credit = $this->T_Wallet->getCurrentCredit($phone);
                        $new_balance = $current_balance + $txn_amount;
                        $total_credit = $current_credit + $txn_amount;

                        $data_wallet = [
                            'balance' => $new_balance,
                            'total_credit' => $total_credit
                        ];
                        $this->M_General->updateData('tbl_wallet', $data_wallet, 'phone', $phone);

                        if ($order_code != '') {

                            $this->paymentOrder($phone, $order_code, $txn_amount);

                            $current_debit = $this->T_Wallet->getCurrentDebit($phone);

                            $new_balance = $new_balance - $txn_amount;
                            $total_debit = $current_debit + $txn_amount;

                            $data_wallet = [
                                'balance' => $new_balance,
                                'total_debit' => $total_debit
                            ];
                            $this->M_General->updateData('tbl_wallet', $data_wallet, 'phone', $phone);

                            $data_order = [
                                'order_status' => 'WAITING CONFIRMATION'
                            ];
                            $this->M_General->updateData('tbl_order', $data_order, 'order_code', $order_code);
                        }
                    }
                } elseif ($txn_code == 'WDRW') {
                    $config['upload_path'] = './assets/uploaded-image/';
                    $config['allowed_types'] = '*';
                    $config['max_size'] = 3000;
                    $this->load->library('upload', $config);
                    if (! $this->upload->do_upload('receipt')) {
                        $error_pass = $this->upload->display_errors();
                        echo $error_pass;
                    } else {
                        $image_data = $this->upload->data();
                        $imgdata = file_get_contents($image_data['full_path']);
                        $receipt = base64_encode($imgdata);
                    }

                    $data_update = [
                        'is_approved' => 1,
                        'is_processed' => $is_processed,
                        'modified_datetime' => date("Y-m-d h:i:sa", strtotime("now")),
                        'modified_by' => $this->session->userdata('code'),
                        'receipt' => $receipt
                    ];
                    $this->M_General->updateData('tbl_transaction_history', $data_update, 'id', $id);
                }

                redirect('Controller_Wallet');
            }
        }
    }

	public function paymentOrder($phone, $order_code, $amount) {
        $this->load->model("M_General");
        $this->load->model("T_Wallet");
        $this->load->model("M_Customer");
        $this->load->model("M_Admin");

        $phone = $phone;
        $amount = $amount;
        $order_code = $order_code;
        $is_processed = 1;
        $txn_code = 'PAYM';

        if (isset($phone)) {
            $data_insert = [
                'phone' => $phone,
                'txn_amount' => $amount,
                'txn_code' => $txn_code,
                'is_processed' => $is_processed,
                'order_code' => $order_code
            ];
        }

        $insertId = $this->M_General->insertData('tbl_transaction_history', $data_insert);
    }

	public function goTopUp($code = '') {
        if ($this->session->userdata('akses') == '3') {

            $this->load->model("M_Customer");

            $data['code'] = $code;
            if (isset($code)) {
                $data['data'] = $this->M_Customer->getOneById($code);
            }
            $this->load->view('customer/topup', $data);
        }
    }

	public function customTopUpOrder($order_code = '', $total_amount = '') {
        if ($this->session->userdata('akses') == '3') {

            $this->load->model("M_Customer");
            $this->load->model("M_Order");

            $data['order_code'] = $order_code;
            if (isset($order_code)) {
                $data_order = $this->M_Order->getForTopUp($order_code);
                if ($data_order->num_rows() > 0) {
                    $xdata_order = $data_order->row_array();
                    $customer_code = $xdata_order['customer_code'];
                }
                $data['data_order'] = $data_order;
                $data['data'] = $this->M_Customer->getOneById($customer_code);
                $data['total_amount'] = $total_amount;
            }
            $this->load->view('customer/topup', $data);
        }
    }

	public function getTransactionByPhone($phone='') {
        if ($this->session->userdata('akses') == '3') {

            $this->load->model("M_Customer");
            $this->load->model("T_Wallet");

            if (isset($phone)) {
                $data['data'] = $this->T_Wallet->getTransactionByPhone($phone);
            }
            $this->load->view('customer/list_wallet_transaction', $data);
        }
    }

	public function goUploadReceipt($id='') {
        if ($this->session->userdata('akses') == '3') {

            $this->load->model("T_Wallet");
            if (isset($id)) {
                $data['insertedData'] = $this->T_Wallet->getTransactionHistoryById($id);
                $this->load->view('customer/upload_receipt_topup', $data);
            }
        }
    }
}