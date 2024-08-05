<?php
class Mlbb_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_all_accounts() {
        $query = $this->db->get('akun_ml');
        $result = $query->result_array();
        foreach ($result as &$akun_ml) {
            $akun_ml['harga'] = (float) $akun_ml['harga'];
        }
        return $result;
    }
    public function get_akunml_kode($akun_ml_id) {
        $this->db->where('kode_akun', $akun_ml_id);
        $query = $this->db->get('akun_ml');
        return $query->row_array();
    }
    public function create_akun($data) {
        return $this->db->insert('akun_ml', $data);
    }

    public function get_account_price($kode_akun) {
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

    public function search_accounts($query) {
        $this->db->like('nama_akun', $query);
        $this->db->or_like('kode_akun', $query);
        $this->db->or_like('harga', $query);
        $this->db->or_like('rank', $query);
        $this->db->or_like('jumlah_hero', $query);
        $this->db->or_like('jumlah_skin', $query);
        $this->db->or_like('deskripsi', $query);

        $result = $this->db->get('akun_ml'); // Ganti variabel agar tidak tumpang tindih dengan input
        return $result->result_array();
    }

    public function post_akun($data) {
        $data['kode_akun'] = $this->generate_kode_akun();
        $data['status'] = 'Pending'; // Set status to pending
        return $this->db->insert('akun_ml', $data);
    }

    private function generate_kode_akun() {
        $this->db->select('kode_akun');
        $this->db->order_by('kode_akun', 'DESC');
        $query = $this->db->get('akun_ml', 1);

        if ($query->num_rows() > 0) {
            $last_kode = $query->row()->kode_akun;
            $last_number = (int)substr($last_kode, 1);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        return 'A' . str_pad($new_number, 4, '0', STR_PAD_LEFT);
    }

    public function update_status($kode_akun, $status) {
        $data = array(
            'status' => $status
        );
    
        // Debug data yang akan diupdate
        var_dump($kode_akun, $data);
    
        $this->db->where('kode_akun', $kode_akun);
        $this->db->update('akun_ml', $data);
    }

    
    // Mengupdate akun
    public function update_akun($kode_akun, $data) {
        $this->db->where('kode_akun', $kode_akun);
        return $this->db->update('akun_ml', $data);
    }
    // Menghapus akun
    public function delete_akun($kode_akun) {
        $this->db->where('kode_akun', $kode_akun);
        return $this->db->delete('akun_ml');
    }
}

