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

	function printDetailOrder($order_code) {
		$this->load->library('ReportHeaderLandscape');
        $this->load->model("M_Order");
        $this->load->helper('download');
        
        // $order_history = $this->M_Order->getAll($from, $to);
        $order = $this->M_Order->getOne($order_code);

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf = $this->reportheaderlandscape->getInstance($from, $to);

        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'Data Pemesanan', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 8);

        $pdf->SetX(110);
        $pdf->Cell(50, 7, 'Kode Pesanan', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(100, 7, $order[0]->order_code, 0, 1, 'L');

        $pdf->SetX(110);
		$pdf->Cell(50, 7, 'Nama Pelanggan', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(100, 7, $order[0]->nama_customer, 0, 1, 'L');

        $pdf->SetX(110);
		$pdf->Cell(50, 7, 'Nama Teknisi', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(100, 7, $order[0]->nama_teknisi, 0, 1, 'L');

        $pdf->SetX(110);
		$pdf->Cell(50, 7, 'Kategori Layanan', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(100, 7, $order[0]->service_category_name, 0, 1, 'L');

        $pdf->SetX(110);
		$pdf->Cell(50, 7, 'Tipe Layanan', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(100, 7, $order[0]->service_type_name, 0, 1, 'L');

        $pdf->SetX(110);
		$pdf->Cell(50, 7, 'Waktu Pengerjaan', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(100, 7, $order[0]->repair_datetime, 0, 1, 'L');

        $pdf->SetX(110);
        $pdf->SetWidths(Array(50,5,100));
        $pdf->SetLineHeight(7);
        $pdf->Row(Array('Alamat', ':', $order[0]->alamat_pengerjaan), 0);

        $pdf->SetX(110);
		$pdf->Cell(50, 7, 'Foto Kerusakan', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
		// const TEMPIMGLOC = 'tempimg.png';
		define('TEMPIMGLOC', 'tempimg.png');

		$dataURI    = "data:image/png;base64,".$order[0]->photo;
		$dataPieces = explode(',',$dataURI);
		$encodedImg = $dataPieces[1];
		$decodedImg = base64_decode($encodedImg);

		//  Check if image was properly decoded
		if( $decodedImg!==false )
		{
		    //  Save image to a temporary location
		    if( file_put_contents(TEMPIMGLOC,$decodedImg)!==false )
		    {
		        $pdf->Image(TEMPIMGLOC, null, null, 80);

		        //  Delete image from server
		        unlink(TEMPIMGLOC);
		    }
		}
        
        $filename = 'list_detail_pemesanan_'.$order[0]->order_code.'_'.date("Ymdhis").'.pdf';
        
        $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');
        force_download('./assets/downloaded-pdf/'.$filename,NULL);
	}

	function printInvoice($order_code) {
		$this->load->library('ReportHeaderLandscape');
        $this->load->model("M_Order");
        $this->load->helper('download');
        
        // $order_history = $this->M_Order->getAll($from, $to);
        $order = $this->M_Order->getOne($order_code);

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf = $this->reportheaderlandscape->getInstance($from, $to);

        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'Kuitansi', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 8);

        $pdf->SetX(70);
        $pdf->Cell(50, 7, 'Kode Pesanan', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(70, 7, $order[0]->order_code, 0, 0, 'L');

        $pdf->SetX(190);
		$pdf->Cell(50, 7, 'Waktu Pengerjaan', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(100, 7, $order[0]->repair_datetime, 0, 1, 'L');

        $pdf->SetX(70);
		$pdf->Cell(50, 7, 'Nama Pelanggan', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(100, 7, $order[0]->nama_customer, 0, 0, 'L');

        $pdf->SetX(190);
        $pdf->SetWidths(Array(50,5,70));
        $pdf->SetLineHeight(7);
        $pdf->Row(Array('Alamat', ':', $order[0]->alamat_pengerjaan), 0);

        $pdf->SetX(70);
		$pdf->Cell(50, 7, 'Nama Teknisi', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(100, 7, $order[0]->nama_teknisi, 0, 0, 'L');

        $pdf->SetX(190);
		$pdf->Cell(50, 7, 'Kategori Layanan', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'C');
        $pdf->Cell(100, 7, $order[0]->service_category_name, 0, 1, 'L');

        $order_detail = $this->M_Order->getOrderDetailByOrderCode($order_code);

        $pdf->SetX(190);
		$pdf->Cell(50, 7, '', 0, 0, 'L');
        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(100, 7, '', 0, 1, 'L');
		$pdf->Cell(50, 7, '', 0, 0, 'L');
        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(100, 7, '', 0, 1, 'L');
		$pdf->Cell(50, 7, '', 0, 0, 'L');
        $pdf->Cell(5, 7, '', 0, 0, 'C');
        $pdf->Cell(100, 7, '', 0, 1, 'L');

        $pdf->SetX(120);
        $pdf->Cell(10, 7, 'No', 1, 0, 'C');
        $pdf->Cell(80, 7, 'Jenis Layanan', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Harga', 1, 1, 'C');

        $no = 1;
        $total_pembayaran = 0;
        foreach ($order_detail as $data) {
        	$pdf->SetX(120);
        	$pdf->Cell(10, 7, $no, 1, 0, 'L');
	        $pdf->Cell(80, 7, $data->service_type_name, 1, 0, 'L');
	        $pdf->Cell(50, 7, 'Rp '.number_format($data->price,2,',','.'), 1, 1, 'L');
	        $no ++;
	        $total_pembayaran = $total_pembayaran + $data->price;
	    }

	    $pdf->SetX(120);
    	$pdf->Cell(10, 7, '', 0, 0, 'L');
        $pdf->Cell(80, 7, 'Total ', 0, 0, 'R');
        $pdf->Cell(50, 7, 'Rp '.number_format($total_pembayaran,2,',','.'), 0, 1, 'L');

        $pdf->SetY(160);
        $pdf->SetX(250);
        $pdf->Cell(50, 7, 'Tulungagung, '.date("d F Y"), 0, 1, 'C');
        $pdf->Cell(50, 7, '', 0, 1, 'C');
        $pdf->Cell(50, 7, '', 0, 1, 'C');
        $pdf->SetX(250);
        $pdf->Cell(50, 7, $order[0]->nama_teknisi, 0, 1, 'C');
        $pdf->SetX(250);
        $pdf->Cell(50, 7, '(Teknisi)', 0, 1, 'C');
        
        $filename = 'Kuitansi_'.$order[0]->order_code.'_'.date("Ymdhis").'.pdf';
        
        $pdf->Output(FCPATH.'assets\\downloaded-pdf\\'.$filename,'F');
        force_download('./assets/downloaded-pdf/'.$filename,NULL);
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
	
	
	public function getOne($code='') {
		if($this->session->userdata('akses')=='1'){
			$this->load->model("M_Order");
			$this->load->model("M_ServiceType");
			$this->load->model("M_Review");

			if (isset($code)) {
				$data_order = $this->M_Order->getOne($code);
				$customer_wa = preg_replace("/^0/", "62", $data_order[0]->customer_phone);
				$technician_wa = preg_replace("/^0/", "62", $data_order[0]->technician_phone);
				$payment = $this->M_Order->getPayment($code);
				$data['customer_wa'] = $customer_wa;
				$data['technician_wa'] = $technician_wa;
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

			$this->load->view('admin/order_view', $data);
		} else if($this->session->userdata('akses')=='2'){
			$this->load->model("M_Order");
			$this->load->model("M_ServiceType");
			$this->load->model("M_Review");

			if (isset($code)) {
				$data_order = $this->M_Order->getOne($code);
				$customer_wa = preg_replace("/^0/", "62", $data_order[0]->customer_phone);
				$technician_wa = preg_replace("/^0/", "62", $data_order[0]->technician_phone);
				$payment = $this->M_Order->getPayment($code);
				$data['customer_wa'] = $customer_wa;
				$data['technician_wa'] = $technician_wa;
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

			$this->load->view('admin/order_view', $data);
		} else if($this->session->userdata('akses')=='3') {
			$this->load->model("M_Order");
			$this->load->model("M_ServiceType");
			$this->load->model("M_Review");

			if (isset($code)) {
				$data_order = $this->M_Order->getOne($code);
				$customer_wa = preg_replace("/^0/", "62", $data_order[0]->customer_phone);
				$payment = $this->M_Order->getPayment($code);
				$data['customer_wa'] = $customer_wa;
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
				$technician_wa = preg_replace("/^0/", "62", $data_order[0]->technician_phone);
				$data['technician_wa'] = $technician_wa;
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

	// public function createOrder($serviceDetailCode = '') {
	// 	if($this->session->userdata('akses')=='3'){

	// 		$this->load->model("M_Service");
			
	// 		if(isset($serviceDetailCode)) {
	// 			$data['data'] = $this->M_Service->getServiceDetailByCode($serviceDetailCode);
	// 			$this->load->view('customer/order_create_location', $data);
	// 		}

	// 	} else {
	// 		redirect('Controller_Login');
	// 	}
	// }

	// public function searchTechnician() {
	// 	$this->load->model("M_Order");
		
	// 	$foto_kerusakan = '';
	// 	$config['upload_path']          = './assets/uploaded-image/';
	// 	$config['allowed_types']        = '*';
	// 	$config['max_size']             = 3000;
	// 	$this->load->library('upload', $config);
	// 	if ( !$this->upload->do_upload('foto_kerusakan') ) {
	// 		$error = array('error' => $this->upload->display_errors());
	// 		$this->session->set_flashdata('error',$error['error']);
	// 		redirect('Controller_Order/preorder/'.$this->input->post('service_category_code'), 'refresh');
	// 	} else {
	// 		$image_data = $this->upload->data();
	// 		$imgdata = file_get_contents($image_data['full_path']);
	// 		$foto_kerusakan = base64_encode($imgdata);
	// 	}

	// 	$latitude =	$this->input->post('latitude');
	// 	$longitude = $this->input->post('longitude');
	// 	$service_category_code = $this->input->post('service_category_code');
	// 	$service_type_code = $this->input->post('service_type_code');

	// 	$data['jenis_layanan'] = $this->input->post('jenis_layanan');
	// 	$data['waktu_perbaikan'] = $this->input->post('waktu_perbaikan');
	// 	$data['alamat'] = $this->input->post('alamat');
	// 	$data['catatan_alamat'] = $this->input->post('catatan_alamat');
	// 	$data['foto_kerusakan'] = $foto_kerusakan;
	// 	$data['detail_keluhan'] = $this->input->post('detail_keluhan');
	// 	$data['metode_pembayaran'] = $this->input->post('metode_pembayaran');
	// 	$data['latitude'] = $this->input->post('latitude');
	// 	$data['longitude'] = $this->input->post('longitude');
	// 	$data['service_category_code'] = $this->input->post('service_category_code');
	// 	$data['service_type_code'] = $this->input->post('service_type_code');

	// 	$data['data'] = $this->M_Order->searchTechnician($latitude, $longitude, $service_type_code);
	// 	$this->listTechnician($data);
	// 	// $this->load->view('customer/order_result_technician', $data);
	// }

	// public function listTechnician($data = '') {
	// 	if(is_array($data) && count($data) > 0) {
			
	// 		$nearestTech = $data['data'];

	// 		$dataView['jenis_layanan'] = $data['jenis_layanan'];
	// 		$dataView['waktu_perbaikan'] = $data['waktu_perbaikan'];
	// 		$dataView['alamat'] = $data['alamat'];
	// 		$dataView['catatan_alamat'] = $data['catatan_alamat'];
	// 		$dataView['foto_kerusakan'] = $data['foto_kerusakan'];
	// 		$dataView['detail_keluhan'] = $data['detail_keluhan'];
	// 		$dataView['metode_pembayaran'] = $data['metode_pembayaran'];
	// 		$dataView['latitude'] = $data['latitude'];
	// 		$dataView['longitude'] = $data['longitude'];
	// 		$dataView['service_category_code'] = $data['service_category_code'];
	// 		$dataView['service_type_code'] = $data['service_type_code'];
	// 		$dataView['nearestTech'] = $nearestTech;

	// 		$this->load->view('customer/nearest_technician', $dataView);
	// 	} else {
	// 		echo "No result found";
	// 	}
	// }

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
		$data['technician_code'] = $this->input->post('tech_code');
		$data['service_category'] = $this->M_ServiceCategory->getServiceCategoryDetailByCode($this->input->post('service_category_code'));
		$data['service_type'] = $this->M_ServiceType->getServiceTypeDetailByCode($this->input->post('service_type_code'));
		$data['technician'] = $this->M_Technician->getTechnicianDetailByCode($this->input->post('tech_code'));

		// print_r($data['service_type'][0]->price);

		if ($this->input->post('jenis_layanan') == 'INSTALASI') {
			$service_type = $this->M_ServiceType->getInstalasiService($this->input->post('service_category_code'));
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
			$this->load->model("M_Order");

			$existing_repair_datetime = $this->M_Order->get_existing_repair_datetime($service_category_code, $this->session->userdata('user_code'));
			$service_category = $this->M_ServiceCategory->getServiceCategoryDetailByCode($service_category_code);
			$service_type_pemeliharaan = $this->M_ServiceType->getServiceTypeDetailByCodeAndType($service_category_code, 'PEMELIHARAAN');
			$isInstalasiExists = $this->M_ServiceType->isInstalasiExists($service_category_code);
			
			$data['service_category'] = $service_category;
			$data['service_type'] = $service_type_pemeliharaan;
			$data['isInstalasiExists'] = $isInstalasiExists;
			$data['existing_repair_datetime'] = $existing_repair_datetime;

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
		// $waktu_perbaikan = date_format(date_create_from_format("d/m/Y H.i", $this->input->post('waktu_perbaikan')),"Y-m-d H.i");
		$waktu_perbaikan = $this->input->post('waktu_perbaikan');
		$alamat = $this->input->post('alamat');
		$catatan_alamat = $this->input->post('catatan_alamat');
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

		$instalasi_pengecekan = $this->M_ServiceCategory->get_instalasi_pengecekan($code);

		//insert into tbl_order
		$data_tbl_order = [ 'order_code'  => $order_code,
		'customer_code' => $customer_code,
		'address' => $alamat,
		'address_note' => $catatan_alamat,
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
			if (!($instalasi_pengecekan[0]->code_pengecekan == '')) {
				$price = $instalasi_pengecekan[0]->price_pengecekan;
				$description = $instalasi_pengecekan[0]->pengecekan;
			} else {
				$price = '20000';
				$description = 'Pengecekan Tanpa Code';
			}
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

	// public function finishOrderByTech($order_code = '', $technician_code = '') {
 //        if ($this->session->userdata('akses') == '2') {
 //            $this->load->model("M_Order");
 //            $this->load->model("M_Technician");
 //            if (isset($order_code)) {
 //                $total_amount = $this->M_Order->getTotalPriceFromOrder($order_code);
 //                $phone = $this->M_Technician->getPhoneByCode($technician_code);
 //                $this->M_Order->updateStatus($order_code, 'FINISHED');
 //                $this->transferPaymentIntermediaryWallet('technician', $phone, $total_amount, $order_code);
 //                redirect('Controller_Order/getOneByCode/' . $order_code);
 //            }
 //        }
 //    }
	
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
    
    // public function approvedRequestByCustomer($order_code, $phone) {
    //     $this->load->model("M_Order");
    //     $this->load->model("T_Wallet");
    //     $this->load->model("M_General");
        
    //     $total_unpaid = $this->M_Order->getUnpaidOrderCustomer($order_code);
    //     $total_balance_customer = $this->T_Wallet->getCurrentBalance($phone);
    //     $is_approved = $this->input->post('is_approved');
        
    //     if ($is_approved == 1) {
    //         if ($total_balance_customer >= $total_unpaid) {
    //             //update status order detail to paid
    //             $data = [
    //                 'order_code' => $order_code,
    //                 'is_paid' => 1
    //             ];
    //             $this->M_General->updateData('tbl_order_detail', $data, 'order_code', $order_code);
                
    //             //update total price
    //             $total_price = $this->M_Order->getTotalPriceFromOrder($order_code);
    //             $data_order = [
    //                 'total_amount' => $total_price
    //             ];
    //             $this->M_General->updateData('tbl_order', $data_order, 'order_code', $order_code);
                
    //             $this->transferPaymentIntermediaryWallet('customer', $phone, $total_unpaid, $order_code);
    //         }
    //     } else {
    //         $this->M_General->deleteData('tbl_order_detail', 'order_code = \''.$order_code.'\' and is_paid = 0');
    //     }
        
    //     redirect('Controller_Order/getOneByCode/'.$order_code);
    // }
    
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
    	$this->load->model("M_Order");

    	$order = $this->M_Order->getOne($order_code);
    	if (!($order[0]->order_status == 'MENUNGGU KONFIRMASI') && !($this->session->userdata('user_code') == $order[0]->technician_code)) {
	    	$url=base_url('Controller_Order/getOneAfterOrderByCode/'.$order_code);
	        echo $this->session->set_flashdata('msg','Pesanan sudah diambil oleh teknisi lain');
	        redirect($url);
		} else if ($order[0]->order_status == 'DIBATALKAN') {
			$url=base_url('Controller_Order/getOneAfterOrderByCode/'.$order_code);
	        echo $this->session->set_flashdata('msg','Pesanan dibatalkan otomatis oleh sistem');
	        redirect($url);
	    } else {
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
    }

    public function confirmPayment($order_code) {
    	if ($this->session->userdata('akses') == '4') {
	    	$this->load->model("M_General");
	    	$receipt = '';
			$config['upload_path']          = './assets/uploaded-image/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 3000;
			$this->load->library('upload', $config);
			if ( !$this->upload->do_upload('receipt') ) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error',$error['error']);
				redirect('Controller_Order/getOne/'.$order_code, 'refresh');
			} else {
				$image_data = $this->upload->data();
				$imgdata = file_get_contents($image_data['full_path']);
				$receipt = base64_encode($imgdata);
			}

			$data_payment = [
				'payment_date' => date("Y-m-d H:i:s"),
				'receipt' => $receipt,
				'payment_status' => 'SUDAH UPLOAD'
			];
			$this->M_General->updateData('tbl_payment', $data_payment, 'order_code', $order_code);
	       	redirect('Controller_Order/getOne/'.$order_code);
       }
    }
    
    // public function rejectByAdmin($order_code) {
    //     if ($this->session->userdata('akses') == '1') {
    //         $this->load->model("M_General");
    //         $data = [
    //             'order_code' => $order_code,
    //             'order_status' => 'REJECTED BY ADMIN',
    //             'modified_by' => $this->session->userdata('code'),
    //             'modified_datetime' => date("Y-m-d h:i:sa", strtotime("now"))
    //         ];

    //         $this->M_General->updateData('tbl_order', $data, 'order_code', $order_code);
    //         redirect('Controller_Order/getWaitingConfirmationOrder');
    //     }
    // }

    public function cancel_order($order_code) {
    	$this->load->model("M_General");

    	$canceled_reason = $this->input->post('canceled_reason');

    	$data = [
                'order_status' => 'DIBATALKAN',
                'canceled_reason' => $canceled_reason,
                'modified_by' => $this->session->userdata('user_name'),
                'modified_datetime' => date("Y-m-d H:i:s")
            ];

       	$this->M_General->updateData('tbl_order', $data, 'order_code', $order_code);

       	redirect('Controller_Order/getAll/'.$this->session->userdata('user_code'));
    }
}