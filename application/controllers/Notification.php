<?php
class Notification extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('Notification_Model');
            $this->load->model('User_Model'); // Pastikan Anda memiliki User_Model untuk mendapatkan data user
        }
    
        // public function create() {
        //     $data['title'] = 'Buat Notif';
        //     $data['users'] = $this->User_Model->get_all_users();
        //     $id_user = $this->session->userdata('id_user');
        //     $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
    
        //     // Gabungkan data pengguna dan data judul
        //     $this->load->view('admin/header', array_merge($data, $data_user));
        //     $this->load->view('admin/create_notif', $data);
        // }

        public function create() {
            $data['title'] = 'Buat Notif';
            $data['users'] = $this->User_Model->get_all_users();
            $id_user = $this->session->userdata('id_user');
            $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
            $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
            $data_user['notif_count'] = count($data_user['notifications']);
    
            $this->load->view('admin/header', array_merge($data, $data_user));
            $this->load->view('admin/create_notif', $data);
        }
    
        public function store() {
            $id_user = $this->session->userdata('id_user');
            $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
            $this->form_validation->set_rules('id_user', 'User', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
        
            if ($this->form_validation->run() === FALSE) {
                $this->create();
            } else {
                $id_user = $this->input->post('id_user'); // Ambil id_user dari POST
                $message = $this->input->post('message'); // Ambil message dari POST
        
                // Debugging untuk memastikan nilai id_user dan message benar
                log_message('debug', 'ID User: ' . $id_user);
                log_message('debug', 'Message: ' . $message);
                $data = array(
                    'id_user' => $id_user,
                    'message' => $message
                );
        
                // Simpan notifikasi ke database
                $this->Notification_Model->create_notification($data);
                $this->session->set_flashdata('success', 'Notifikasi berhasil dikirim');
                redirect('notification/create', $data_user);
            }
        }
        
    
        public function index() {
            $id_user = $this->session->userdata('id_user');
            $data['notifications'] = $this->Notification_Model->get_notifications_by_user($id_user);
            $this->load->view('admin/notif', $data);
        }
        public function create_seller() {
            $data['title'] = 'Buat Notif';
            $data['users'] = $this->User_Model->get_all_users();
            $id_user = $this->session->userdata('id_user');
            $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
            $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
            $data_user['notif_count'] = count($data_user['notifications']);
            // Gabungkan data pengguna dan data judul
            $this->load->view('seller/header', array_merge($data, $data_user));
            $this->load->view('seller/create_notif', $data);
        }
       
        public function store_seller() {
            $id_user = $this->session->userdata('id_user');
            $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
            $this->form_validation->set_rules('message', 'Message', 'required');
        
            if ($this->form_validation->run() === FALSE) {
                $this->create();
            } else {
                $send_to_all = $this->input->post('send_to_all_hidden');
                $message = $this->input->post('message'); // Ambil message dari POST
        
                if ($send_to_all == '1') {
                    // Kirim ke semua user
                    $all_users = $this->User_Model->get_all_users();
                    foreach ($all_users as $user) {
                        $data = array(
                            'id_user' => $user->id_user,
                            'message' => $message
                        );
                        // Simpan notifikasi ke database
                        $this->Notification_Model->create_notification($data);
                   }
                    $this->session->set_flashdata('success', 'Notifikasi berhasil dikirim ke semua user');
                } else {
                    $id_user = $this->input->post('id_user'); // Ambil id_user dari POST
                    $data = array(
                        'id_user' => $id_user,
                        'message' => $message
                    );
                    // Simpan notifikasi ke database
                    $this->Notification_Model->create_notification($data);
                    $this->session->set_flashdata('success', 'Notifikasi berhasil dikirim');
                }
                redirect('notification/create_seller', $data_user);
            }
        }
        
}
?>
