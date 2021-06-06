<?php
class M_Token extends CI_Model{
	function getTokenData($token = ''){
		$this->db->select('*, tt.user_code as token_user_code');
		$this->db->from('tbl_token tt');
    	$this->db->join('tbl_user_login tul', 'tul.user_code = tt.user_code');
	    $this->db->where('tt.token', $token);
	    $this->db->order_by('tt.token_id','desc');
	    $this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	function getTokenDataByUsercode($user_code = ''){
		$this->db->select('*, tt.user_code as token_user_code');
		$this->db->from('tbl_token tt');
    	$this->db->join('tbl_user_login tul', 'tul.user_code = tt.user_code');
	    $this->db->where('tt.user_code', $user_code);
	    $this->db->order_by('tt.token_id','desc');
	    $this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	function generateRandomToken() {
		do {
			$random_token_query = $this->db->select('LPAD(FLOOR(RAND() * 999999.99), 6, \'0\') as random_token');
			// select LPAD(FLOOR(RAND() * 999999.99), 6, '0');
			$random_token_query = $this->db->get();
			$random_token = $random_token_query->result();

			$count_query = $this->db->select('count(*) as count');
			$count_query = $this->db->from('tbl_token tt');
			$count_query = $this->db->where('tt.token', $random_token[0]->random_token);
			$count_query = $this->db->get();
			$count = $count_query->result();

		} while ($count[0]->count > 0);

		return $random_token[0]->random_token;
	}
}