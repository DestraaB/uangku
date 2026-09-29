<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller {

    public function __construct()
        {
            parent::__construct();
            // Pastikan user sudah login
            if (!$this->session->userdata('email')) {
                redirect('auth/login');
            }
        }

    public function index()
        {
            $this->load->view('pemasukan/catat_pemasukan');
        }

    public function simpan_pemasukan()
        {
            // Ambil data user dari database berdasarkan email session yang sedang aktif
            $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

            // Deteksi otomatis nama kolom ID di tabel users (bisa id, id_user, atau user_id)
            $id_pengguna = isset($user['id']) ? $user['id'] : (isset($user['id_user']) ? $user['id_user'] : $user['user_id']);

            $data = [
                'id_user'   => $id_pengguna, 
                'nominal'   => $this->input->post('nominal', true),
                'sumber'    => $this->input->post('sumber', true),
                'tanggal'   => $this->input->post('tanggal', true),
                'deskripsi' => $this->input->post('deskripsi', true)
            ];

            $this->db->insert('pemasukan', $data);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Uang masuk berhasil dicatat!</div>');
            redirect('home');
        }
    }