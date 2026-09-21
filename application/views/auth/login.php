<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Uangku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary">Uangku</h2>
                    <p class="text-muted">Masuk untuk mencatat keuanganmu</p>
                </div>

                <!-- Pesan Error/Sukses -->
                <?= $this->session->flashdata('pesan'); ?>

                <form action="<?= base_url('auth/proses_login'); ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-muted">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="email@contoh.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="******" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">Masuk</button>
                    </div>
                </form>
                
                <div class="text-center mt-4">
                    <p class="text-muted">Belum punya akun? <a href="<?= base_url('auth/register'); ?>" class="text-decoration-none fw-bold">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>