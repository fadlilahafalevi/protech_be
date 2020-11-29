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
		$this->db->select('th.phone as txn_phone, c.fullname as customer_name, t.fullname as technician_name, th.*');
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

	public function getTransactionByPhone($phone='') {
		$this->db->select('c.fullname as customer_name, t.fullname as technician_name, th.*');
		$this->db->from('tbl_transaction_history th');
		$this->db->join('tbl_customer c', 'c.phone = th.phone', 'left');
		$this->db->join('tbl_technician t', 't.phone = th.phone', 'left');
		$this->db->where('th.phone', $phone);
		$this->db->order_by("txn_datetime", "desc");
		$query = $this->db->get();
		return $query->result();
	}
}