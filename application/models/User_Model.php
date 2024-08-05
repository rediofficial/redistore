<?php
class User_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_all_users() {
        $query = $this->db->get('user'); // Pastikan nama tabel 'user'
        return $query->result();
    }

    public function get_user_by_id($id_user) {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('user');
        return $query->row();
    }

    public function get_role($role_id) {
        $this->db->select('role_id');
        $this->db->where('role_id', $role_id);
        $query = $this->db->get('user');
        return $query->row_array();
    }
    public function get_akunml_byid($akun_ml_id) {
        $this->db->select('*'); // Select all columns for debugging
        $this->db->from('akun_ml');
        $this->db->where('kode_akun', $akun_ml_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function update_transaction_status($kode_akun, $new_status) {
        $data = array('status' => $new_status);
        $this->db->where('kode_akun', $kode_akun);
        $this->db->update('akun_ml', $data);
    }
     // Verifikasi sandi
     public function verify_password($id_user, $password) {
        $this->db->where('id_user', $id_user);
        $user = $this->db->get('user')->row();

        if ($user) {
            return password_verify($password, $user->password); // Pastikan password di-hash
        }
        return false;
    }

    // Update sandi
    public function update_password($id_user, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $this->db->where('id_user', $id_user);
        $this->db->update('user', array('password' => $hashed_password));
    }
    public function update_profile($id_user, $full_name, $email) {
        $data = [
            'full_name' => $full_name,
            'email' => $email
        ];
        $this->db->where('id_user', $id_user);
        return $this->db->update('user', $data);
    }
    
    
    
}
?>
