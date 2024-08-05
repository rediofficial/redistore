<?php
class Reply_Review_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Metode yang sudah ada tetap seperti sebelumnya...

    public function create_reply($data) {
        return $this->db->insert('review_replies', $data);
    }

    public function get_replies_by_review_id($id_review) {
        $this->db->where('id_review', $id_review);
        $query = $this->db->get('review_replies');
        return $query->result_array();
    }
    public function get_all_reviews_with_replies() {
        $this->db->select('review.*, review_replies.reply, review_replies.tanggal_reply');
        $this->db->from('review');
        $this->db->join('review_replies', 'review.id_review = review_replies.id_review', 'left');
        $this->db->order_by('review.tanggal_rating', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function delete_review($id_review) {
        // Hapus balasan terkait terlebih dahulu (jika ada)
        $this->db->where('id_review', $id_review);
        $this->db->delete('review_replies');

        // Hapus review
        return $this->db->where('id_review', $id_review)->delete('review');
    }

    
}
?>