<?php
class Controller_Wallet extends CI_Controller{
	function index(){
        $this->load->model('T_Wallet');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->T_Wallet->getAllTransaction();
			$this->load->view('admin/transaction_confirmation',$data);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	public function insertTransaction() {
		if($this->session->userdata('akses')=='3'){

			$this->load->model("M_General");
			$this->load->model("T_Wallet");
			$this->load->model("M_Customer");

			$phone = $this->input->post('phone');
			$amount = $this->input->post('amount');
			$txn_code = $this->input->post('txn_code');
			$is_processed = $this->input->post('is_processed');
			$order_code = $this->input->post('order_code');

			if (isset($phone)) {
				$data_insert = ['phone' => $phone,
				'txn_amount' => $amount,
				'txn_code' => $txn_code,
				'is_processed' => $is_processed
				];
			}

			if (isset($order_code)) {
				$data_insert['order_code'] = $order_code;
			}

			$insertId = $this->M_General->insertData('tbl_transaction_history', $data_insert);

			$data['insertedData'] = $this->T_Wallet->getTransactionHistoryById($insertId);
			$data['phone'] = $phone;

			$this->load->view('customer/upload_receipt_topup', $data);

		}
	}

	public function uploadReceipt() {
		if($this->session->userdata('akses')=='3'){

			$this->load->model("M_General");
			$this->load->model("T_Wallet");

			$receipt = "";

			$service_detail_name = $this->input->post('service_detail_name');
			
			$config['upload_path']          = './assets/uploaded-receipt/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 3000;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('receipt')) {
				$error = $this->upload->display_errors();
				$this->load->view('customer/upload_receipt_topup', $error);
			} else {
				$image_data = $this->upload->data();
				$imgdata = file_get_contents($image_data['full_path']);
				$receipt=base64_encode($imgdata);
			}

			$phone = $this->input->post('phone');
			$id = $this->input->post('id');

			if (isset($id)) {
				$data = ['receipt' => $receipt,
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
			
			if(isset($id)) {

				$data['data'] = $this->T_Wallet->getTransactionHistoryById($id);
				$this->load->view('admin/transaction_confirmation_view', $data);
			}

		}

	}

	public function confirmationSubmit() {

		if ($this->session->userdata('akses') == '1') {	
			
			$this->load->model("T_Wallet");
			$this->load->model("M_General");
			$this->load->model("M_Order");

			$id = $this->input->post('id');
				
			if(isset($id)) {

				$is_approved = $this->input->post('is_approved');
				$txn_code = $this->input->post('txn_code');
				$txn_amount = $this->input->post('txn_amount');
				$phone = $this->input->post('phone');
				$is_processed = '1';
				$order_code = $this->input->post('order_code');

				$data_update = [ 'is_approved' => $is_approved,
				'is_processed' => $is_processed,
				'modified_datetime' => date("Y-m-d h:i:sa", strtotime("now")),
				'modified_by' => $this->session->userdata('code')
				];

				$this->M_General->updateData('tbl_transaction_history', $data_update, 'id', $id);

				if ($is_approved == 1 && $txn_code == 'TOPU' && isset($order_code)) {


				}

				if ($is_approved == 1 && $txn_code == 'TOPU') {

					$current_balance = $this->T_Wallet->getCurrentBalance($phone);
					$current_credit = $this->T_Wallet->getCurrentCredit($phone);
					$new_balance = $current_balance + $txn_amount;
					$total_credit = $current_credit + $txn_amount;

					$data_wallet = ['balance' => $new_balance,
					'total_credit' => $total_credit
					];
					$this->M_General->updateData('tbl_wallet', $data_wallet, 'phone', $phone);

					if(isset($order_code)) {

						$this->paymentOrder($phone, $order_code, $txn_amount);

						$current_debit = $this->T_Wallet->getCurrentDebit($phone);

						$new_balance = $new_balance - $txn_amount;
						$total_debit = $current_debit + $txn_amount;

						$data_wallet = ['balance' => $new_balance,
						'total_debit' => $total_debit
						];
						$this->M_General->updateData('tbl_wallet', $data_wallet, 'phone', $phone);

						$data_order = ['order_status' => 'WAITING CONFIRMATION'];
						$this->M_General->updateData('tbl_order', $data_order, 'order_code', $order_code);

					}			

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
			$data_insert = ['phone' => $phone,
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
				$data_order = $this->M_Order->getOneByCode($order_code);
				if($data_order->num_rows() > 0){
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
			if(isset($id)) {
				$data['insertedData'] = $this->T_Wallet->getTransactionHistoryById($id);
				$this->load->view('customer/upload_receipt_topup', $data);
			}
		}
	}
}