<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct() {
        parent::__construct();
        $this->load->model('Mlbb_Model');
		$this->load->model('Home_Model');
        $this->load->helper('url');
        $this->load->helper('auth_helper'); // Load helper auth_helper
    }

    public function index() {
        $data['title'] = 'Redi Store';
		$data['akun_ml'] = $this->Home_Model->get_akun();
		$this->load->view('layout/home/header', $data);
		$this->load->view('home', $data);
		$this->load->view('layout/home/footer');
    }

		public function tentang() {
		$data['title'] = 'Tentang Redi Store';
		$this->load->view('layout/home/header', $data);
		$this->load->view('home_menu/tentang');
	}

	public function stok() {
		$data['title'] = 'Redi Store';
		$data['akun_ml'] = $this->Mlbb_Model->get_all_accounts();
		$this->load->view('layout/home/header', $data);
		$this->load->view('stok_akun_blm_login', $data);
    }
	
	public function search() {
        // Ambil query pencarian dari URL
        $query = $this->input->get('query');

        // Load model dan cari akun berdasarkan query
        $data['akun_ml'] = $this->Mlbb_Model->search_accounts($query);

        // Load view dengan hasil pencarian
        $this->load->view('layout/home/header', array('title' => 'Hasil Pencarian'));
        $this->load->view('home', $data);
        $this->load->view('layout/home/footer');
    }
    public function search_stok() {
        // Ambil query pencarian dari URL
        $query = $this->input->get('search'); // Sesuaikan nama parameter dengan yang ada di form
    
        // Load model dan cari akun berdasarkan query
        $data['akun_ml'] = $this->Mlbb_Model->search_accounts($query);
    
        // Load view dengan hasil pencarian
        $this->load->view('layout/home/header', array('title' => 'Hasil Pencarian'));
        $this->load->view('stok_akun_blm_login', $data);
    }
    
}
