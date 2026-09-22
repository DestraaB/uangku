<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandi Baru - Uangku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #F4F6F9; animation: slideUp 0.5s ease-out; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .text-livin { color: #005E9D !important; }
        .btn-livin { background-color: #005E9D; color: white; border-radius: 50rem; font-weight: 700; padding: 12px; border:none; }
        .input-livin { border-radius: 1rem; background-color: #F8F9FA; border: 1px solid #E9ECEF; padding: 12px 16px; font-weight: 600;}
    </style>
</head>
<body class="d-flex align-items-center" style="min-height: 100vh;">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 text-center">
            
            <h3 class="fw-bold text-livin mb-2">Buat Sandi Baru</h3>
            <p class="text-muted small mb-4">Masukkan kombinasi rahasia baru Anda.</p>

            <form action="<?= base_url('auth/proses_password_baru'); ?>" method="POST" class="text-start">
                <input type="hidden" name="token" value="<?= $token; ?>">
                
                <div class="mb-3">
                    <input type="password" name="password" class="form-control input-livin" placeholder="Kata Sandi Baru" required minlength="6">
                </div>
                <div class="mb-4">
                    <input type="password" name="konfirmasi_password" class="form-control input-livin" placeholder="Konfirmasi Kata Sandi" required>
                </div>
                
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-livin shadow-sm">Simpan & Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>