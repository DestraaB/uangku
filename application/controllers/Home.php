<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek apakah user sudah login
        if (!$this->session->userdata('email')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        // 1. Ambil data user yang sedang login
        $email = $this->session->userdata('email');
        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        
        // Deteksi nama kolom ID user
        $id_pengguna = isset($user['id']) ? $user['id'] : (isset($user['id_user']) ? $user['id_user'] : $user['user_id']);
        
        // Deteksi nama kolom user di tabel expenses
        $kolom_user_expenses = $this->db->field_exists('user_id', 'expenses') ? 'user_id' : 'id_user';

        $bulan_ini = date('m');
        $tahun_ini = date('Y');

        // ==========================================
        // 2. MENGHITUNG SALDO & TABUNGAN (ALL-TIME)
        // ==========================================
        $total_in_all = $this->db->select_sum('nominal')->get_where('pemasukan', ['id_user' => $id_pengguna])->row()->nominal ?? 0;
        $total_out_all = $this->db->select_sum('nominal')->get_where('expenses', [$kolom_user_expenses => $id_pengguna])->row()->nominal ?? 0;
        $total_tabungan = $this->db->select_sum('nominal')->get_where('tabungan', ['id_user' => $id_pengguna])->row()->nominal ?? 0;

        // Rumus Saldo Aktif = Total Uang Masuk - (Total Pengeluaran + Uang Ditabung)
        $saldo_aktif = $total_in_all - ($total_out_all + $total_tabungan);

        // ==========================================
        // 3. MENGHITUNG TRANSAKSI BULAN INI
        // ==========================================
        $total_pemasukan_bulan_ini = $this->db->select_sum('nominal')
            ->where('id_user', $id_pengguna)->where('MONTH(tanggal)', $bulan_ini)->where('YEAR(tanggal)', $tahun_ini)
            ->get('pemasukan')->row()->nominal ?? 0;

        $total_pengeluaran_bulan_ini = $this->db->select_sum('nominal')
            ->where($kolom_user_expenses, $id_pengguna)->where('MONTH(tanggal)', $bulan_ini)->where('YEAR(tanggal)', $tahun_ini)
            ->get('expenses')->row()->nominal ?? 0;

        // ==========================================
        // 4. MENGHITUNG LIMIT PENGELUARAN
        // ==========================================
        $limit = $user['limit_pengeluaran'] ?? 0;
        $sisa_limit = $limit - $total_pengeluaran_bulan_ini;
        if ($sisa_limit < 0) { $sisa_limit = 0; } // Jangan sampai minus di tampilan
        
        $persentase_limit = 0;
        if ($limit > 0) {
            $persentase_limit = ($total_pengeluaran_bulan_ini / $limit) * 100;
        }
        if ($persentase_limit > 100) { $persentase_limit = 100; } // Maksimal bar 100%

        // ==========================================
        // 5. MENGGABUNGKAN RIWAYAT (MASUK & KELUAR)
        // ==========================================
        // Ambil 5 Pemasukan Terakhir
        $pemasukan = $this->db->order_by('tanggal', 'DESC')->limit(5)->get_where('pemasukan', ['id_user' => $id_pengguna])->result();
        
        // Deteksi kolom relasi kategori agar tidak error
        $kolom_kategori_expenses = $this->db->field_exists('category_id', 'expenses') ? 'category_id' : 'id_kategori';
        $kolom_id_categories = $this->db->field_exists('id', 'categories') ? 'id' : 'id_kategori';
        $kolom_nama_categories = $this->db->field_exists('name', 'categories') ? 'name' : 'nama_kategori';

        // Ambil 5 Pengeluaran Terakhir beserta Kategori
        $this->db->select("expenses.*, categories.{$kolom_nama_categories} as nama_kategori");
        $this->db->from('expenses');
        $this->db->join('categories', "categories.{$kolom_id_categories} = expenses.{$kolom_kategori_expenses}", 'left');
        $this->db->where("expenses.{$kolom_user_expenses}", $id_pengguna);
        $this->db->order_by('expenses.tanggal', 'DESC');
        $this->db->limit(5);
        $pengeluaran = $this->db->get()->result();

        // Gabungkan keduanya ke dalam satu Array baru
        $riwayat_gabungan = [];
        
        foreach ($pemasukan as $p) {
            $riwayat_gabungan[] = (object)[
                'tanggal' => $p->tanggal,
                'sumber_atau_kategori' => $p->sumber,
                'deskripsi' => $p->deskripsi,
                'nominal' => $p->nominal,
                'jenis' => 'Pemasukan' // Penanda untuk Frontend
            ];
        }
        foreach ($pengeluaran as $p) {
            $riwayat_gabungan[] = (object)[
                'tanggal' => $p->tanggal,
                'sumber_atau_kategori' => isset($p->nama_kategori) ? $p->nama_kategori : 'Lainnya',
                'deskripsi' => $p->deskripsi,
                'nominal' => $p->nominal,
                'jenis' => 'Pengeluaran' // Penanda untuk Frontend
            ];
        }

        // Urutkan array gabungan dari yang paling baru (DESC)
        usort($riwayat_gabungan, function($a, $b) {
            return strtotime($b->tanggal) - strtotime($a->tanggal);
        });

        // Potong array, ambil 5 paling atas saja
        $riwayat_gabungan = array_slice($riwayat_gabungan, 0, 5);

        // ==========================================
        // 6. KIRIM SEMUA DATA KE VIEW
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