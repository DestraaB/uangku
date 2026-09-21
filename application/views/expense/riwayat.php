<div class="container mt-4 mb-5 pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Semua Riwayat</h3>
        <a href="<?= base_url('home') ?>" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>

    <div class="list-group shadow-sm">
        <?php foreach($semua_riwayat as $row): ?>
        <div class="list-group-item d-flex justify-content-between align-items-center py-3">
            <div>
                <h6 class="mb-1 fw-bold"><?= $row->nama_kategori; ?></h6>
                <small class="text-muted d-block"><?= date('d M Y', strtotime($row->tanggal)); ?></small>
                <?php if(!empty($row->deskripsi)): ?>
                    <small class="text-secondary"><?= $row->deskripsi; ?></small>
                <?php endif; ?>
            </div>
            
            <div class="text-end">
                <h6 class="mb-1 text-danger fw-bold">- Rp <?= number_format($row->nominal, 0, ',', '.'); ?></h6>
                <button type="button" class="btn btn-sm btn-outline-secondary mt-1" data-bs-toggle="modal" data-bs-target="#strukModalRiwayat<?= $row->id_expense; ?>">
                    <i class="bi bi-receipt"></i> Struk
                </button>
            </div>
        </div>

        <!-- Modal Pop-up Struk -->
        <div class="modal fade" id="strukModalRiwayat<?= $row->id_expense; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Struk Tanggal <?= date('d M', strtotime($row->tanggal)); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="<?= base_url('uploads/struk/'.$row->foto_struk); ?>" class="img-fluid rounded shadow-sm" alt="Foto Struk">
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
        <?php if(empty($semua_riwayat)): ?>
            <div class="text-center text-muted my-4">Belum ada riwayat transaksi.</div>
        <?php endif; ?>
    </div>
</div>