<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <script>
        const savedTheme = localStorage.getItem('uangku_theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>

    <style>
        body { background-color: #f4f6f9; font-family: 'Nunito', sans-serif; padding-bottom: 100px; }
        .bg-livin-header { background: linear-gradient(135deg, #005E9D 0%, #004a7c 100%); padding: 25px 20px 60px 20px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px; color: white; }
        .card-livin { background: white; border-radius: 20px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.03); }
        .overlap-card { margin-top: -40px; }
        .input-livin { border-radius: 12px; background-color: #F8F9FA; border: 1.5px solid #E9ECEF; padding: 12px 15px; font-weight: 600; font-size: 14px; }
        .input-livin:focus { border-color: #005E9D; box-shadow: 0 0 0 0.2rem rgba(0, 94, 157, 0.15); background: white; }
        
        /* DARK MODE */
        [data-theme="dark"] body { background-color: #121212 !important; color: #e4e6eb !important; }
        [data-theme="dark"] .bg-livin-header { background: linear-gradient(135deg, #1a1c1e 0%, #121212 100%); border-bottom: 1px solid #333; }
        [data-theme="dark"] .card-livin { background-color: #242526 !important; border: 1px solid #3a3b3c !important; }
        [data-theme="dark"] .text-dark { color: #e4e6eb !important; }
        [data-theme="dark"] .text-muted { color: #a6adb3 !important; }
        [data-theme="dark"] .input-livin { background-color: #3a3b3c !important; color: #e4e6eb !important; border-color: #4e4f50 !important; }
    </style>
</head>
<body>

    <!-- Header dengan Animasi Pertama -->
    <div class="bg-livin-header anim-1">
        <h5 class="fw-bold mb-0 text-white"><i class="bi bi-piggy-bank me-2"></i> Tabungan & Limit</h5>
        <small class="text-white-50">Kelola target menabung dan batasan pengeluaran bulananmu.</small>
    </div>

    <div class="container px-3 overlap-card">
        
        <div class="anim-2">
            <?= $this->session->flashdata('pesan'); ?>
        </div>

        <!-- KARTU INFORMASI UTAMA dengan Animasi Kedua -->
        <div class="row g-3 mb-4 anim-2">
            <div class="col-6">
                <div class="card-livin p-3 h-100 text-center">
                    <span class="text-muted small fw-bold">Total Tabungan</span>
                    <h5 class="fw-bolder text-success mt-1 mb-0">Rp <?= number_format($total_tabungan, 0, ',', '.'); ?></h5>
                </div>
            </div>
            <div class="col-6">
                <div class="card-livin p-3 h-100 text-center">
                    <span class="text-muted small fw-bold">Limit Bulan Ini</span>
                    <h5 class="fw-bolder text-primary mt-1 mb-0">Rp <?= number_format($user['limit_pengeluaran'] ?? 0, 0, ',', '.'); ?></h5>
                </div>
            </div>
        </div>

        <!-- FORM TAMBAH SETORAN dengan Animasi Ketiga -->
        <div class="card-livin p-4 mb-4 anim-3">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-plus-circle-fill text-success me-2"></i> Setor / Tambah Tabungan</h6>
            <form action="<?= base_url('tabungan/simpan_tabungan'); ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">Nominal Tabungan (Rp)</label>
                    <input type="number" name="nominal" class="form-control input-livin" min="0" required placeholder="Contoh: 100000">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control input-livin" value="<?= date('Y-m-d'); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">Keterangan / Tujuan (Opsional)</label>
                    <input type="text" name="deskripsi" class="form-control input-livin" placeholder="Contoh: Nabung beli laptop">
                </div>
                <button type="submit" class="btn btn-success w-100 fw-bold py-2 rounded-pill" style="border:none;">Setor Tabungan</button>
            </form>
        </div>

        <!-- RIWAYAT TABUNGAN dengan Animasi Ketiga -->
        <div class="anim-3">
            <h6 class="fw-bold mb-3 ms-1 text-dark">Riwayat Setoran Tabungan</h6>
            <div class="card-livin p-3">
                <?php if(!empty($tabungan)): ?>
                    <?php foreach($tabungan as $row): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <div>
                            <h6 class="mb-0 fw-bold text-dark" style="font-size:14px;"><?= !empty($row->deskripsi) ? $row->deskripsi : 'Tabungan Rutin'; ?></h6>
                            <small class="text-muted" style="font-size:11px;"><?= date('d M Y', strtotime($row->tanggal)); ?></small>
                        </div>
                        <span class="fw-bold text-success" style="font-size:14px;">+ Rp <?= number_format($row->nominal, 0, ',', '.'); ?></span>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted small mb-0 py-3">Belum ada riwayat tabungan.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</body>
</html>