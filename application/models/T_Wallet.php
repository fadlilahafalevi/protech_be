<?php
class T_Wallet extends CI_Model{

	public function getAllTransaction() {
		$this->db->select('c.fullname as customer_name, t.fullname as technician_name, th.*');
		$this->db->from('tbl_transaction_history th');
		$this->db->join('tbl_customer c', 'c.phone = th.phone', 'left');
		$this->db->join('tbl_technician t', 't.phone = th.phone', 'left');
		$this->db->where('is_processed', '0');
		$this->db->order_by("txn_datetime", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function getTransactionHistoryById($id) {
		$this->db->select('c.fullname as customer_name, t.fullname as technician_name, th.*');
		$this->db->from('tbl_transaction_history th');
		$this->db->join('tbl_customer c', 'c.phone = th.phone', 'left');
		$this->db->join('tbl_technician t', 't.phone = th.phone', 'left');
		$this->db->where('th.id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getCurrentBalance($phone) {
		$query=$this->db->query("SELECT balance from tbl_wallet where phone = '$phone'");
		return $query->row()->balance;
	}

	public function getCurrentDebit($phone) {
		$query=$this->db->query("SELECT total_debit from tbl_wallet where phone = '$phone'");
		return $query->row()->total_debit;
	}

	public function getCurrentCredit($phone) {
		$query=$this->db->query("SELECT total_credit from tbl_wallet where phone = '$phone'");
		return $query->row()->total_credit;
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

	public function getListNeedConfirmationByTechCode($code) {
		$this->db->select('o.*');
		$this->db->from('tbl_order o');
		$this->db->where('o.order_status', 'WAITING CONFIRMATION')->where('o.technician_code', $code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOrderId() {
		$query=$this->db->query("SELECT concat(date_format(CURDATE(), '%Y%m%d'),'-',(SELECT LPAD((SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='tbl_order' and TABLE_SCHEMA = 'db_protech'), 4, '0'))) as auto_value");
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
}