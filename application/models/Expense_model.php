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
    public function get_riwayat_transaksi($id_user) {
        $this->db->select('expenses.*, categories.nama_kategori');
        $this->db->from('expenses');
        $this->db->join('categories', 'categories.id_kategori = expenses.id_kategori'); // Mengambil nama kategori
        $this->db->where('expenses.id_user', $id_user);
        $this->db->order_by('expenses.tanggal', 'DESC'); // Urutkan dari yang terbaru
        $this->db->order_by('expenses.id_expense', 'DESC');
        
        return $this->db->get()->result(); // Mengembalikan banyak data (array of objects)
    }

    // Fungsi ini yang dicari oleh Controller untuk menyimpan data
    public function insert_data($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
}