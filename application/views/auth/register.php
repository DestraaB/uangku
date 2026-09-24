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

        /* ================= DARK MODE GLOBAL & FORM ================= */
        [data-theme="dark"] body { background: #121212 !important; color: #e4e6eb !important; }
        [data-theme="dark"] .auth-card { background-color: #242526 !important; box-shadow: none !important; }
        [data-theme="dark"] .text-livin { color: #87CEEB !important; }
        
        [data-theme="dark"] .form-control {
            background-color: #3a3b3c !important;
            color: #e4e6eb !important;
            border-color: #4e4f50 !important;
        }
        [data-theme="dark"] .form-control::placeholder {
            color: #b0b3b8 !important;
        }
        [data-theme="dark"] .text-muted {
            color: #b0b3b8 !important;
        }

        /* ================= STYLE TOMBOL TOGGLE ================= */
        .theme-switch { display: inline-block; height: 34px; position: relative; width: 64px; }
        .theme-switch input { display: none; }
        .slider { 
            background-color: #ccc; 
            bottom: 0; left: 0; position: absolute; right: 0; top: 0; 
            cursor: pointer; transition: .4s; border-radius: 34px; 
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 8px;
        }
        .slider:before { 
            background-color: #fff; bottom: 4px; content: ""; height: 26px; left: 4px; 
            position: absolute; transition: .4s; width: 26px; border-radius: 50%; z-index: 2;
        }
        .moon-icon { color: #f1c40f; font-size: 14px; z-index: 1; }
        .sun-icon { color: #f39c12; font-size: 14px; z-index: 1; }
        
        input:checked + .slider { background-color: #242526; border: 1px solid #4e4f50; }
        input:checked + .slider:before { transform: translateX(30px); background-color: #87CEEB; }
    </style>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleSwitch = document.querySelector('#checkbox-theme');
            const currentTheme = localStorage.getItem('theme');

            // Cek status saat halaman pertama kali dimuat
            if (currentTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
                if (toggleSwitch) toggleSwitch.checked = true;
            }

            // Fungsi saat tombol diklik
            if (toggleSwitch) {
                toggleSwitch.addEventListener('change', function(e) {
                    if (e.target.checked) {
                        document.documentElement.setAttribute('data-theme', 'dark');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        document.documentElement.setAttribute('data-theme', 'light');
                        localStorage.setItem('theme', 'light');
                    }    
                });
            }
        });
    </script>
</head>
<body>

<!-- BAGIAN TOMBOL DARK MODE -->
<div class="theme-switch-wrapper" style="position: absolute; top: 20px; right: 20px; z-index: 99;">
    <label class="theme-switch" for="checkbox-theme">
        <input type="checkbox" id="checkbox-theme" />
        <div class="slider round">
            <i class="bi bi-moon-fill moon-icon"></i>
            <i class="bi bi-sun-fill sun-icon"></i>
        </div>
    </label>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            
            <div class="auth-card">
                <div class="text-center mb-4">
                    <h3 class="fw-bolder text-livin mb-1">Daftar Akun</h3>
                    <p class="text-muted small">Mulai gaya hidup finansial yang baru.</p>
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
                    <div class="d-grid mb-4 mt-2">
                        <button type="submit" class="btn btn-livin">Mulai Sekarang</button>
                    </div>
                </form>
                
                <div class="text-center mt-3">
                    <a href="<?= base_url('auth/login'); ?>" class="text-decoration-none text-muted small fw-bold">Sudah punya akun? <span class="text-livin">Login di sini</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>