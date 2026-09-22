<!DOCTYPE html>
<html lang="id">
    <div class="container-fluid p-0 mb-5 pb-5">
    <!-- Header Banner -->
    <div class="bg-livin header-curve pt-4 pb-5 px-3 text-center anim-1">
        <h5 class="mb-3 fw-bold text-white">Profil Saya</h5>
    </div>

    <!-- Konten Profil -->
    <div class="container overlap-card anim-2">
        <div class="card-livin p-4 mb-4 text-center shadow-sm">
            <div class="avatar-initial mx-auto mb-3 text-livin" style="width:70px; height:70px; font-size: 30px; background: #e6f0f9;">
                <?= strtoupper(substr($this->session->userdata('nama'), 0, 1)); ?>
            </div>
            <h5 class="fw-bold mb-1 text-dark"><?= $this->session->userdata('nama'); ?></h5>
            <p class="text-muted small mb-0"><?= $this->session->userdata('email'); ?></p>
        </div>

        <div class="row g-3 mb-4 anim-3">
            <div class="col-6">
                <div class="card-livin p-3 text-center h-100 shadow-sm">
                    <i class="bi bi-receipt text-warning fs-3 mb-2"></i>
                    <h6 class="text-muted small mb-1">Total Struk</h6>
                    <h5 class="fw-bold text-dark mb-0"><?= $total_transaksi; ?></h5>
                </div>
            </div>
            <div class="col-6">
                <div class="card-livin p-3 text-center h-100 shadow-sm">
                    <i class="bi bi-wallet2 text-success fs-3 mb-2"></i>
                    <h6 class="text-muted small mb-1">Pengeluaran</h6>
                    <h6 class="fw-bold text-dark mb-0 text-truncate">Rp <?= number_format($total_lifetime, 0, ',', '.'); ?></h6>
                </div>
            </div>
        </div>

        <!-- Menu List -->
        <div class="card-livin shadow-sm anim-3 mb-4">
            <div class="list-group list-group-flush" style="border-radius: 1.5rem;">
                <a href="<?= base_url('profil/pengaturan'); ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center border-0 border-bottom">
                    <i class="bi bi-gear-fill text-livin me-3 fs-5"></i>
                    <span class="fw-bold text-dark">Pengaturan Akun</span>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </a>
                <a href="<?= base_url('auth/logout'); ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center border-0">
                    <i class="bi bi-box-arrow-right text-danger me-3 fs-5"></i>
                    <span class="fw-bold text-danger">Keluar (Logout)</span>
                </a>
            </div>
        </div>
    </div>
</div>
</html>