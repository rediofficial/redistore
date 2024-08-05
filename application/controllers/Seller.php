<?php
class Seller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load session library and URL helper
        $this->load->library('session');
        $this->load->helper('url');

        // Periksa apakah pengguna sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('login/authen');
        }

        // Periksa role pengguna
        if ($this->session->userdata('role_id') != 2) {
            show_error('Access Denied!', 403);
        }

        // Periksa waktu terakhir aktivitas pengguna
        $last_activity = $this->session->userdata('last_activity');
        if ($last_activity && (time() - $last_activity > $this->config->item('sess_expiration'))) {
            $this->session->sess_destroy();
            redirect('login/index');
        } else {
            $this->session->set_userdata('last_activity', time());
        }

        // Load required models
        // Load model dan library
        $this->load->model('User_Model');
        $this->load->model('Mlbb_Model');
        $this->load->model('Transaksi_Model');
        $this->load->model('Home_Model');
        $this->load->helper('url');
        $this->load->model('Notification_Model');
        $this->load->helper('auth_helper');
        $this->load->library(array('form_validation', 'session'));
        check_role(2);
    }
    
    public function index() {
        $data['title'] = 'Beranda';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $dataml['akun_ml'] = $this->Home_Model->get_akun();
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('seller/header', array_merge($dataml, $data, $data_user));
        $this->load->view('seller/stok_akun');
    }
    
    public function detail_akun() {
        $data['title'] = 'Detail Akun';
        $id_user = $this->session->userdata('id_user');
        $kode_akun = $this->input->post('kode_akun'); // Mengambil kode_akun dari POST
        
        log_message('debug', 'Kode Akun: ' . print_r($kode_akun, true));
        
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $dataml['akun_ml'] = $this->Home_Model->get_akun_by_kode($kode_akun); // Mengambil akun ML berdasarkan kode
        
        log_message('debug', 'Data Akun ML: ' . print_r($dataml['akun_ml'], true));
        
        // Jika dataml['akun_ml'] kosong, set ke array kosong
        if (is_null($dataml['akun_ml']) || !is_array($dataml['akun_ml'])) {
            $dataml['akun_ml'] = [];
        } else {
            $dataml['akun_ml'] = [$dataml['akun_ml']]; // Bungkus dalam array
        }
    
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('seller/header', array_merge($dataml, $data, $data_user));
        $this->load->view('seller/detail', array_merge($dataml, $data, $data_user));
    }
    
    
    

    public function chat() {
        $data['title'] = 'Chat';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('seller/header', array_merge($data, $data_user));
        $this->load->view('seller/chat');
    }
    public function form_akun() {
        $data['title'] = 'Posting Akun Baru';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $dataml['akun_ml'] = $this->Home_Model->get_akun();
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('seller/header', array_merge($dataml, $data, $data_user));
        $this->load->view('seller/posting_akun_baru');
    }

      // Menambahkan akun baru
    public function posting() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');

        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $dataml['akun_ml'] = $this->Home_Model->get_akun();
        $data['title'] = 'Posting Akun Baru';
    
        // Tambahkan aturan validasi untuk setiap input
        $this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required');
        $this->form_validation->set_rules('rank', 'Rank', 'required');
        $this->form_validation->set_rules('jumlah_hero', 'Jumlah Hero', 'required|integer');
        $this->form_validation->set_rules('jumlah_skin', 'Jumlah Skin', 'required|integer');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('seller/header', array_merge($dataml, $data, $data_user));
            $this->load->view('seller/posting_akun_baru');
        } else {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
    
            $this->upload->initialize($config);
    
            $images = [];
            for ($i = 1; $i <= 4; $i++) {
                if (!empty($_FILES['gambar' . $i]['name'])) {
                    if ($this->upload->do_upload('gambar' . $i)) {
                        $fileData = $this->upload->data();
                        $images['gambar' . $i] = $fileData['file_name'];
                    } else {
                        $data['error'] = $this->upload->display_errors();
                        $this->load->view('seller/header', array_merge($dataml, $data, $data_user));
                        $this->load->view('seller/posting_akun_baru', $data);
                        return;
                    }
                } else {
                    $images['gambar' . $i] = NULL;
                }
            }
    
            $postData = $this->input->post();
            $postData['gambar1'] = $images['gambar1'];
            $postData['gambar2'] = $images['gambar2'];
            $postData['gambar3'] = $images['gambar3'];
            $postData['gambar4'] = $images['gambar4'];
            $postData['id_user'] = $id_user;
            $postData['username'] = $data_user['user']->username; // Accessing property as object
    
            if ($this->Mlbb_Model->post_akun($postData)) {
                $this->session->set_flashdata('success', 'Akun berhasil diposting.');
                redirect('seller');
            } else {
                $data['error'] = 'Terjadi kesalahan saat menyimpan data akun.';
                $this->load->view('seller/header', array_merge($dataml, $data, $data_user));
                $this->load->view('seller/posting_akun_baru', $data);
            }
        }
    }
    public function riwayat_pesanan_seller() {
        $data['title'] = 'Riwayat Pesanan Seller'; 
        $id_user = $this->session->userdata('id_user');
            $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
            $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
            $data_user['notif_count'] = count($data_user['notifications']);    
        $id_penjual = $this->session->userdata('id_user'); // Asumsi ID penjual disimpan dalam session dengan nama 'id_user'
        $data_user['user'] = $this->User_Model->get_user_by_id($id_penjual);    
        $data['transaksi'] = $this->Transaksi_Model->get_transaksi();   
        $this->load->view('seller/header', array_merge($data, $data_user));
        $this->load->view('seller/riwayat_pesanan', $data);
    }

    public function detail() {
        $kode_transaksi = $this->input->get('kode_transaksi');
        log_message('debug', 'Kode transaksi: ' . $kode_transaksi);
        
        $data['transaksi'] = $this->Transaksi_Model->get_trx_by_id($kode_transaksi);
    
        if (empty($data['transaksi'])) {
            $this->session->set_flashdata('error', 'Data transaksi tidak ditemukan.');
            redirect('seller/riwayat_pesanan_seller');
        }
    
        $data['title'] = 'Detail Transaksi';
        $this->load->view('seller/akun_detail', $data);
    }
    
    
    public function update_status() {
        $kode_akun = $this->input->post('kode_akun');
        $status = $this->input->post('status');
        $kode_transaksi = $this->input->post('kode_transaksi');
        $ket = $this->input->post('ket');

        // Panggil model untuk memperbarui status akun
        $this->Mlbb_Model->update_status($kode_akun, $status);
        $this->Transaksi_Model->update_status_transaksi($kode_transaksi, $status, $ket);
        $this->Transaksi_Model->update_ket_transaksi($kode_transaksi, $ket);

        // Redirect kembali ke halaman riwayat pesanan
        redirect('seller/riwayat_pesanan_seller');
    }
    
    public function kelola_akun() {
        $data['title'] = 'Kelola Akun';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $akun_ml = $this->Home_Model->get_akun();
        $dataml['akun_ml'] = $akun_ml; 
        $data['transaksi'] = $this->Transaksi_Model->get_transaksi();
        $this->load->view('seller/header',  array_merge($data, $data_user, $dataml));
        $this->load->view('seller/kelola_akun', $data);
    }
  
    // Private function to handle image upload
    private function _upload_image($field_name) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field_name)) {
            // Return upload data
            return array('success' => true, 'file_name' => $this->upload->data('file_name'));
        } else {
            // Return failure indication
            return array('success' => false);
        }
    }

    public function confirm_edit_akun($akun_ml_id) {
        $data['title'] = 'Edit Akun';
        $data['akun_ml'] = $this->Mlbb_Model->get_akunml_kode($akun_ml_id);
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);
        $this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required');
        // Add more validation rules as needed
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('seller/header', array_merge($data, $data_user));
            $this->load->view('seller/edit_akun', $data);
        } else {
            $update_data = [
                'status' => $this->input->post('status'),
                'nama_akun' => $this->input->post('nama_akun'),
                'username' => $this->input->post('username'),
                'rank' => $this->input->post('rank'),
                'jumlah_hero' => $this->input->post('jumlah_hero'),
                'jumlah_skin' => $this->input->post('jumlah_skin'),
                'harga' => $this->input->post('harga'),
                'deskripsi' => $this->input->post('deskripsi')
            ];
    
            // Handle file uploads
            // Ensure your _upload_image function returns an array with 'success' and 'file_name'
            $upload_data = $this->_upload_image('gambar1');
            if ($upload_data['success']) {
                $update_data['gambar1'] = $upload_data['file_name'];
            }
    
            $upload_data = $this->_upload_image('gambar2');
            if ($upload_data['success']) {
                $update_data['gambar2'] = $upload_data['file_name'];
            }
    
            $upload_data = $this->_upload_image('gambar3');
            if ($upload_data['success']) {
                $update_data['gambar3'] = $upload_data['file_name'];
            }
    
            $upload_data = $this->_upload_image('gambar4');
            if ($upload_data['success']) {
                $update_data['gambar4'] = $upload_data['file_name'];
            }
    
            $this->Mlbb_Model->update_akun($akun_ml_id, $update_data);
            $this->session->set_flashdata('success', 'Akun berhasil diperbarui.');
            redirect('seller/kelola_akun');
        }
    }
    

    public function hapus_transaksi($kode_akun) {
        $this->load->model('Transaksi_model');
        if ($this->Transaksi_Model->hapus_transaksi($kode_akun)) {
            // Redirect atau tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Akun berhasil dihapus');
            redirect('seller/riwayat_pesanan_seller');
        } else {
            // Tampilkan pesan error
            echo "Gagal menghapus Transaksi";
        }
    }
      
     // Mengedit akun
     public function edit($akun_ml_id) {
        $data['akun_ml'] = $this->Mlbb_Model->get_akunml_kode($akun_ml_id);

        $this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('rank', 'Rank', 'required');
        $this->form_validation->set_rules('jumlah_hero', 'Jumlah Hero', 'required');
        $this->form_validation->set_rules('jumlah_skin', 'Jumlah Skin', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Edit Akun ML';
            $this->load->view('seller/edit_akun', $data);
        } else {
            $data = array(
                'status' => $this->input->post('status'),
                'nama_akun' => $this->input->post('nama_akun'),
                'gambar1' => $this->_upload_image('gambar1'),
                'gambar2' => $this->_upload_image('gambar2'),
                'gambar3' => $this->_upload_image('gambar3'),
                'gambar4' => $this->_upload_image('gambar4'),
                'username' => $this->input->post('username'),
                'rank' => $this->input->post('rank'),
                'jumlah_hero' => $this->input->post('jumlah_hero'),
                'jumlah_skin' => $this->input->post('jumlah_skin'),
                'harga' => $this->input->post('harga'),
                'deskripsi' => $this->input->post('deskripsi')
            );
            $this->Mlbb_Model->update_akun($akun_ml_id, $data);
            $this->session->set_flashdata('success', 'Akun berhasil diperbarui');
            redirect('seller/kelola_akun');
        }
    }
    // // Menghapus akun
    // public function hapus($kode_akun) {
    //     $this->Mlbb_Model->delete_akun($kode_akun);
    //     $this->session->set_flashdata('success', 'Akun berhasil dihapus');
    //     redirect('seller/kelola_akun');
    // }
 
    public function profile() {
        // Load the profile view
        $data['title'] = 'Profile';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('seller/header', array_merge($data, $data_user));
        $this->load->view('seller/profile', $data);
    }
    
    public function change_password() {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'Sandi Baru', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Sandi', 'required|matches[new_password]');
    
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
        } else {
            $id_user = $this->session->userdata('id_user');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
    
            // Verifikasi sandi saat ini
            if ($this->User_Model->verify_password($id_user, $current_password)) {
                // Ubah sandi
                $this->User_Model->update_password($id_user, $new_password);
                $data['success'] = 'Sandi berhasil diubah.';
            } else {
                $data['error'] = 'Sandi saat ini salah.';
            }
        }
            
        // Load view with data
        $data['title'] = 'Update Profil';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('seller/header', array_merge($data, $data_user));
        $this->load->view('seller/profile', $data);
    }
    
    public function update_profile() {
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
        } else {
            $id_user = $this->session->userdata('id_user');
            $full_name = $this->input->post('full_name');
            $email = $this->input->post('email');
    
            if ($this->User_Model->update_profile($id_user, $full_name, $email)) {
                $data['success'] = 'Profil berhasil diubah.';
            } else {
                $data['error'] = 'Terjadi kesalahan saat mengubah profil.';
            }
        }
            
        // Load view with data
        $data['title'] = 'Update Profil';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('seller/header', array_merge($data, $data_user));
        $this->load->view('seller/profile', $data);
    }
}