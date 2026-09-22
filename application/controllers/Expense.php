<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load library dan helper yang dibutuhkan
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'upload', 'image_lib'));
        
        // Asumsi kamu sudah membuat Expense_model
        $this->load->model('Expense_model'); 

        // Proteksi: Pastikan hanya user yang sudah login yang bisa mengakses
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login'); 
        }
    }

    public function simpan_pengeluaran() {
        // 1. Konfigurasi Upload File CI3
        $config['upload_path']   = './uploads/struk/'; // Lokasi simpan file
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Format gambar
        $config['max_size']      = 5120; // Maksimal ukuran file: 5MB
        $config['encrypt_name']  = TRUE; // Mengubah nama file menjadi string acak yang aman

        $this->upload->initialize($config);

        // 2. Proses Upload (nama input di HTML harus: name="foto_struk")
        if ($this->upload->do_upload('foto_struk')) {
            
            // Ambil data file yang baru saja diupload
            $upload_data = $this->upload->data();
            $nama_file = $upload_data['file_name'];

            // 3. Proses Kompresi/Resize Gambar (Optimasi HP)
            // Mengecilkan foto dari HP agar tidak memberatkan server
            $config_resize['image_library']  = 'gd2';
            $config_resize['source_image']   = './uploads/struk/' . $nama_file;
            $config_resize['maintain_ratio'] = TRUE;
            $config_resize['width']          = 800; // Lebar maksimal
            $config_resize['height']         = 800; // Tinggi maksimal
            $config_resize['quality']        = '60%'; // Kurangi ukuran file 40%

            $this->image_lib->initialize($config_resize);
            $this->image_lib->resize();

            // 4. Siapkan data dari Form Input untuk disimpan ke Database
            $data_insert = array(
                'id_user'     => $this->session->userdata('id_user'), // ID dari session login
                'id_kategori' => $this->input->post('id_kategori', TRUE),
                'nominal'     => $this->input->post('nominal', TRUE),
                'deskripsi'   => $this->input->post('deskripsi', TRUE),
                'tanggal'     => $this->input->post('tanggal', TRUE),
                'foto_struk'  => $nama_file // Cukup simpan nama filenya saja
            );

            // 5. Kirim data ke Model
            $this->Expense_model->insert_data('expenses', $data_insert);

            // 6. Set notifikasi sukses dan kembalikan ke halaman Home
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Pengeluaran berhasil dicatat!</div>');
            redirect('home');

        } else {
            // Jika upload gagal (file kebesaran, format salah, dll)
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal upload foto: '.$error.'</div>');
            
            // Kembalikan ke halaman form
            redirect('expense/tambah'); 
        }
    }

        public function riwayat() {
        // Tarik semua data tanpa limit
        $id_user = $this->session->userdata('id_user');
        $data['semua_riwayat'] = $this->Expense_model->get_riwayat_transaksi($id_user); 

        $this->load->view('templates/header');
        $this->load->view('expense/riwayat', $data);
        $this->load->view('templates/footer');
    }

        public function tambah() {
            // Memuat antarmuka form tambah pengeluaran beserta navigasinya
            $this->load->view('templates/header');
            $this->load->view('expense/tambah');
            $this->load->view('templates/footer');
     }

        public function hapus($id_expense) {
        $id_user = $this->session->userdata('id_user');
        
        // 1. Tarik data transaksi berdasarkan ID
        $transaksi = $this->Expense_model->get_expense_by_id($id_expense, $id_user);
        
        if ($transaksi) {
            // 2. Hapus fisik foto struk dari folder uploads/struk/
            $path_ke_file = './uploads/struk/' . $transaksi->foto_struk;
            if ($transaksi->foto_struk != null && file_exists($path_ke_file)) {
                unlink($path_ke_file); // Perintah sakti penghapus file
            }
            
            // 3. Hapus datanya dari database MySQL
            $this->Expense_model->delete_data($id_expense, $id_user);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Transaksi dan foto struk berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal! Data tidak ditemukan atau Anda tidak memiliki akses.</div>');
        }
        
        // 4. Kembali ke halaman sebelumnya (Bisa dari Home atau dari Riwayat)
        redirect($_SERVER['HTTP_REFERER']);
    }
}