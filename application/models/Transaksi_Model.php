<?php
class Transaksi_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    public function get_transaksi() {
        $query = $this->db->get('transaksi');
        return $query->result_array();
    }

    public function insert_transaksi($data) {
        return $this->db->insert('transaksi', $data);
    }

    public function get_transaksi_byiduser($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->order_by('tanggal_pesanan', 'DESC'); // Mengurutkan berdasarkan tanggal pesanan terbaru
        $query = $this->db->get('transaksi');
        return $query->result_array();
    }
    
    public function get_next_transaction_number() {
        // Implementasi untuk mengambil nomor urut transaksi berikutnya
        // Misalnya, TXXYYYY
        $last_transaction = $this->db->select('kode_trx')
                                     ->order_by('kode_trx', 'DESC')
                                     ->limit(1)
                                     ->get('transaksi')
                                     ->row();

        if ($last_transaction) {
            // Extract nomor urut dari kode transaksi terakhir
            $last_number = substr($last_transaction->kode_trx, 5); // Ambil angka setelah 'TRX_'
            $next_number = intval($last_number) + 1;
        } else {
            // Jika tidak ada transaksi sebelumnya, mulai dari 1
            $next_number = 1;
        }

        // Format kode transaksi baru
        $next_transaction_number = 'TRX_' . str_pad($next_number, 4, '0', STR_PAD_LEFT); // Contoh: TRX_0001

        return $next_transaction_number;
    }
    // public function get_transaksi_bypenjual($id_penjual) {
    //     $this->db->select('transaksi.*, akun_ml.nama_akun, akun_ml.harga, akun_ml.status');
    //     $this->db->from('transaksi');
    //     $this->db->join('akun_ml', 'transaksi.kode_akun = akun_ml.kode_akun');
    //     $this->db->where('akun_ml.id_user', $id_penjual);
    //     $this->db->order_by('transaksi.tanggal_pesanan', 'DESC'); // Mengurutkan berdasarkan tanggal pesanan terbaru
    //     $query = $this->db->get();
        
    //     // Debugging: Cek query terakhir yang dijalankan
    //     log_message('info', 'Query terakhir: ' . $this->db->last_query());
        
    //     return $query->result_array();
    // }

    public function update_status_transaksi($kode_transaksi, $status) {
        $data = array(
            'status' => $status,
        );
    
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi', $data);  // Pastikan nama tabel sudah benar
    }

    public function update_ket_transaksi($kode_transaksi, $ket) {
        $data = array(
            'ket' => $ket
        );
    
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi', $data);  // Pastikan nama tabel sudah benar
    }

    public function get_trx_by_id($kode_transaksi) {
        $this->db->where('kode_transaksi', $kode_transaksi);
        $query = $this->db->get('transaksi');
        return $query->result_array();
    }
    
    public function get_akun_by_transaksi($akun_ml_id) {
        $this->db->where('kode_akun', $akun_ml_id);
        $query = $this->db->get('akun_ml');
        return $query->result_array();
    }
    // public function get_transaksi_by_kode_akun($kode_transaksi) {
    //     $this->db->where('kode_akun', $kode_transaksi);
    //     $query = $this->db->get('transaksi');
    //     return $query->result_array();
    // }

    public function update_akun($kode_transaksi) {
        $data = array(
            'nama_akun' => $this->input->post('nama_akun'),
            // Tambahkan field lain sesuai kebutuhan
        );

        if (!empty($_FILES['bukti_transfer']['name'])) {
            $upload = $this->_do_upload();
            $data['bukti_transfer'] = $upload;
        }

        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi', $data);
    }

    public function hapus_transaksi($kode_transaksi) {
        log_message('debug', 'Kode transaksi yang akan dihapus: ' . $kode_transaksi);
        $this->db->where('kode_transaksi', $kode_transaksi);
        $result = $this->db->delete('transaksi');
        log_message('debug', 'Hasil penghapusan: ' . $result);
        return $result;
    }

    
    private function _do_upload() {
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = uniqid();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bukti_transfer')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('seller/kelola_penjualan');
        }
        return $this->upload->data('file_name');
    }
}
?>
