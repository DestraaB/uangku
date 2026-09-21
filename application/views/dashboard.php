<!-- Pastikan memuat CSS Bootstrap di head -->
<div class="container mt-4 mb-5">
    <h3 class="mb-4">Halo, <?= $this->session->userdata('nama'); ?> 👋</h3>

    <!-- Notifikasi jika ada dari Controller Expense -->
    <?= $this->session->flashdata('pesan'); ?>

    <!-- Kartu Total Keseluruhan (Warna Utama) -->
    <div class="card bg-primary text-white mb-4 shadow-sm">
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-white-50">Total Pengeluaran (Bulan Ini)</h6>
            <!-- Gunakan number_format untuk mengubah 50000 menjadi 50.000 -->
            <h1 class="card-title mb-0">Rp <?= number_format($total_pengeluaran, 0, ',', '.'); ?></h1>
        </div>
    </div>

    <h5 class="mb-3 text-muted">Rincian Kategori</h5>
    
    <div class="row g-3">
        <!-- Kartu Primer (Kuning) -->
        <div class="col-12">
            <div class="card border-warning shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <span class="text-warning fw-bold">Primer (Pokok)</span>
                    <span class="fw-bold">Rp <?= number_format($total_primer, 0, ',', '.'); ?></span>
                </div>
            </div>
        </div>
        
        <!-- Kartu Sekunder (Biru Muda) -->
        <div class="col-12">
            <div class="card border-info shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <span class="text-info fw-bold">Sekunder</span>
                    <span class="fw-bold">Rp <?= number_format($total_sekunder, 0, ',', '.'); ?></span>
                </div>
            </div>
        </div>

        <!-- Kartu Tersier (Merah) -->
        <div class="col-12">
            <div class="card border-danger shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <span class="text-danger fw-bold">Tersier (Hiburan)</span>
                    <span class="fw-bold">Rp <?= number_format($total_tersier, 0, ',', '.'); ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tombol Tambah yang melayang atau di bawah (Floating Action Button style) -->
    <div class="d-grid gap-2 mt-4">
        <a href="<?= base_url('expense/tambah'); ?>" class="btn btn-success btn-lg">
            + Tambah Pengeluaran
        </a>
    </div>
</div>