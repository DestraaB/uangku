<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth/login');
        }
        // Wajib load library enkripsi
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
        // 1. AMBIL & DEKRIPSI PEMASUKAN DENGAN AMAN
        // ==========================================
        $data_pemasukan = $this->db->get_where('pemasukan', ['id_user' => $id_pengguna])->result();
        $total_in_all = 0;
        $total_pemasukan_bulan_ini = 0;

        foreach ($data_pemasukan as $p) {
            // Smart Decrypt: Jika gagal didekripsi (data lama), gunakan data aslinya
            $dec_nom = $this->encryption->decrypt($p->nominal);
            $nominal_asli = ($dec_nom !== FALSE && $dec_nom != '') ? (float) $dec_nom : (float) $p->nominal;
            
            $dec_sumber = $this->encryption->decrypt($p->sumber);
            $sumber_asli = ($dec_sumber !== FALSE && $dec_sumber != '') ? $dec_sumber : $p->sumber;

            $dec_desk = $this->encryption->decrypt($p->deskripsi);
            $deskripsi_asli = ($dec_desk !== FALSE && $dec_desk != '') ? $dec_desk : $p->deskripsi;

            $total_in_all += $nominal_asli; // Total All-time
            
            $tgl = strtotime($p->tanggal);
            if (date('m', $tgl) == $bulan_ini && date('Y', $tgl) == $tahun_ini) {
                $total_pemasukan_bulan_ini += $nominal_asli;
            }

            // Kembalikan ke format asli agar bisa dibaca di View
            $p->nominal = $nominal_asli; 
            $p->sumber = $sumber_asli;
            $p->deskripsi = $deskripsi_asli;
        }

        // ==========================================
        // 2. AMBIL & DEKRIPSI PENGELUARAN DENGAN AMAN
        // ==========================================
        $kolom_kategori_expenses = $this->db->field_exists('category_id', 'expenses') ? 'category_id' : 'id_kategori';
        $kolom_id_categories = $this->db->field_exists('id', 'categories') ? 'id' : 'id_kategori';
        $kolom_nama_categories = $this->db->field_exists('name', 'categories') ? 'name' : 'nama_kategori';

        $this->db->select("expenses.*, categories.{$kolom_nama_categories} as nama_kategori");
        $this->db->from('expenses');
        $this->db->join('categories', "categories.{$kolom_id_categories} = expenses.{$kolom_kategori_expenses}", 'left');
        $this->db->where("expenses.{$kolom_user_expenses}", $id_pengguna);
        $data_pengeluaran = $this->db->get()->result();

        $total_out_all = 0;
        $total_pengeluaran_bulan_ini = 0;

        foreach ($data_pengeluaran as $ex) {
            $dec_nom = $this->encryption->decrypt($ex->nominal);
            $nominal_asli = ($dec_nom !== FALSE && $dec_nom != '') ? (float) $dec_nom : (float) $ex->nominal;
            
            $dec_desk = $this->encryption->decrypt($ex->deskripsi);
            $deskripsi_asli = ($dec_desk !== FALSE && $dec_desk != '') ? $dec_desk : $ex->deskripsi;
            
            $total_out_all += $nominal_asli; 
            
            $tgl = strtotime($ex->tanggal);
            if (date('m', $tgl) == $bulan_ini && date('Y', $tgl) == $tahun_ini) {
                $total_pengeluaran_bulan_ini += $nominal_asli;
            }

            $ex->nominal = $nominal_asli; 
            $ex->deskripsi = $deskripsi_asli; 
        }

        // ==========================================
        // 3. AMBIL & DEKRIPSI TABUNGAN
        // ==========================================
        $data_tabungan = $this->db->get_where('tabungan', ['id_user' => $id_pengguna])->result();
        $total_tabungan = 0;
        foreach ($data_tabungan as $t) {
            $dec_nom = $this->encryption->decrypt($t->nominal);
            $total_tabungan += ($dec_nom !== FALSE && $dec_nom != '') ? (float) $dec_nom : (float) $t->nominal;
        }

        // ==========================================
        // 4. PERHITUNGAN MATEMATIKA & LIMIT
        // ==========================================
        $saldo_aktif = $total_in_all - ($total_out_all + $total_tabungan);

        $limit_asli = 0;
        if (!empty($user['limit_pengeluaran'])) {
            $dec_lim = $this->encryption->decrypt($user['limit_pengeluaran']);
            $limit_asli = ($dec_lim !== FALSE && $dec_lim != '') ? (float) $dec_lim : (float) $user['limit_pengeluaran'];
        }

        $sisa_limit = $limit_asli - $total_pengeluaran_bulan_ini;
        if ($sisa_limit < 0) { $sisa_limit = 0; }
        
        $persentase_limit = 0;
        if ($limit_asli > 0) {
            $persentase_limit = ($total_pengeluaran_bulan_ini / $limit_asli) * 100;
        }
        if ($persentase_limit > 100) { $persentase_limit = 100; }

        // ==========================================
        // 5. MENGGABUNGKAN RIWAYAT (AMBIL 5 TERBARU)
        // ==========================================
        $riwayat_gabungan = [];
        
        foreach ($data_pemasukan as $p) {
            $riwayat_gabungan[] = (object)[
                'tanggal' => $p->tanggal,
                'sumber_atau_kategori' => $p->sumber,
                'deskripsi' => $p->deskripsi,
                'nominal' => $p->nominal, 
                'jenis' => 'Pemasukan'
            ];
        }
        foreach ($data_pengeluaran as $p) {
            $riwayat_gabungan[] = (object)[
                'tanggal' => $p->tanggal,
                'sumber_atau_kategori' => isset($p->nama_kategori) ? $p->nama_kategori : 'Lainnya',
                'deskripsi' => $p->deskripsi,
                'nominal' => $p->nominal, 
                'jenis' => 'Pengeluaran'
            ];
        }

        usort($riwayat_gabungan, function($a, $b) {
            return strtotime($b->tanggal) - strtotime($a->tanggal);
        });
        $riwayat_gabungan = array_slice($riwayat_gabungan, 0, 5);

        // ==========================================
        // 6. KIRIM KE VIEW
        // ==========================================
        $data = [
            'title'             => 'Beranda - Uangku',
            'saldo_aktif'       => $saldo_aktif,
            'total_pemasukan'   => $total_pemasukan_bulan_ini,
            'total_pengeluaran' => $total_pengeluaran_bulan_ini,
            'total_tabungan'    => $total_tabungan,
            'sisa_limit'        => $sisa_limit,
            'persentase_limit'  => $persentase_limit,
            'riwayat'           => $riwayat_gabungan
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('dashboard', $data); 
        $this->load->view('templates/footer');
    }
}