<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uangku - ala Livin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --livin-blue: #005E9D; 
            --livin-light: #F4F6F9;
            --livin-text: #2C3E50;
        }
body {
        background-color: var(--livin-light);
        font-family: 'Nunito', sans-serif;
        color: var(--livin-text);
        /* Efek animasi dipertahankan, tapi HANYA transparansinya agar fixed-bottom tidak rusak */
        animation: pageFadeIn 0.5s ease-out forwards;
    }
    
    @keyframes pageFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .anim-1 { animation: slideUp 0.5s ease-out 0.1s both; }
        .anim-2 { animation: slideUp 0.5s ease-out 0.2s both; }
        .anim-3 { animation: slideUp 0.5s ease-out 0.3s both; }

        .bg-livin { background-color: var(--livin-blue) !important; color: white; }
        .text-livin { color: var(--livin-blue) !important; }
        .btn-livin { background-color: var(--livin-blue); color: white; border-radius: 50rem; font-weight: 700; padding: 12px; }
        
        .card-livin { border: none; border-radius: 1.5rem; box-shadow: 0 8px 24px rgba(0,0,0,0.06); background: white; }
        .input-livin { border-radius: 1rem; background-color: #F8F9FA; border: 1px solid #E9ECEF; padding: 12px 16px; font-weight: 600;}
        
        .header-curve { border-bottom-left-radius: 2rem; border-bottom-right-radius: 2rem; padding-bottom: 3.5rem; }
        .overlap-card { margin-top: -45px; }

        .bottom-nav-livin { background: white; border-top-left-radius: 1.5rem; border-top-right-radius: 1.5rem; box-shadow: 0 -4px 20px rgba(0,0,0,0.05); }
        .nav-fab { width: 56px; height: 56px; background: var(--livin-blue); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; box-shadow: 0 6px 15px rgba(0, 94, 157, 0.4); transform: translateY(-20px); transition: all 0.3s ease;}
        
        .avatar-initial { width: 45px; height: 45px; background: #E9ECEF; color: var(--livin-text); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; }
    </style>
</head>
<body>
</html>