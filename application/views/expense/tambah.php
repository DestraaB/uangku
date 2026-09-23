<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catat Pengeluaran</title>

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>

        /* =====================================================
           RESET
        ====================================================== */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;

            background: #f6f8fa;

            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            color: #20252b;
        }


        /* =====================================================
           PAGE
        ====================================================== */

        .expense-page {
            min-height: 100vh;

            padding-bottom: 120px;

            background: #f6f8fa;
        }


        /* =====================================================
           HEADER
        ====================================================== */

        .expense-header {
            height: 65px;

            background: #ffffff;

            display: flex;
            align-items: center;

            padding: 0 20px;

            border-bottom: 1px solid #edf0f2;

            position: sticky;
            top: 0;

            z-index: 100;
        }

        .expense-header h5 {
            margin: 0;

            font-size: 21px;
            font-weight: 700;
        }

        .expense-close {
            width: 36px;
            height: 36px;

            margin-right: 6px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #20252b;

            text-decoration: none;

            border-radius: 50%;

            transition: .2s ease;
        }

        .expense-close:hover {
            background: #f1f3f5;

            transform: rotate(90deg);
        }


        /* =====================================================
           CONTAINER
        ====================================================== */

        .expense-container {
            max-width: 760px;

            margin: 0 auto;

            padding: 28px 22px 40px;
        }


        /* =====================================================
           LABEL
        ====================================================== */

        .field-label,
        .section-title {
            display: block;

            margin-bottom: 10px;

            font-size: 14px;

            font-weight: 700;

            color: #68727d;
        }

        .section-title span {
            margin-left: 5px;

            font-weight: 500;

            color: #9aa2aa;
        }


        /* =====================================================
           NOMINAL
        ====================================================== */

        .nominal-section {
            margin-bottom: 30px;

            text-align: center;
        }

        .nominal-box {
            min-height: 105px;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 10px 25px;

            background: #ffffff;

            border: 2px solid transparent;

            border-radius: 24px;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, .05);

            transition: .25s ease;
        }

        .nominal-box:focus-within {
            border-color: #0068a8;

            box-shadow:
                0 8px 30px rgba(0, 104, 168, .12);
        }

        .nominal-prefix {
            margin-right: 8px;

            font-size: 24px;

            font-weight: 700;

            color: #0068a8;
        }

        .nominal-box input {
            width: 100%;

            border: 0;
            outline: 0;

            background: transparent;

            text-align: center;

            font-size: 40px;
            font-weight: 800;

            color: #242a30;
        }

        .nominal-box input::placeholder {
            color: #c8cdd2;
        }

        .nominal-box input::-webkit-inner-spin-button,
        .nominal-box input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }


        /* =====================================================
           FORM SECTION
        ====================================================== */

        .form-section {
            margin-bottom: 26px;
        }


        /* =====================================================
           CATEGORY
        ====================================================== */

        .category-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 12px;
        }

        .category-card {
            position: relative;

            border: 2px solid #e9edf0;

            background: #ffffff;

            border-radius: 20px;

            padding: 16px 12px;

            text-align: left;

            cursor: pointer;

            transition:
                transform .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .category-card:hover {
            transform: translateY(-3px);

            border-color: #b8d8e8;

            box-shadow:
                0 8px 20px rgba(0, 0, 0, .06);
        }

        .category-card.selected {
            border-color: #0068a8;

            background: #f1f9fd;

            box-shadow:
                0 8px 22px rgba(0, 104, 168, .12);
        }

        .category-icon {
            width: 44px;
            height: 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 12px;

            border-radius: 14px;

            font-size: 20px;
        }

        .category-primary {
            background: #e9f6ee;
            color: #29935b;
        }

        .category-secondary {
            background: #edf4ff;
            color: #3978c9;
        }

        .category-tertiary {
            background: #fff1e8;
            color: #e77c38;
        }

        .category-info strong {
            display: block;

            margin-bottom: 3px;

            font-size: 14px;

            color: #20252b;
        }

        .category-info span {
            display: block;

            font-size: 11px;

            line-height: 1.3;

            color: #8a939c;
        }

        .category-check {
            position: absolute;

            top: 12px;
            right: 12px;

            width: 22px;
            height: 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #0068a8;

            color: #ffffff;

            font-size: 12px;

            opacity: 0;

            transform: scale(.5);

            transition: .2s ease;
        }

        .category-card.selected .category-check {
            opacity: 1;

            transform: scale(1);
        }

        .category-hidden-select {
            position: absolute;

            width: 1px;
            height: 1px;

            opacity: 0;

            pointer-events: none;
        }


        /* =====================================================
           UPLOAD STRUK
        ====================================================== */

        .receipt-upload {
            position: relative;

            display: block;

            width: 100%;

            min-height: 125px;

            background: #ffffff;

            border: 2px dashed #cbd7df;

            border-radius: 22px;

            cursor: pointer;

            overflow: hidden;

            transition:
                border-color .25s ease,
                background .25s ease,
                transform .2s ease,
                box-shadow .25s ease;
        }

        .receipt-upload:hover {
            border-color: #0068a8;

            background: #f7fcff;

            box-shadow:
                0 8px 25px rgba(0, 104, 168, .08);

            transform: translateY(-2px);
        }

        .receipt-upload:active {
            transform: scale(.99);
        }

        .receipt-upload input {
            display: none;
        }


        /* =====================================================
           UPLOAD DEFAULT
        ====================================================== */

        .upload-content {
            min-height: 125px;

            display: flex;
            align-items: center;

            padding: 20px;
        }

        .upload-icon {
            width: 58px;
            height: 58px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 18px;

            background: #eaf6fc;

            color: #0068a8;

            font-size: 27px;

            transition: .25s ease;
        }

        .receipt-upload:hover .upload-icon {
            transform:
                translateY(-3px)
                scale(1.05);

            background: #dff1fa;
        }

        .upload-text {
            display: flex;
            flex-direction: column;

            margin-left: 15px;
        }

        .upload-text strong {
            margin-bottom: 5px;

            font-size: 14px;

            color: #27313a;
        }

        .upload-text span {
            font-size: 12px;

            color: #929ba3;
        }

        .upload-arrow {
            margin-left: auto;

            color: #aab3ba;

            font-size: 18px;
        }


        /* =====================================================
           PREVIEW
        ====================================================== */

        .upload-preview {
            min-height: 125px;

            display: flex;
            align-items: center;

            padding: 14px 18px;
        }

        .upload-preview img {
            width: 82px;
            height: 82px;

            border-radius: 16px;

            object-fit: cover;

            box-shadow:
                0 5px 15px rgba(0,0,0,.12);
        }

        .preview-info {
            display: flex;
            flex-direction: column;

            min-width: 0;

            margin-left: 15px;
        }

        .preview-info strong {
            max-width: 350px;

            overflow: hidden;

            white-space: nowrap;

            text-overflow: ellipsis;

            font-size: 13px;

            color: #27313a;
        }

        .preview-info span {
            margin-top: 5px;

            font-size: 11px;

            color: #8d979f;
        }

        .preview-check {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-left: auto;

            border-radius: 50%;

            background: #e7f7ee;

            color: #26945b;
        }


        /* =====================================================
           DATE
        ====================================================== */

        .input-modern {
            min-height: 58px;

            display: flex;
            align-items: center;

            padding: 0 17px;

            background: #ffffff;

            border: 1px solid #e5eaee;

            border-radius: 18px;

            transition: .2s ease;
        }

        .input-modern:focus-within {
            border-color: #0068a8;

            box-shadow:
                0 5px 18px rgba(0,104,168,.08);
        }

        .input-modern i {
            margin-right: 12px;

            color: #0068a8;

            font-size: 20px;
        }

        .input-modern input {
            width: 100%;

            border: 0;
            outline: 0;

            background: transparent;

            font-size: 14px;

            color: #303840;
        }


        /* =====================================================
           TEXTAREA
        ====================================================== */

        .textarea-modern {
            padding: 14px 17px;

            background: #ffffff;

            border: 1px solid #e5eaee;

            border-radius: 18px;

            transition: .2s ease;
        }

        .textarea-modern:focus-within {
            border-color: #0068a8;

            box-shadow:
                0 5px 18px rgba(0,104,168,.08);
        }

        .textarea-modern textarea {
            width: 100%;

            border: 0;
            outline: 0;

            resize: vertical;

            background: transparent;

            font-size: 14px;

            color: #303840;
        }

        .textarea-modern textarea::placeholder {
            color: #a6adb3;
        }


        /* =====================================================
           SAVE BUTTON
        ====================================================== */

        .save-section {
            margin-top: 35px;

            margin-bottom: 20px;
        }

        .save-button {
            width: 100%;

            min-height: 62px;

            display: flex;
            align-items: center;

            padding: 8px 10px;

            border: 0;

            border-radius: 20px;

            background: #0068a8;

            color: #ffffff;

            font-size: 15px;
            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 10px 25px rgba(0,104,168,.22);

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .save-button:hover {
            background: #005b94;

            transform: translateY(-2px);

            box-shadow:
                0 13px 30px rgba(0,104,168,.28);
        }

        .save-button:active {
            transform: scale(.98);
        }

        .save-icon {
            width: 44px;
            height: 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: rgba(255,255,255,.15);

            font-size: 21px;
        }

        .save-button > span:nth-child(2) {
            flex: 1;

            text-align: center;
        }

        .save-arrow {
            width: 44px;

            font-size: 20px;

            transition: transform .2s ease;
        }

        .save-button:hover .save-arrow {
            transform: translateX(4px);
        }


        /* =====================================================
           MOBILE
        ====================================================== */

        @media (max-width: 600px) {

            .expense-container {
                padding: 22px 16px 35px;
            }

            .expense-header {
                padding: 0 16px;
            }

            .expense-header h5 {
                font-size: 19px;
            }

            .nominal-box {
                min-height: 95px;

                border-radius: 21px;
            }

            .nominal-box input {
                font-size: 34px;
            }

            .category-grid {
                grid-template-columns: 1fr;

                gap: 10px;
            }

            .category-card {
                min-height: 76px;

                display: flex;
                align-items: center;

                padding: 12px;
            }

            .category-icon {
                margin-right: 12px;
                margin-bottom: 0;
            }

            .category-info {
                flex: 1;
            }

            .category-check {
                position: static;

                margin-left: 10px;
            }

            .receipt-upload {
                min-height: 110px;
            }

            .upload-content {
                min-height: 110px;

                padding: 15px;
            }

            .upload-icon {
                width: 50px;
                height: 50px;

                border-radius: 15px;

                font-size: 23px;
            }

            .upload-text strong {
                font-size: 13px;
            }

            .upload-text span {
                font-size: 11px;
            }

        }

    </style>

</head>


<body>

<div class="expense-page">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="expense-header">

        <a
            href="<?= base_url('home'); ?>"
            class="expense-close"
        >
            <i class="bi bi-x-lg"></i>
        </a>

        <h5>
            Catat Pengeluaran
        </h5>

    </div>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <div class="expense-container">

        <?= $this->session->flashdata('pesan'); ?>


        <form
            action="<?= base_url('expense/simpan_pengeluaran'); ?>"
            method="post"
            enctype="multipart/form-data"
            id="expenseForm"
        >


            <!-- =================================================
                 NOMINAL
            ================================================== -->

            <div class="nominal-section">

                <span class="field-label">
                    Nominal
                </span>

                <div class="nominal-box">

                    <span class="nominal-prefix">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="nominal"
                        id="nominal"
                        placeholder="0"
                        min="0"
                        required
                    >

                </div>

            </div>


            <!-- =================================================
                 KATEGORI
            ================================================== -->

            <div class="form-section">

                <div class="section-title">
                    Pilih Kategori
                </div>


                <div class="category-grid">


                    <!-- PRIMER -->

                    <button
                        type="button"
                        class="category-card"
                        data-value="1"
                    >

                        <div class="category-icon category-primary">
                            <i class="bi bi-cart3"></i>
                        </div>

                        <div class="category-info">

                            <strong>
                                Primer
                            </strong>

                            <span>
                                Kebutuhan pokok
                            </span>

                        </div>

                        <div class="category-check">
                            <i class="bi bi-check"></i>
                        </div>

                    </button>


                    <!-- SEKUNDER -->

                    <button
                        type="button"
                        class="category-card"
                        data-value="2"
                    >

                        <div class="category-icon category-secondary">
                            <i class="bi bi-bag"></i>
                        </div>

                        <div class="category-info">

                            <strong>
                                Sekunder
                            </strong>

                            <span>
                                Kebutuhan tambahan
                            </span>

                        </div>

                        <div class="category-check">
                            <i class="bi bi-check"></i>
                        </div>

                    </button>


                    <!-- TERSIER -->

                    <button
                        type="button"
                        class="category-card"
                        data-value="3"
                    >

                        <div class="category-icon category-tertiary">
                            <i class="bi bi-controller"></i>
                        </div>

                        <div class="category-info">

                            <strong>
                                Tersier
                            </strong>

                            <span>
                                Hiburan
                            </span>

                        </div>

                        <div class="category-check">
                            <i class="bi bi-check"></i>
                        </div>

                    </button>

                </div>


                <!-- SELECT ASLI UNTUK BACKEND -->

                <select
                    name="id_kategori"
                    id="id_kategori"
                    class="category-hidden-select"
                    required
                >

                    <option value="">
                        -- Pilih --
                    </option>

                    <option value="1">
                        Primer
                    </option>

                    <option value="2">
                        Sekunder
                    </option>

                    <option value="3">
                        Tersier
                    </option>

                </select>

            </div>


            <!-- =================================================
                 UPLOAD STRUK
            ================================================== -->

            <div class="form-section">

                <div class="section-title">
                    Upload Struk
                </div>


                <label
                    for="foto_struk"
                    class="receipt-upload"
                    id="receiptUpload"
                >


                    <!-- DEFAULT -->

                    <div
                        class="upload-content"
                        id="uploadDefault"
                    >

                        <div class="upload-icon">

                            <i class="bi bi-cloud-arrow-up"></i>

                        </div>


                        <div class="upload-text">

                            <strong>
                                Tambahkan foto struk
                            </strong>

                            <span>
                                Ketuk untuk memilih foto
                            </span>

                        </div>


                        <i
                            class="bi bi-chevron-right upload-arrow"
                        ></i>

                    </div>


                    <!-- PREVIEW -->

                    <div
                        class="upload-preview"
                        id="uploadPreview"
                        style="display: none;"
                    >

                        <img
                            id="previewImage"
                            src=""
                            alt="Preview struk"
                        >


                        <div class="preview-info">

                            <strong id="fileName">
                                Foto struk
                            </strong>

                            <span>
                                Ketuk untuk mengganti
                            </span>

                        </div>


                        <div class="preview-check">

                            <i class="bi bi-check-lg"></i>

                        </div>

                    </div>


                    <input
                        type="file"
                        name="foto_struk"
                        id="foto_struk"
                        accept="image/*"
                        capture="environment"
                        required
                    >

                </label>

            </div>


            <!-- =================================================
                 TANGGAL
            ================================================== -->

            <div class="form-section">

                <div class="section-title">
                    Tanggal
                </div>


                <div class="input-modern">

                    <i class="bi bi-calendar3"></i>

                    <input
                        type="date"
                        name="tanggal"
                        value="<?= date('Y-m-d'); ?>"
                        required
                    >

                </div>

            </div>


            <!-- =================================================
                 CATATAN
            ================================================== -->

            <div class="form-section">

                <div class="section-title">

                    Catatan

                    <span>
                        Opsional
                    </span>

                </div>


                <div class="textarea-modern">

                    <textarea
                        name="deskripsi"
                        rows="3"
                        placeholder="Tulis catatan tentang pengeluaran ini..."
                    ></textarea>

                </div>

            </div>


            <!-- =================================================
                 SIMPAN
            ================================================== -->

            <div class="save-section">

                <button
                    type="submit"
                    class="save-button"
                    id="saveButton"
                >

                    <span class="save-icon">

                        <i class="bi bi-check2"></i>

                    </span>


                    <span>
                        Simpan Transaksi
                    </span>


                    <i
                        class="bi bi-arrow-right save-arrow"
                    ></i>

                </button>

            </div>


        </form>

    </div>

</div>


<!-- =====================================================
     JAVASCRIPT
====================================================== -->

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       KATEGORI
    ====================================================== */

    const categoryCards =
        document.querySelectorAll('.category-card');

    const categorySelect =
        document.getElementById('id_kategori');


    categoryCards.forEach(function (card) {

        card.addEventListener('click', function () {

            const value =
                this.getAttribute('data-value');


            categoryCards.forEach(function (item) {

                item.classList.remove('selected');

            });


            this.classList.add('selected');


            categorySelect.value = value;


            this.animate(
                [
                    {
                        transform: 'scale(.97)'
                    },
                    {
                        transform: 'scale(1)'
                    }
                ],
                {
                    duration: 180,
                    easing: 'ease-out'
                }
            );

        });

    });


    /* =====================================================
       UPLOAD
    ====================================================== */

    const fileInput =
        document.getElementById('foto_struk');

    const uploadBox =
        document.getElementById('receiptUpload');

    const uploadDefault =
        document.getElementById('uploadDefault');

    const uploadPreview =
        document.getElementById('uploadPreview');

    const previewImage =
        document.getElementById('previewImage');

    const fileName =
        document.getElementById('fileName');


    fileInput.addEventListener('change', function () {

        const file = this.files[0];


        if (!file) {
            return;
        }


        if (!file.type.startsWith('image/')) {

            alert('Silakan pilih file gambar.');

            this.value = '';

            return;

        }


        const reader =
            new FileReader();


        reader.onload =
            function (event) {

                previewImage.src =
                    event.target.result;

                fileName.textContent =
                    file.name;

                uploadDefault.style.display =
                    'none';

                uploadPreview.style.display =
                    'flex';

                uploadBox.classList.add(
                    'has-file'
                );

            };


        reader.readAsDataURL(file);

    });


    /* =====================================================
       SUBMIT
    ====================================================== */

    const form =
        document.getElementById('expenseForm');

    const saveButton =
        document.getElementById('saveButton');


    form.addEventListener('submit', function () {

        saveButton.classList.add('loading');

        saveButton.querySelector(
            'span:nth-child(2)'
        ).textContent =
            'Menyimpan...';

    });

});

</script>


</body>
</html>