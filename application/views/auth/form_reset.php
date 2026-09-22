<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru - Uangku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="text-center mb-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-key-fill fs-1"></i>
                    </div>
                    <h3 class="fw-bold text-primary">Password Baru</h3>
                    <p class="text-muted">Silakan masukkan kata sandi baru untuk akun Anda.</p>
                </div>

                <form action="<?= base_url('auth/proses_password_baru'); ?>" method="POST">
                    
                    <!-- Token rahasia dari URL ditangkap dan disembunyikan di sini -->
                    <input type="hidden" name="token" value="<?= $token; ?>">
                    
                    <div class="mb-4">
                        <label class="form-label text-muted fw-bold">Password Baru (Min. 6 Karakter)</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="******" required minlength="6">
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">Simpan Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>