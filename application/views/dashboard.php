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


    <h5 class="mt-5 mb-3 text-muted">Riwayat Transaksi Terakhir</h5>
    
    <div class="list-group mb-5">
        <!-- Looping data riwayat dari Controller -->
        <?php foreach($riwayat as $row): ?>
        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
            <div>
                <h6 class="mb-1 fw-bold"><?= $row->nama_kategori; ?></h6>
                <small class="text-muted d-block"><?= date('d M Y', strtotime($row->tanggal)); ?></small>
                <?php if(!empty($row->deskripsi)): ?>
                    <small class="text-secondary"><?= $row->deskripsi; ?></small>
                <?php endif; ?>
            </div>
            
            <div class="text-end">
                <h6 class="mb-1 text-danger fw-bold">- Rp <?= number_format($row->nominal, 0, ',', '.'); ?></h6>
                
                <!-- Tombol untuk memicu Modal (Pop-up) Struk -->
                <button type="button" class="btn btn-sm btn-outline-secondary mt-1" data-bs-toggle="modal" data-bs-target="#strukModal<?= $row->id_expense; ?>">
                    <i class="bi bi-receipt"></i> Lihat Struk
                </button>
            </div>
        </div>

        <!-- Modal (Pop-up) Gambar Struk untuk setiap transaksi -->
        <div class="modal fade" id="strukModal<?= $row->id_expense; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Struk Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="<?= base_url('uploads/struk/'.$row->foto_struk); ?>" class="img-fluid rounded shadow-sm" alt="Foto Struk">
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
        <?php if(empty($riwayat)): ?>
            <div class="text-center text-muted my-4">Belum ada transaksi dicatat.</div>
        <?php endif; ?>
    </div>
</div>