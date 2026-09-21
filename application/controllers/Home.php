<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // 1. Load Model untuk mengambil fungsi kalkulasi uang
        $this->load->model('Expense_model');

        // 2. Proteksi Halaman: Lempar ke halaman Login jika belum ada session id_user
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login'); 
        }
    }

    public function index() {
        // Ambil ID user yang sedang login saat ini
        $id_user = $this->session->userdata('id_user');

        // 3. Tarik data kalkulasi dari Model (Bulan Berjalan)
        $data['total_pengeluaran'] = $this->Expense_model->get_total_bulan_ini($id_user);
        
        // 4. Tarik rincian per kategori (1:Primer, 2:Sekunder, 3:Tersier)
        $data['total_primer']   = $this->Expense_model->get_total_per_kategori($id_user, 1);
        $data['total_sekunder'] = $this->Expense_model->get_total_per_kategori($id_user, 2);
        $data['total_tersier']  = $this->Expense_model->get_total_per_kategori($id_user, 3);

       // Cari baris ini, lalu tambahkan angka 5 sebagai limit
        $data['riwayat'] = $this->Expense_model->get_riwayat_transaksi($id_user, 5);

        // 5. Tampilkan ke Layar (Load View) berurutan dari atas ke bawah
        $this->load->view('templates/header');         // Muat CSS & HTML atas
        $this->load->view('dashboard', $data);         // Muat isi konten Dashboard + bawa data uang
        $this->load->view('templates/footer');         // Muat navigasi bawah (Bottom Nav)
    }
}