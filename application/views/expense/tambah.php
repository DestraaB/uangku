<!-- Pastikan framework CSS (seperti Bootstrap) sudah di-load di header -->
<div class="container mt-4 mb-5">
    <h3 class="mb-4 text-center">Catat Pengeluaran Uangku</h3>

    <!-- Tempat memunculkan notifikasi sukses/gagal dari Controller -->
    <?= $this->session->flashdata('pesan'); ?>

    <!-- Atribut enctype WAJIB ada agar gambar bisa terkirim -->
    <form action="<?= base_url('expense/simpan_pengeluaran') ?>" method="post" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label class="form-label text-muted">Nominal (Rp)</label>
            <!-- Tipe number akan memunculkan keyboard angka di HP -->
            <input type="number" name="nominal" class="form-control form-control-lg" required placeholder="Contoh: 50000">
        </div>

        <div class="mb-3">
            <label class="form-label text-muted">Kategori</label>
            <select name="id_kategori" class="form-select form-select-lg" required>
                <option value="">-- Pilih Kategori --</option>
                <!-- Value disesuaikan dengan ID di tabel categories -->
                <option value="1">Primer (Kebutuhan Pokok)</option>
                <option value="2">Sekunder (Kebutuhan Tambahan)</option>
                <option value="3">Tersier (Hiburan/Lainnya)</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label text-muted">Foto Struk</label>
            <!-- Atribut capture="environment" otomatis membuka kamera belakang HP -->
            <input type="file" name="foto_struk" class="form-control form-control-lg" accept="image/*" capture="environment" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-muted">Tanggal</label>
            <input type="date" name="tanggal" class="form-control form-control-lg" value="<?= date('Y-m-d') ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label text-muted">Keterangan (Opsional)</label>
            <textarea name="deskripsi" class="form-control" rows="2" placeholder="Beli makan siang..."></textarea>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">Simpan Pengeluaran</button>
        </div>
    </form>
</div>