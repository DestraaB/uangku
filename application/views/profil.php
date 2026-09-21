<div class="container mt-4 mb-5">
    <h3 class="text-center mb-4">Profil Saya</h3>
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body text-center p-4">
            <!-- Icon Profil -->
            <i class="bi bi-person-circle text-primary" style="font-size: 4rem;"></i>
            <h4 class="mt-3 fw-bold"><?= $this->session->userdata('nama'); ?></h4>
            <p class="text-muted"><?= $this->session->userdata('email'); ?></p>
            
            <hr class="my-4">
            
            <!-- Tombol Logout yang memanggil fungsi di Controller Auth -->
            <div class="d-grid gap-2">
                <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger btn-lg rounded-3">
                    <i class="bi bi-box-arrow-right"></i> Keluar (Logout)
                </a>
            </div>
        </div>
    </div>
</div>