<?php
class Reply_Review extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Reply_Review_Model');
        $this->load->model('User_Model');
        $this->load->model('Review_Model');
        $this->load->model('Notification_Model');
        $this->load->library('form_validation');
    }
    public function reply() {
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $this->form_validation->set_rules('id_review', 'Review ID', 'required');
        $this->form_validation->set_rules('reply', 'Reply', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array('success' => false, 'message' => 'Validation failed'));
        } else {
            $data = array(
                'id_review' => $this->input->post('id_review'),
                'id_user' => $id_user,
                'reply' => $this->input->post('reply'),
                'tanggal_reply' => date('Y-m-d H:i:s')
            );
    
            if ($this->Reply_Review_Model->create_reply($data)) {
                $reply_data = array(
                    'reply' => htmlspecialchars($data['reply']),
                    'tanggal_reply' => date('d F Y, H:i', strtotime($data['tanggal_reply']))
                );
                echo json_encode(array('success' => true, 'reply' => $reply_data['reply'], 'tanggal_reply' => $reply_data['tanggal_reply']));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to save reply'));
            }
        }
    }
    
    
    public function reviews() {
        $data['title'] = 'Reply Review';
        $data['review'] = $this->Reply_Review_Model->get_all_reviews_with_replies();
    
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
    
        $this->load->view('seller/header', array_merge($data, $data_user));
        $this->load->view('seller/reply_review', $data);
    }

 
    
    
}
?>