<!-- =====================================================
     STYLE FOOTER / NAVIGASI BAWAH
====================================================== -->
<style>
.bottom-nav {
    position: fixed !important;
    bottom: 0 !important;
    left: 0 !important;
    right: 0 !important;
    width: 100%;
    height: 72px; /* Lebih ramping & elegan */
    background: #ffffff;
    border-radius: 22px 22px 0 0;
    box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.06);
    z-index: 99999 !important;
    margin: 0 !important;
    padding: 0 !important;
    transition: background-color 0.4s ease, border-color 0.4s ease;
}

/* Menggunakan space-evenly agar 6 menu memiliki jarak yang 100% sama rata */
.bottom-nav-inner {
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    height: 100%;
    padding: 0 4px;
}

.bottom-nav-item {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #9aa2aa; 
    font-size: 10px;
    font-weight: 700;
    transition: all 0.2s ease;
    -webkit-tap-highlight-color: transparent;
}

.bottom-nav-item i {
    font-size: 22px;
    margin-bottom: 3px;
    transition: transform 0.2s ease, color 0.2s ease;
}

.bottom-nav-item span {
    white-space: nowrap;
}

/* Efek saat menu aktif atau disentuh */
.bottom-nav-item.active, .bottom-nav-item:hover {
    color: #005E9D;
}
.bottom-nav-item.active i, .bottom-nav-item:hover i {
    transform: translateY(-2px);
}

