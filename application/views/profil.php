<!-- Hapus margin default container agar banner menempel di ujung layar -->
<div class="container-fluid p-0 mb-5 pb-5">
    
    <!-- Header / Banner Cover Melengkung -->
    <div class="bg-primary text-white pt-4 pb-5 px-3 text-center" style="border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
        <h5 class="mb-3 fw-bold">Profil Saya</h5>
    </div>

    <!-- Kartu Profil Identitas (Melayang ke atas) -->
    <div class="container" style="margin-top: -45px;">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body text-center p-4">
                <!-- Avatar Berinisial Huruf Depan User -->
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 80px; height: 80px;">
                    <h1 class="text-primary fw-bold mb-0">
                        <?= strtoupper(substr($this->session->userdata('nama'), 0, 1)); ?>
                    </h1>
                </div>
                <h5 class="fw-bold mb-1"><?= $this->session->userdata('nama'); ?></h5>
                <p class="text-muted mb-0"><i class="bi bi-envelope"></i> <?= $this->session->userdata('email'); ?></p>
            </div>
        </div>

        <!-- Kartu Statistik (Kiri & Kanan) -->
        <div class="row g-3 mb-4">
            <!-- Box Total Transaksi -->
            <div class="col-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body text-center p-3">
                        <i class="bi bi-receipt text-warning fs-2 mb-2"></i>
                        <h6 class="text-muted mb-1" style="font-size: 13px;">Total Struk</h6>
                        <h4 class="fw-bold mb-0 text-dark"><?= $total_transaksi; ?></h4>
                    </div>
                </div>
            </div>
            <!-- Box Total Pengeluaran -->
            <div class="col-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body text-center p-3">
                        <i class="bi bi-wallet2 text-success fs-2 mb-2"></i>
                        <h6 class="text-muted mb-1" style="font-size: 13px;">Pengeluaran</h6>
                        <h6 class="fw-bold mb-0 text-dark text-truncate">Rp <?= number_format($total_lifetime, 0, ',', '.'); ?></h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu List ala Aplikasi Mobile -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="list-group list-group-flush rounded-4">
                <a href="<?= base_url('profil/pengaturan'); ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                        <i class="bi bi-gear-fill"></i>
                    </div>
                    <span class="fw-bold">Pengaturan Akun</span>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </a>
                
                <a href="#" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info rounded p-2 me-3">
                        <i class="bi bi-question-circle-fill"></i>
                    </div>
                    <span class="fw-bold">Pusat Bantuan</span>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </a>

                <!-- Tombol Logout -->
                <a href="<?= base_url('auth/logout'); ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center text-danger">
                    <div class="bg-danger bg-opacity-10 text-danger rounded p-2 me-3">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    <span class="fw-bold">Keluar (Logout)</span>
                </a>
            </div>
        </div>
    </div>
</div>