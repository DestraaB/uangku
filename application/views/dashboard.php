<!DOCTYPE html>
<html lang="id">
<div class="container-fluid p-0 mb-5 pb-5">
    <!-- Header Melengkung Biru -->
    <div class="bg-livin header-curve pt-4 px-3 anim-1">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle d-flex justify-content-center align-items-center text-white fw-bold me-2" style="width:40px; height:40px;">
                    <?= strtoupper(substr($this->session->userdata('nama'), 0, 1)); ?>
                </div>
                <div>
                    <small class="d-block text-white-50" style="font-size:11px;">Selamat datang,</small>
                    <span class="fw-bold text-white"><?= strtok($this->session->userdata('nama'), " "); ?></span>
                </div>
            </div>
            <i class="bi bi-bell-fill fs-5 text-white"></i>
        </div>
    </div>

    <!-- Kartu Saldo (Melayang) -->
    <div class="container overlap-card anim-2">
        <div class="card-livin p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted fw-bold small">Total Pengeluaran Bulan Ini</span>
                <i class="bi bi-wallet2 text-livin"></i>
            </div>
            <h2 class="fw-bolder text-dark mb-0">Rp <?= number_format($total_pengeluaran, 0, ',', '.'); ?></h2>
            <hr class="text-muted my-3 opacity-25">
            <a href="<?= base_url('expense/riwayat'); ?>" class="text-decoration-none text-livin fw-bold small d-block text-center">
                Lihat Semua Riwayat <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <!-- Transaksi Terbaru (Mirip Transaksi Favorit) -->
        <h6 class="fw-bold mb-3 ms-1 text-dark anim-3">Transaksi Terakhir</h6>
        <div class="card-livin p-3 anim-3">
            <?php foreach($riwayat as $row): ?>
            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="avatar-initial me-3">
                        <?= strtoupper(substr($row->nama_kategori, 0, 2)); ?>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark" style="font-size:14px;"><?= $row->nama_kategori; ?></h6>
                        <small class="text-muted" style="font-size:11px;"><?= date('d M Y', strtotime($row->tanggal)); ?> &bull; <?= $row->deskripsi; ?></small>
                    </div>
                </div>
                <div class="text-end">
                    <span class="fw-bold text-danger d-block" style="font-size:14px;">- Rp <?= number_format($row->nominal, 0, ',', '.'); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</html>