/* =====================================================
   TOMBOL QR (CATAT) LEBIH RAPI & MENYATU
====================================================== */
.qr-btn-wrapper {
    width: 46px;
    height: 46px;
    background: linear-gradient(135deg, #005E9D, #004a7c);
    border-radius: 14px; /* Bentuk squircle modern ala Livin/Apple */
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 5px 15px rgba(0, 94, 157, 0.35);
    margin-bottom: 4px;
    margin-top: -18px; /* Efek melayang ringan */
    border: 4px solid #ffffff;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.bottom-nav-item:hover .qr-btn-wrapper {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 94, 157, 0.45);
}

.qr-btn-wrapper i {
    color: #ffffff !important;
    font-size: 22px;
    margin: 0 !important;
    transform: none !important;
}

.qr-text {
    color: #005E9D;
    font-weight: 800;
}

body {
    padding-bottom: 90px;
}

/* Responsif untuk layar HP kecil */
@media (max-width: 576px) {
    .bottom-nav { height: 68px; }
    .bottom-nav-item i { font-size: 20px; }
    .bottom-nav-item span { font-size: 9px; }
    .qr-btn-wrapper { width: 42px; height: 42px; border-width: 3px; margin-top: -14px; }
    .qr-btn-wrapper i { font-size: 20px; }
}

/* =====================================================
   DARK MODE OVERRIDES FOOTER & MODAL
====================================================== */
[data-theme="dark"] .bottom-nav { background: #1e1e1e !important; box-shadow: 0 -4px 20px rgba(0,0,0,0.5); }
[data-theme="dark"] .qr-btn-wrapper { border-color: #1e1e1e !important; }
[data-theme="dark"] .bottom-nav-item { color: #8d979f; }
[data-theme="dark"] .bottom-nav-item.active, [data-theme="dark"] .bottom-nav-item:hover { color: #87CEEB !important; }
[data-theme="dark"] .qr-text { color: #87CEEB !important; }

[data-theme="dark"] .modal-content { background-color: #242526 !important; border-color: #3a3b3c !important; }
[data-theme="dark"] .modal-title, [data-theme="dark"] h6 { color: #e4e6eb !important; }
[data-theme="dark"] .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }
[data-theme="dark"] .modal-card-in { background-color: #163323 !important; }
[data-theme="dark"] .modal-card-out { background-color: #3a1c1c !important; }
</style>

<!-- =====================================================
     NAVIGASI BAWAH HTML (6 MENU SEJAJAR RATA)
====================================================== -->
<nav class="bottom-nav">
    <div class="bottom-nav-inner">
        
        <!-- 1. BERANDA -->
        <a href="<?= base_url('home'); ?>" class="bottom-nav-item <?= ($this->uri->segment(1) == 'home') ? 'active' : ''; ?>">
            <i class="bi <?= ($this->uri->segment(1) == 'home') ? 'bi-house-door-fill' : 'bi-house-door'; ?>"></i>
            <span>Beranda</span>
        </a>

        <!-- 2. RIWAYAT -->
        <a href="<?= base_url('expense/riwayat'); ?>" class="bottom-nav-item <?= ($this->uri->segment(2) == 'riwayat') ? 'active' : ''; ?>">
            <i class="bi <?= ($this->uri->segment(2) == 'riwayat') ? 'bi-clock-history' : 'bi-clock'; ?>"></i>
            <span>Riwayat</span>
        </a>

        <!-- 3. TABUNGAN -->
        <a href="<?= base_url('tabungan'); ?>" class="bottom-nav-item <?= ($this->uri->segment(1) == 'tabungan') ? 'active' : ''; ?>">
            <i class="bi <?= ($this->uri->segment(1) == 'tabungan') ? 'bi-piggy-bank-fill' : 'bi-piggy-bank'; ?>"></i>
            <span>Tabungan</span>
        </a>

        <!-- 4. CATAT (QR) -->
        <a href="#" class="bottom-nav-item" data-bs-toggle="modal" data-bs-target="#modalPilihTransaksi">
            <div class="qr-btn-wrapper">
                <i class="bi bi-upc-scan"></i>
            </div>
            <span class="qr-text">Catat</span>
        </a>

        <!-- 5. LIMIT -->
        <a href="<?= base_url('limit'); ?>" class="bottom-nav-item <?= ($this->uri->segment(1) == 'limit') ? 'active' : ''; ?>">
            <i class="bi <?= ($this->uri->segment(1) == 'limit') ? 'bi-speedometer2' : 'bi-speedometer'; ?>"></i>
            <span>Limit</span>
        </a>

        <!-- 6. PROFIL -->
        <a href="<?= base_url('profil'); ?>" class="bottom-nav-item <?= ($this->uri->segment(1) == 'profil') ? 'active' : ''; ?>">
            <i class="bi <?= ($this->uri->segment(1) == 'profil') ? 'bi-person-fill' : 'bi-person'; ?>"></i>
            <span>Profil</span>
        </a>

    </div>
</nav>

<!-- =====================================================
     MODAL PILIH TRANSAKSI (Muncul saat tombol QR diklik)
====================================================== -->
<div class="modal fade" id="modalPilihTransaksi" tabindex="-1" aria-labelledby="modalTransaksiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content shadow" style="border-radius: 20px;">
      <div class="modal-header border-0 pb-0">
        <h6 class="modal-title fw-bold" id="modalTransaksiLabel">Buat Catatan Baru</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center pb-4">
        <div class="row g-3 mt-1">
            <!-- Pemasukan -->
            <div class="col-6">
                <a href="<?= base_url('pemasukan'); ?>" class="text-decoration-none">
                    <div class="card modal-card-in shadow-sm border-0 h-100" style="border-radius:15px; background: #eaf6fc;">
                        <div class="card-body py-4">
                            <i class="bi bi-arrow-down-circle-fill text-success" style="font-size: 2rem;"></i>
                            <h6 class="mt-2 mb-0 fw-bold text-dark" style="font-size: 13px;">Uang Masuk</h6>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Pengeluaran -->
            <div class="col-6">
                <a href="<?= base_url('expense/tambah'); ?>" class="text-decoration-none">
                    <div class="card modal-card-out shadow-sm border-0 h-100" style="border-radius:15px; background: #fceaea;">
                        <div class="card-body py-4">
                            <i class="bi bi-arrow-up-circle-fill text-danger" style="font-size: 2rem;"></i>
                            <h6 class="mt-2 mb-0 fw-bold text-dark" style="font-size: 13px;">Pengeluaran</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- =====================================================
     JAVASCRIPT BOOTSTRAP & BUG FIX TOMBOL KEMBALI HP
====================================================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function () {
                window.history.pushState(null, null, window.location.href);
            });
        });
        window.addEventListener('popstate', function () {
            const openModal = document.querySelector('.modal.show');
            if (openModal) {
                const modalInstance = bootstrap.Modal.getInstance(openModal);
                if (modalInstance) {
                    modalInstance.hide();
                }
            }
        });
    });
</script>
</body>
</html>