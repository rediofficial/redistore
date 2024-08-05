<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load model dan library yang dibutuhkan
        $this->load->model('Login_Model');
        $this->load->model('Mlbb_Model');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'session'));
    }


    public function index() {
        // Load halaman login
		$data['title'] = 'Login';
		// $data['product'] = $this->model_pembayaran->get('product')->result();
		$this->load->view('auth/login', $data);
        
    }
    public function register() {
    // Set rules untuk validasi form
    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

    if ($this->form_validation->run() === FALSE) {
        // Jika validasi gagal, tampilkan form registrasi lagi
        $data['title'] = 'Register';
        $this->load->view('auth/register', $data);
    } else {
        // Jika validasi berhasil, simpan data ke database
        // $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $data = array(
            'full_name' => $this->input->post('full_name'),
            'nomer_hp' => $this->input->post('nomer_hp'),
            'alamat_user' => $this->input->post('alamat_user'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'role_id' => 3 // Set role_id default ke 3
        );

        if ($this->Login_Model->register($data)) {
            // Jika registrasi berhasil, arahkan ke halaman login
            $this->session->set_flashdata('message', 'Registration successful! Please login.');
            redirect('login/register');
        } else {
            // Jika registrasi gagal, tampilkan pesan error
            $this->session->set_flashdata('message', 'Registration failed. Please try again.');
            redirect('login/register');
        }
    }
    }

    public function authen() {
        // Form validation
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $data['title'] = 'Login';
        if ($this->form_validation->run() == false) {
            // Display login form with validation errors
            $this->load->view('auth/login', $data);
        } else {
            // Validate credentials
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            $user = $this->Login_Model->get_user_by_email($email);
    
            if ($user) {
                if ($user['is_blocked']) {
                    // Account is blocked
                    $this->session->set_flashdata('login_failed', 'Akun Anda diblokir!');
                    $this->load->view('auth/login', $data);
                } else {
                    if ($this->Login_Model->verify_password($password, $user['password'])) {
                        // Set session data
                        $user_data = array(
                            'id_user' => $user['id_user'],
                            'email' => $user['email'],
                            'username' => $user['username'], // Tambahkan `username` ke session
                            'role_id' => $user['role_id'],
                            'logged_in' => TRUE
                        );
                        $this->session->set_userdata($user_data);
    
                        // Redirect based on user role
                        if ($user['role_id'] == 1) {
                            redirect('admin'); // Admin dashboard
                        } elseif ($user['role_id'] == 2) {
                            redirect('seller'); // Seller dashboard
                        } elseif ($user['role_id'] == 3) {
                            redirect('user'); // User dashboard
                        } else {
                            show_error('Invalid role!');
                        }
                    } else {
                        // Incorrect password
                        $this->session->set_flashdata('login_failed', 'Password salah!');
                        $this->load->view('auth/login', $data);
                    }
                }
            } else {
                // Email not found
                $this->session->set_flashdata('login_failed', 'Email tidak ditemukan!');
                $this->load->view('auth/login', $data);
            }
        }
    }
    
    
        public function forgot_password() {
            // Set rules untuk validasi form
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $data['title'] = 'Reset Password';
            if ($this->form_validation->run() === FALSE) {
                // Jika validasi gagal, tampilkan form lupa password lagi
                $this->load->view('auth/lupa_pw', $data);
            } else {
                // Jika validasi berhasil, cek keberadaan email di database
                $email = $this->input->post('email');
                $user = $this->Login_Model->get_user_by_email($email);
        
                if (!$user) {
                    // Jika email tidak ditemukan dalam database
                    $this->session->set_flashdata('message', 'Email tidak ditemukan.');
                    redirect('login/forgot_password', $data);
                } else {
                    // Generate token untuk reset password
                    $token = bin2hex(random_bytes(32));
        
                    // Simpan token ke database untuk user tertentu
                    if ($this->Login_Model->save_reset_token($user['id_user'], $token)) {
                        log_message('debug', 'Reset token saved successfully for user ID: ' . $user['id_user']);
                        // Kirim email reset password (implementasi email tidak disertakan dalam contoh ini)
                        $this->send_reset_password_email($email, $token);
        
                        // Redirect ke halaman sukses atau form reset password
                        $this->session->set_flashdata('message', 'Silakan periksa email Anda untuk petunjuk pengaturan ulang kata sandi');
                        redirect('login/forgot_password', $data);
                    } else {
                        log_message('error', 'Failed to save reset token for user ID: ' . $user['id_user']);
                        $this->session->set_flashdata('message', 'Gagal membuat token setel ulang. Silakan coba lagi nanti.');
                        redirect('login/forgot_password', $data);
                    }
                }
            }
        }
        
        
        public function reset_password($token) {
            // Verifikasi token reset password
            $user = $this->Login_Model->get_user_by_token($token);
        
            if (!$user) {
                // Jika token tidak valid atau user tidak ditemukan
                $this->session->set_flashdata('message', 'Invalid token.');
                log_message('error', 'Invalid token: ' . $token);
                redirect('login');
            }
        
            // Set rules untuk validasi form reset password
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        
            if ($this->form_validation->run() === FALSE) {
                // Jika validasi gagal, tampilkan form reset password
                $data['token'] = $token;
                log_message('debug', 'Form validation failed for token: ' . $token);
                $this->load->view('auth/reset_pw', $data);
            } else {
                // Jika validasi berhasil, reset password
                $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                $this->Login_Model->reset_password($user['id_user'], $password, $token);
                log_message('debug', 'Reset kata sandi berhasil untuk ID pengguna: ' . $user['id_user']);
        
                // Berhasil reset password, arahkan ke halaman login
                $this->session->set_flashdata('message', 'Penyetelan ulang kata sandi berhasil! Silakan login dengan kata sandi baru Anda.');
                redirect('login');
            }
        }
        
        

        public function send_reset_password_email($email, $reset_token) {
            $this->load->library('email');
            
            $this->email->from('irinafahranty@gmail.com', 'Redi Store');
           $this->email->to($email);
            
            $this->email->subject('Reset Password');
            $reset_url = site_url('login/reset_password/' . $reset_token);
            $message = "Click this link to reset your password: <a href=\"$reset_url\">Reset Password</a>";
            $this->email->message($message);
            
            if ($this->email->send()) {
                return true; // Berhasil mengirim email
            } else {
                log_message('error', 'Email sending failed: ' . $this->email->print_debugger());
                return false; // Gagal mengirim email
            }
        }
        
       public function logout() {
        // Contoh logika logout
        // Hapus sesi pengguna dan redirect ke halaman login
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('logged_in');
          // Clear session data
         $this->session->sess_destroy();
        $this->session->set_flashdata('message', 'You have been logged out.');
        redirect('login');
    }


}

