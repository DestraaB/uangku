<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load library untuk validasi form
        $this->load->library('form_validation');
    }

    // --- HALAMAN & LOGIKA LOGIN ---
    public function login() {
        // Cegah user yang sudah login kembali ke halaman login
        if ($this->session->userdata('id_user')) {
            redirect('home');
        }
        $this->load->view('auth/login');
    }

    public function proses_login() {
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        // Cari user berdasarkan email
        $user = $this->db->get_where('users', ['email' => $email])->row();

        // Cek apakah user ditemukan DAN password cocok dengan hash di database
        if ($user && password_verify($password, $user->password)) {
            
            // Simpan data ke session
            $data_session = [
                'id_user' => $user->id_user,
                'nama'    => $user->nama,
                'email'   => $user->email
            ];
            $this->session->set_userdata($data_session);
            redirect('home'); // Masuk ke Dashboard
            
        } else {
            // Jika gagal, kembalikan dengan pesan error
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center">Email atau Password salah!</div>');
            redirect('auth/login');
        }
    }

    // --- HALAMAN & LOGIKA REGISTER ---
    public function register() {
        if ($this->session->userdata('id_user')) {
            redirect('home');
        }
        $this->load->view('auth/register');
    }

    public function proses_register() {
        // Aturan validasi (Email harus unik di tabel users)
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah pernah didaftarkan!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
            'min_length' => 'Password minimal 6 karakter!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembali ke form registrasi
            $this->load->view('auth/register');
        } else {
            // Jika validasi sukses, enkripsi password dan simpan ke database
            $data = [
                'nama'     => htmlspecialchars($this->input->post('nama', TRUE)),
                'email'    => htmlspecialchars($this->input->post('email', TRUE)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT) // Enkripsi Hash!
            ];

            $this->db->insert('users', $data);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Akun berhasil dibuat! Silakan Login.</div>');
            redirect('auth/login');
        }
    }

    // --- FUNGSI LOGOUT ---
    public function logout() {
        // Hancurkan semua session
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}