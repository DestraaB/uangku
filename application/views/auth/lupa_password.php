<style>
    body { background-color: var(--livin-light); height: 100vh; display: flex; align-items: center; justify-content: center; }
    .auth-card { max-width: 400px; width: 100%; padding: 2rem; }
    .icon-circle { width: 80px; height: 80px; background: #e9eef3; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; color: var(--livin-blue); font-size: 35px; }
    [data-theme="dark"] .icon-circle { background: #3a3b3c !important; color: #87CEEB !important; }
</style>

<div class="container d-flex justify-content-center anim-1">
    <div class="card-livin auth-card shadow-sm text-center">
        
        <div class="icon-circle">
            <i class="bi bi-shield-lock-fill"></i>
        </div>

        <h4 class="fw-bold mb-2 text-dark">Lupa Password?</h4>
        <p class="text-muted small mb-4">Masukkan email yang terdaftar, kami akan mengirimkan instruksi pemulihan.</p>

        <?= $this->session->flashdata('pesan'); ?>

        <form action="<?= base_url('auth/lupa_password'); ?>" method="post">
            <div class="mb-4 text-start">
                <label class="form-label text-muted small fw-bold mb-1">Email</label>
                <input type="email" class="form-control input-livin" name="email" placeholder="contoh@email.com" value="<?= set_value('email'); ?>">
                <?= form_error('email', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
            </div>

            <button type="submit" class="btn btn-livin w-100 mb-3">Kirim Instruksi</button>
        </form>

        <a href="<?= base_url('auth/login'); ?>" class="text-decoration-none text-muted small fw-bold">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Login
        </a>
    </div>
</div>