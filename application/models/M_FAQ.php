<?php
class M_FAQ extends CI_Model{
	function getAllFAQ(){
		$query = $this->db->get('tbl_faq');
		return $query->result();
	}

	public function getOneById($faq_code) {
		$this->db->select('*');
		$this->db->from('tbl_faq');
		$this->db->where('faq_code', $faq_code);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOneByQuestion($question) {
		$this->db->select('*');
		$this->db->from('tbl_faq');
		$this->db->where('faq_question', $question);
		$query = $this->db->get();
		return $query->row()->id;
	}

	public function getNextSequenceId() {
		$query=$this->db->query("SELECT AUTO_INCREMENT as auto_value FROM information_schema.tables WHERE table_name='tbl_faq' and TABLE_SCHEMA = 'db_protech'");
		return $query->row()->auto_value;
		 
	}

	function inputData($faqQuestion, $faqAnswer, $createdBy){
		$result=$this->db->query("INSERT INTO tbl_faq(faq_question, faq_answer, created_by, created_datetime) VALUES ('$faqQuestion','$faqAnswer','$createdBy', now())");
		return $result;
	}

	function updateData($id, $faqQuestion, $faqAnswer, $modifiedBy) {
		$result=$this->db->query("UPDATE tbl_faq SET faq_question='$faqQuestion', faq_answer='$faqAnswer', modified_by='$modifiedBy', modified_datetime=now() WHERE id='$id'");
		return $result;
	}
}