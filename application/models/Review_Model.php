<?php
class Review_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    public function get_all_reviews() {
        $query = $this->db->get('review');
        return $query->result_array();
    }
    
    public function create_review($data) {
        return $this->db->insert('review', $data);
    }
    public function get_latest_review_number() {
        $this->db->select('SUBSTRING(id_review, 3, 4) AS review_number');
        $this->db->order_by('review_number', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('review');
        $result = $query->row_array();
        return $result ? (int) $result['review_number'] : 0;
    }
    public function get_review_by_user($id_user) {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('review');
        return $query->row_array();
    }
    public function has_user_reviewed($id_user) {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('review');
        return $query->num_rows() > 0;
    }
    public function check_review_exists($id_review) {
        $this->db->where('id_review', $id_review);
        $query = $this->db->get('review');
        return $query->num_rows() > 0;
    }
}
?>
