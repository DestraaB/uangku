<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandi Baru - Uangku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { 
            font-family: 'Nunito', sans-serif; 
            background: linear-gradient(135deg, #e6f0f9 0%, #f4f6f9 100%); 
            animation: pageFadeIn 0.5s ease-out; 
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        @keyframes pageFadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        
        .auth-card { background: #ffffff; border-radius: 30px; box-shadow: 0 15px 35px rgba(0, 94, 157, 0.08); padding: 40px 30px; }
        .text-livin { color: #005E9D !important; }
        .btn-livin { background-color: #005E9D; color: white; border-radius: 50rem; font-weight: 700; padding: 14px; border: none; transition: all 0.3s; }
        .btn-livin:hover { background-color: #004a7c; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0, 94, 157, 0.3); }
        .input-livin { border-radius: 1rem; background-color: #F8F9FA; border: 1.5px solid #E9ECEF; padding: 14px 18px; font-weight: 600; font-size: 14px; }
        .input-livin:focus { border-color: #005E9D; box-shadow: 0 0 0 0.25rem rgba(0, 94, 157, 0.15); background: white; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            
            <div class="auth-card text-center">
                <i class="bi bi-shield-lock text-livin mb-3 d-block" style="font-size: 3rem;"></i>
                <h4 class="fw-bolder text-livin mb-2">Buat Sandi Baru</h4>
                <p class="text-muted small mb-4">Masukkan kombinasi rahasia baru Anda.</p>

                <form action="<?= base_url('auth/proses_password_baru'); ?>" method="POST" class="text-start">
                    <input type="hidden" name="token" value="<?= $token; ?>">
                    
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control input-livin" placeholder="Kata Sandi Baru" required minlength="6">
                    </div>
                    <div class="mb-4">
                        <input type="password" name="konfirmasi_password" class="form-control input-livin" placeholder="Konfirmasi Kata Sandi" required>
                    </div>
                    
                    <div class="d-grid mb-2 mt-2">
                        <button type="submit" class="btn btn-livin">Simpan & Login</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</body>
</html>