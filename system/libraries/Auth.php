<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {
    protected $CI;

    public function __construct() {
        // Mendapatkan instance CI
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->model('Login_Model'); // Ganti dengan model pengguna Anda
    }

    public function login($email, $password) {
        $user = $this->CI->User_Model->get_user_by_email($email);

        if ($user && password_verify($password, $user->password)) {
            $this->CI->session->set_userdata('user_logged_in', true);
            $this->CI->session->set_userdata('id_user', $user->id);
            return true;
        }
        return false;
    }

    public function logout() {
        $this->CI->session->unset_userdata('user_logged_in');
        $this->CI->session->unset_userdata('id_user');
    }

    public function is_logged_in() {
        return $this->CI->session->userdata('user_logged_in') === true;
    }
}
