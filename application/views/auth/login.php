<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Uangku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #ffffff; animation: pageFadeIn 0.5s ease-out; }
        @keyframes pageFadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        .text-livin { color: #005E9D !important; }
        .btn-livin { background-color: #005E9D; color: white; border-radius: 50rem; font-weight: 700; padding: 12px; border: none; }
        .btn-livin:hover { background-color: #004a7c; }
        .input-livin { border-radius: 1rem; background-color: #F8F9FA; border: 1px solid #E9ECEF; padding: 12px 16px; font-weight: 600; }
        .input-livin:focus { border-color: #005E9D; box-shadow: 0 0 0 0.2rem rgba(0, 94, 157, 0.15); background: white; }
    </style>
</head>
<body>
<div class="container d-flex flex-column justify-content-center" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 text-center p-4">
            <div class="mb-5 mt-4">
                <i class="bi bi-wallet2 text-livin" style="font-size: 5rem;"></i>
                <h1 class="fw-bold text-livin mt-2">Uangku</h1>
                <p class="text-muted small">Kelola keuangan Anda seutuhnya.</p>
            </div>

            <?= $this->session->flashdata('pesan'); ?>

            <form action="<?= base_url('auth/proses_login'); ?>" method="POST" class="text-start">
                <div class="mb-3">
                    <input type="email" name="email" class="form-control input-livin" placeholder="Alamat Email" required>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" class="form-control input-livin" placeholder="Kata Sandi" required>
                </div>
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-livin shadow-sm">Login</button>
                </div>
            </form>
            
            <div class="text-center pb-4">
                <a href="<?= base_url('auth/register'); ?>" class="text-decoration-none text-muted small fw-bold">Belum punya akun? <span class="text-livin">Daftar Sekarang</span></a>
                <br><br>
                <!-- Tambahkan URL menuju fitur lupa password yang sudah kamu buat -->
                <a href="<?= base_url('profil/pengaturan'); ?>" class="text-decoration-none text-muted small">Lupa Password?</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>