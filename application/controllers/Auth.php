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
        if ($this->session->userdata('id_user')) {
            redirect('home');
        }
        $this->load->view('auth/login');
    }

    public function proses_login() {
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->db->get_where('users', ['email' => $email])->row();

        if ($user && password_verify($password, $user->password)) {
            $data_session = [
                'id_user' => $user->id_user,
                'nama'    => $user->nama,
                'email'   => $user->email
            ];
            $this->session->set_userdata($data_session);
            redirect('home');
        } else {
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
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah pernah didaftarkan!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
            'min_length' => 'Password minimal 6 karakter!'
        ]);
        
        // BARU: Aturan validasi untuk konfirmasi password agar harus sama dengan password atasnya
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password]', [
            'matches' => 'Konfirmasi password tidak sama!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'nama'     => htmlspecialchars($this->input->post('nama', TRUE)),
                'email'    => htmlspecialchars($this->input->post('email', TRUE)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];

            $this->db->insert('users', $data);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Akun berhasil dibuat! Silakan Login.</div>');
            redirect('auth/login');
        }
    }

    // --- FUNGSI LOGOUT ---
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
    
    // --- FUNGSI RESET PASSWORD (DARI EMAIL) ---
    public function reset_password() {
        $token = $this->input->get('token');
        $user = $this->db->get_where('users', ['reset_token' => $token])->row();

        if ($user) {
            $data['token'] = $token;
            $this->load->view('auth/form_reset', $data); 
        } else {
            echo "Token tidak valid atau sudah kadaluarsa.";
        }
    }

    public function proses_password_baru() {
        $token      = $this->input->post('token');
        $password   = $this->input->post('password');
        
        // BARU: Menangkap input konfirmasi password
        $konfirmasi = $this->input->post('konfirmasi_password');

        // BARU: Cek apakah password dan konfirmasi sama
        if ($password !== $konfirmasi) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center">Password baru dan konfirmasi tidak cocok!</div>');
            redirect('auth/reset_password?token=' . $token);
            return; // Hentikan script di sini jika password beda
        }

        // Jika cocok, lanjutkan proses enkripsi
        $password_baru = password_hash($password, PASSWORD_DEFAULT);

        $this->db->where('reset_token', $token);
        $this->db->update('users', [
            'password' => $password_baru,
            'reset_token' => NULL 
        ]);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Password berhasil diubah! Silakan login kembali.</div>');
        redirect('auth/login');
    }

}