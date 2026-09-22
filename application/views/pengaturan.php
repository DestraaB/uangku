<!DOCTYPE html>
<html lang="id">
<div class="container-fluid p-0 mb-5 pb-5">
    <div class="bg-white pt-4 pb-3 px-3 border-bottom d-flex align-items-center anim-1 shadow-sm">
        <a href="<?= base_url('profil') ?>" class="text-dark me-3"><i class="bi bi-arrow-left fs-4"></i></a>
        <h5 class="mb-0 fw-bold text-dark">Pengaturan Akun</h5>
    </div>

    <div class="container mt-4 anim-2">
        <?= $this->session->flashdata('pesan'); ?>

        <div class="card-livin p-4 text-center shadow-sm">
            <i class="bi bi-shield-lock text-livin mb-3" style="font-size: 4rem;"></i>
            <h5 class="fw-bold mt-2 text-dark">Keamanan & Sandi</h5>
            <p class="text-muted small">Kami akan mengirimkan link khusus ke email <strong><?= $this->session->userdata('email'); ?></strong> untuk mereset kata sandi Anda dengan aman.</p>
            
            <a href="<?= base_url('profil/kirim_reset_email') ?>" class="btn btn-livin w-100 mt-3">
                <i class="bi bi-envelope me-1"></i> Kirim Link Reset
            </a>
        </div>
    </div>
</div>
</html>