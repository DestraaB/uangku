<!DOCTYPE html>
<html lang="id">

<style>
    /* =====================================================
   RIWAYAT TRANSAKSI
===================================================== */

body {
    margin: 0;
    padding: 0;

    background: #f4f6f9;

    /* Ruang untuk bottom navigation */
    padding-bottom: 100px !important;
}


/* Header biru */

.header-curve {
    position: relative;

    min-height: 220px;

    border-radius: 0 0 35px 35px;
}


/* Card transaksi */

.overlap-card {
    position: relative;

    margin-top: -75px;

    z-index: 10;

    padding-bottom: 110px;
}


/* Card */

.card-livin {
    background: #ffffff;

    border-radius: 25px;

    overflow: hidden;
}


/* Item transaksi terakhir tidak perlu garis */

.card-livin > div:last-child {
    border-bottom: none !important;

    margin-bottom: 0 !important;
}


/* Avatar */

.avatar-initial {
    width: 56px;
    height: 56px;

    border-radius: 50%;

    background: #e9eef3;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #304254;

    font-size: 18px;
    font-weight: 700;

    flex-shrink: 0;
}
</style>

<div class="container-fluid p-0">

    <!-- =====================================================
         HEADER RIWAYAT
    ====================================================== -->
    <div class="bg-livin header-curve pt-4 px-3 text-center anim-1">

        <!-- Header / Tombol Kembali -->
        <div class="d-flex align-items-center justify-content-between text-white mb-2">

            <a href="<?= base_url('home'); ?>" class="text-white text-decoration-none">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>

            <h5 class="mb-0 fw-bold">
                Riwayat Transaksi
            </h5>

            <div style="width: 24px;"></div>

        </div>


        <!-- Total Keseluruhan -->
        <div class="mt-4 pb-5">

            <small class="text-white-50">
                Total Keseluruhan
            </small>

            <h2 class="text-white fw-bold mb-0">
                Rp <?= number_format($total_keseluruhan, 0, ',', '.'); ?>
            </h2>

        </div>

    </div>
    <!-- END HEADER -->


    <!-- =====================================================
         DAFTAR RIWAYAT
    ====================================================== -->
    <div class="container overlap-card anim-2">

        <div class="card-livin p-3 shadow-sm">

            <?php if (!empty($semua_riwayat)): ?>

                <?php foreach ($semua_riwayat as $row): ?>

                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">

                        <!-- KIRI -->
                        <div class="d-flex align-items-center">

                            <div class="avatar-initial me-3">
                                <?= strtoupper(substr($row->nama_kategori, 0, 2)); ?>
                            </div>

                            <div>

                                <h6
                                    class="mb-0 fw-bold text-dark"
                                    style="font-size: 14px;"
                                >
                                    <?= $row->nama_kategori; ?>
                                </h6>

                                <small
                                    class="text-muted"
                                    style="font-size: 11px;"
                                >
                                    <?= date('d M Y', strtotime($row->tanggal)); ?>
                                </small>

                            </div>

                        </div>


                        <!-- KANAN -->
                        <div class="text-end">

                            <span
                                class="fw-bold text-danger d-block mb-1"
                                style="font-size: 14px;"
                            >
                                - Rp <?= number_format($row->nominal, 0, ',', '.'); ?>
                            </span>


                            <!-- Tombol Struk -->
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-secondary"
                                style="font-size: 10px; border-radius: 50rem;"
                                data-bs-toggle="modal"
                                data-bs-target="#strukModalRiwayat<?= $row->id_expense; ?>"
                            >
                                Struk
                            </button>


                            <!-- Hapus -->
                            <a
                                href="<?= base_url('expense/hapus/' . $row->id_expense); ?>"
                                class="btn btn-sm btn-outline-danger"
                                style="font-size: 10px; border-radius: 50rem;"
                                onclick="return confirm('Hapus transaksi ini?')"
                            >
                                <i class="bi bi-trash"></i>
                            </a>

                        </div>

                    </div>


                    <!-- =================================================
                         MODAL STRUK
                         Taruh modal kamu di sini jika memang digunakan
                    ================================================== -->

                    <?php endforeach; ?>

            <?php else: ?>

                <!-- Jika belum ada transaksi -->
                <div class="text-center py-5">

                    <i
                        class="bi bi-receipt text-muted"
                        style="font-size: 45px;"
                    ></i>

                    <p class="text-muted mt-3 mb-0">
                        Belum ada transaksi.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>
    <!-- END DAFTAR RIWAYAT -->


</div>
<!-- END CONTAINER -->


<!-- =====================================================
     JAVASCRIPT
====================================================== -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>