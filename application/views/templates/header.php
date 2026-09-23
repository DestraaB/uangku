<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uangku - ala Livin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Script pencegah kedip putih saat refresh halaman -->
    <script>
        const savedTheme = localStorage.getItem('uangku_theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>

    <style>
        /* =====================================================
           TEMA TERANG (BAWAAN) & ANIMASI HALAMAN
        ====================================================== */
        :root {
            --livin-blue: #005E9D; 
            --livin-light: #F4F6F9;
            --livin-text: #2C3E50;
        }
        body {
            background-color: var(--livin-light);
            font-family: 'Nunito', sans-serif;
            color: var(--livin-text);
            animation: pageFadeIn 0.5s ease-out forwards;
            /* Efek transisi mulus saat warna background berubah */
            transition: background-color 0.4s ease, color 0.4s ease; 
        }
        
        @keyframes pageFadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        
        .anim-1 { animation: slideUp 0.5s ease-out 0.1s both; }
        .anim-2 { animation: slideUp 0.5s ease-out 0.2s both; }
        .anim-3 { animation: slideUp 0.5s ease-out 0.3s both; }

        .bg-livin { background-color: var(--livin-blue) !important; color: white; transition: background-color 0.4s ease; }
        .text-livin { color: var(--livin-blue) !important; }
        .btn-livin { background-color: var(--livin-blue); color: white; border-radius: 50rem; font-weight: 700; padding: 12px; }
        
        .card-livin { border: none; border-radius: 1.5rem; box-shadow: 0 8px 24px rgba(0,0,0,0.06); background: white; transition: background-color 0.4s ease, border-color 0.4s ease; }
        .input-livin { border-radius: 1rem; background-color: #F8F9FA; border: 1px solid #E9ECEF; padding: 12px 16px; font-weight: 600; transition: background-color 0.4s ease, color 0.4s ease;}
        
        .header-curve { border-bottom-left-radius: 2rem; border-bottom-right-radius: 2rem; padding-bottom: 3.5rem; transition: background-color 0.4s ease; }
        .overlap-card { margin-top: -45px; }

        .avatar-initial { width: 45px; height: 45px; background: #E9ECEF; color: var(--livin-text); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; transition: background-color 0.4s ease, color 0.4s ease; }

        /* =====================================================
           DARK MODE GLOBAL
        ====================================================== */
        [data-theme="dark"] body { background-color: #121212 !important; color: #e4e6eb !important; }
        [data-theme="dark"] .bg-white, 
        [data-theme="dark"] .card-livin, 
        [data-theme="dark"] .bottom-nav,
        [data-theme="dark"] .modal-content,
        [data-theme="dark"] .auth-card { background-color: #242526 !important; border-color: #3a3b3c !important; }
        [data-theme="dark"] .text-dark { color: #e4e6eb !important; }
        [data-theme="dark"] .text-muted { color: #b0b3b8 !important; }
        [data-theme="dark"] .border-bottom { border-color: #3a3b3c !important; }
        [data-theme="dark"] .header-curve, 
        [data-theme="dark"] .bg-livin { background-color: #0b192c !important; }
        [data-theme="dark"] .avatar-initial { background-color: #3a3b3c !important; color: #e4e6eb !important; }
        [data-theme="dark"] .input-livin { background-color: #3a3b3c !important; border-color: #555 !important; color: #fff !important; }
        [data-theme="dark"] .bg-white, 
        [data-theme="dark"] .card-livin, 
        [data-theme="dark"] .bottom-nav,
        [data-theme="dark"] .modal-content,
        [data-theme="dark"] .auth-card,
        [data-theme="dark"] .list-group-item { 
            background-color: #242526 !important; 
            border-color: #3a3b3c !important; 
        }

        /* =====================================================
           SWITCH TEMA ANIMASI LUCU & MEMANTUL (BOUNCY)
        ====================================================== */
        .floating-theme-switch {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
        .theme-switch { display: inline-block; width: 66px; height: 34px; position: relative; }
        .theme-switch input { opacity: 0; width: 0; height: 0; }
        .slider {
            position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
            background-color: #87CEEB; /* Warna Siang */
            transition: .4s; border-radius: 34px;
            display: flex; align-items: center; justify-content: space-between; padding: 0 8px;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .slider .sun { color: #FFD700; font-size: 16px; transition: 0.4s; z-index: 1; transform: translateY(0); }
        .slider .moon { color: #F4F6F9; font-size: 14px; transition: 0.4s; z-index: 1; transform: translateY(0); }
        
        .slider:before {
            position: absolute; content: ""; height: 26px; width: 26px;
            left: 4px; bottom: 4px; background-color: white;
            /* Efek jelly / memantul */
            transition: 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55); 
            border-radius: 50%; z-index: 2;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        /* Kondisi Malam */
        input:checked + .slider { background-color: #2C3E50; /* Warna Malam */ }
        input:checked + .slider:before { transform: translateX(32px); background-color: #F4F6F9; }
        
        /* Animasi Ikon menghilang/muncul */
        input:checked + .slider .sun { opacity: 0; transform: translateY(15px) scale(0.5); }
        input:not(:checked) + .slider .moon { opacity: 0; transform: translateY(-15px) scale(0.5); }
    </style>
</head>
<body>
    
    <!-- Elemen Tombol Mengambang (Langsung dirender setelah body terbuka) -->
    <div class="floating-theme-switch anim-1">
        <label class="theme-switch" for="checkbox-theme">
            <input type="checkbox" id="checkbox-theme" />
            <div class="slider">
                <i class="bi bi-moon-stars-fill moon"></i>
                <i class="bi bi-sun-fill sun"></i>
            </div>
        </label>
    </div>

    <!-- Script Pemicu Switch -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const themeToggle = document.getElementById('checkbox-theme');
            const currentTheme = document.documentElement.getAttribute('data-theme');
            
            // Cocokkan status tombol dengan memori tema saat halaman pertama dimuat
            if (currentTheme === 'dark') {
                themeToggle.checked = true;
            }

            // Ganti tema secara live saat tombol digeser
            themeToggle.addEventListener('change', function(e) {
                if (e.target.checked) {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('uangku_theme', 'dark');
                } else {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('uangku_theme', 'light');
                }
            });
        });
    </script>