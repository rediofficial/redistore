<?php
class Login_Model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    // Fungsi untuk menghasilkan ID pengguna dengan format khusus
    private function generateUserId() {
        // Contoh format: 'UBY12345' (USR diikuti dengan angka acak 4 digit)
        $prefix = 'UBY';
        $random_number = mt_rand(1000, 9999);
        return $prefix . $random_number;
    }

    private function generateRoleId() {
        // Contoh format: '1' (Untuk user buyyer biasa)
        $prefix = '1';
        return $prefix;
    }

    public function register($data) {
        // Generate ID pengguna dengan format khusus
        $data['id_user'] = $this->generateUserId();


        // Hash password sebelum menyimpannya ke database
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        
        return $this->db->insert('user', $data);
    }
    
    public function get_user_by_email($email) {
        $query = $this->db->get_where('user', array('email' => $email));
        return $query->row_array();
    }

    public function verify_password($password, $hashed_password) {
        return password_verify($password, $hashed_password);
    }

    public function save_reset_token($id_user, $token) {
        $data = array(
            'reset_token' => $token,
            'token_created_at' => date('Y-m-d H:i:s') // Menyimpan timestamp saat token dibuat
        );
        log_message('debug', 'Data to be saved: ' . print_r($data, true));
        $this->db->where('id_user', $id_user);
        if ($this->db->update('user', $data)) {
            log_message('debug', 'Reset token updated successfully for user ID: ' . $id_user);
            return true;
        } else {
            $error = $this->db->error();
            log_message('error', 'Database error: ' . $error['message']);
            return false;
        }
    }

    public function get_user_by_token($token) {
        $this->db->where('reset_token', $token);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            log_message('debug', 'User found with reset token: ' . $token);
            return $query->row_array();
        } else {
            log_message('error', 'No user found with reset token: ' . $token);
            return false;
        }
    }


    public function reset_password($id_user, $password, $token) {
        $data = array(
            'password' => $password,
            'reset_token' => NULL
        );
        $this->db->where('id_user', $id_user);
        $this->db->where('reset_token', $token);
        $result = $this->db->update('user', $data);
        
        if($result) {
            log_message('debug', 'Password updated successfully for user ID: ' . $id_user);
        } else {
            log_message('error', 'Failed to update password for user ID: ' . $id_user);
        }
    }

}