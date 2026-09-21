<div class="container mt-4 mb-5">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('profil') ?>" class="text-dark me-3"><i class="bi bi-arrow-left fs-4"></i></a>
        <h4 class="mb-0 fw-bold">Pengaturan Akun</h4>
    </div>

    <?= $this->session->flashdata('pesan'); ?>

    <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
        <i class="bi bi-shield-lock text-primary" style="font-size: 3rem;"></i>
        <h5 class="fw-bold mt-3">Keamanan Akun</h5>
        <p class="text-muted">Kami akan mengirimkan tautan khusus ke email <strong><?= $this->session->userdata('email'); ?></strong> untuk mengatur ulang kata sandi Anda.</p>
        
        <a href="<?= base_url('profil/kirim_reset_email') ?>" class="btn btn-primary btn-lg mt-2 rounded-3">
            <i class="bi bi-envelope"></i> Kirim Link Reset Password
        </a>
    </div>
</div>