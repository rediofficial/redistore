<?php
class Komplain_Model extends CI_Model {

    public function get_all_complaints() {
        $query = $this->db->get('review');
        return $query->result_array();
    }

    // Additional complaint-related functions here
}
?>
