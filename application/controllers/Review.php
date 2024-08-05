<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Review_Model');
        $this->load->model('Reply_Review_Model');
        $this->load->model('User_Model');
        $this->load->model('Notification_Model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Testimoni Orang!';
        $data['review'] = $this->Reply_Review_Model->get_all_reviews_with_replies(); // Mengambil ulasan dan balasan
        
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);                
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);

        // Check if the user has already reviewed in this session
        $data['has_reviewed'] = $this->session->userdata('has_reviewed') ? true : false;

        $this->load->view('user/header', array_merge($data, $data_user));
        $this->load->view('user/review', $data);
    }

    public function buat() {
        $id_user = $this->session->userdata('id_user');
    
        // Check if the user has already reviewed in this session
        if ($this->session->userdata('has_reviewed')) {
            $data['title'] = 'Review';
            $data['error'] = 'Anda sudah memberikan review. Logout dan masuk lagi untuk memberikan review baru.';
            $id_user = $this->session->userdata('id_user');
            $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
            $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
            $data_user['notif_count'] = count($data_user['notifications']);            
            $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
            $this->load->view('user/header', array_merge($data, $data_user));            
            $this->load->view('user/create_review', $data);
            return;
        }
    
        $this->form_validation->set_rules('rating', 'Rating', 'required|integer|greater_than[0]|less_than[6]');
        $this->form_validation->set_rules('comment', 'Comment', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Review';
            $id_user = $this->session->userdata('id_user');
            $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
            $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
            $data_user['notif_count'] = count($data_user['notifications']);      
            $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
            $this->load->view('user/header', array_merge($data, $data_user));
            $this->load->view('user/create_review', $data);
        } else {
            // Generate a unique review ID
            do {
                $latest_review_number = $this->Review_Model->get_latest_review_number();
                $new_review_number = $latest_review_number + 1;
                $formatted_number = str_pad($new_review_number, 4, '0', STR_PAD_LEFT);
                $rating = $this->input->post('rating');
                $id_review = $this->session->userdata('id_review');
                $kode_review = 'R' . str_pad($rating, 2, '0', STR_PAD_LEFT) . $formatted_number;
            } while ($this->Review_Model->check_review_exists($id_review));
    
            $data = array(
                'id_review' => $this->session->userdata('id_review'),
                'id_user' => $this->session->userdata('id_user'),
                'username' => $this->session->userdata('username'),
                'rating' => $this->input->post('rating'),
                'comment' => $this->input->post('comment'),
                'tanggal_rating' => date('Y-m-d H:i:s'),
                'kode_review' => $kode_review,

            );
            $this->Review_Model->create_review($data);
    
            // Set session to indicate the user has reviewed
            $this->session->set_userdata('has_reviewed', true);
            
            redirect('review/success');
        }
    }
    

    public function success() {
        $data['title'] = 'Review Success';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $this->load->view('user/header', array_merge($data, $data_user));
        $this->load->view('user/sukses_review', $data);
    }
}
