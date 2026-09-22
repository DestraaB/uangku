<!DOCTYPE html>
<html lang="id">
<div class="container-fluid p-0 mb-5 pb-5 bg-white" style="min-height: 100vh;">
    <div class="d-flex align-items-center p-3 text-dark border-bottom anim-1">
        <a href="<?= base_url('home') ?>" class="text-dark me-3"><i class="bi bi-x-lg fs-5"></i></a>
        <h5 class="mb-0 fw-bold">Catat Pengeluaran</h5>
    </div>

    <div class="container mt-4 anim-2">
        <?= $this->session->flashdata('pesan'); ?>
        <form action="<?= base_url('expense/simpan_pengeluaran') ?>" method="post" enctype="multipart/form-data">
            
            <div class="mb-4 text-center">
                <small class="text-muted fw-bold d-block mb-2">Nominal</small>
                <input type="number" name="nominal" class="form-control input-livin text-center fs-2 fw-bold text-livin border-0 bg-light" placeholder="Rp 0" required style="height: 80px;">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Pilih Kategori</label>
                <select name="id_kategori" class="form-select input-livin" required>
                    <option value="">-- Pilih --</option>
                    <option value="1">Primer (Kebutuhan Pokok)</option>
                    <option value="2">Sekunder (Tambahan)</option>
                    <option value="3">Tersier (Hiburan)</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Upload Struk</label>
                <input type="file" name="foto_struk" class="form-control input-livin" accept="image/*" capture="environment" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Tanggal</label>
                <input type="date" name="tanggal" class="form-control input-livin" value="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold small text-muted">Catatan (Opsional)</label>
                <textarea name="deskripsi" class="form-control input-livin" rows="2" placeholder="Tulis catatan..."></textarea>
            </div>

            <div class="d-grid mt-5">
                <button type="submit" class="btn btn-livin shadow-sm">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>

</html>