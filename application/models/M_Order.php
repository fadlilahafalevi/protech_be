<?php
class M_Order extends CI_Model{
	public function searchTechnician($latitude, $longitude, $service_code){
		$result=$this->db->query("SELECT * , (6371 * 2 * ASIN(SQRT( POWER(SIN(( $latitude - t.latitude) *  pi()/180 / 2), 2) +COS( $latitude * pi()/180) * COS(t.latitude * pi()/180) * POWER(SIN(( $longitude - t.longitude) * pi()/180 / 2), 2) ))) as distance, t.technician_code as tech_id FROM  tbl_technician t LEFT JOIN tbl_service_ref sr on sr.technician_code = t.technician_code WHERE sr.service_detail_code = '$service_code'  HAVING distance <= 10 ORDER BY distance");
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

	public function getAllByCustomerCode($code) {
		$this->db->select('o.*, c.fullname as customer_name, t.fullname as technician_name');
		$this->db->from('tbl_order o');
		$this->db->join('tbl_customer c', 'c.customer_code = o.customer_code', 'left');
		$this->db->join('tbl_technician t', 't.technician_code = o.technician_code', 'left');
		$this->db->where('o.customer_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllByTechnicianCode($code) {
		$this->db->select('o.*, c.fullname as customer_name, t.fullname as technician_name');
		$this->db->from('tbl_order o');
		$this->db->join('tbl_customer c', 'c.customer_code = o.customer_code', 'left');
		$this->db->join('tbl_technician t', 't.technician_code = o.technician_code', 'left');
		$this->db->where('o.technician_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getForTopUp($code) {
		$this->db->select('o.*, c.fullname as customer_name, t.fullname as technician_name');
		$this->db->from('tbl_order o');
		$this->db->join('tbl_customer c', 'c.customer_code = o.customer_code', 'left');
		$this->db->join('tbl_technician t', 't.technician_code = o.technician_code', 'left');
		$this->db->where('o.order_code', $code);
		$query = $this->db->get();
		return $query;
	}
	
	public function getOneByCode($code) {
	    $this->db->select('o.*, c.fullname as customer_name, t.fullname as technician_name');
	    $this->db->from('tbl_order o');
	    $this->db->join('tbl_customer c', 'c.customer_code = o.customer_code', 'left');
	    $this->db->join('tbl_technician t', 't.technician_code = o.technician_code', 'left');
	    $this->db->where('o.order_code', $code);
	    $query = $this->db->get();
	    return $query->result();
	}

	public function getDetailByCode($code) {
		$this->db->select('od.*, concat(sc.service_category_name, \' - \', sd.service_detail_name, \' - \', st.service_type_name) as service');
		$this->db->from('tbl_order_detail od');
		$this->db->join('tbl_service_type st', 'st.service_type_code = od.service_type_code', 'left');
		$this->db->join('tbl_service_detail sd', 'sd.service_detail_code = st.service_detail_code', 'left');
		$this->db->join('tbl_service_category sc', 'sc.service_category_code = sd.service_category_code', 'left');
		$this->db->where('od.order_code', $code);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getListNeedConfirmByCustomer($customer_code) {
	    $this->db->distinct();
	    $this->db->select('o.order_code, o.fix_datetime, concat(sc.service_category_name, \' - \', sd.service_detail_name) as service');
	    $this->db->from('tbl_order o');
	    $this->db->join('tbl_order_detail od', 'od.order_code = o.order_code', 'left');
	    $this->db->join('tbl_service_type st', 'st.service_type_code = od.service_type_code', 'left');
	    $this->db->join('tbl_service_detail sd', 'sd.service_detail_code = st.service_detail_code', 'left');
	    $this->db->join('tbl_service_category sc', 'sc.service_category_code = sd.service_category_code', 'left');
	    $this->db->where('o.customer_code', $customer_code);
	    $this->db->where('od.is_paid', 0);
	    $this->db->where('o.order_status', 'IN PROGRESS');
	    $query = $this->db->get();
	    return $query->result();
	}

	public function getListNeedConfirmationByTechCode($code) {
		$this->db->select('o.*');
		$this->db->from('tbl_order o');
		$this->db->where('o.order_status', 'WAITING CONFIRMATION')->where('o.technician_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOrderId() {
        $query = $this->db->query("SELECT concat(date_format(CURDATE(), '%Y%m%d'),'-',(SELECT LPAD((SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='tbl_order' and TABLE_SCHEMA = 'db_protech'), 4, '0'))) as auto_value");
        return $query->row()->auto_value;
    }

	public function checkUniqueNumber($unique_number) {
		$query=$this->db->query("SELECT count(*) as unique_number from tbl_payment_unique_code where unique_number = '$unique_number'");
		return $query->row()->unique_number;
	}

	public function getLastIdWithOrderCode($code) {
		$query=$this->db->query("SELECT MAX(id) as lastId from tbl_order_detail where order_code = '$code'");
		return $query->row()->lastId;
	}

	public function updateStatus($code, $status) {
		$result=$this->db->query("UPDATE `tbl_order` SET  order_status = '$status'  WHERE order_code = '$code'");
		return $result;
	}

	public function getUnpaidOrderCustomer($code) {
		$result=$this->db->query("SELECT sum(price) as total_price from tbl_order_detail where order_code = '$code' and is_paid = 0");
		return $result->row()->total_price;
	}
	
	public function getTotalPriceFromOrder($code) {
	    $result=$this->db->query("SELECT sum(price) as total_price from tbl_order_detail where order_code = '$code' and is_paid = 1");
	    return $result->row()->total_price;
	}
	
	public function getServiceTypeFromOrder($code) {
	    $this->db->select('od.service_type_code');
	    $this->db->from('tbl_order_detail od');
	    $this->db->where('od.order_code', $code);
	    $query = $this->db->get();
	    return $query->row()->service_type_code;
	}
	
	public function getTechnicianCodeFromOrder($order_code) {
	    $this->db->select('technician_code');
	    $this->db->from('tbl_order');
	    $this->db->where('order_code', $order_code);
	    $query = $this->db->get();
	    return $query->row()->technician_code;
	}
	
	public function getAverageRate($technician_code) {
	    $total_rate = $this->db->query("select sum(order_rate) as total_rate from tbl_order where technician_code = '$technician_code' group by technician_code")->row()->total_rate;
	    $total_order = $this->db->query("select count(*) as total_order from tbl_order where order_status = 'FINISHED' and order_rate is not null and technician_code = '$technician_code'")->row()->total_order;
	    
	    return $total_rate / $total_order;
	}
	
	public function getOrderByStatus($status) {
        $result = $this->db->query("select concat(c.fullname, ' (', c.phone, ')') as customer, concat(t.fullname, ' (', t.phone, ')') as technician, time_to_sec(timediff(now(), o.created_datetime)) / 3600 as hour_diff, o.* from tbl_order o left join tbl_customer c on c.customer_code = o.customer_code left join tbl_technician t on t.technician_code = o.technician_code where order_status = '$status'");
        // $result = $this->db->query("select concat(c.fullname, ' (', c.phone, ')') as customer, concat(t.fullname, ' (', t.phone, ')') as technician_name, time_to_sec(timediff(now(), o.created_datetime)) / 3600 as hour_diff, o.* from tbl_order o left join tbl_customer c on c.customer_code = o.customer_code left join tbl_technician t on t.technician_code = o.technician_code where order_status = 'WAITING CONFIRMATION'");
        return $result->result();
    }
}