<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load library yang dibutuhkan, wajib huruf kecil semua!
        $this->load->library(array('session', 'encryption')); 
        
        if (!$this->session->userdata('email')) {
            redirect('auth/login');
        }
    }

    // Menampilkan form catat pemasukan
        public function index() {
        $data['title'] = 'Catat Pemasukan - Uangku';
        
        $this->load->view('templates/header', $data);
        // UBAH BARIS DI BAWAH INI
        $this->load->view('pemasukan/catat_pemasukan'); 
        $this->load->view('templates/footer');
    }

    // Fungsi untuk memproses data dari form dan menyimpannya ke database
    public function simpan() {
        // Ambil ID User
        $email = $this->session->userdata('email');
        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        $id_pengguna = isset($user['id']) ? $user['id'] : (isset($user['id_user']) ? $user['id_user'] : $user['user_id']);

        // BUNGKUS DATA DENGAN ENKRIPSI SEBELUM DISIMPAN KE MYSQL
        $data_insert = array(
            'id_user'   => $id_pengguna,
            'tanggal'   => $this->input->post('tanggal', TRUE),
            // 3 BARIS INI WAJIB DIENKRIPSI
            'nominal'   => $this->encryption->encrypt($this->input->post('nominal', TRUE)),
            'sumber'    => $this->encryption->encrypt($this->input->post('sumber', TRUE)),
            'deskripsi' => $this->encryption->encrypt($this->input->post('deskripsi', TRUE))
        );

        $this->db->insert('pemasukan', $data_insert);
        
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Pemasukan berhasil dicatat!</div>');
        redirect('home');
    }
}