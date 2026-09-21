<!-- BOTTOM NAVIGATION BAR -->
<nav class="navbar fixed-bottom bg-white border-top shadow-sm d-flex justify-content-around py-2">
    <!-- Tombol Home -->
    <a href="<?= base_url('home'); ?>" class="text-decoration-none text-center <?= ($this->uri->segment(1) == 'home' || $this->uri->segment(1) == '') ? 'text-primary' : 'text-muted'; ?>">
        <i class="bi bi-house-door-fill fs-4"></i>
        <div style="font-size: 12px; margin-top: -5px;">Home</div>
    </a>

    <!-- Tombol Tambah (Di Tengah & Sedikit Lebih Besar) -->
    <a href="<?= base_url('expense/tambah'); ?>" class="text-decoration-none text-center">
        <!-- Icon Plus dilapisi lingkaran warna biru -->
        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 45px; height: 45px; margin-top: -15px; box-shadow: 0 4px 6px rgba(0,0,0,0.2);">
            <i class="bi bi-plus-lg fs-4"></i>
        </div>
        <div class="text-primary fw-bold" style="font-size: 12px;">Catat</div>
    </a>

    <!-- Tombol Profil / Riwayat -->
    <a href="<?= base_url('profil'); ?>" class="text-decoration-none text-center <?= ($this->uri->segment(1) == 'profil') ? 'text-primary' : 'text-muted'; ?>">
        <i class="bi bi-person-fill fs-4"></i>
        <div style="font-size: 12px; margin-top: -5px;">Profil</div>
    </a>
</nav>

<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>