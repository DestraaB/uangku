<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Chart.js untuk Diagram Bulat -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        const savedTheme = localStorage.getItem('theme') || localStorage.getItem('darkMode') || localStorage.getItem('mode');
        if (savedTheme === 'dark' || savedTheme === 'true') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
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

    <!-- Header -->
    <div class="bg-livin-header">
        <h5 class="fw-bold mb-0 text-white"><i class="bi bi-speedometer2 me-2"></i> Limit & Statistik Anggaran</h5>
        <small class="text-white-50">Monitor batas pengeluaran dan sisa duit bulananmu.</small>
    </div>

    <div class="container px-3 overlap-card">
        
        <?= $this->session->flashdata('pesan'); ?>

        <!-- KARTU STATISTIK & DIAGRAM BULAT -->
        <div class="card-livin p-4 mb-4 text-center">
            <h6 class="fw-bold text-dark mb-3">Diagram Pengeluaran Bulan Ini</h6>
            
            <!-- Elemen Kanvas Chart.js -->
            <div style="max-width: 220px; margin: 0 auto; position: relative;">
                <canvas id="limitChart"></canvas>
            </div>

            <div class="row mt-4 pt-3 border-top g-2">
                <div class="col-4">
                    <span class="text-muted small d-block">Limit</span>
                    <span class="fw-bold text-dark small">Rp <?= number_format($limit, 0, ',', '.'); ?></span>
                </div>
                <div class="col-4">
                    <span class="text-muted small d-block">Terpakai</span>
                    <span class="fw-bold text-danger small">Rp <?= number_format($total_pengeluaran, 0, ',', '.'); ?></span>
                </div>
                <div class="col-4">
                    <span class="text-muted small d-block">Sisa Duit</span>
                    <span class="fw-bold <?= ($persentase >= 80) ? 'text-danger' : 'text-success'; ?> small">Rp <?= number_format($sisa_limit, 0, ',', '.'); ?></span>
                </div>
            </div>
        </div>

        <!-- REDZONE WARNING ALERT -->
        <?php if($persentase >= 90): ?>
        <div class="alert alert-danger border-0 shadow-sm rounded-4 d-flex align-items-center mb-4 p-3 animate-pulse" role="alert" style="background-color: #fceaea; color: #dc3545;">
            <i class="bi bi-exclamation-octagon-fill fs-3 me-3"></i>
            <div>
                <h6 class="fw-bold mb-0" style="font-size: 13px;">REDZONE KRITIS!</h6>
                <span class="small" style="font-size: 11px;">Pengeluaranmu sudah sangat mepet atau melampaui batas limit! Segera kurangi pengeluaran.</span>
            </div>
        </div>
        <?php elseif($persentase >= 80): ?>
        <div class="alert alert-warning border-0 shadow-sm rounded-4 d-flex align-items-center mb-4 p-3" role="alert" style="background-color: #fff4e5; color: #d97706;">
            <i class="bi bi-exclamation-triangle-fill fs-3 me-3"></i>
            <div>
                <h6 class="fw-bold mb-0" style="font-size: 13px;">ZONA WASPADA (MEPET LIMIT)!</h6>
                <span class="small" style="font-size: 11px;">Pengeluaranmu sudah mencapai lebih dari 80% dari total limit. Hati-hati boros!</span>
            </div>
        </div>
        <?php endif; ?>

        <!-- FORM ATUR LIMIT PENGELUARAN -->
        <div class="card-livin p-4 mb-4">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-sliders text-primary me-2"></i> Perbarui Limit Pengeluaran</h6>
            <form action="<?= base_url('limit/update'); ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">Nominal Limit Baru (Rp)</label>
                    <input type="number" name="limit_pengeluaran" class="form-control input-livin" value="<?= $limit; ?>" min="0" required placeholder="Contoh: 2500000">
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 rounded-pill" style="background-color: #005E9D; border:none;">Simpan Perubahan Limit</button>
            </form>
        </div>

    </div>

    <!-- SCRIPT RENDER CHART.JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('limitChart').getContext('2d');
            
            let terpakai = <?= $total_pengeluaran; ?>;
            let sisa = <?= $sisa_limit; ?>;
            let persentase = <?= $persentase; ?>;

            // Warna berubah otomatis ke Oranye / Merah jika masuk Redzone
            let warnaTerpakai = '#005E9D'; // Biru standar
            if (persentase >= 90) {
                warnaTerpakai = '#dc3545'; // Merah Kritis
            } else if (persentase >= 80) {
                warnaTerpakai = '#f59e0b'; // Oranye Waspada
            }

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Terpakai', 'Sisa Duit'],
                    datasets: [{
                        data: [terpakai, sisa],
                        backgroundColor: [warnaTerpakai, '#e9ecef'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: {
                                    size: 11,
                                    family: 'Nunito'
                                }
                            }
                        }
                    },
                    cutout: '75%'
                }
            });
        });
    </script>
</body>
</html>