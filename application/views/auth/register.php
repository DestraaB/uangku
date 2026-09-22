<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Uangku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 p-4 my-4">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary">Daftar Uangku</h2>
                    <p class="text-muted">Buat akun untuk memulai</p>
                </div>

                <!-- Menampilkan Error Validasi Form -->
                <?= validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>

                <form action="<?= base_url('auth/proses_register'); ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-muted">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control form-control-lg" value="<?= set_value('nama'); ?>" placeholder="Contoh: Budi Santoso" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" value="<?= set_value('email'); ?>" placeholder="email@contoh.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted">Password (Min. 6 Karakter)</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="******" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted">Konfirmasi Password</label>
                        <input type="password" name="konfirmasi_password" class="form-control form-control-lg" placeholder="Ulangi kata sandi" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">Daftar Akun</button>
                    </div>
                </form>
                
                <div class="text-center mt-4">
                    <p class="text-muted">Sudah punya akun? <a href="<?= base_url('auth/login'); ?>" class="text-decoration-none fw-bold">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>