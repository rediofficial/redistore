<?php
class Home_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Mendapatkan semua data akun ml
    public function get_akun() {
        $query = $this->db->get('akun_ml');
        return $query->result_array();
    }

    public function get_harga($kode_akun) {
        $this->db->select('harga');
        $this->db->from('akun_ml');
        $this->db->where('kode_akun', $kode_akun);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->harga;
        } else {
            return false;
        }
    }
    
    // Mendapatkan data akun ml berdasarkan kode akun
    public function get_akunml_bykode($kode_akun) {
        $this->db->where('kode_akun', $kode_akun);
        $query = $this->db->get('akun_ml');

        // Debugging: cek apakah query mengembalikan hasil
        log_message('debug', 'Query Result: ' . print_r($query->result_array(), true));

        return $query->result_array();
    }
    public function get_akun_by_kode($kode_akun) {
        $this->db->select('*');
        $this->db->from('akun_ml');
        $this->db->where('kode_akun', $kode_akun);
        $query = $this->db->get();
        return $query->row_array(); // Pastikan mengembalikan array
    }
    
    


    public function get_akun_by_id($akun_ml_id) {
        $this->db->where('id_user', $akun_ml_id); // Assuming 'id' is the primary key
        $query = $this->db->get('akun_ml'); // Assuming 'akun_ml' is the table name
        $result = $query->row_array();
        
        // Debug: Log the result
        log_message('debug', 'Query Result: ' . print_r($result, true));
        
        return $result;
    }
    
 


}
