<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Expense_model');
        
        if (!$this->session->userdata('id_user')) { 
            redirect('auth/login'); 
        }
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');

        // Ambil data statistik dari Model
        $data['total_lifetime']  = $this->Expense_model->get_total_lifetime($id_user);
        $data['total_transaksi'] = $this->Expense_model->count_transaksi($id_user);

        $this->load->view('templates/header');
        $this->load->view('profil', $data); // Sisipkan $data di sini
        $this->load->view('templates/footer');
    }

        public function pengaturan() {
        $this->load->view('templates/header');
        $this->load->view('pengaturan');
        $this->load->view('templates/footer');
    }

    public function kirim_reset_email() {
        $email = $this->session->userdata('email');
        
        // 1. Buat Token Acak
        $token = bin2hex(random_bytes(32)); 

        // 2. Simpan token ke database user ini
        $this->db->where('email', $email);
        $this->db->update('users', ['reset_token' => $token]);

        // 3. Konfigurasi SMTP Gmail
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'email_kamu@gmail.com', // Ganti dengan Email-mu
            'smtp_pass' => 'sandi_aplikasi_google', // BUKAN password biasa. Harus buat "App Password" di setelan Google
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        // 4. Proses Kirim Email
        $this->load->library('email', $config);
        $this->email->from('email_kamu@gmail.com', 'Admin Uangku');
        $this->email->to($email);
        $this->email->subject('Reset Password Akun Uangku');

        $link = base_url('auth/reset_password?token=' . $token);
        $pesan = "Halo, ini adalah link untuk mereset password aplikasi Uangku Anda.<br><br>
                <a href='$link' style='background:blue;color:white;padding:10px;text-decoration:none;'>Klik Untuk Reset Password</a>";
        
        $this->email->message($pesan);

        if ($this->email->send()) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Link reset telah dikirim ke '.$email.'!</div>');
        } else {
            // Memunculkan pesan error teknis jika SMTP gagal
            $error = $this->email->print_debugger(array('headers'));
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal kirim email. Pastikan settingan SMTP Gmail benar.</div>');
        }
        
        redirect('profil/pengaturan');
    }
}