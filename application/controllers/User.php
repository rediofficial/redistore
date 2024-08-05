<?php
class User extends CI_Controller {

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
        if ($this->session->userdata('role_id') != 3) {
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
        $this->load->helper('auth_helper');
        $this->load->model('Notification_Model');
        $this->load->library(array('form_validation', 'session'));
        check_role(3);
    }
    
    public function index() {
        $data['title'] = 'Beranda';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data['akun_ml'] = $this->Home_Model->get_akun();
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('user/header_user', array_merge($data, $data_user));
        $this->load->view('user/stok_akun', $data);
    }

    public function payment() {
        $data['title'] = 'Pembayaran';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $username = $this->session->userdata('username');
        
        // Pastikan session username ada
        if (!$username) {
            $this->session->set_flashdata('error', 'Terjadi kesalahan. Silakan login kembali.');
            redirect('auth/login');
        }
        
        $akun_ml_id = $this->input->post('akun_ml_id'); // Ambil ID akun yang dipilih dari form
        if (!$akun_ml_id) {
            $this->session->set_flashdata('error', 'Akun tidak ditemukan.');
            redirect('user/payment'); // Redirect ke halaman akun jika ID tidak ditemukan
        }
    
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $akun_ml = $this->Home_Model->get_akun_by_id($akun_ml_id); // Ambil data akun berdasarkan ID
        
        if (!$akun_ml) {
            $this->session->set_flashdata('error', 'Akun tidak ditemukan.');
            redirect('user/payment'); // Redirect ke halaman akun jika data akun tidak ditemukan
        }
    
        $dataml['akun_ml'] = array($akun_ml);   
        $dataml['username'] = $username;
        $dataml['tanggal_pesanan'] = date('Y-m-d');
        
        $this->load->view('user/header', array_merge($data, $data_user));
        $this->load->view('user/payment', $dataml);
    }

    public function payment_success() {
        $data['title'] = 'Pembayaran Sukses';     
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data['akun_ml'] = $this->Mlbb_Model->get_all_accounts($id_user);   
        $this->load->view('user/header', array_merge($data, $data_user));
        $this->load->view('user/payment_succes', $data);
    }

    public function create_transaction() {
        $id_user = $this->session->userdata('id_user');
        $username = $this->session->userdata('username'); // Pastikan `username` disimpan di session
        $akun_ml_id = $this->input->post('akun_ml_id'); // Mengambil akun_ml_id dari input
        // $status = 'Proses'; // Status default adalah Proses untuk pembuatan pesanan
        $tanggal_pesanan = date('Y-m-d H:i:s'); // Tanggal pesanan saat ini
        $metode_pembayaran = $this->input->post('metode_pembayaran');
        $harga = $this->input->post('harga');
        $kode_transaksi = $this->input->post('kode_transaksi');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
        $config['max_size'] = 2048;
        $config['file_name'] = $akun_ml_id. '_' . time();
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('bukti_transfer')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error);
            redirect('user/payment', $error);
        } else {
            $upload_data = $this->upload->data();
            $bukti_transfer = $upload_data['file_name'];
            // Ambil data akun ML berdasarkan akun_ml_id dari model
            $akun_ml = $this->User_Model->get_akunml_byid($akun_ml_id);
    
            // Pastikan akun ML valid
            if (!$akun_ml) {
                $this->session->set_flashdata('error', 'Akun ML tidak ditemukan.');
                redirect('user/payment');
            }
    
            // Update status akun ML menjadi 'Proses'
            // $this->Transaksi_Model->simpan_transaksi($kode_transaksi);
            $this->User_Model->update_transaction_status($akun_ml['kode_akun'], 'Proses');
    
            $kode_akun = $akun_ml['kode_akun']; 
            $harga = $akun_ml['harga'];
            $nama_akun = $akun_ml['nama_akun'];
            $harga = $akun_ml['harga'];
            $rank = $akun_ml['rank'];
            $jumlah_hero = $akun_ml['jumlah_hero'];
            $jumlah_skin = $akun_ml['jumlah_skin'];
            $deskripsi = $akun_ml['deskripsi'];
            $gambar1 = $akun_ml['gambar1'];

            $status = 'Proses'; // atau sesuaikan dengan logika bisnis Anda
            // Generate kode transaksi baru
            $kode_trx = $this->Transaksi_Model->get_next_transaction_number();

            // Debugging
            if (is_null($kode_akun) || is_null($harga)) {
                echo "Error: Kode akun atau harga tidak boleh null";
                var_dump($akun_ml);
                die();
            }
    
            // Data untuk diinsert
            $data = array(
                'kode_transaksi' => $kode_transaksi,
                'id_user' => $id_user,
                'username' => $username,
                'kode_akun' => $kode_akun,
                'harga' => $harga,
                'kode_trx' => $kode_trx,
                'rank' => $rank,
                'jumlah_hero' => $jumlah_hero,
                'jumlah_skin' => $jumlah_skin,
                'deskripsi' => $deskripsi,
                'gambar1' => $gambar1,

                'status' => $status,
                'nama_akun' => $nama_akun,
                'tanggal_pesanan' => $tanggal_pesanan,
                'metode_pembayaran' => $metode_pembayaran,
                'bukti_transfer' => $bukti_transfer
            );
            $this->db->insert('transaksi', $data);
            // Update status menjadi PROSES setelah insert
            $this->session->set_flashdata('success', 'Bukti transfer berhasil diupload. Silakan tunggu konfirmasi.');
            redirect('user/payment_success');
        }
    }
    
    public function riwayat_pesanan() {
        $data['title'] = 'Riwayat Pesanan';     
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $akun_ml_id = $this->input->post('kode_akun');
        $data['akun_ml'] = $this->Transaksi_Model->get_akun_by_transaksi($akun_ml_id);
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data['transaksi'] = $this->Transaksi_Model->get_transaksi_byiduser($id_user);   
        $this->load->view('user/header', array_merge($data, $data_user));
        $this->load->view('user/riwayat_pesanan', $data);
    }

    
    public function akun_detail() {
        // Ambil kode_transaksi dari parameter GET
        $kode_transaksi = $this->input->get('kode_transaksi');
        
        // Ambil data transaksi berdasarkan kode_transaksi
        $data['transaksi'] = $this->Transaksi_Model->get_trx_by_id($kode_transaksi);
    
        // Jika data tidak ditemukan, tampilkan pesan error
        if (empty($data['transaksi'])) {
            $this->session->set_flashdata('error', 'Data transaksi tidak ditemukan.');
            redirect('user/payment');
        }
    
        // Kirim data ke view
        $data['title'] = 'Detail Transaksi';
        $this->load->view('user/akun_detail', $data);
    }
    
    
    

    public function chat() {
        $data['title'] = 'Chat';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);       
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('user/header', array_merge($data, $data_user));
        $this->load->view('chat/chat');
    }
    
    public function profile() {
        // Load the profile view
        $data['title'] = 'Profile';
        $id_user = $this->session->userdata('id_user');
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $data_user['notifications'] = $this->Notification_Model->get_notifications($id_user);
        $data_user['notif_count'] = count($data_user['notifications']);        
        $data_user['user'] = $this->User_Model->get_user_by_id($id_user);
        $this->session->set_userdata('user_logged_in', true);
        $this->load->view('user/header_user', array_merge($data, $data_user));
        $this->load->view('user/profile', $data);
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
        $this->load->view('user/header_user', array_merge($data, $data_user));
        $this->load->view('user/profile', $data);
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
        $this->load->view('user/header_user', array_merge($data, $data_user));
        $this->load->view('user/profile', $data);
    }
    
    
           
}
