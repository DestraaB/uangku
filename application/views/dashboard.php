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
        </div>
    </div>

    <!-- Kartu Saldo (Melayang) -->
    <div class="container overlap-card anim-2">
        
        <!-- Kartu 1: Saldo Utama, Pemasukan & Pengeluaran -->
        <div class="card-livin p-4 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted fw-bold small">Saldo Aktif</span>
                <i class="bi bi-wallet2 text-livin"></i>
            </div>
            <h2 class="fw-bolder text-dark mb-0">Rp <?= number_format($saldo_aktif, 0, ',', '.'); ?></h2>
            
            <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                <div>
                    <p class="text-muted small mb-0"><i class="bi bi-arrow-down-circle-fill text-success me-1"></i> Pemasukan</p>
                    <span class="fw-bold text-dark small">Rp <?= number_format($total_pemasukan, 0, ',', '.'); ?></span>
                </div>
                <div class="text-end">
                    <p class="text-muted small mb-0"><i class="bi bi-arrow-up-circle-fill text-danger me-1"></i> Pengeluaran</p>
                    <span class="fw-bold text-dark small">Rp <?= number_format($total_pengeluaran, 0, ',', '.'); ?></span>
                </div>
            </div>

            <hr class="text-muted my-3 opacity-25">
            <a href="<?= base_url('expense/riwayat'); ?>" class="text-decoration-none text-livin fw-bold small d-block text-center">
                Lihat Semua Riwayat <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <!-- Kartu 2 & 3: Tabungan & Limit -->
        <div class="row g-2 mb-4">
            <div class="col-6">
                <div class="card-livin p-3 h-100">
                    <p class="text-muted small fw-bold mb-1"><i class="bi bi-piggy-bank-fill text-primary me-1"></i> Tabungan</p>
                    <h6 class="fw-bolder text-dark mb-0">Rp <?= number_format($total_tabungan, 0, ',', '.'); ?></h6>
                </div>
            </div>
            <div class="col-6">
                <div class="card-livin p-3 h-100">
                    <p class="text-muted small fw-bold mb-1"><i class="bi bi-speedometer2 text-warning me-1"></i> Sisa Limit</p>
                    <h6 class="fw-bolder text-dark mb-2">Rp <?= number_format($sisa_limit, 0, ',', '.'); ?></h6>
                    <div class="progress" style="height: 5px; border-radius: 10px; background-color: #e9ecef;">
                        <!-- Class bg-danger akan muncul jika limit sudah terpakai 80% ke atas -->
                        <div class="progress-bar <?= ($persentase_limit >= 80) ? 'bg-danger' : 'bg-warning'; ?>" style="width: <?= $persentase_limit; ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Warning Limit (Otomatis Muncul) -->
        <?php if($persentase_limit >= 80): ?>
        <div class="alert alert-danger border-0 shadow-sm rounded-4 d-flex align-items-center mb-4 p-3 anim-2" role="alert">
            <i class="bi bi-exclamation-triangle-fill text-danger fs-4 me-3"></i>
            <div>
                <h6 class="fw-bold mb-0 text-danger" style="font-size: 13px;">Awas Overbudget!</h6>
                <span class="small text-danger" style="font-size: 11px;">Pengeluaranmu sudah mendekati limit.</span>
            </div>
        </div>
        <?php endif; ?>

        <!-- Transaksi Terbaru (Gabungan Pemasukan & Pengeluaran) -->
        <h6 class="fw-bold mb-3 ms-1 text-dark anim-3">Transaksi Terakhir</h6>
        <div class="card-livin p-3 anim-3">
            <?php if(!empty($riwayat)): ?>
                <?php foreach($riwayat as $row): ?>
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="avatar-initial me-3">
                            <?= strtoupper(substr($row->sumber_atau_kategori, 0, 2)); ?>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold text-dark" style="font-size:14px;"><?= $row->sumber_atau_kategori; ?></h6>
                            <small class="text-muted" style="font-size:11px;"><?= date('d M Y', strtotime($row->tanggal)); ?> &bull; <?= $row->deskripsi; ?></small>
                        </div>
                    </div>
                    <div class="text-end">
                        <!-- Pengecekan: Jika Pemasukan warnanya Hijau (+), Jika Pengeluaran Merah (-) -->
                        <?php if($row->jenis == 'Pemasukan'): ?>
                            <span class="fw-bold text-success d-block" style="font-size:14px;">+ Rp <?= number_format($row->nominal, 0, ',', '.'); ?></span>
                        <?php else: ?>
                            <span class="fw-bold text-danger d-block" style="font-size:14px;">- Rp <?= number_format($row->nominal, 0, ',', '.'); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted small mb-0 py-2">Belum ada transaksi dicatat.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</html>