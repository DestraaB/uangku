<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Limit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth/login');
        }
        // 1. TAMBAHKAN LIBRARY ENKRIPSI
        $this->load->library('encryption');
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        $id_pengguna = isset($user['id']) ? $user['id'] : (isset($user['id_user']) ? $user['id_user'] : $user['user_id']);
        
        $kolom_user_expenses = $this->db->field_exists('user_id', 'expenses') ? 'user_id' : 'id_user';
        $bulan_ini = date('m');
        $tahun_ini = date('Y');

        // ==========================================
        // 2. TARIK DATA, DEKRIPSI, DAN JUMLAHKAN MANUAL
        // ==========================================
        $pengeluaran_bulan_ini = $this->db
            ->where($kolom_user_expenses, $id_pengguna)
            ->where('MONTH(tanggal)', $bulan_ini)
            ->where('YEAR(tanggal)', $tahun_ini)
            ->get('expenses')->result();

        $total_pengeluaran_bulan_ini = 0;
        foreach ($pengeluaran_bulan_ini as $ex) {
            // Dekripsi nominal menjadi angka kembali lalu jumlahkan
            $total_pengeluaran_bulan_ini += (float) $this->encryption->decrypt($ex->nominal);
        }

        // Dekripsi Limit Pengeluaran milik User
        $limit = 0;
        if (!empty($user['limit_pengeluaran'])) {
            $limit = (float) $this->encryption->decrypt($user['limit_pengeluaran']);
        }

        $sisa_limit = $limit - $total_pengeluaran_bulan_ini;
        if ($sisa_limit < 0) { $sisa_limit = 0; }

        $persentase = 0;
        if ($limit > 0) {
            $persentase = ($total_pengeluaran_bulan_ini / $limit) * 100;
        }
        if ($persentase > 100) { $persentase = 100; }

        $data = [
            'title'             => 'Atur Limit Pengeluaran - Uangku',
            'user'              => $user,
            'total_pengeluaran' => $total_pengeluaran_bulan_ini,
            'limit'             => $limit,
            'sisa_limit'        => $sisa_limit,
            'persentase'        => $persentase
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('limit/index', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $email = $this->session->userdata('email');
        $limit_baru = $this->input->post('limit_pengeluaran', true);

        // ==========================================
        // 3. ENKRIPSI LIMIT SEBELUM DISIMPAN KE MYSQL
        // ==========================================
        $limit_rahasia = $this->encryption->encrypt($limit_baru);

        $this->db->where('email', $email);
        $this->db->update('users', ['limit_pengeluaran' => $limit_rahasia]);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Limit pengeluaran berhasil diperbarui!</div>');
        redirect('limit');
    }
}