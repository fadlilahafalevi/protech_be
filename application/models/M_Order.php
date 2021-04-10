<?php
class M_Order extends CI_Model{
	public function searchTechnician($latitude, $longitude, $service_code){
		$result=$this->db->query("SELECT *, @rownum := @rownum + 1 as row_number, (6371 * 2 * ASIN(SQRT( POWER(SIN(( $latitude - tup.latitude) *  pi()/180 / 2), 2) +COS( $latitude * pi()/180) * COS(tup.latitude * pi()/180) * POWER(SIN(( $longitude - tup.longitude) * pi()/180 / 2), 2) ))) as distance, tup.user_code as tech_id FROM tbl_user_profile tup cross join (select @rownum := 0) r LEFT JOIN tbl_service_ref sr on sr.user_code = tup.user_code WHERE sr.service_type_code = '$service_code'  ");
		//HAVING distance <= 10 ORDER BY distance
		return $result->result();
	}
	
	public function getAll($from, $to) {
	    $this->db->distinct();
	    $this->db->select('o.*, c.fullname as customer_name, t.fullname as technician_name, concat(sc.service_category_name, \' - \', sd.service_detail_name) as service');
	    $this->db->from('tbl_order o');
	    $this->db->join('tbl_customer c', 'c.customer_code = o.customer_code', 'left');
	    $this->db->join('tbl_technician t', 't.technician_code = o.technician_code', 'left');
	    $this->db->join('tbl_order_detail od', 'od.order_code = o.order_code', 'left');
	    $this->db->join('tbl_service_type st', 'st.service_type_code = od.service_type_code', 'left');
	    $this->db->join('tbl_service_detail sd', 'sd.service_detail_code = st.service_detail_code', 'left');
	    $this->db->join('tbl_service_category sc', 'sc.service_category_code = sd.service_category_code', 'left');
        $this->db->where('o.created_datetime >=', $from);
        $this->db->where('o.created_datetime <=', $to);
	    $query = $this->db->get();
// 	    print_r($this->db->last_query());
	    return $query->result();
	}

	public function getOne($code) {
		$this->db->distinct();
		$this->db->select('o.*, sc.*, concat(upt.first_name, \' \', upt.middle_name, \' \', upt.last_name) as nama_teknisi, concat(upc.first_name, \' \', upc.middle_name, \' \', upc.last_name) as nama_customer ');
		$this->db->from('tbl_order o');
    	$this->db->join('tbl_order_detail od', 'od.order_code=o.order_code');
    	$this->db->join('tbl_service_type st', 'st.service_type_code = od.service_type_code');
    	$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
    	$this->db->join('tbl_user_profile upc', 'upc.user_code = o.customer_code');
    	$this->db->join('tbl_user_profile upt', 'upt.user_code = o.technician_code');
    	$this->db->where('o.order_code', $code);
	    $this->db->order_by('o.created_datetime','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getOrderDetailByOrderCode($code) {
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('tbl_order_detail od');
    	$this->db->join('tbl_service_type st', 'st.service_type_code = od.service_type_code');
    	$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
    	$this->db->where('od.order_code', $code);
	    $this->db->order_by('od.created_datetime','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllByCustomerCode($code) {
		$this->db->distinct();
		$this->db->select('o.*, sc.*');
		$this->db->from('tbl_order o');
    	$this->db->join('tbl_order_detail od', 'od.order_code=o.order_code');
    	$this->db->join('tbl_service_type st', 'st.service_type_code = od.service_type_code');
    	$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
    	$this->db->where('customer_code', $code);
	    $this->db->order_by('o.created_datetime','desc');    
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllByTechnicianCode($code) {
		$this->db->distinct();
		$this->db->select('o.*, sc.*');
		$this->db->from('tbl_order o');
    	$this->db->join('tbl_order_detail od', 'od.order_code=o.order_code');
    	$this->db->join('tbl_service_type st', 'st.service_type_code = od.service_type_code');
    	$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
    	$this->db->where('technician_code', $code);
	    $this->db->order_by('o.created_datetime','desc');    
		$query = $this->db->get();
		return $query->result();
	}

	function getAllOrder(){
		$this->db->select('*');
		$this->db->from('tbl_order o');
    	$this->db->join('tbl_order_detail od', 'od.order_code=o.order_code');
	    $this->db->order_by('o.created_datetime','asc');    
		$query = $this->db->get();
		return $query->result();
	}

	function getOrderDetailAfterOrderByCode($order_code) {
		$this->db->select('*, concat(upt.first_name, \' \', upt.middle_name, \' \', upt.last_name) as nama_teknisi, concat(upc.first_name, \' \', upc.middle_name, \' \', upc.last_name) as nama_customer ');
		$this->db->from('tbl_order o');
    	$this->db->join('tbl_order_detail od', 'od.order_code=o.order_code');
    	$this->db->join('tbl_user_profile upc', 'upc.user_code = o.customer_code');
    	$this->db->join('tbl_user_profile upt', 'upt.user_code = o.technician_code');
    	$this->db->join('tbl_service_type st', 'st.service_type_code = od.service_type_code');
    	$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
		$this->db->where('o.order_code', $order_code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getCountOrderNeedConfirmationByTechCode($technician_code='') {
		$this->db->select('count(*) as count');
		$this->db->from('tbl_order o');
	    $this->db->where('order_status','MENUNGGU KONFIRMASI');
	    $this->db->where('technician_code', $technician_code);
		$query = $this->db->get();
		return $query->row()->count;
	}

	public function getOrderNeedConfirmationByTechCode($technician_code='') {
		$this->db->select('*, concat(upc.first_name, \' \', upc.middle_name, \' \', upc.last_name) as nama_customer ');
		$this->db->from('tbl_order o');
    	$this->db->join('tbl_order_detail od', 'od.order_code=o.order_code');
    	$this->db->join('tbl_user_profile upc', 'upc.user_code = o.customer_code');
    	$this->db->join('tbl_user_profile upt', 'upt.user_code = o.technician_code');
    	$this->db->join('tbl_service_type st', 'st.service_type_code = od.service_type_code');
    	$this->db->join('tbl_service_category sc', 'sc.service_category_code = st.service_category_code');
	    $this->db->where('order_status','MENUNGGU KONFIRMASI');
	    $this->db->where('technician_code', $technician_code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getPayment($order='') {
		$this->db->select('*');
		$this->db->from('tbl_payment');
	    $this->db->where('order_code', $order);
		$query = $this->db->get();
		return $query->result();
	}
}