<?php
class Admin_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function get_all_users() {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function get_user_by_id($id_user) {
        $query = $this->db->get_where('user', array('id_user' => $id_user));
        return $query->row_array();
    }

    public function add_user($data) {
        return $this->db->insert('user', $data);
    }

    public function update_user($id_user, $data) {
        $this->db->where('id_user', $id_user);
        return $this->db->update('user', $data);
    }

    public function delete_user($id_user) {
        $this->db->where('id_user', $id_user);
        return $this->db->delete('user');
    }

    public function block_user($id_user) {
        $data = array('is_blocked' => 1);
        $this->db->where('id_user', $id_user);
        return $this->db->update('user', $data);
    }

    public function unblock_user($id_user) {
        $data = array('is_blocked' => 0);
        $this->db->where('id_user', $id_user);
        return $this->db->update('user', $data);
    }
}