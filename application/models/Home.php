<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model untuk kalkulasi uang
        $this->load->model('Expense_model');

        // Pastikan user sudah login
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login'); 
        }
    }

    public function index() {
        // Ambil ID user dari session
        $id_user = $this->session->userdata('id_user');

        // Tarik data kalkulasi dari Model
        $data['total_pengeluaran'] = $this->Expense_model->get_total_bulan_ini($id_user);
        
        // Tarik rincian per kategori (1:Primer, 2:Sekunder, 3:Tersier)
        $data['total_primer']   = $this->Expense_model->get_total_per_kategori($id_user, 1);
        $data['total_sekunder'] = $this->Expense_model->get_total_per_kategori($id_user, 2);
        $data['total_tersier']  = $this->Expense_model->get_total_per_kategori($id_user, 3);

        // Lempar data variabel array $data ke halaman View
        $this->load->view('dashboard', $data); 
    }
}