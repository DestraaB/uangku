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

        <!-- RIWAYAT -->
        <a href="<?= base_url('expense/riwayat'); ?>" class="bottom-nav-item <?= ($this->uri->segment(2) == 'riwayat') ? 'active' : ''; ?>">
            <i class="bi <?= ($this->uri->segment(2) == 'riwayat') ? 'bi-clock-history' : 'bi-clock'; ?>"></i>
            <span>Riwayat</span>
        </a>

        <!-- TOMBOL CATAT -->
        <a href="<?= base_url('expense/tambah'); ?>" class="bottom-nav-item bottom-nav-add">
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