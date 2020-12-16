<?php
class T_Wallet extends CI_Model{

    public function getAllNonProcessedTransaction() {
        $query = $this->db->query("select
    H.id as id,
	H.order_code,
    H.txn_code,
	H.from_phone,
	case
		when H.from_phone = C.phone then concat(C.fullname, ' (CUSTOMER)')
		when H.from_phone = T.phone then concat(T.fullname, ' (TECHNICIAN)')
		when H.from_phone = A.phone then '(INTERMEDIARY ACCOUNT)'
		when H.from_phone is null
		and H.txn_code = 'TOPU' then concat(H.bank_name, ' ', H.account_name)
		else null
	end as NAME_FROM,
	H.to_phone,
	case
		when H.to_phone = C.phone then concat(C.fullname, ' (CUSTOMER)')
		when H.to_phone = T.phone then concat(T.fullname, ' (TECHNICIAN)')
		when H.to_phone = A.phone then '(INTERMEDIARY ACCOUNT)'
		when H.to_phone is null
		and H.txn_code = 'WDRW' then concat(H.bank_name, ' ', H.account_name)
		else null
	end as NAME_TO,
	H.txn_code,
	H.txn_amount,
	H.txn_datetime
from
	tbl_transaction_history H
left join tbl_customer C on
	(C.phone = H.from_phone
	or C.phone = H.to_phone)
left join tbl_technician T on
	(T.phone = H.from_phone
	or T.phone = H.to_phone)
left join tbl_admin A on
	(A.phone = H.from_phone
	or A.phone = H.to_phone)
where h.is_processed = 0
order by
	H.txn_datetime desc");
        return $query->result();
    }
    
    public function getAllTransaction($from, $to) {
        $query = $this->db->query("select
    H.id as id,
	H.order_code,
    H.txn_code,
	H.from_phone,
	case
		when H.from_phone = C.phone then concat(C.fullname, ' (CUSTOMER)')
		when H.from_phone = T.phone then concat(T.fullname, ' (TECHNICIAN)')
		when H.from_phone = A.phone then '(INTERMEDIARY ACCOUNT)'
		when H.from_phone is null
		and H.txn_code = 'TOPU' then concat(H.bank_name, ' ', H.account_name)
		else null
	end as NAME_FROM,
	H.to_phone,
	case
		when H.to_phone = C.phone then concat(C.fullname, ' (CUSTOMER)')
		when H.to_phone = T.phone then concat(T.fullname, ' (TECHNICIAN)')
		when H.to_phone = A.phone then '(INTERMEDIARY ACCOUNT)'
		when H.to_phone is null
		and H.txn_code = 'WDRW' then concat(H.bank_name, ' ', H.account_name)
		else null
	end as NAME_TO,
	H.txn_code,
	H.txn_amount,
	H.txn_datetime
from
	tbl_transaction_history H
left join tbl_customer C on
	(C.phone = H.from_phone
	or C.phone = H.to_phone)
left join tbl_technician T on
	(T.phone = H.from_phone
	or T.phone = H.to_phone)
left join tbl_admin A on
	(A.phone = H.from_phone
	or A.phone = H.to_phone)
where H.txn_datetime >= '$from' and H.txn_datetime <= '$to'
order by
	H.txn_datetime desc");
        return $query->result();
    }

	public function getTransactionHistoryById($id) {
        $query = $this->db->query("select
	H.id as id,
    H.receipt,
	H.order_code,
	H.from_phone,
	case
		when H.from_phone = C.phone then concat(C.fullname, ' (CUSTOMER)')
		when H.from_phone = T.phone then concat(T.fullname, ' (TECHNICIAN)')
		when H.from_phone = A.phone then '(INTERMEDIARY ACCOUNT)'
		when H.from_phone is null
		and H.txn_code = 'TOPU' then concat(H.bank_name, ' ', H.account_name)
		else null
	end as NAME_FROM,
	H.to_phone,
	case
		when H.to_phone = C.phone then concat(C.fullname, ' (CUSTOMER)')
		when H.to_phone = T.phone then concat(T.fullname, ' (TECHNICIAN)')
		when H.to_phone = A.phone then '(INTERMEDIARY ACCOUNT)'
		when H.to_phone is null
		and H.txn_code = 'WDRW' then concat(H.bank_name, ' ', H.account_name)
		else null
	end as NAME_TO,
	H.txn_code,
	H.txn_amount,
	H.txn_datetime
from
	tbl_transaction_history H
left join tbl_customer C on
	(C.phone = H.from_phone
	or C.phone = H.to_phone)
left join tbl_technician T on
	(T.phone = H.from_phone
	or T.phone = H.to_phone)
left join tbl_admin A on
	(A.phone = H.from_phone
	or A.phone = H.to_phone)
where h.id = $id");
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
	
	public function getTechnicianBalanceList() {
	    $query = $this->db->query("select t.fullname, w.phone, w.balance, w.total_credit, w.total_debit from tbl_wallet w inner join tbl_technician t on t.phone = w.phone order by balance desc");
	    return $query->result();
	}
}