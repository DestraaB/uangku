<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_model extends CI_Model {
    
    // (Fungsi insert_data sebelumnya sudah ada di sini...)

    // 1. Fungsi untuk menghitung TOTAL KESELURUHAN pengeluaran user bulan ini
    public function get_total_bulan_ini($id_user) {
        $bulan_sekarang = date('m');
        $tahun_sekarang = date('Y');

        $this->db->select_sum('nominal'); // Fitur CI3 untuk query SUM()
        $this->db->where('id_user', $id_user);
        $this->db->where('MONTH(tanggal)', $bulan_sekarang);
        $this->db->where('YEAR(tanggal)', $tahun_sekarang);
        
        $query = $this->db->get('expenses')->row();
        
        // Cek jika null (belum ada pengeluaran), kembalikan angka 0
        return ($query->nominal != null) ? $query->nominal : 0; 
    }

    // 2. Fungsi untuk menghitung total pengeluaran PER KATEGORI bulan ini
    public function get_total_per_kategori($id_user, $id_kategori) {
        $bulan_sekarang = date('m');
        $tahun_sekarang = date('Y');

        $this->db->select_sum('nominal');
        $this->db->where('id_user', $id_user);
        $this->db->where('id_kategori', $id_kategori);
        $this->db->where('MONTH(tanggal)', $bulan_sekarang);
        $this->db->where('YEAR(tanggal)', $tahun_sekarang);
        
        $query = $this->db->get('expenses')->row();
        
        return ($query->nominal != null) ? $query->nominal : 0;
    }

    // Fungsi untuk menarik daftar riwayat transaksi
    public function get_riwayat_transaksi($id_user, $limit = null) {
        $this->db->select('expenses.*, categories.nama_kategori');
        $this->db->from('expenses');
        $this->db->join('categories', 'categories.id_kategori = expenses.id_kategori');
        $this->db->where('expenses.id_user', $id_user);
        $this->db->order_by('expenses.tanggal', 'DESC');
        $this->db->order_by('expenses.id_expense', 'DESC');
        
        // Jika limit diisi, batasi jumlah datanya
        if ($limit != null) {
            $this->db->limit($limit);
        }
        
        return $this->db->get()->result();
    }

    // Fungsi ini yang dicari oleh Controller untuk menyimpan data
    public function insert_data($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    // Menghitung total semua pengeluaran user (sejak awal akun dibuat)
    public function get_total_lifetime($id_user) {
        $this->db->select_sum('nominal');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('expenses')->row();
        return ($query->nominal != null) ? $query->nominal : 0;
    }

    // Menghitung berapa kali user melakukan transaksi
    public function count_transaksi($id_user) {
        $this->db->where('id_user', $id_user);
        return $this->db->count_all_results('expenses');
    }

    // Mencari 1 data spesifik untuk mengetahui nama file fotonya
    public function get_expense_by_id($id_expense, $id_user) {
        $this->db->where('id_expense', $id_expense);
        $this->db->where('id_user', $id_user); // Keamanan: Pastikan ini milik user yang sedang login
        return $this->db->get('expenses')->row();
    }

    // Eksekusi hapus baris di tabel
    public function delete_data($id_expense, $id_user) {
        $this->db->where('id_expense', $id_expense);
        $this->db->where('id_user', $id_user);
        return $this->db->delete('expenses');
    }
}