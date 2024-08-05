<?php
class Notification_Model  extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create_notification($data) {
        return $this->db->insert('notifications', $data);
    }

    public function get_notifications_by_user($id_user) {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('notifications');
        return $query->result();
    }
    public function get_notifications($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('notifications');
        return $query->result();
    }

}
?>
