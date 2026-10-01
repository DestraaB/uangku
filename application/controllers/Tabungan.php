<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabungan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth/login');
        }
        // 1. WAJIB LOAD LIBRARY ENKRIPSI
        $this->load->library('encryption');
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        $id_pengguna = isset($user['id']) ? $user['id'] : (isset($user['id_user']) ? $user['id_user'] : $user['user_id']);

        // 2. TARIK DATA TABUNGAN MENTAH (TERENKRIPSI)
        $tabungan_mentah = $this->db->order_by('tanggal', 'DESC')->get_where('tabungan', ['id_user' => $id_pengguna])->result();
        
        $total_tabungan = 0;

        // 3. BUKA KUNCI (DECRYPT) SATU PER SATU
        foreach ($tabungan_mentah as $t) {
            $nominal_asli = (float) $this->encryption->decrypt($t->nominal);
            $total_tabungan += $nominal_asli; // Jumlahkan manual pakai PHP
            
            // Timpa data terenkripsi dengan data asli untuk ditampilkan di View
            $t->nominal = $nominal_asli;
            $t->deskripsi = $this->encryption->decrypt($t->deskripsi);
        }

        $data['tabungan'] = $tabungan_mentah;
        $data['total_tabungan'] = $total_tabungan;
        $data['user'] = $user;
        $data['title'] = 'Tabungan & Limit - Uangku';

        $this->load->view('templates/header', $data);
        $this->load->view('tabungan/index', $data);
        $this->load->view('templates/footer');
    }

    public function simpan_tabungan()
    {
        $email = $this->session->userdata('email');
        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        $id_pengguna = isset($user['id']) ? $user['id'] : (isset($user['id_user']) ? $user['id_user'] : $user['user_id']);

        // 4. BUNGKUS NOMINAL & DESKRIPSI DENGAN ENKRIPSI SEBELUM DISIMPAN
        $data = [
            'id_user'   => $id_pengguna,
            'tanggal'   => $this->input->post('tanggal', true),
            'nominal'   => $this->encryption->encrypt($this->input->post('nominal', true)),
            'deskripsi' => $this->encryption->encrypt($this->input->post('deskripsi', true))
        ];

        $this->db->insert('tabungan', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Setoran tabungan berhasil disimpan!</div>');
        redirect('tabungan');
    }
}