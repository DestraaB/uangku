<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Uangku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #ffffff; animation: pageFadeIn 0.5s ease-out; }
        @keyframes pageFadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        .text-livin { color: #005E9D !important; }
        .btn-livin { background-color: #005E9D; color: white; border-radius: 50rem; font-weight: 700; padding: 12px; border: none; }
        .input-livin { border-radius: 1rem; background-color: #F8F9FA; border: 1px solid #E9ECEF; padding: 12px 16px; font-weight: 600; }
        .input-livin:focus { border-color: #005E9D; box-shadow: 0 0 0 0.2rem rgba(0, 94, 157, 0.15); background: white; }
    </style>
</head>
<body>
<div class="container d-flex flex-column justify-content-center py-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 p-4">
            <div class="text-center mb-4 mt-3">
                <h3 class="fw-bold text-livin">Selamat Datang</h3>
                <p class="text-muted small">Satu aplikasi untuk gaya hidup keuangan Anda.</p>
            </div>
            
            <?= validation_errors('<div class="alert alert-danger text-center rounded-4 small">', '</div>'); ?>

            <form action="<?= base_url('auth/proses_register'); ?>" method="POST">
                <div class="mb-3">
                    <input type="text" name="nama" class="form-control input-livin" value="<?= set_value('nama'); ?>" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control input-livin" value="<?= set_value('email'); ?>" placeholder="Alamat Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control input-livin" placeholder="Buat Kata Sandi" required minlength="6">
                </div>
                <div class="mb-4">
                    <input type="password" name="konfirmasi_password" class="form-control input-livin" placeholder="Konfirmasi Kata Sandi" required>
                </div>
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-livin shadow-sm">Mulai Sekarang</button>
                </div>
            </form>
            <div class="text-center pb-3">
                <a href="<?= base_url('auth/login'); ?>" class="text-decoration-none text-muted small fw-bold">Sudah punya akun? <span class="text-livin">Login di sini</span></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>