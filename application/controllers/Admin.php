<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        if ($this->session->userdata('role_id') != 1) {
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
        $this->load->model('User_Model');
        $this->load->model('Komplain_Model');
        $this->load->model('Transaksi_Model');
        $this->load->model('Mlbb_Model');
        $this->load->model('Admin_Model');
        $this->load->model('Review_Model');
        $this->load->model('Notification_Model');
        $this->load->model('Home_Model');
        $this->load->model('Reply_Review_Model');
        $this->load->helper('url');
        $this->load->helper('auth_helper');
        $this->load->library(array('form_validation', 'session'));
        check_role(1);
    }
    

    public function index() {
        $data['title'] = 'Beranda';
        $id_user = $this->session->userdata('id_user');
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);
        $data['user'] = $this->User_Model->get_user_by_id($id_user);
        $data['review'] = $this->Komplain_Model->get_all_complaints();
        $data['transaksi'] = $this->Transaksi_Model->get_transaksi();
        
        $this->load->view('admin/header', array_merge($data, $data_user));
        $this->load->view('admin/dashboard', $data);
    }

    public function view_complaints() {
        $data['review'] = $this->Komplain_Model->get_all_complaints();
        $this->load->view('admin/header');
        $this->load->view('admin/view_complaints', $data);
        $this->load->view('admin/footer');
    }

    public function kelola_akun() {
        $data['title'] = 'Kelola Akun';
        $id_user = $this->session->userdata('id_user');
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $akun_ml = $this->Home_Model->get_akun();
        $dataml['akun_ml'] = $akun_ml; 
        $data['transaksi'] = $this->Transaksi_Model->get_transaksi();
        $this->load->view('admin/header',  array_merge($data, $data_user, $dataml));
        $this->load->view('admin/kelola_akun', $data);
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
        $id_user = $this->session->userdata('id_user');
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);
        $data['akun_ml'] = $this->Mlbb_Model->get_akunml_kode($akun_ml_id);
    
        $this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required');
        // Add more validation rules as needed
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/header', array_merge($data, $data_user));
            $this->load->view('admin/edit_akun', $data);
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
            redirect('admin/kelola_akun');
        }
    }
    
    public function hapus_transaksi($kode_transaksi) {
        if ($this->Transaksi_Model->hapus_transaksi($kode_transaksi)) {
            $this->session->set_flashdata('success', 'Akun berhasil dihapus');
            redirect('admin/riwayat_pesanan');

        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus akun');
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
            $this->load->view('admin/edit_akun', $data);
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
            redirect('admin/kelola_akun');
        }
    }
      // Menghapus akun
      public function hapus($kode_akun) {
        $this->Mlbb_Model->delete_akun($kode_akun);
        $this->session->set_flashdata('success', 'Akun berhasil dihapus');
        redirect('admin/kelola_akun');
    }
    
    public function riwayat_pesanan() {
        $data['title'] = 'Riwayat Pesanan';     
        $id_penjual = $this->session->userdata('id_user'); // Asumsi ID penjual disimpan dalam session dengan nama 'id_user'
        $id_user = $this->session->userdata('id_user');
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);
        $data_user['user'] = $this->User_Model->get_user_by_id($id_penjual);
        $data['transaksi'] = $this->Transaksi_Model->get_transaksi();   
        $this->load->view('admin/header', array_merge($data, $data_user));
        $this->load->view('admin/riwayat_pesanan', $data);
    }

    public function detail() {
        $kode_transaksi = $this->input->get('kode_transaksi');
        log_message('debug', 'Kode transaksi: ' . $kode_transaksi);
        
        $data['transaksi'] = $this->Transaksi_Model->get_trx_by_id($kode_transaksi);
    
        if (empty($data['transaksi'])) {
            $this->session->set_flashdata('error', 'Data transaksi tidak ditemukan.');
            redirect('admin/riwayat_pesanan');
        }
    
        $data['title'] = 'Detail Transaksi';
        $this->load->view('admin/akun_detail', $data);
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
        redirect('admin/riwayat_pesanan');
    }
    public function profile() {
        // Load the profile view
        $data['title'] = 'Profile';
        $id_user = $this->session->userdata('id_user');
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('admin/header', array_merge($data, $data_user));
        $this->load->view('admin/profile', $data);
    }
    
    public function change_password() {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'Sandi Baru', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Sandi', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/profile');
        } else {
            $id_user = $this->session->userdata('id_user');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            // Verifikasi sandi saat ini
            if ($this->User_Model->verify_password($id_user, $current_password)) {
                // Ubah sandi
                $this->User_Model->update_password($id_user, $new_password);
                $this->session->set_flashdata('success', 'Sandi berhasil diubah.');
            } else {
                $this->session->set_flashdata('error', 'Sandi saat ini salah.');
            }
            redirect('admin/profile');
        }
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
        $this->load->view('admin/header', array_merge($data, $data_user));
        $this->load->view('admin/profile', $data);
    }
    public function kelola_user() {
        $data['title'] = 'Kelola User';
        $id_user = $this->session->userdata('id_user');
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data['users'] = $this->Admin_Model->get_all_users();
        $this->load->view('admin/header', array_merge($data, $data_user));
        $this->load->view('admin/kelola_user', $data);
    }

    public function add_user() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('nomer_hp', 'Nomor HP', 'required');
        $this->form_validation->set_rules('alamat_user', 'Alamat', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Kelola User';
            $this->load->view('admin/add_user', $data);
        } else {
            $data = array(
                'id_user' => uniqid(),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'full_name' => $this->input->post('full_name'),
                'nomer_hp' => $this->input->post('nomer_hp'),
                'alamat_user' => $this->input->post('alamat_user'),
                'role_id' => $this->input->post('role_id'),
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->Admin_Model->add_user($data);
            redirect('admin/kelola_user');
        }
    }

    public function edit_user($id_user) {
        $id_user_session = $this->session->userdata('id_user');
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user_session);
        $data_user['notif_count'] = count($data_user['notifications']);
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user_session);
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('nomer_hp', 'Nomor HP', 'required');
        $this->form_validation->set_rules('alamat_user', 'Alamat', 'required');
        $this->form_validation->set_rules('role_id', 'Role Id', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            $data['user'] = $this->Admin_Model->get_user_by_id($id_user);
            $data['title'] = 'Edit User';
            $this->load->view('admin/header', array_merge($data, $data_user));
            $this->load->view('admin/edit_user', $data);
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'full_name' => $this->input->post('full_name'),
                'nomer_hp' => $this->input->post('nomer_hp'),
                'alamat_user' => $this->input->post('alamat_user'),
                'role_id' => $this->input->post('role_id'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->Admin_Model->update_user($id_user, $data);
            redirect('admin/kelola_user');
        }
    }

    public function delete_user($id_user) {
        $this->Admin_Model->delete_user($id_user);
        redirect('admin/kelola_user');
    }

    public function block_user($id_user) {
        $this->Admin_Model->block_user($id_user);
        redirect('admin/kelola_user');
    }

    public function unblock_user($id_user) {
        $this->Admin_Model->unblock_user($id_user);
        redirect('admin/kelola_user');
    }
    public function review() {
        $data['title'] = 'Kelola Review';
        $data['review'] = $this->Reply_Review_Model->get_all_reviews_with_replies(); // Mengambil ulasan dan balasan
        
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);

        // Check if the user has already reviewed in this session
        $data['has_reviewed'] = $this->session->userdata('has_reviewed') ? true : false;

        $this->load->view('admin/header', array_merge($data, $data_user));
        $this->load->view('admin/review', $data);
    }

    public function delete_review() {
        $id_review = $this->input->post('id_review');

        if ($this->Reply_Review_Model->delete_review($id_review)) {
            $this->session->set_flashdata('message', 'Review deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete review');
        }
        redirect('admin/review');
    }
    

}
?>
