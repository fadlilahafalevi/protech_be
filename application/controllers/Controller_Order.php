<?php
class Controller_Order extends CI_Controller{
	function index(){
        $this->load->model('T_Order');
        
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->T_Order->getAllOrder();
			$this->load->view('admin/order',$data);
		}else if($this->session->userdata('akses')=='2'){
			$data['data']=$this->T_Order->getAllOrder();
			$this->load->view('technician/order',$data);
	    }else if($this->session->userdata('akses')=='3'){
			$data['data']=$this->T_Order->getAllOrder();
			$this->load->view('customer/order',$data);
	    }else {
	        echo "Halaman tidak ditemukan";
	    }
	}
	
	public function orderHistory() {
	    if($this->session->userdata('akses')=='1'){
	        $this->load->model("M_Order");
	        $from = $this->input->post('from');
	        $to = $this->input->post('to');
	        
	        if ($from == null && $to == null) {
	            $from = '2019-01-01';
	            $to = '2029-12-31';
	        }
	        $data['data'] = $this->M_Order->getAll($from, $to);
	        $data['from'] = $from;
	        $data['to'] = $to;
	        $this->load->view('admin/order_history', $data);
	    }
	}
	
	public function downloadOrderHistory($from, $to) {
	    if($this->session->userdata('akses')=='1'){
	        $this->load->library('ReportHeaderLandscape');
	        $this->load->model("M_Order");
	        $this->load->library('pdf');
	        $this->load->helper('download');
	        
	        $order_history = $this->M_Order->getAll($from, $to);

	        $pdf = new FPDF('L', 'mm', 'A4');
	        $pdf = $this->reportheaderlandscape->getInstance($from, $to);

            $pdf->AddPage();

            $pdf->SetFont('Courier', 'B', 16);
            $pdf->Cell(0, 7, 'Report Order', 0, 1, 'C');
            $pdf->Cell(10, 7, '', 0, 1);

            $pdf->SetFont('Courier', 'B', 10);

            $pdf->Cell(5, 6, 'No', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Order Code', 1, 0, 'C');
            $pdf->Cell(40, 6, 'Order Time', 1, 0, 'C');
            $pdf->Cell(50, 6, 'Customer', 1, 0, 'C');
            $pdf->Cell(50, 6, 'Technician', 1, 0, 'C');
            $pdf->Cell(50, 6, 'Service', 1, 0, 'C');
            $pdf->Cell(50, 6, 'Status', 1, 1, 'C',);

            $pdf->SetFont('Courier', '', 8);
            $no = 1;
            foreach ($order_history as $data) {
                $pdf->Cell(5, 6, $no, 1, 0);
                $pdf->Cell(30, 6, $data->order_code, 1, 0);
                $pdf->Cell(40, 6, $data->created_datetime, 1, 0);
                $pdf->Cell(50, 6, $data->customer_name, 1, 0);
                $pdf->Cell(50, 6, $data->technician_name, 1, 0);
                $pdf->Cell(50, 6, $data->service, 1, 0);
                $pdf->Cell(50, 6, $data->order_status, 1, 1);
                $no ++;
            }
	        
	        $filename = 'order_history_report_'.date("Ymdhis").'.pdf';
	        
	        $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');
	        force_download('./assets/downloaded-pdf/'.$filename,NULL);
	    }
	}
	
	public function downloadInvoice($code) {
        if ($this->session->userdata('akses') == '3') {
            $this->load->library('ReportHeader');
            $this->load->model("M_Order");
            $this->load->library('pdf');
            $this->load->helper('download');

            $order = $this->M_Order->getOneByCode($code);
            foreach ($order as $data) {
                $customer_name = $data->customer_name;
                $technician_name = $data->technician_name;
                $address = $data->address;
                $fix_datetime = $data->fix_datetime;
            }
            $pdf = new FPDF('P', 'mm', 'A4');
            $pdf = $this->reportheader->getInstance($code);

            $pdf->AddPage();
            /* output the result */

            /* set font to Courier, bold, 14pt */
            $pdf->SetFont('Courier', 'B', 20);

            /* Cell(width , height , text , border , end line , [align] ) */

            $pdf->Cell(75, 10, '', 0, 0);
            $pdf->Cell(59, 5, 'Invoice', 0, 0);
            $pdf->Cell(59, 10, '', 0, 1);

            $pdf->Cell(34, 5, '', 0, 1);
            $pdf->Cell(59, 5, '', 0, 1);

            $pdf->SetFont('Courier', 'B', 12);
            $pdf->Cell(130, 10, 'Detail Repairing', 0, 1);
            
            $pdf->SetFont('Courier', '', 8);
            $pdf->Cell(40, 5, 'Address', 0, 0);
            $pdf->MultiCell(150, 5, ': '.$address, 0, 1);
            $pdf->Cell(40, 5, 'Customer Name', 0, 0);
            $pdf->Cell(50, 5, ': '.$customer_name, 0, 1);
            $pdf->Cell(40, 5, 'Technician Name', 0, 0);
            $pdf->Cell(50, 5, ': '.$technician_name, 0, 1);
            $pdf->Cell(40, 5, 'Repair Datetime', 0, 0);
            $pdf->Cell(25, 5, ': '.$fix_datetime, 0, 1);
            $pdf->Cell(59, 5, '', 0, 1);
            
            $pdf->SetFont('Courier', 'B', 12);
            $pdf->Cell(130, 10, 'Detail Service', 0, 1);

            $pdf->SetFont('Courier', 'B', 8);
            /* Heading Of the table */
            $pdf->Cell(10, 6, 'No', 1, 0, 'C');
            $pdf->Cell(35, 6, 'Service Code', 1, 0, 'C');
            $pdf->Cell(100, 6, 'Service Name', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Price', 1, 1, 'C'); /* end of line */
            /* Heading Of the table end */
            $pdf->SetFont('Courier', '', 8);
            $detail = $this->M_Order->getDetailByCode($code);
            $no=1;
            $total_price = 0;
            foreach ($detail as $detail) {
                $pdf->Cell(10, 6, $no, 1, 0, 'C');
                $pdf->Cell(35, 6, $detail->service_type_code, 1, 0, 'C');
                $pdf->Cell(100, 6, $detail->service, 1, 0, 'C');
                $pdf->Cell(30, 6, 'Rp. '.number_format($detail->price, 2, ',', '.'), 1, 1, 'R');
                $no++;
                $total_price = $total_price + $detail->price;
            }

            $pdf->Cell(10, 6, '', 0, 0);
            $pdf->Cell(35, 6, '', 0, 0);
            $pdf->Cell(100, 6, 'Subtotal', 1, 0, 'R');
            $pdf->Cell(30, 6, 'Rp. '.number_format($total_price, 2, ',', '.'), 1, 1, 'R');

            $filename = 'invoice_order_' . $code . '_' . date("Ymdhis") . '.pdf';

            $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');

            force_download('./assets/downloaded-pdf/' . $filename, NULL);
        }
    }

	public function getOne($code='') {
		if($this->session->userdata('akses')=='1'){
			$this->load->model("T_Order");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->T_Order->getOneById($id);
			}

			$this->load->view('admin/order_view', $data);
		} else if($this->session->userdata('akses')=='2'){
			$this->load->model("T_Order");

			$data['id'] = $id;
			if (isset($id)) {
				$data['data'] = $this->T_Order->getOneById($id);
			}

			$this->load->view('customer/order_view', $data);
		} else if($this->session->userdata('akses')=='3') {
			$this->load->model("M_Order");
			$this->load->model("M_ServiceType");
			$this->load->model("M_Review");

			if (isset($code)) {
				$data_order = $this->M_Order->getOne($code);
				$payment = $this->M_Order->getPayment($code);
				$data['data_layanan_tambahan'] = $this->M_ServiceType->getServiceTypeDetailByCategoryCode($data_order[0]->service_category_code);
	            $data['service_category_code'] = $data_order[0]->service_category_code;
	            $data['order_code'] = $code;
				$data['count_order_NC']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
				$data['data'] = $data_order;
				$data['review'] = $this->M_Review->getOneByOrderCode($code);
				$data['data_detail'] = $this->M_Order->getOrderDetailByOrderCode($code);
				$data['waktu_perbaikan'] = DateTime::createFromFormat('Y-m-d H:i:s', $data_order[0]->repair_datetime)->format('m/d/Y H.i');
				$data['payment'] = $payment;
			}

			$this->load->view('technician/order_view', $data);
		} else if($this->session->userdata('akses')=='4') {
			$this->load->model("M_Order");
			$this->load->model("M_ServiceType");
			$this->load->model("M_Review");

			if (isset($code)) {
				$data_order = $this->M_Order->getOne($code);
				$payment = $this->M_Order->getPayment($code);
				$data['data_layanan_tambahan'] = $this->M_ServiceType->getServiceTypeDetailByCategoryCode($data_order[0]->service_category_code);
	            $data['service_category_code'] = $data_order[0]->service_category_code;
	            $data['order_code'] = $code;
				$data['count_order_NC']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
				$data['data'] = $data_order;
				$data['data_detail'] = $this->M_Order->getOrderDetailByOrderCode($code);
				$data['review'] = $this->M_Review->getOneByOrderCode($code);
				$data['waktu_perbaikan'] = DateTime::createFromFormat('Y-m-d H:i:s', $data_order[0]->repair_datetime)->format('m/d/Y H.i');
				$data['payment'] = $payment;
			}

			$this->load->view('customer/order_view', $data);
		}
	}

	public function createOrder($serviceDetailCode = '') {
		if($this->session->userdata('akses')=='3'){

			$this->load->model("M_Service");
			
			if(isset($serviceDetailCode)) {
				$data['data'] = $this->M_Service->getServiceDetailByCode($serviceDetailCode);
				$this->load->view('customer/order_create_location', $data);
			}

		} else {
			redirect('Controller_Login');
		}
	}

	public function searchTechnician() {
		$this->load->model("M_Order");
		
		$foto_kerusakan = '';
		$config['upload_path']          = './assets/uploaded-image/';
		$config['allowed_types']        = '*';
		$config['max_size']             = 3000;
		$this->load->library('upload', $config);
		if ( !$this->upload->do_upload('foto_kerusakan') ) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			redirect('Controller_Order/preorder/'.$this->input->post('service_category_code'), 'refresh');
		} else {
			$image_data = $this->upload->data();
			$imgdata = file_get_contents($image_data['full_path']);
			$foto_kerusakan = base64_encode($imgdata);
		}

		$latitude =	$this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$service_category_code = $this->input->post('service_category_code');
		$service_type_code = $this->input->post('service_type_code');

		$data['jenis_layanan'] = $this->input->post('jenis_layanan');
		$data['waktu_perbaikan'] = $this->input->post('waktu_perbaikan');
		$data['alamat'] = $this->input->post('alamat');
		$data['catatan_alamat'] = $this->input->post('catatan_alamat');
		$data['foto_kerusakan'] = $foto_kerusakan;
		$data['detail_keluhan'] = $this->input->post('detail_keluhan');
		$data['metode_pembayaran'] = $this->input->post('metode_pembayaran');
		$data['latitude'] = $this->input->post('latitude');
		$data['longitude'] = $this->input->post('longitude');
		$data['service_category_code'] = $this->input->post('service_category_code');
		$data['service_type_code'] = $this->input->post('service_type_code');

		$data['data'] = $this->M_Order->searchTechnician($latitude, $longitude, $service_type_code);
		$this->listTechnician($data);
		// $this->load->view('customer/order_result_technician', $data);
	}

	public function listTechnician($data = '') {
		if(is_array($data) && count($data) > 0) {
			
			$nearestTech = $data['data'];

			$dataView['jenis_layanan'] = $data['jenis_layanan'];
			$dataView['waktu_perbaikan'] = $data['waktu_perbaikan'];
			$dataView['alamat'] = $data['alamat'];
			$dataView['catatan_alamat'] = $data['catatan_alamat'];
			$dataView['foto_kerusakan'] = $data['foto_kerusakan'];
			$dataView['detail_keluhan'] = $data['detail_keluhan'];
			$dataView['metode_pembayaran'] = $data['metode_pembayaran'];
			$dataView['latitude'] = $data['latitude'];
			$dataView['longitude'] = $data['longitude'];
			$dataView['service_category_code'] = $data['service_category_code'];
			$dataView['service_type_code'] = $data['service_type_code'];
			$dataView['nearestTech'] = $nearestTech;

			$this->load->view('customer/nearest_technician', $dataView);
		} else {
			echo "No result found";
		}
	}

	public function confirmOrder() {
		$this->load->model("M_Order");
		$this->load->model("M_Technician");
		$this->load->model("M_ServiceCategory");
		$this->load->model("M_ServiceType");

		$foto_kerusakan = '';
		$config['upload_path']          = './assets/uploaded-image/';
		$config['allowed_types']        = '*';
		$config['max_size']             = 3000;
		$this->load->library('upload', $config);
		if ( !$this->upload->do_upload('foto_kerusakan') ) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			redirect('Controller_Order/preorder/'.$this->input->post('service_category_code'), 'refresh');
		} else {
			$image_data = $this->upload->data();
			$imgdata = file_get_contents($image_data['full_path']);
			$foto_kerusakan = base64_encode($imgdata);
		}

		$data['jenis_layanan'] = $this->input->post('jenis_layanan');
		$data['waktu_perbaikan'] = date_format(date_create_from_format("d/m/Y H.i", $this->input->post('waktu_perbaikan')),"d/m/Y H.i");
		$data['alamat'] = $this->input->post('alamat');
		$data['catatan_alamat'] = $this->input->post('catatan_alamat');
		$data['foto_kerusakan'] = $foto_kerusakan;
		$data['detail_keluhan'] = $this->input->post('detail_keluhan');
		$data['metode_pembayaran'] = $this->input->post('metode_pembayaran');
		$data['latitude'] = $this->input->post('latitude');
		$data['longitude'] = $this->input->post('longitude');
		$data['service_category_code'] = $this->input->post('service_category_code');
		$data['service_type_code'] = $this->input->post('service_type_code');
		$data['technician_code'] = $this->input->post('tech_code');
		$data['service_category'] = $this->M_ServiceCategory->getServiceCategoryDetailByCode($this->input->post('service_category_code'));
		$data['service_type'] = $this->M_ServiceType->getServiceTypeDetailByCode($this->input->post('service_type_code'));
		$data['technician'] = $this->M_Technician->getTechnicianDetailByCode($this->input->post('tech_code'));

		// print_r($data['service_type'][0]->price);

		if ($this->input->post('jenis_layanan') == 'INSTALASI') {
			$service_type = $this->M_ServiceCategory->getInstalasiService($this->input->post('service_category_code'));
			$data['service_type'] = $service_type;
			$data['service_type_code'] = $service_type[0]->service_type_code;
		}

		if ($this->input->post('jenis_layanan') == 'PERBAIKAN') {
			$service_type = $this->M_ServiceCategory->getServiceCategoryDetailByCode($this->input->post('service_category_code'));
			$data['service_type'] = $service_type;
		}

		$this->load->view('customer/order_confirmation', $data);
	}

	public function preOrder($service_category_code) {
		if ($this->session->userdata('akses') == '4') {
			$this->load->model("M_ServiceCategory");
			$this->load->model("M_ServiceType");

			$service_category = $this->M_ServiceCategory->getServiceCategoryDetailByCode($service_category_code);
			$service_type_pemeliharaan = $this->M_ServiceType->getServiceTypeDetailByCodeAndType($service_category_code, 'PEMELIHARAAN');
			$isInstalasiExists = $this->M_ServiceType->isInstalasiExists($service_category_code);
			
			$data['service_category'] = $service_category;
			$data['service_type'] = $service_type_pemeliharaan;
			$data['isInstalasiExists'] = $isInstalasiExists;

			$this->load->view('customer/pre_order', $data);
		} else {
			redirect('Controller_Login');
		}

	}

	public function inputOrder() {
		$this->load->model("M_General");
		$this->load->model("M_ServiceCategory");
		$this->load->model("M_ServiceType");
		$this->load->model("M_Technician");

		$jenis_layanan = $this->input->post('jenis_layanan');
		$waktu_perbaikan = date_format(date_create_from_format("d/m/Y H.i", $this->input->post('waktu_perbaikan')),"Y-m-d H.i");
		$alamat = $this->input->post('alamat');
		$catatan_alamat = $this->input->post('catatan_alamat');
		$foto_kerusakan = $this->input->post('foto_kerusakan');
		$detail_keluhan = $this->input->post('detail_keluhan');
		$metode_pembayaran = $this->input->post('metode_pembayaran');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$service_category_code = $this->input->post('service_category_code');
		$service_type_code = $this->input->post('service_type_code');
		$technician_code = $this->input->post('tech_code');
		$service_category = $this->M_ServiceCategory->getServiceCategoryDetailByCode($this->input->post('service_category_code'));
		$service_type = $this->M_ServiceType->getServiceTypeDetailByCode($this->input->post('service_type_code'));
		$technician = $this->M_Technician->getTechnicianDetailByCode($this->input->post('tech_code'));
		$order_status_wc = 'MENUNGGU KONFIRMASI';
		$order_code = $this->M_General->getSequenceOrder('tbl_order', 4);
		$customer_code =  $this->session->userdata('user_code');
		$customer_username = $this->session->userdata('user_name');
		$now = date("Y-m-d H:i:s");
		

		//insert into tbl_order
		$data_tbl_order = [ 'order_code'  => $order_code,
		'customer_code' => $customer_code,
		'address' => $alamat,
		'latitude' => $latitude,
		'longitude' => $longitude,
		'repair_datetime' => $waktu_perbaikan,
		'photo' => $foto_kerusakan,
		'detail_keluhan' => $detail_keluhan,
		'order_status' => $order_status_wc,
		'created_by' => $customer_username,
		'created_datetime' => $now,
		'service_category_code' => $service_category_code
		];

		$this->M_General->insertData('tbl_order', $data_tbl_order);

		if ($jenis_layanan == 'PERBAIKAN') {
			$price = '20000';
			$description = 'Pengecekan';
		} else {
			$price =  $service_type[0]->price;
		}

		//insert into tbl_order_detail
		$data_detail = [ 'order_code'  => $order_code,
		'service_type_code' => empty($service_type_code) ? NULL : $service_type_code,
		'price' => $price,
		'description' => $description,
		'created_by' => $customer_username,
		'created_datetime' => $now
		];

		$this->M_General->insertData('tbl_order_detail', $data_detail);

		//insert into tbl_payment
		$data_payment = [ 'order_code' => $order_code,
		'payment_method' => $metode_pembayaran,
		'total_payment' => $price,
		'created_by' => $customer_username,
		'created_datetime' => $now
		];

		$this->M_General->insertData('tbl_payment', $data_payment);

		redirect('Controller_Order/getOneAfterOrderByCode/'.$order_code);
	}

	public function getOneAfterOrderByCode($code = '') {
        $this->load->model("M_Order");

        if ($this->session->userdata('akses') == '1') {
            if (isset($code)) {
                $data['list_service_detail'] = $this->M_Service->getAllServiceCategory();

                $data['data'] = $this->M_Order->getOneByCode($code);
                $data['detail'] = $this->M_Order->getDetailByCode($code);
                $this->load->view('admin/order_view', $data);
            }
        } else if ($this->session->userdata('akses') == '2') {
            if (isset($code)) {
                $data['list_service_detail'] = $this->M_Service->getAllServiceCategory();
                $data['data'] = $this->M_Order->getOneByCode($code);
                $data['detail'] = $this->M_Order->getDetailByCode($code);
                $this->load->view('technician/order_view', $data);
            }
        } else if ($this->session->userdata('akses') == '3') {

            if (isset($code)) {
            	$data_order_detail = $this->M_Order->getOne($code);
            	$waktu_perbaikan = DateTime::createFromFormat('Y-m-d H:i:s', $data_order_detail[0]->repair_datetime)->format('m/d/Y H.i');
            	$payment = $this->M_Order->getPayment($code);
            	$data['count_order_NC']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
            	$data['data'] = $data_order_detail;
            	$data['waktu_perbaikan'] = $waktu_perbaikan;
            	$data['payment'] = $payment;
                $this->load->view('technician/order_confirmation_detail', $data);
            }
        } else if ($this->session->userdata('akses') == '4') {
            if (isset($code)) {
            	$data_order_detail = $this->M_Order->getOne($code);
            	$payment = $this->M_Order->getPayment($code);
            	$data['data'] = $data_order_detail;
            	$data['waktu_perbaikan'] = DateTime::createFromFormat('Y-m-d H:i:s', $data_order_detail[0]->repair_datetime)->format('m/d/Y H.i');
            	$data['payment'] = $payment;
                $this->load->view('customer/order_detail', $data);
            }
        } else {
            redirect('Controller_Login');
        }
    }

	public function getAllByCustomerCode($code = '') {
		if($this->session->userdata('akses')=='3'){

			$this->load->model("M_Order");
			
			if(isset($code)) {
				$data['data'] = $this->M_Order->getAllByCustomerCode($code);
				$this->load->view('customer/order', $data);
			}
		} else {
			redirect('Controller_Login');
		}
	}

	public function getAll($code = '') {
		if($this->session->userdata('akses')=='3'){

			$this->load->model("M_Order");
			
			if(isset($code)) {
				$data['data'] = $this->M_Order->getAllByTechnicianCode($code);
				$data['count_order_NC']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
				$this->load->view('technician/order_list', $data);
			}
		} else if ($this->session->userdata('akses')=='4') {
			$this->load->model("M_Order");
			
			if(isset($code)) {
				$data['data'] = $this->M_Order->getAllByCustomerCode($code);
				$data['count_order_NC']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
				$this->load->view('customer/order_list', $data);
			}
		} else {
			redirect('Controller_Login');
		}
	}

	// public function confirmOrderByTech() {
	// 	if ($this->session->userdata('akses')=='2') {

	// 	    $this->load->model("M_Order");
	// 	    $this->load->model("M_Customer");
	// 	    $this->load->model("T_Wallet");
	// 	    $this->load->model("M_General");
		    
	// 		$order_code = $this->input->post('order_code');
	// 		$is_approved = $this->input->post('is_approved');
	// 		if (isset($order_code)) {
	// 		    if ($is_approved == 1) {
	// 			    $this->M_Order->updateStatus($order_code, 'IN PROGRESS');
	// 		    } else {
	// 		        $paid_amount = $this->M_Order->getTotalPriceFromOrder($order_code);
	// 		        $customer_code = $this->M_Order->getCustomerCodeFromOrder($order_code);
	// 		        $customer_phone = $this->M_Customer->getPhoneByCode($customer_code);
	// 		        $balance = $this->T_Wallet->getCurrentBalance($customer_phone);
	// 		        $credit = $this->T_Wallet->getCurrentCredit($customer_phone);
	// 		        $data_wallet = [
	// 		            'balance' => $balance + $paid_amount,
	// 		            'total_credit' => $credit + $paid_amount
	// 		        ];
			        
	// 		        $intermediaryWallet = '082213223526';
	// 		        $balanceIntermediaryWallet = $this->T_Wallet->getCurrentBalance($intermediaryWallet);
	// 		        $debitIntermediaryWallet = $this->T_Wallet->getCurrentCredit($intermediaryWallet);
	// 		        $data_wallet_intermediary = [
	// 		            'balance' => $balanceIntermediaryWallet + $paid_amount,
	// 		            'total_credit' => $debitIntermediaryWallet + $paid_amount
	// 		        ];
			        
	// 		        $data = [
	// 		            'to_phone' => $customer_phone,
	// 		            'from_phone' => $intermediaryWallet,
	// 		            'txn_amount' => $paid_amount,
	// 		            'txn_code' => 'PAYM',
	// 		            'order_code' => $order_code,
	// 		            'is_processed' => 1,
	// 		            'is_approved' => 1
	// 		        ];
			        
	// 		        $this->M_General->insertData('tbl_transaction_history', $data);
	// 		        $this->M_General->updateData('tbl_wallet', $data_wallet, 'phone', $customer_phone);
	// 		        $this->M_General->updateData('tbl_wallet', $data_wallet_intermediary, 'phone', $intermediaryWallet);
	// 		        $this->M_Order->updateStatus($order_code, 'REJECTED BY TECH');
	// 		    }
	// 			redirect('Controller_Order/getOneByCode/'.$order_code);
	// 		}
	// 	}
	// }

	public function finishOrderByTech($order_code = '', $technician_code = '') {
        if ($this->session->userdata('akses') == '2') {
            $this->load->model("M_Order");
            $this->load->model("M_Technician");
            if (isset($order_code)) {
                $total_amount = $this->M_Order->getTotalPriceFromOrder($order_code);
                $phone = $this->M_Technician->getPhoneByCode($technician_code);
                $this->M_Order->updateStatus($order_code, 'FINISHED');
                $this->transferPaymentIntermediaryWallet('technician', $phone, $total_amount, $order_code);
                redirect('Controller_Order/getOneByCode/' . $order_code);
            }
        }
    }
	
	public function requestNewService($order_code, $service_category_code) {
        $this->load->model("M_Order");
        $this->load->model("M_ServiceType");
        if (isset($order_code)) {
            $data['data'] = $this->M_ServiceType->getServiceTypeDetailByCategoryCode($service_category_code);
            $data['count_order_NC']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
            $data['order_code'] = $order_code;
            $data['service_category_code'] = $service_category_code;
            $this->load->view('technician/add_new_services', $data);
        }
	}
	
	public function requestNewServiceSubmit($order_code, $service_category_code) {
        $this->load->model("M_Order");
        $this->load->model("M_ServiceType");
        $this->load->model("M_General");

        if (isset($order_code)) {
            $list_request_service = $this->M_ServiceType->getServiceTypeDetailByCategoryCode($service_category_code);
            $data['count_order_NC'] = $this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
            $data['order_code'] = $order_code;
            $new_price = 0;
            foreach ($list_request_service as $service) {
                $code = $service->service_type_code;
                $service_type_code = $this->input->post($code);
                $price = $this->input->post('price-'.$code);
                if (isset($service_type_code)) {
                $data = [
                    'order_code' => $order_code,
                    'service_type_code' => $service_type_code,
                    'price' => $price,
                    'created_by' => $this->session->userdata('user_name')
                ];
                    $this->M_General->insertData('tbl_order_detail', $data);

                $new_price = $new_price + $price;
                }
            }

            $payment = $this->M_Order->getPayment($order_code);
            $new_price = $new_price + $payment[0]->total_payment;
            $data_payment = [
            	'total_payment' => $new_price
            ];
            $this->M_General->updateData('tbl_payment', $data_payment, 'order_code', $order_code);

            redirect('Controller_Order/getOne/'.$order_code);
        }
    }
    
    public function approvedRequestByCustomer($order_code, $phone) {
        $this->load->model("M_Order");
        $this->load->model("T_Wallet");
        $this->load->model("M_General");
        
        $total_unpaid = $this->M_Order->getUnpaidOrderCustomer($order_code);
        $total_balance_customer = $this->T_Wallet->getCurrentBalance($phone);
        $is_approved = $this->input->post('is_approved');
        
        if ($is_approved == 1) {
            if ($total_balance_customer >= $total_unpaid) {
                //update status order detail to paid
                $data = [
                    'order_code' => $order_code,
                    'is_paid' => 1
                ];
                $this->M_General->updateData('tbl_order_detail', $data, 'order_code', $order_code);
                
                //update total price
                $total_price = $this->M_Order->getTotalPriceFromOrder($order_code);
                $data_order = [
                    'total_amount' => $total_price
                ];
                $this->M_General->updateData('tbl_order', $data_order, 'order_code', $order_code);
                
                $this->transferPaymentIntermediaryWallet('customer', $phone, $total_unpaid, $order_code);
            }
        } else {
            $this->M_General->deleteData('tbl_order_detail', 'order_code = \''.$order_code.'\' and is_paid = 0');
        }
        
        redirect('Controller_Order/getOneByCode/'.$order_code);
    }
    
    public function submitReview($order_code) {
        $this->load->model("M_Order");
        $this->load->model("M_General");
        
        $rating = $this->input->post('rating');
        $ulasan = $this->input->post('ulasan');
        $data = [
            'order_code' => $order_code,
            'rate' => $rating,
            'review'=> $ulasan,
            'created_by' => $this->session->userdata('user_name'),
            'created_datetime' => date("Y-m-d H:i:s")
        ];
        
        $this->M_General->insertData('tbl_review', $data);

        redirect('Controller_Order/getOne/'.$order_code);
    }
	
	// public function transferPaymentIntermediaryWallet($user_type, $phone, $amount, $order_code) {
	//     $this->load->model("T_Wallet");
	//     $this->load->model("M_General");
	    
	//     $intermediaryWallet = '082213223526';
	//     $balanceIntermediaryWallet = $this->T_Wallet->getCurrentBalance($intermediaryWallet);
	//     $debitIntermediaryWallet = $this->T_Wallet->getCurrentDebit($intermediaryWallet);
	//     $creditIntermediaryWallet = $this->T_Wallet->getCurrentCredit($intermediaryWallet);
	//     if (strcasecmp($user_type, 'customer') == 0) {
	//         $txn_code = 'PAYM';
	//         $is_processed = '1';
	//         $is_approved = '1';
	        
	//         $balance = $this->T_Wallet->getCurrentBalance($phone);
	//         $debit = $this->T_Wallet->getCurrentDebit($phone);
	//         $credit = $this->T_Wallet->getCurrentCredit($phone);
	        
	//         $data = [
	//             'from_phone' => $phone,
	//             'to_phone' => $intermediaryWallet,
	//             'txn_amount' => $amount,
	//             'txn_code' => $txn_code,
	//             'order_code' => $order_code,
	//             'is_processed' => $is_processed,
	//             'is_approved' => $is_approved
	//         ];
	        
	//         $data_wallet = [
	//             'balance' => $balance - $amount,
	//             'total_debit' => $debit + $amount
	//         ];
	        
	//         $data_wallet_intermediary = [
	//             'balance' => $balanceIntermediaryWallet + $amount,
	//             'total_credit' => $creditIntermediaryWallet + $amount
	//         ];
	//     } else if (strcasecmp($user_type, 'technician') == 0) {
	//         $txn_code = 'PAYM';
	//         $is_processed = '1';
	//         $is_approved = '1';
	        
	//         $balance = $this->T_Wallet->getCurrentBalance($phone);
	//         $debit = $this->T_Wallet->getCurrentDebit($phone);
	//         $credit = $this->T_Wallet->getCurrentCredit($phone);
	        
	//         $data = [
	//             'to_phone' => $phone,
	//             'from_phone' => $intermediaryWallet,
	//             'txn_amount' => $amount,
	//             'txn_code' => $txn_code,
	//             'order_code' => $order_code,
	//             'is_processed' => $is_processed,
	//             'is_approved' => $is_approved
	//         ];
	        
	//         $data_wallet = [
	//             'balance' => $balance + $amount,
	//             'total_credit' => $credit + $amount
	//         ];
	        
	//         $data_wallet_intermediary = [
	//             'balance' => $balanceIntermediaryWallet - $amount,
	//             'total_debit' => $debitIntermediaryWallet + $amount
	//         ];
	//     }
	    
	//     $this->M_General->insertData('tbl_transaction_history', $data);
	//     $this->M_General->updateData('tbl_wallet', $data_wallet, 'phone', $phone);
	//     $this->M_General->updateData('tbl_wallet', $data_wallet_intermediary, 'phone', $intermediaryWallet);
	// }

	// public function cancelByCustomer($order_code) {
 //        if ($this->session->userdata('akses') == '3') {

 //            $this->load->model("M_Order");
 //            if (isset($order_code)) {
 //                $this->M_Order->updateStatus($order_code, 'CANCELLED BY CUST');
 //                redirect('Controller_Order/getOneByCode/' . $order_code);
 //            }
 //        }
 //    }
	
	public function getWaitingConfirmationOrder() {
        if ($this->session->userdata('akses') == '3') {
            $this->load->model("M_Order");
            $this->load->model("M_Technician");

            //get data technician
            $technician_data = $this->M_Technician->getTechnicianDetailByCode($this->session->userdata('user_code'));
            $order_data = $this->M_Order->searchOrder($technician_data[0]->latitude, $technician_data[0]->longitude, $this->session->userdata('user_code'));
            $data['count_order_NC']=$this->M_Order->getCountOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
            // $data['data'] = $this->M_Order->getOrderNeedConfirmationByTechCode($this->session->userdata('user_code'));
            $data['data'] = $order_data;
            $this->load->view('technician/order_need_confirmation_list', $data);
        }
    }

    public function confirmOrderTechnician($order_code, $status) {
    	$this->load->model("M_General");
    	$status = str_replace("%20"," ",$status);
    	$data = [
    			'technician_code' => $this->session->userdata('user_code'),
                'order_status' => $status,
                'modified_by' => $this->session->userdata('user_name'),
                'modified_datetime' => date("Y-m-d H:i:s")
            ];

       	$this->M_General->updateData('tbl_order', $data, 'order_code', $order_code);
       	redirect('Controller_Order/getOne/'.$order_code);
    }

    public function confirmPayment($order_code) {
    	$this->load->model("M_General");
		$data_payment = [
			'payment_date' => date("Y-m-d H:i:s")
		];
		$this->M_General->updateData('tbl_payment', $data_payment, 'order_code', $order_code);
       	redirect('Controller_Order/getOne/'.$order_code);
    }
    
    public function rejectByAdmin($order_code) {
        if ($this->session->userdata('akses') == '1') {
            $this->load->model("M_General");
            $data = [
                'order_code' => $order_code,
                'order_status' => 'REJECTED BY ADMIN',
                'modified_by' => $this->session->userdata('code'),
                'modified_datetime' => date("Y-m-d h:i:sa", strtotime("now"))
            ];

            $this->M_General->updateData('tbl_order', $data, 'order_code', $order_code);
            redirect('Controller_Order/getWaitingConfirmationOrder');
        }
    }
}