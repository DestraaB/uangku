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
    height: 86px;
    background: #ffffff;
    border-radius: 22px 22px 0 0;
    box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.10);
    z-index: 99999 !important;
    margin: 0 !important;
    padding: 0 !important;
    transition: background-color 0.4s ease, border-color 0.4s ease;
}

.bottom-nav-inner {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding: 0 25px;
}

.bottom-nav-item {
    position: relative;
    width: 25%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #777;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.bottom-nav-item i {
    font-size: 25px;
    margin-bottom: 5px;
    line-height: 1;
}

.bottom-nav-item span {
    font-size: 11px;
    font-weight: 600;
}

.bottom-nav-item.active, .bottom-nav-item:hover {
    color: #0068a8;
}

.bottom-nav-add {
    justify-content: flex-end;
    padding-bottom: 12px;
    color: #0068a8;
}

.add-button {
    position: absolute;
    top: -30px;
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #0068a8;
    border: 5px solid #f4f6f9;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 5px 15px rgba(0, 94, 157, 0.30);
    transition: border-color 0.4s ease;
}

.add-button i {
    color: #ffffff;
    font-size: 28px;
    margin: 0;
}

body {
    padding-bottom: 95px;
}

@media (max-width: 576px) {
    .bottom-nav { height: 78px; }
    .bottom-nav-inner { padding: 0 10px; }
    .bottom-nav-item i { font-size: 22px; }
    .bottom-nav-item span { font-size: 10px; }
    .add-button { width: 60px; height: 60px; top: -27px; }
}

/* =====================================================
     TAMBAHAN DARK MODE FOOTER & MODAL POP-UP
====================================================== */
[data-theme="dark"] .bottom-nav { background: #1e1e1e !important; box-shadow: 0 -5px 20px rgba(0,0,0,0.5); }
[data-theme="dark"] .add-button { border-color: #121212 !important; }
[data-theme="dark"] .modal-content { background-color: #242526 !important; border-color: #3a3b3c !important; }
[data-theme="dark"] .modal-title, [data-theme="dark"] h6 { color: #e4e6eb !important; }
[data-theme="dark"] .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }
[data-theme="dark"] .modal-card-in { background-color: #163323 !important; }
[data-theme="dark"] .modal-card-out { background-color: #3a1c1c !important; }
[data-theme="dark"] .bottom-nav-item.active, [data-theme="dark"] .bottom-nav-item:hover { color: #87CEEB !important; }
[data-theme="dark"] .bottom-nav-item { color: #8d979f; }
</style>

<!-- =====================================================
     NAVIGASI BAWAH HTML
====================================================== -->
<nav class="bottom-nav">
    <div class="bottom-nav-inner">
        <!-- BERANDA -->
        <a href="<?= base_url('home'); ?>" class="bottom-nav-item <?= ($this->uri->segment(1) == 'home') ? 'active' : ''; ?>">
            <i class="bi <?= ($this->uri->segment(1) == 'home') ? 'bi-house-door-fill' : 'bi-house-door'; ?>"></i>
            <span>Beranda</span>
        </a>

        <!-- RIWAYAT (Bisa untuk Pemasukan & Pengeluaran nanti) -->
        <a href="<?= base_url('expense/riwayat'); ?>" class="bottom-nav-item <?= ($this->uri->segment(2) == 'riwayat') ? 'active' : ''; ?>">
            <i class="bi <?= ($this->uri->segment(2) == 'riwayat') ? 'bi-clock-history' : 'bi-clock'; ?>"></i>
            <span>Riwayat</span>
        </a>

        <!-- TOMBOL CATAT (Memanggil Modal) -->
        <a href="#" class="bottom-nav-item bottom-nav-add" data-bs-toggle="modal" data-bs-target="#modalPilihTransaksi">
            <div class="add-button">
                <i class="bi bi-upc-scan"></i>
            </div>
            <span>Catat</span>
        </a>

        <!-- PROFIL -->
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
            <!-- Pilihan Pemasukan -->
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
            <!-- Pilihan Pengeluaran (Disesuaikan dengan route lamamu) -->
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
     JAVASCRIPT BOOTSTRAP & BUG FIX
====================================================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script Trik Menangani Tombol Back HP pada Pop-up -->
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