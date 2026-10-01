<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Pemasukan</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <script>
        // Membaca status saklar terbaru dari sistem
        const savedTheme = localStorage.getItem('uangku_theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>

    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: 0; background: #f6f8fa; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #20252b; }
        .expense-page { min-height: 100vh; padding-bottom: 120px; background: #f6f8fa; }
        
        /* DARK MODE */
        [data-theme="dark"] body, [data-theme="dark"] .expense-page { background: #121212 !important; color: #e4e6eb !important; }
        [data-theme="dark"] .expense-header { background: #1e1e1e !important; border-bottom: 1px solid #333 !important; }
        [data-theme="dark"] .expense-header h5, [data-theme="dark"] .expense-close { color: #e4e6eb !important; }
        [data-theme="dark"] .expense-close:hover { background: #333 !important; }
        [data-theme="dark"] .field-label, [data-theme="dark"] .section-title { color: #b0b3b8 !important; }
        
        [data-theme="dark"] .nominal-box, [data-theme="dark"] .category-card, 
        [data-theme="dark"] .input-modern, [data-theme="dark"] .textarea-modern { background: #242526 !important; border-color: #3a3b3c !important; }
        
        [data-theme="dark"] .nominal-box input, [data-theme="dark"] .input-modern input, [data-theme="dark"] .textarea-modern textarea { color: #e4e6eb !important; }
        [data-theme="dark"] .nominal-box input::placeholder, [data-theme="dark"] .textarea-modern textarea::placeholder { color: #6c757d !important; }
        
        [data-theme="dark"] .category-info strong { color: #e4e6eb !important; }
        [data-theme="dark"] .category-info span { color: #b0b3b8 !important; }
        
        /* Kategori Pemasukan Dark Mode */
        [data-theme="dark"] .category-primary { background: #163323 !important; color: #4cd98b !important; }
        [data-theme="dark"] .category-secondary { background: #3d2c18 !important; color: #ffb74d !important; }
        [data-theme="dark"] .category-tertiary { background: #1a2f4d !important; color: #6bb0ff !important; }
        [data-theme="dark"] .category-card:hover { border-color: #29935b !important; background: #1e2830 !important; }
        [data-theme="dark"] .category-card.selected { background: #163323 !important; border-color: #29935b !important; }

        /* HEADER & CONTAINER */
        .expense-header { height: 65px; background: #ffffff; display: flex; align-items: center; padding: 0 20px; border-bottom: 1px solid #edf0f2; position: sticky; top: 0; z-index: 100; }
        .expense-header h5 { margin: 0; font-size: 21px; font-weight: 700; }
        .expense-close { width: 36px; height: 36px; margin-right: 6px; display: flex; align-items: center; justify-content: center; color: #20252b; text-decoration: none; border-radius: 50%; transition: .2s ease; }
        .expense-close:hover { background: #f1f3f5; transform: rotate(90deg); }
        .expense-container { max-width: 760px; margin: 0 auto; padding: 28px 22px 40px; }

        /* FORM ELEMENTS */
        .field-label, .section-title { display: block; margin-bottom: 10px; font-size: 14px; font-weight: 700; color: #68727d; }
        .section-title span { margin-left: 5px; font-weight: 500; color: #9aa2aa; }
        .form-section { margin-bottom: 26px; }

        /* Nominal - Warna Hijau untuk Pemasukan */
        .nominal-section { margin-bottom: 30px; text-align: center; }
        .nominal-box { min-height: 105px; display: flex; align-items: center; justify-content: center; padding: 10px 25px; background: #ffffff; border: 2px solid transparent; border-radius: 24px; box-shadow: 0 8px 25px rgba(0, 0, 0, .05); transition: .25s ease; }
        .nominal-box:focus-within { border-color: #29935b; box-shadow: 0 8px 30px rgba(41, 147, 91, .12); }
        .nominal-prefix { margin-right: 8px; font-size: 24px; font-weight: 700; color: #29935b; }
        .nominal-box input { width: 100%; border: 0; outline: 0; background: transparent; text-align: center; font-size: 40px; font-weight: 800; color: #242a30; }
        .nominal-box input::placeholder { color: #c8cdd2; }
        .nominal-box input::-webkit-inner-spin-button, .nominal-box input::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }

        /* Kategori Pemasukan */
        .category-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .category-card { position: relative; border: 2px solid #e9edf0; background: #ffffff; border-radius: 20px; padding: 16px 12px; text-align: left; cursor: pointer; transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease, background .2s ease; }
        .category-card:hover { transform: translateY(-3px); border-color: #b8e8c8; box-shadow: 0 8px 20px rgba(0, 0, 0, .06); }
        .category-card.selected { border-color: #29935b; background: #f1fcf5; box-shadow: 0 8px 22px rgba(41, 147, 91, .12); }
        .category-icon { width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px; border-radius: 14px; font-size: 20px; }
        .category-primary { background: #e9f6ee; color: #29935b; }
        .category-secondary { background: #fff4e5; color: #f59e0b; }
        .category-tertiary { background: #edf4ff; color: #3978c9; }
        .category-info strong { display: block; margin-bottom: 3px; font-size: 14px; color: #20252b; }
        .category-info span { display: block; font-size: 11px; line-height: 1.3; color: #8a939c; }
        .category-check { position: absolute; top: 12px; right: 12px; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #29935b; color: #ffffff; font-size: 12px; opacity: 0; transform: scale(.5); transition: .2s ease; }
        .category-card.selected .category-check { opacity: 1; transform: scale(1); }
        .category-hidden-select { position: absolute; width: 1px; height: 1px; opacity: 0; pointer-events: none; }

        /* Input Tanggal & Textarea */
        .input-modern, .textarea-modern { padding: 0 17px; background: #ffffff; border: 1px solid #e5eaee; border-radius: 18px; transition: .2s ease; }
        .input-modern { min-height: 58px; display: flex; align-items: center; }
        .textarea-modern { padding: 14px 17px; }
        .input-modern:focus-within, .textarea-modern:focus-within { border-color: #29935b; box-shadow: 0 5px 18px rgba(41, 147, 91, .08); }
        .input-modern i { margin-right: 12px; color: #29935b; font-size: 20px; }
        .input-modern input, .textarea-modern textarea { width: 100%; border: 0; outline: 0; background: transparent; font-size: 14px; color: #303840; }
        .textarea-modern textarea { resize: vertical; }
        .textarea-modern textarea::placeholder { color: #a6adb3; }

        /* Tombol Simpan - Hijau */
        .save-section { margin-top: 35px; margin-bottom: 20px; }
        .save-button { width: 100%; min-height: 62px; display: flex; align-items: center; padding: 8px 10px; border: 0; border-radius: 20px; background: #29935b; color: #ffffff; font-size: 15px; font-weight: 700; cursor: pointer; box-shadow: 0 10px 25px rgba(41, 147, 91, .22); transition: transform .2s ease, box-shadow .2s ease, background .2s ease; }
        .save-button:hover { background: #227a4b; transform: translateY(-2px); box-shadow: 0 13px 30px rgba(41, 147, 91, .28); }
        .save-icon { width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; border-radius: 14px; background: rgba(255,255,255,.2); font-size: 21px; }
        .save-button > span:nth-child(2) { flex: 1; text-align: center; }
        .save-arrow { width: 44px; font-size: 20px; transition: transform .2s ease; }
        .save-button:hover .save-arrow { transform: translateX(4px); }

        @media (max-width: 600px) {
            .expense-container { padding: 22px 16px 35px; }
            .nominal-box { min-height: 95px; border-radius: 21px; }
            .nominal-box input { font-size: 34px; }
            .category-grid { grid-template-columns: 1fr; gap: 10px; }
            .category-card { min-height: 76px; display: flex; align-items: center; padding: 12px; }
            .category-icon { margin-right: 12px; margin-bottom: 0; }
            .category-info { flex: 1; }
            .category-check { position: static; margin-left: 10px; }
        }
    </style>
</head>
<body>

<div class="expense-page">
    <div class="expense-header">
        <a href="<?= base_url('home'); ?>" class="expense-close"><i class="bi bi-x-lg"></i></a>
        <h5>Uang Masuk</h5>
    </div>

    <div class="expense-container">
        <form action="<?= base_url('pemasukan/simpan'); ?>" method="post" id="incomeForm">

            <!-- NOMINAL -->
            <div class="nominal-section">
                <span class="field-label">Nominal Pendapatan</span>
                <div class="nominal-box">
                    <span class="nominal-prefix">Rp</span>
                    <input type="number" name="nominal" id="nominal" placeholder="0" min="0" required>
                </div>
            </div>

            <!-- SUMBER (KATEGORI) -->
            <div class="form-section">
                <div class="section-title">Sumber Dana</div>
                <div class="category-grid">
                    <button type="button" class="category-card" data-value="Gaji">
                        <div class="category-icon category-primary"><i class="bi bi-cash-stack"></i></div>
                        <div class="category-info">
                            <strong>Gaji / Bulanan</strong>
                            <span>Pendapatan rutin</span>
                        </div>
                        <div class="category-check"><i class="bi bi-check"></i></div>
                    </button>
                    
                    <button type="button" class="category-card" data-value="Bonus">
                        <div class="category-icon category-secondary"><i class="bi bi-gift"></i></div>
                        <div class="category-info">
                            <strong>Bonus</strong>
                            <span>Uang kaget/hadiah</span>
                        </div>
                        <div class="category-check"><i class="bi bi-check"></i></div>
                    </button>
                    
                    <button type="button" class="category-card" data-value="Lainnya">
                        <div class="category-icon category-tertiary"><i class="bi bi-wallet2"></i></div>
                        <div class="category-info">
                            <strong>Lainnya</strong>
                            <span>Sumber lainnya</span>
                        </div>
                        <div class="category-check"><i class="bi bi-check"></i></div>
                    </button>
                </div>

                <select name="sumber" id="sumber_dana" class="category-hidden-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="Gaji">Gaji / Bulanan</option>
                    <option value="Bonus">Bonus</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <!-- TANGGAL -->
            <div class="form-section">
                <div class="section-title">Tanggal Masuk</div>
                <div class="input-modern">
                    <i class="bi bi-calendar3"></i>
                    <input type="date" name="tanggal" value="<?= date('Y-m-d'); ?>" required>
                </div>
            </div>

            <!-- CATATAN -->
            <div class="form-section">
                <div class="section-title">Catatan <span>Opsional</span></div>
                <div class="textarea-modern">
                    <textarea name="deskripsi" rows="3" placeholder="Tulis catatan (misal: Gaji bulan Oktober)..."></textarea>
                </div>
            </div>

            <!-- SIMPAN -->
            <div class="save-section">
                <button type="submit" class="save-button" id="saveButton">
                    <span class="save-icon"><i class="bi bi-check2"></i></span>
                    <span>Simpan Pemasukan</span>
                    <i class="bi bi-arrow-right save-arrow"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categoryCards = document.querySelectorAll('.category-card');
    const sourceSelect = document.getElementById('sumber_dana');

    categoryCards.forEach(function (card) {
        card.addEventListener('click', function () {
            const value = this.getAttribute('data-value');
            categoryCards.forEach(function (item) { item.classList.remove('selected'); });
            this.classList.add('selected');
            sourceSelect.value = value;
            this.animate([
                { transform: 'scale(.97)' },
                { transform: 'scale(1)' }
            ], { duration: 180, easing: 'ease-out' });
        });
    });

    const form = document.getElementById('incomeForm');
    const saveButton = document.getElementById('saveButton');
    form.addEventListener('submit', function () {
        saveButton.style.opacity = '0.7';
        saveButton.querySelector('span:nth-child(2)').textContent = 'Menyimpan...';
    });
});
</script>
</body>
</html>