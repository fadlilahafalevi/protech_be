<?php
class T_Wallet extends CI_Model{

	public function getAllTransaction() {
	    $query = $this->db->query("select th.*, w.user_code, c.fullname as customer_name, t.fullname as technician_name from tbl_transaction_history th left join tbl_wallet w on w.phone = th.to_phone left join tbl_customer c on c.phone = w.phone left join tbl_technician t on t.phone = w.phone where txn_code = 'TOPU' and is_processed = 0 union all select th.*, w.user_code, c.fullname as customer_name, t.fullname as technician_name from tbl_transaction_history th left join tbl_wallet w on w.phone = th.to_phone left join tbl_customer c on c.phone = w.phone left join tbl_technician t on t.phone = w.phone where txn_code = 'WDRW' and is_processed = 0");
	    return $query->result();
	}

	public function getTransactionHistoryById($id) {
	    $query = $this->db->query("select * from (select th.*, w.user_code, c.fullname as customer_name, t.fullname as technician_name from tbl_transaction_history th left join tbl_wallet w on w.phone = th.to_phone left join tbl_customer c on c.phone = w.phone left join tbl_technician t on t.phone = w.phone where txn_code = 'TOPU' and is_processed = 0 union all select th.*, w.user_code, c.fullname as customer_name, t.fullname as technician_name from tbl_transaction_history th left join tbl_wallet w on w.phone = th.to_phone left join tbl_customer c on c.phone = w.phone left join tbl_technician t on t.phone = w.phone where txn_code = 'WDRW' and is_processed = 0) trans where trans.id = $id");
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
	    $query = $this->db->query("select * from (select * from tbl_transaction_history where from_phone = '$phone' union all select * from tbl_transaction_history where to_phone = '$phone') as hist order by hist.txn_datetime desc");
	    return $query->result();
	}
}