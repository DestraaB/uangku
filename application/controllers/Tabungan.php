<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabungan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        $id_pengguna = isset($user['id']) ? $user['id'] : (isset($user['id_user']) ? $user['id_user'] : $user['user_id']);

        // Ambil data tabungan user
        $data['tabungan'] = $this->db->order_by('tanggal', 'DESC')->get_where('tabungan', ['id_user' => $id_pengguna])->result();
        $data['total_tabungan'] = $this->db->select_sum('nominal')->get_where('tabungan', ['id_user' => $id_pengguna])->row()->nominal ?? 0;
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

        $data = [
            'id_user'   => $id_pengguna,
            'nominal'   => $this->input->post('nominal', true),
            'tanggal'   => $this->input->post('tanggal', true),
            'deskripsi' => $this->input->post('deskripsi', true)
        ];

        $this->db->insert('tabungan', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Setoran tabungan berhasil disimpan!</div>');
        redirect('tabungan');
    }

    public function update_limit()
    {
        $email = $this->session->userdata('email');
        $limit_baru = $this->input->post('limit_pengeluaran', true);

        $this->db->where('email', $email);
        $this->db->update('users', ['limit_pengeluaran' => $limit_baru]);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Limit pengeluaran bulanan berhasil diperbarui!</div>');
        redirect('tabungan');
    }
}