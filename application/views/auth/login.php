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
        body { 
            font-family: 'Nunito', sans-serif; 
            /* Latar belakang gradasi biru sangat lembut */
            background: linear-gradient(135deg, #e6f0f9 0%, #f4f6f9 100%); 
            animation: pageFadeIn 0.5s ease-out; 
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        @keyframes pageFadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        
        .auth-card {
            background: #ffffff;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0, 94, 157, 0.08);
            padding: 40px 30px;
        }
        .icon-circle {
            width: 90px;
            height: 90px;
            background: rgba(0, 94, 157, 0.08);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .text-livin { color: #005E9D !important; }
        .btn-livin { background-color: #005E9D; color: white; border-radius: 50rem; font-weight: 700; padding: 14px; border: none; transition: all 0.3s; }
        .btn-livin:hover { background-color: #004a7c; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0, 94, 157, 0.3); }
        .input-livin { border-radius: 1rem; background-color: #F8F9FA; border: 1.5px solid #E9ECEF; padding: 14px 18px; font-weight: 600; font-size: 14px; }
        .input-livin:focus { border-color: #005E9D; box-shadow: 0 0 0 0.25rem rgba(0, 94, 157, 0.15); background: white; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            
            <div class="auth-card text-center">
                <div class="icon-circle">
                    <i class="bi bi-wallet2 text-livin" style="font-size: 3.5rem;"></i>
                </div>
                <h2 class="fw-bolder text-livin mb-1">Uangku</h2>
                <p class="text-muted small mb-4">Kelola keuangan Anda seutuhnya.</p>

                <?= $this->session->flashdata('pesan'); ?>

                <form action="<?= base_url('auth/proses_login'); ?>" method="POST" class="text-start">
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control input-livin" placeholder="Alamat Email" required>
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" class="form-control input-livin" placeholder="Kata Sandi" required>
                    </div>
                    <div class="d-grid mb-4 mt-2">
                        <button type="submit" class="btn btn-livin">Login</button>
                    </div>
                </form>
                
                <div class="mt-4">
                    <a href="<?= base_url('auth/register'); ?>" class="text-decoration-none text-muted small fw-bold d-block mb-2">Belum punya akun? <span class="text-livin">Daftar Sekarang</span></a>
                    <a href="<?= base_url('auth/lupa_password'); ?>" class="text-decoration-none text-muted small">Lupa Password?</a>
            </div>

        </div>
    </div>
</div>
</body>
</html>